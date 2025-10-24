<?php

namespace App\Http\Controllers\Admin; // <-- เช็ค Namespace

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth; // <-- เช็ค Import Auth
use Illuminate\View\View;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log; // (เผื่อ Debug)

class AuthenticatedSessionController extends Controller // <-- เช็คชื่อ Class
{
    /**
     * Display the login view.
     * (ฟังก์ชันนี้ไม่ได้ถูกใช้แล้ว แต่เก็บไว้ก่อน)
     */
    public function create(): View
    {
        return view('admin.login');
    }

    /**
     * Handle an incoming authentication request.
     * (ฟังก์ชันนี้ไม่ได้ถูกใช้แล้ว แต่เก็บไว้ก่อน)
     */
    public function store(Request $request): RedirectResponse
    {
        // Logic ถูกย้ายไป Auth\AuthenticatedSessionController แล้ว
        return redirect('/');
    }

    /**
     * Destroy an authenticated session.
     * [แก้ไข]
     */
    public function destroy(Request $request): RedirectResponse
    {
        // 1. Logout โดยใช้ "faculty_staff" guard (เหมือนเดิม)
        Auth::guard('faculty_staff')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // 2. [แก้ไข] เปลี่ยน Redirect ไปหน้า '/' (หน้าหลักของเว็บ)
        return redirect('/');
    }
}