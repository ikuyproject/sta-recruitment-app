<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>STA Admin Panel</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-200">

    <div class="flex min-h-screen">
        <aside class="w-64 bg-sta-dark text-gray-300 p-6 flex flex-col">
            <h1 class="text-2xl font-bold text-sta-yellow mb-6">STA Admin</h1>
            
            <nav class="flex-grow">
                <ul>
                    <li class="mb-3">
                        <a href="{{ route('admin.dashboard') }}" 
                           class="flex items-center p-3 rounded-lg hover:bg-gray-700 transition-colors
                                  {{ request()->routeIs('admin.dashboard') ? 'bg-sta-yellow text-black' : '' }}">
                            <span class="mr-3">📊</span>
                            Dashboard (สรุป)
                        </a>
                    </li>
                    
                    <li class="mb-3">
                        <a href="{{ route('admin.applications.index') }}" 
                           class="flex items-center p-3 rounded-lg hover:bg-gray-700 transition-colors
                                  {{ request()->routeIs('admin.applications.index') ? 'bg-sta-yellow text-black' : '' }}">
                            <span class="mr-3">📄</span>
                            ข้อมูลการสมัคร
                        </a>
                    </li>
                    
                    </ul>
            </nav>

            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button type="submit" class="w-full text-left flex items-center p-3 rounded-lg text-red-400 hover:bg-red-700 hover:text-white transition-colors">
                    <span class="mr-3">🚪</span>
                    Logout
                </button>
            </form>
        </aside>

        <main class="flex-1 p-8">
            @if (isset($header))
                <header class="mb-6">
                    <h2 class="text-3xl font-semibold text-gray-800">{{ $header }}</h2>
                </header>
            @endif

            @if (session('status'))
                <div class="mb-4 bg-green-500 text-white p-4 rounded-lg shadow-md">
                    {{ session('status') }}
                </div>
            @endif

            {{ $slot }}
        </main>
    </div>

    @stack('scripts')
</body>
</html>