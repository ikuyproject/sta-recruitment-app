<x-guest-layout>
    <style>
        body {
            background-color: #FFD600; /* 🌕 เหลืองสดของ STA */
        }
        .login-card {
            background: #1e1e1e;
            border-radius: 1rem;
            box-shadow: 0 4px 20px rgba(0,0,0,0.4);
            max-width: 420px;
            margin: 4rem auto;
            padding: 2rem 2.5rem;
            color: #fff;
        }
        .login-title {
            color: #FFD600;
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }
        .login-subtitle {
            color: #bfbfbf;
            font-size: 0.95rem;
            margin-bottom: 1.5rem;
        }
        .btn-login {
            background: linear-gradient(90deg, #FFD600, #ffcc00);
            color: #000;
            font-weight: 700;
            transition: 0.3s;
            width: 100%;
        }
        .btn-login:hover {
            background: linear-gradient(90deg, #ffcc00, #FFD600);
            transform: scale(1.03);
        }
        .link {
            color: #FFD600;
            transition: 0.3s;
        }
        .link:hover {
            text-decoration: underline;
            color: #fff;
        }
    </style>

    <div class="login-card">
        <div class="text-center mb-4">
            <h2 class="login-title">STA-Recruitment Login</h2>
            <p class="login-subtitle">เข้าสู่ระบบเพื่อจัดการข้อมูลการสมัครเรียน</p>
        </div>

        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Username -->
            <div>
                <x-input-label for="username" value="ชื่อผู้ใช้ (Username)" />
                <x-text-input id="username" class="block mt-1 w-full bg-gray-800 text-white border-gray-700 focus:border-yellow-400 focus:ring-yellow-400"
                    type="text" name="username" :value="old('username')" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('username')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" value="รหัสผ่าน (Password)" />
                <x-text-input id="password" class="block mt-1 w-full bg-gray-800 text-white border-gray-700 focus:border-yellow-400 focus:ring-yellow-400"
                    type="password" name="password" required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-yellow-400 shadow-sm focus:ring-yellow-400" name="remember">
                    <span class="ms-2 text-sm text-gray-400">{{ __('Remember me') }}</span>
                </label>
            </div>

            <!-- Button -->
            <div class="mt-6">
                <button type="submit" class="btn-login py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-400">
                    {{ __('เข้าสู่ระบบ') }}
                </button>
            </div>

            <!-- Links -->
            <div class="flex justify-between items-center mt-4 text-sm">
                <a href="{{ route('register') }}" class="link">ยังไม่มีบัญชี? สมัครสมาชิก</a>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="link">ลืมรหัสผ่าน?</a>
                @endif
            </div>
        </form>
    </div>
</x-guest-layout>
