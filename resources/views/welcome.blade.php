<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-gray-100">
    @include('layouts.navbar')
    <!-- ✅ Navbar -->
    <nav class="bg-white border-b border-gray-200 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                    @guest('student')
                    @else
                    @endguest
                </div>
            </div>
        </div>
    </nav>
    <section class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h2 class="text-2xl font-semibold text-center mb-6 text-gray-800">
                วีดีโอแนะนำคณะ
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-white p-4 rounded-lg shadow-md">
                    <div class="aspect-video bg-gray-300 rounded mb-2 flex items-center justify-center text-gray-500">
                        (Video Placeholder)
                    </div>
                    <h3 class="font-semibold text-gray-700">แนะนำคณะ STA</h3>
                </div>
                <div class="bg-white p-4 rounded-lg shadow-md">
                    <div class="aspect-video bg-gray-300 rounded mb-2 flex items-center justify-center text-gray-500">
                        (Video Placeholder)
                    </div>
                    <h3 class="font-semibold text-gray-700">แนะนำสาขา ComSci</h3>
                </div>
                <div class="bg-white p-4 rounded-lg shadow-md">
                    <div class="aspect-video bg-gray-300 rounded mb-2 flex items-center justify-center text-gray-500">
                        (Video Placeholder)
                    </div>
                    <h3 class="font-semibold text-gray-700">แนะนำสาขา IT</h3>
                </div>
                <div class="bg-white p-4 rounded-lg shadow-md">
                    <div class="aspect-video bg-gray-300 rounded mb-2 flex items-center justify-center text-gray-500">
                        (Video Placeholder)
                    </div>
                    <h3 class="font-semibold text-gray-700">แนะนำสาขา Agri</h3>
                </div>
            </div>
        </div>
    </section>

    <!-- 🟫 Footer -->
    <footer class="w-full text-center p-6 text-gray-500 bg-gray-100 border-t border-gray-200 mt-12">
        <div>
            © {{ date('Y') }} คณะวิทยาศาสตร์เทคโนโลยีและการเกษตร มหาวิทยาลัยราชภัฏยะลา
        </div>
    </footer>
</body>
</html>
