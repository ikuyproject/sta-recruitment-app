<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\InterestForm;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log; // เพิ่มการ import สำหรับการ log error

class InterestFormController extends Controller
{
    /**
     * (GET) Display the table of interest form submissions (Admin View).
     */
    public function index(): View
    {
        // 1. โค้ดเดิมของคุณสำหรับการดึงข้อมูลมาแสดงในตาราง Admin
        $interestForms = InterestForm::with('student', 'program')
                            ->orderBy('created_at', 'desc') // Show newest first
                            ->get();

        return view('admin.interest_forms.index', compact('interestForms'));
    }

    // --- เพิ่มเมธอด STORE เข้าไปตรงนี้ ---

    /**
     * (POST) Handles the submission and saving of a new interest form (User Submission).
     * * NOTE: You should ensure this method is protected by appropriate middleware 
     * if it handles public submissions.
     */
    public function store(Request $request)
    {
        // กำหนด Choices ที่อนุญาต (ต้องตรงกับใน Blade View)
        $reasonChoices = ['รักการทดลอง', 'ชอบเขียนโค้ด', 'มีคนแนะนำ', 'อื่นๆ']; 

        // 1. Validation Rules
        $validated = $request->validate([
            // ตรวจสอบ ID ที่จำเป็นสำหรับการสร้างฟอร์ม
            'student_id' => ['required', 'exists:students,student_id'],
            'program_id' => ['required', 'exists:programs,program_id'],
            
            // reason_choice ต้องถูกเลือกและอยู่ในรายการที่กำหนด
            'reason_choice' => ['required', 'string', Rule::in($reasonChoices)],

            // Conditional Validation: บังคับให้กรอก 'reason_other' เมื่อเลือก 'อื่นๆ'
            'reason_other' => [
                Rule::requiredIf($request->input('reason_choice') === 'อื่นๆ'),
                'nullable', // อนุญาตให้เป็น null ได้ ถ้าไม่ได้เลือก 'อื่นๆ'
                'string',
                'max:500', // กำหนดความยาวสูงสุด
            ],
        ]);

        try {
            // 2. Data Preparation: 
            // ล้างค่า reason_other ให้เป็น null ถ้าไม่ได้เลือก 'อื่นๆ' 
            if ($validated['reason_choice'] !== 'อื่นๆ') {
                $validated['reason_other'] = null;
            }

            // 3. Create the Interest Form Record
            InterestForm::create($validated);

            // 4. Success Response
            return back() // redirect กลับหน้าเดิม
                ->with('success', 'บันทึกข้อมูลความสนใจเรียบร้อยแล้ว');

        } catch (\Exception $e) {
            Log::error('Error saving interest form:', ['error' => $e->getMessage()]);

            // 5. Error Response
            return back()
                ->withInput()
                ->with('error', 'เกิดข้อผิดพลาดในการบันทึกข้อมูล กรุณาลองใหม่อีกครั้ง');
        }
    }
    
    // (We might add delete functionality later if needed)
    // public function destroy(InterestForm $interestForm) { ... }
}
