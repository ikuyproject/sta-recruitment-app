<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Login - STA Recruitment</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-gray-900 antialiased">
    
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-sta-yellow">
        
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-sta-dark shadow-md overflow-hidden sm:rounded-lg">
            
            <div class="text-center mb-4">
                <h2 class="text-2xl font-bold text-sta-yellow">STA Admin Login</h2>
                <p class="text-gray-400">สำหรับเจ้าหน้าที่คณะ</p>
            </div>

            @if ($errors->any())
                <div class="mb-4 bg-red-800 text-white p-3 rounded">
                    {{ $errors->first('username') ?: $errors->first('password') }}
                </div>
            @endif

            <form method="POST" action="{{ route('admin.login.store') }}">
                @csrf

                <div>
                    <x-input-label for="username" value="Username (ชื่อผู้ใช้)" class="text-gray-300" />
                    <x-text-input id="username" class="block mt-1 w-full bg-gray-700 text-white border-gray-600" 
                                  type="text" name="username" :value="old('username')" required autofocus />
                </div>

                <div class="mt-4">
                    <x-input-label for="password" value="Password (รหัสผ่าน)" class="text-gray-300" />
                    <x-text-input id="password" class="block mt-1 w-full bg-gray-700 text-white border-gray-600"
                                    type="password"
                                    name="password"
                                    required autocomplete="current-password" />
                </div>

                <div class="block mt-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-sta-yellow shadow-sm focus:ring-sta-yellow" name="remember">
                        <span class="ms-2 text-sm text-gray-400">{{ __('Remember me') }}</span>
                    </label>
                </div>

                <div class="flex items-center justify-end mt-4">
                    <button type="submit" class="w-full px-4 py-2 bg-gradient-to-r from-yellow-400 via-sta-yellow to-yellow-500 text-black font-bold rounded-md hover:from-yellow-500 hover:to-yellow-600 focus:outline-none focus:ring-2 focus:ring-sta-yellow focus:ring-offset-2 focus:ring-offset-sta-dark">
                        {{ __('Log in') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>