<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        // 1. เปลี่ยน 'email' เป็น 'username'
        return [
            'username' => ['required', 'string'], //
            'password' => ['required', 'string'],
        ];
    }

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited();

        // 2. เปลี่ยน 'email' เป็น 'username'
        // และใช้ guard 'student' ที่เราตั้งค่าไว้
        if (! Auth::guard('student')->attempt($this->only('username', 'password'), $this->boolean('remember'))) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'username' => trans('auth.failed'), // ให้แสดง error ที่ช่อง username
            ]);
        }

        RateLimiter::clear($this->throttleKey());
    }

    // ... (ฟังก์ชัน ensureIsNotRateLimited และ throttleKey คงเดิม) ...
    // ...
    public function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'username' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    public function throttleKey(): string
    {
        // 3. เปลี่ยน 'email' เป็น 'username'
        return Str::transliterate(Str::lower($this->input('username')).'|'.$this->ip());
    }
}