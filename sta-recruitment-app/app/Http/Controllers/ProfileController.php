<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * แสดงหน้าฟอร์มแก้ไขโปรไฟล์
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => Auth::guard('student')->user(), 
        ]);
    }

    /**
     * อัปเดตข้อมูลโปรไฟล์
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        /** @var \App\Models\Student $student */ // <-- 1. เพิ่มคอมเมนต์นี้
        $student = Auth::guard('student')->user();
        
        $student->fill($request->validated()); // (จะหายแดง)

        if ($student->isDirty('email')) { // (จะหายแดง)
            // $student->email_verified_at = null; 
        }

        $student->save(); // (จะหายแดง)

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * ลบบัญชีผู้ใช้
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password:student'],
        ]);

        /** @var \App\Models\Student $student */ // <-- 2. เพิ่มคอมเมนต์นี้
        $student = Auth::guard('student')->user();

        Auth::guard('student')->logout();

        $student->delete(); // (จะหายแดง)

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}