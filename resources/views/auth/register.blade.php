<x-guest-layout>
    <style>
        body {
            background-color: #FFD600; /* พื้นหลังเหลืองสด */
        }
        .register-card {
            background: #1e1e1e;
            border-radius: 1rem;
            box-shadow: 0 4px 20px rgba(0,0,0,0.4);
            max-width: 450px;
            margin: 4rem auto;
            padding: 2rem 2.5rem;
            color: #fff;
        }
        .register-title {
            color: #FFD600;
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }
        .register-subtitle {
            color: #bfbfbf;
            font-size: 0.95rem;
            margin-bottom: 1.5rem;
        }
        .btn-register {
            background: linear-gradient(90deg, #FFD600, #ffcc00);
            color: #000;
            font-weight: 700;
            transition: 0.3s;
            width: 100%;
        }
        .btn-register:hover {
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

    <div class="register-card">
        <div class="text-center mb-4">
            <h2 class="register-title">Register (ลงทะเบียน)</h2>
            <p class="register-subtitle">สร้างบัญชีใหม่เพื่อเข้าสู่ระบบรับสมัคร</p>
        </div>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Full Name -->
            <div>
                <x-input-label for="fullname" value="ชื่อ-นามสกุล (Full Name)" />
                <x-text-input id="fullname" class="block mt-1 w-full bg-gray-800 text-white border-gray-700 focus:border-yellow-400 focus:ring-yellow-400"
                    type="text" name="fullname" :value="old('fullname')" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('fullname')" class="mt-2" />
            </div>

            <!-- Username -->
            <div class="mt-4">
                <x-input-label for="username" value="ชื่อผู้ใช้ (Username)" />
                <x-text-input id="username" class="block mt-1 w-full bg-gray-800 text-white border-gray-700 focus:border-yellow-400 focus:ring-yellow-400"
                    type="text" name="username" :value="old('username')" required autocomplete="username" />
                <x-input-error :messages="$errors->get('username')" class="mt-2" />
            </div>

            <!-- Email -->
            <div class="mt-4">
                <x-input-label for="email" value="Email" />
                <x-text-input id="email" class="block mt-1 w-full bg-gray-800 text-white border-gray-700 focus:border-yellow-400 focus:ring-yellow-400"
                    type="email" name="email" :value="old('email')" required autocomplete="email" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" value="Password (รหัสผ่าน)" />
                <x-text-input id="password" class="block mt-1 w-full bg-gray-800 text-white border-gray-700 focus:border-yellow-400 focus:ring-yellow-400"
                    type="password" name="password" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-input-label for="password_confirmation" value="Confirm Password (ยืนยันรหัสผ่าน)" />
                <x-text-input id="password_confirmation" class="block mt-1 w-full bg-gray-800 text-white border-gray-700 focus:border-yellow-400 focus:ring-yellow-400"
                    type="password" name="password_confirmation" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <!-- Register Button -->
            <div class="mt-6">
                <button type="submit" class="btn-register py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-400">
                    {{ __('Register') }}
                </button>
            </div>

            <!-- Login Link -->
            <div class="text-center mt-4 text-sm">
                <a href="{{ route('login') }}" class="link">เป็นสมาชิกอยู่แล้ว? (Login)</a>
            </div>
        </form>
    </div>
</x-guest-layout>
