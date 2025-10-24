<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Models\Program;
use App\Models\Faculty;
use App\Models\InterestForm;
use App\Models\ApplicationForm;
use App\Models\Student;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB; // <-- Import DB Transaction
use Illuminate\Validation\Rule; // <-- Import Rule

class FormController extends Controller
{
    /**
     * (GET) แสดงหน้าแบบฟอร์มสมัครเรียน (ดึงข้อมูลใหม่)
     */
    public function createApplicationForm(): View
    {
        $student = Auth::guard('student')->user();
        $faculty = Faculty::find(1); // คณะ STA
        
        // ดึงสาขาใหม่ (จาก Seeder ใหม่)
        $programs = Program::where('faculty_id', 1)->orderBy('program_name')->get();

        return view('student.application_form', compact('student', 'faculty', 'programs'));
    }

    /**
     * (POST) บันทึกข้อมูลจากแบบฟอร์มสมัครเรียน (Logic ใหม่ทั้งหมด)
     */
    public function storeApplicationForm(Request $request): RedirectResponse
    {
        // 1. Validation (ตรวจสอบข้อมูล)
        $request->validate([
            // Part 1: Personal (ยกเว้น email/phone/fullname ที่มีอยู่แล้ว)
            'prefix' => 'required|string|max:50',
            'id_card_number' => ['required', 'string', Rule::unique('students')->ignore(Auth::guard('student')->id(), 'student_id')],
            'dob' => 'required|date',
            'age' => 'required|integer|min:15',
            'nationality' => 'required|string|max:50',
            'ethnicity' => 'required|string|max:50',
            'religion' => 'required|string|max:50',
            'address_house_no' => 'required|string|max:100',
            'address_province' => 'required|string|max:100',
            'address_district' => 'required|string|max:100',
            'address_subdistrict' => 'required|string|max:100',
            'address_postal_code' => 'required|string|max:10',
            'parent_name' => 'required|string|max:100',
            'parent_phone' => 'required|string|max:20',
            'parent_relation' => 'required|string|max:50',
            
            // Part 2: Education
            'education_status' => 'required|string',
            'graduation_year' => ['nullable', 'required_if:education_status,สำเร็จการศึกษา ม.6/ปวช.', 'required_if:education_status,สำเร็จการศึกษา ปวส.', 'digits:4'],
            'school_name' => 'required|string|max:255',
            'school_province' => 'required|string|max:100',
            'school_major' => 'required|string|max:100',
            'gpax' => 'required|numeric|min:0|max:4.00',
            'gpax_type' => ['nullable', 'required_if:education_status,กำลังศึกษาอยู่ ม.6/ปวช.', 'required_if:education_status,กำลังศึกษาอยู่ ปวส.'],

            // Part 3: Program
            'faculty_id' => 'required|integer|exists:faculties,faculty_id',
            'program_id' => 'required|integer|exists:programs,program_id',

            // Part 4: Files
            'id_card_file' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'transcript_file' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'graduation_certificate_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'other_documents_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        // (ใช้ Transaction เพื่อความปลอดภัย ถ้าล้มเหลวจะ Rollback ทั้งหมด)
        DB::beginTransaction();
        try {
            // 2. อัปเดตข้อมูลส่วนตัว (Part 1) ลงในตาราง 'students'
            
            /** @var \App\Models\Student $student */ // <-- 1. เพิ่มบรรทัดนี้
            $student = Auth::guard('student')->user();
            
            // 2. บรรทัดนี้จะหายแดง
            $student->update($request->only([
                'prefix', 'id_card_number', 'dob', 'age', 'nationality', 'ethnicity',
                // ... (ข้อมูลอื่นๆ)
            ]));

            // 3. จัดการอัปโหลดไฟล์ (Part 4)
            $paths = [];
            $paths['id_card_file'] = $request->file('id_card_file')->store('id_cards', 'public');
            $paths['transcript_file'] = $request->file('transcript_file')->store('transcripts', 'public');
            
            if ($request->hasFile('graduation_certificate_file')) {
                $paths['graduation_certificate_file'] = $request->file('graduation_certificate_file')->store('grad_certs', 'public');
            }
            if ($request->hasFile('other_documents_file')) {
                $paths['other_documents_file'] = $request->file('other_documents_file')->store('other_docs', 'public');
            }

            // 4. บันทึกข้อมูลการสมัคร (Part 2, 3) ลง 'application_forms'
            ApplicationForm::create(array_merge(
                $request->only([
                    'faculty_id', 'program_id', 'education_status', 'graduation_year',
                    'school_name', 'school_province', 'school_major', 'gpax', 'gpax_type'
                ]),
                [
                    'student_id' => $student->student_id,
                    'status' => 'รอตรวจสอบ',
                    'submitted_at' => now(),
                ],
                $paths // (รวม Path ไฟล์ที่อัปโหลด)
            ));

            DB::commit(); // ยืนยันการบันทึก

            return redirect()->route('dashboard')
                         ->with('status', 'ยื่นใบสมัครเรียนฉบับสมบูรณ์เรียบร้อยแล้ว! (สถานะ: รอตรวจสอบ)');

        } catch (\Exception $e) {
            DB::rollBack(); // เกิดข้อผิดพลาด ให้ย้อนกลับ
            
            // (ลบไฟล์ที่อาจอัปโหลดไปแล้ว ถ้าเกิด Error)
            if (isset($paths)) {
                foreach ($paths as $path) { Storage::disk('public')->delete($path); }
            }
            
            return back()->withInput()->withErrors(['submit' => 'เกิดข้อผิดพลาดในการบันทึก: ' . $e->getMessage()]);
        }
    }

    // --- (ฟังก์ชันของ InterestForm (Part 5) ยังอยู่เหมือนเดิม) ---
    public function createInterestForm(): View
    {
        $student = Auth::guard('student')->user();
        // (ใช้ Program Seeder ใหม่)
        $programs = Program::where('faculty_id', 1)->orderBy('program_name')->get();
        return view('student.interest_form', compact('student', 'programs'));
    }

    /**
     * บันทึกข้อมูลจากแบบฟอร์มความสนใจ
     * [แก้ไข Logic ใหม่]
     */
    public function storeInterestForm(Request $request): RedirectResponse
    {
        // 1. กำหนด Choice ที่อนุญาตสำหรับ reason_choice
        $allowedReasons = ['รักการทดลอง', 'ชอบเขียนโค้ด', 'มีคนแนะนำ', 'อื่นๆ']; // <-- เพิ่ม/แก้ไข Choice ได้ตรงนี้

        // 2. ตรวจสอบความถูกต้อง (Validation)
        $request->validate([
            'program_id' => 'required|integer|exists:programs,program_id',
            'reason_choice' => ['required', 'string', Rule::in($allowedReasons)], // <-- ใช้ Rule::in ตรวจสอบ
            'reason_other' => ['nullable', 'required_if:reason_choice,อื่นๆ', 'string', 'max:1000'], // <-- บังคับกรอกถ้าเลือก "อื่นๆ"
        ]);

        // 3. บันทึกข้อมูลลง Database
        InterestForm::create([
            'student_id' => Auth::guard('student')->id(),
            'program_id' => $request->program_id,
            'reason_choice' => $request->reason_choice, // <-- บันทึก Choice หลัก
            'reason_other' => ($request->reason_choice === 'อื่นๆ') ? $request->reason_other : null, // <-- บันทึก "อื่นๆ" ถ้าเลือก
        ]);

        // 4. ส่งกลับไปหน้า Dashboard พร้อมข้อความสำเร็จ (เหมือนเดิม)
        return redirect()->route('dashboard')
                         ->with('status', 'บันทึกข้อมูลความสนใจเรียบร้อยแล้ว!');
    }
}