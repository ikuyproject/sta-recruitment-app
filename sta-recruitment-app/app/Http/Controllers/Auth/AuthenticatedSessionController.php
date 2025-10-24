<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest; // (ไฟล์ Request เดิมที่เราแก้ให้รับ username)
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Validation\ValidationException; // <-- Import เพิ่ม

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view. (เหมือนเดิม)
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     * [แก้ไข Logic ใหม่]
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // 1. ลองล็อกอินเป็น Admin ก่อน
        if (Auth::guard('faculty_staff')->attempt($request->only('username', 'password'), $request->boolean('remember'))) {
            $request->session()->regenerate();
            // ถ้าสำเร็จ ไป Admin Dashboard
            return redirect()->intended(route('admin.dashboard'));
        }

        // 2. ถ้า Admin ไม่ผ่าน ลองล็อกอินเป็น Student
        // (ใช้ authenticate() จาก LoginRequest ที่เราแก้ไว้แล้ว)
        try {
            $request->authenticate(); // นี่คือการเรียก Auth::guard('student')->attempt(...)
            $request->session()->regenerate();
            // ถ้าสำเร็จ ไป Student Dashboard
            return redirect()->intended(RouteServiceProvider::HOME); // HOME คือ /dashboard
        } catch (ValidationException $e) {
            // 3. ถ้า Student ก็ไม่ผ่าน ให้โยน Error เดิมกลับไป
            // (LoginRequest จะจัดการ Rate Limiter ให้)
            throw $e;
        }

        // (กรณีที่ไม่คาดคิดอื่นๆ อาจจะเกิดขึ้นยาก)
        // throw ValidationException::withMessages([
        //     'username' => trans('auth.failed'),
        // ]);
    }

    /**
     * Destroy an authenticated session. (เหมือนเดิม)
     */
    public function destroy(Request $request): RedirectResponse
    {
        // Logout Student (Guard เริ่มต้น)
        Auth::guard('student')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // กลับไปหน้าแรก
        return redirect('/');
    }
}