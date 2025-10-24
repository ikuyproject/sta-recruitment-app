<?php

namespace App\Http\Requests;

use App\Models\Student; // <-- 1. Import Student Model
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth; // <-- 2. Import Auth

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        // 3. ดึง ID ของ Student ที่ Login อยู่
        $studentId = Auth::guard('student')->id();

        return [
            // 4. เพิ่ม Rule สำหรับ fullname และ phone
            'fullname' => ['required', 'string', 'max:100'],
            'phone' => ['nullable', 'string', 'max:20'],
            
            // 5. แก้ไข Rule ของ email
            'email' => [
                'required', 
                'string', 
                'lowercase', 
                'email', 
                'max:100', 
                // ตรวจสอบ Unique โดยให้ "ยกเว้น" ID ของตัวเอง
                Rule::unique(Student::class)->ignore($studentId, 'student_id') 
            ],
        ];
    }
}