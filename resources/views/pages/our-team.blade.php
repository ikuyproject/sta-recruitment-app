<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1"

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://kit.fontawesome.com/a2e0e6ad42.js" crossorigin="anonymous"></script>
</head>
<body class="font-sans antialiased bg-gray-100">
    @include('layouts.navbar')


    <!-- 🟡 Navbar -->
    
        
                <!-- 🧑‍🎓 ผู้ใช้ล็อกอิน -->
                <div class="flex items-center gap-3">
                    @auth('student')
                    @else
                        <a href="{{ route('login') }}" class="text-gray-700 hover:text-gray-900 font-medium">Login</a>
                        <a href="{{ route('register') }}"
                           class="px-4 py-2 bg-yellow-400 text-black font-semibold rounded-md hover:bg-yellow-500 transition shadow-sm">
                            Register
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- 🟡 Header Section -->
    <div class="bg-gradient-to-r from-yellow-400 via-yellow-500 to-yellow-400 py-16 text-center text-black shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-4xl md:text-5xl font-extrabold drop-shadow-md">
                ทีมผู้พัฒนา (Our Team)
            </h1>
            <p class="mt-4 text-lg md:text-xl opacity-90 font-medium">
                นักศึกษาผู้จัดทำระบบรับสมัครและแบบสอบถาม<br>
                คณะวิทยาศาสตร์เทคโนโลยีและการเกษตร มหาวิทยาลัยราชภัฏยะลา
            </p>
        </div>
    </div>

    <!-- ⚫ Team Members -->
    <div class="py-16 bg-[#1E1E1E]">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">

                <!-- สมาชิกคนที่ 1 -->
                <div class="bg-[#2C2C2C] rounded-2xl shadow-lg overflow-hidden text-center border border-gray-700 transition-transform transform hover:scale-105 hover:shadow-yellow-500/40 duration-300">
                    <img src="{{ asset('images/ismaae.jpg') }}" alt="อิสมาแอ ดอแต" class="w-full h-64 object-cover object-center">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-yellow-400">นาย อิสมาแอ ดอแต</h3>
                        <p class="text-gray-400 mt-1">406759032</p>
                        <p class="text-sm text-yellow-500 font-medium mt-2">Developer</p>
                        <div class="flex justify-center space-x-4 mt-4">
                            <a href="https://www.facebook.com/share/19jehLe2XZ/?mibextid=wwXIfr" target="_blank" class="text-gray-400 hover:text-yellow-400">
                                <i class="fa-brands fa-facebook-f text-lg"></i>
                            </a>
                            <a href="https://www.instagram.com/_.ismael.16?igsh=MWphdnFpdHVpM2I2cQ==" target="_blank" class="text-gray-400 hover:text-yellow-400">
                                <i class="fa-brands fa-instagram text-lg"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- สมาชิกคนที่ 2 -->
                <div class="bg-[#2C2C2C] rounded-2xl shadow-lg overflow-hidden text-center border border-gray-700 transition-transform transform hover:scale-105 hover:shadow-yellow-500/40 duration-300">
                    <img src="{{ asset('images/alif.jpg') }}" alt="อาลีฟ คาเรง" class="w-full h-64 object-cover object-center">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-yellow-400">นาย อาลีฟ คาเรง</h3>
                        <p class="text-gray-400 mt-1">406759003</p>
                        <p class="text-sm text-yellow-500 font-medium mt-2">Developer</p>
                        <div class="flex justify-center space-x-4 mt-4">
                            <a href="https://www.facebook.com/share/1WeRavjadW/?mibextid=wwXIfr" target="_blank" class="text-gray-400 hover:text-yellow-400">
                                <i class="fa-brands fa-facebook-f text-lg"></i>
                            </a>
                            <a href="https://www.instagram.com/alif.kh_?igsh=MXQxOWZpaWgweGprYg==" target="_blank" class="text-gray-400 hover:text-yellow-400">
                                <i class="fa-brands fa-instagram text-lg"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- สมาชิกคนที่ 3 -->
                <div class="bg-[#2C2C2C] rounded-2xl shadow-lg overflow-hidden text-center border border-gray-700 transition-transform transform hover:scale-105 hover:shadow-yellow-500/40 duration-300">
                    <img src="{{ asset('images/anwa.jpg') }}" alt="มะอานูวา ดามูซอ" class="w-full h-64 object-cover object-center">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-yellow-400">นาย มะอานูวา ดามูซอ</h3>
                        <p class="text-gray-400 mt-1">406759019</p>
                        <p class="text-sm text-yellow-500 font-medium mt-2">Developer</p>
                        <div class="flex justify-center space-x-4 mt-4">
                            <a href="https://www.facebook.com/share/1FfLfgEhjt/?mibextid=wwXIfr" target="_blank" class="text-gray-400 hover:text-yellow-400">
                                <i class="fa-brands fa-facebook-f text-lg"></i>
                            </a>
                            <a href="https://www.instagram.com/thisisanwa._?igsh=MWlxNnlxb3E0OGtobA%3D%3D&utm_source=qr" target="_blank" class="text-gray-400 hover:text-yellow-400">
                                <i class="fa-brands fa-instagram text-lg"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- สมาชิกคนที่ 4 -->
                <div class="bg-[#2C2C2C] rounded-2xl shadow-lg overflow-hidden text-center border border-gray-700 transition-transform transform hover:scale-105 hover:shadow-yellow-500/40 duration-300">
                    <img src="{{ asset('images/karim.jpg') }}" alt="อับดุลการีม กาแลเปะ" class="w-full h-64 object-cover object-center">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-yellow-400">นาย อับดุลการีม กาแลเปะ</h3>
                        <p class="text-gray-400 mt-1">406759011</p>
                        <p class="text-sm text-yellow-500 font-medium mt-2">Developer</p>
                        <div class="flex justify-center space-x-4 mt-4">
                            <a href="https://www.facebook.com/share/1aBpj4x9oN/?mibextid=wwXIfr" target="_blank" class="text-gray-400 hover:text-yellow-400">
                                <i class="fa-brands fa-facebook-f text-lg"></i>
                            </a>
                            <a href="https://www.instagram.com/r6karim?igsh=M2ltMW9hcGliajFl" target="_blank" class="text-gray-400 hover:text-yellow-400">
                                <i class="fa-brands fa-instagram text-lg"></i>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</body>
</html>
