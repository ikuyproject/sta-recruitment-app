<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Student; // 1. เปลี่ยนจาก User เป็น Student
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // 2. แก้ไข Rules ให้ตรงกับตาราง students
        $request->validate([
            'fullname' => ['required', 'string', 'max:100'],
            'username' => ['required', 'string', 'max:50', 'unique:'.Student::class], //
            'email' => ['required', 'string', 'lowercase', 'email', 'max:100', 'unique:'.Student::class], //
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // 3. สร้าง Student
        $student = Student::create([
            'fullname' => $request->fullname,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            // 'phone' เราไม่ได้ให้กรอกตอนสมัคร
        ]);

        event(new Registered($student));

        // 4. Login ด้วย guard 'student'
        Auth::guard('student')->login($student); 

        return redirect(route('dashboard', absolute: false));
    }
}