<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\ApplicationForm; // 1. Import ApplicationForm
use Illuminate\Validation\Rule; // 2. Import Rule

class ApplicationController extends Controller
{
    /**
     * (GET) แสดงตารางข้อมูลการสมัคร
     * (ฟังก์ชันนี้ยังเหมือนเดิม)
     */
    public function index(): View
    {
        // 3. ดึงข้อมูลทั้งหมด
        // .with() คือการทำ Eager Loading (ดึงข้อมูลนักเรียนและสาขามาด้วยใน Query เดียว)
        $applications = ApplicationForm::with('student', 'program')
                            ->orderBy('submitted_at', 'desc')
                            ->get();

        // 4. ส่งข้อมูลไปที่ View
        return view('admin.applications.index', compact('applications'));
    }

    /**
     * (GET) [ฟังก์ชันใหม่] แสดงหน้ารายละเอียดใบสมัคร
     */
    public function show(ApplicationForm $application): View
    {
        // (เราใช้ Route Model Binding '{application}' Laravel จะหามาให้)
        // เราโหลดข้อมูล Student และ Program มาด้วย
        $application->load('student', 'program', 'faculty');

        // ส่งข้อมูลใบสมัคร 1 ใบ ไปที่ View 'show'
        return view('admin.applications.show', compact('application'));
    }


    /**
     * (POST) อัปเดตสถานะ (อนุมัติ / ไม่อนุมัติ)
     * (ฟังก์ชันนี้ยังเหมือนเดิม)
     */
    public function updateStatus(Request $request, ApplicationForm $application): RedirectResponse
    {
        // (เราใช้ Route Model Binding '{application}' Laravel จะหา ApplicationForm ให้เอง)
        
        // 5. ตรวจสอบว่าค่า 'status' ที่ส่งมาถูกต้อง ("ผ่าน" หรือ "ไม่ผ่าน")
        $request->validate([
            'status' => ['required', Rule::in(['ผ่าน', 'ไม่ผ่าน'])],
        ]);

        // 6. อัปเดตสถานะ
        $application->status = $request->status;
        $application->save();

        // 7. ส่งกลับไปหน้าเดิม พร้อมข้อความ
        return redirect()->route('admin.applications.index')
                         ->with('status', "อัปเดตสถานะของ {$application->student->fullname} เป็น '{$request->status}' เรียบร้อยแล้ว");
    }
}