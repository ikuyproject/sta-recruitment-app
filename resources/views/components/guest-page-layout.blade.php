<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title ?? 'STA Recruitment - YRU' }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-gray-100">

        <nav class="bg-white shadow-sm sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                         <a href="/" class="text-xl font-bold text-gray-800">STA Recruitment</a>
                    </div>
                    <div class="flex items-center">
                        @guest('student')
                            <a href="{{ route('login') }}" class="px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50">Login</a>
                            <a href="{{ route('register') }}" class="ml-4 px-3 py-2 rounded-md text-sm font-medium text-white bg-sta-yellow hover:bg-yellow-400">Register</a>
                        @else
                             <a href="{{ route('dashboard') }}" class="px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50">Dashboard</a>
                             <form method="POST" action="{{ route('logout') }}" class="ml-4">
                                @csrf
                                <button type="submit" class="px-3 py-2 rounded-md text-sm font-medium text-red-600 hover:text-red-800 hover:bg-red-50">Logout</button>
                            </form>
                        @endguest
                    </div>
                </div>
            </div>
        </nav>

        <main>
            {{ $slot }}
        </main>

        <footer class="w-full text-center p-6 text-gray-500 bg-gray-100 border-t border-gray-200 mt-12">
            <div class="space-x-4 mb-2">
                <a href="{{ route('about-us') }}" class="hover:underline">เกี่ยวกับเรา</a>
                <span>|</span>
                <a href="{{ route('our-team') }}" class="hover:underline">ทีมผู้พัฒนา</a>
                <span>|</span>
                <a href="https://sta.yru.ac.th/" target="_blank" class="hover:underline">เว็บไซต์คณะ</a>
                <span>|</span>
                <a href="#" class="hover:underline">นโยบายความเป็นส่วนตัว (PDPA)</a>
            </div>
            <div>
                © {{ date('Y') }} คณะวิทยาศาสตร์เทคโนโลยีและการเกษตร มหาวิทยาลัยราชภัฏยะลา
            </div>
        </footer>

    </body>
</html>