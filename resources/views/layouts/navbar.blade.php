<nav class="bg-white border-b border-gray-100 shadow-sm" x-data="{ open: false }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">

            {{-- 🔸 โลโก้และชื่อเว็บไซต์ --}}
            <div class="flex items-center space-x-3">
                <img src="{{ asset('images/logo.png') }}" alt="STA Logo" class="h-9 w-auto">
                <span class="text-xl font-bold text-yellow-500">STA Recruitment</span>
            </div>

            {{-- 🔸 เมนูหลัก --}}
            <div class="hidden md:flex items-center space-x-3">
                {{-- ⚫ แบบสอบถามความสนใจในสาขา --}}
                @auth('student')
                    <a href="{{ route('interest.form') }}"
                        class="px-4 py-2 bg-gray-800 text-white font-semibold rounded-md hover:bg-gray-700 transition">
                        แบบสอบถาม
                    </a>
                @else
                    <a href="{{ route('login') }}"
                        class="px-4 py-2 bg-gray-800 text-white font-semibold rounded-md hover:bg-gray-700 transition">
                        แบบสอบถาม
                    </a>
                @endauth

                {{-- 🟡 แบบฟอร์มสมัครเรียน --}}
                @auth('student')
                    <a href="{{ route('application.form') }}"
                        class="px-4 py-2 bg-yellow-400 text-black font-semibold rounded-md hover:bg-yellow-500 transition">
                        แบบฟอร์มสมัครเรียน
                    </a>
                @else
                    <a href="{{ route('login') }}"
                        class="px-4 py-2 bg-yellow-400 text-black font-semibold rounded-md hover:bg-yellow-500 transition">
                        แบบฟอร์มสมัครเรียน
                    </a>
                @endauth

                {{-- 🌐 เกี่ยวกับเรา --}}
                <a href="https://yru.ac.th/th/" target="_blank"
                    class="px-4 py-2 bg-yellow-400 text-black font-semibold rounded-md hover:bg-yellow-500 transition">
                    เกี่ยวกับเรา
                </a>

                {{-- 👥 ทีมผู้พัฒนา --}}
                <a href="{{ route('our-team') }}"
                    class="px-4 py-2 bg-gray-800 text-white font-semibold rounded-md hover:bg-gray-700 transition">
                    ทีมผู้พัฒนา
                </a>
            </div>

            {{-- 🔸 ด้านขวา: Login/Register หรือชื่อผู้ใช้ --}}
            <div class="hidden md:flex items-center space-x-4">
                @guest('student')
                    {{-- 🔹 ถ้ายังไม่ได้ล็อกอิน --}}
                    <a href="{{ route('login') }}" class="text-gray-700 hover:text-gray-900 font-medium">Login</a>
                    <a href="{{ route('register') }}"
                        class="px-4 py-2 bg-yellow-400 text-black font-semibold rounded-md hover:bg-yellow-500 transition">
                        Register
                    </a>
                @else
                    {{-- 🔹 ถ้าล็อกอินแล้ว --}}
                    <div class="relative" x-data="{ dropdown: false }">
                        <button @click="dropdown = !dropdown"
                            class="flex items-center text-gray-800 font-semibold focus:outline-none">
                            <svg class="w-6 h-6 text-gray-600 mr-2" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            <span>{{ Auth::guard('student')->user()->fullname }}</span>
                            <svg class="ml-1 w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.24a.75.75 0 01-1.06 0L5.25 8.27a.75.75 0 01-.02-1.06z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>

                        {{-- 🔽 Dropdown Menu --}}
                        <div x-show="dropdown" @click.away="dropdown = false"
                            class="absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-lg shadow-lg z-50 py-1">
                            <a href="{{ route('profile.edit') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                โปรไฟล์ของฉัน
                            </a>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                                    ออกจากระบบ
                                </button>
                            </form>
                        </div>
                    </div>
                @endguest
            </div>
        </div>
    </div>
</nav>
