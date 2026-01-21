<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') - Aplikasi Tanggap Bencana Alam</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar Navigation -->
        <div class="w-64 bg-red-700 text-white shadow-lg">
            <div class="p-6 border-b border-red-600">
                <h1 class="text-2xl font-bold">Admin Panel</h1>
                <p class="text-red-100 text-sm mt-2">Aplikasi Tanggap Bencana</p>
            </div>
            
            <nav class="mt-6">
                <a href="{{ route('admin.dashboard') }}" 
                   class="block px-6 py-3 {{ request()->routeIs('admin.dashboard') ? 'bg-red-600 border-l-4 border-white' : 'hover:bg-red-600' }}">
                    <span class="flex items-center">
                        <span class="mr-3">📊</span>
                        Dashboard
                    </span>
                </a>
                
                <a href="{{ route('admin.users') }}" 
                   class="block px-6 py-3 {{ request()->routeIs('admin.users*') ? 'bg-red-600 border-l-4 border-white' : 'hover:bg-red-600' }}">
                    <span class="flex items-center">
                        <span class="mr-3">👥</span>
                        Manage Users
                    </span>
                </a>
                
                <a href="{{ route('admin.reports') }}" 
                   class="block px-6 py-3 {{ request()->routeIs('admin.reports*') ? 'bg-red-600 border-l-4 border-white' : 'hover:bg-red-600' }}">
                    <span class="flex items-center">
                        <span class="mr-3">📋</span>
                        Reports
                    </span>
                </a>
                
                <a href="{{ route('admin.sos') }}" 
                   class="block px-6 py-3 {{ request()->routeIs('admin.sos*') ? 'bg-red-600 border-l-4 border-white' : 'hover:bg-red-600' }}">
                    <span class="flex items-center">
                        <span class="mr-3">🆘</span>
                        SOS Alerts
                    </span>
                </a>
                
                <a href="{{ route('admin.news') }}" 
                   class="block px-6 py-3 {{ request()->routeIs('admin.news*') ? 'bg-red-600 border-l-4 border-white' : 'hover:bg-red-600' }}">
                    <span class="flex items-center">
                        <span class="mr-3">📰</span>
                        News & Articles
                    </span>
                </a>
            </nav>

            <!-- User Info & Logout -->
            <div class="absolute bottom-0 w-64 border-t border-red-600 bg-red-800">
                <div class="p-4">
                    <p class="text-sm text-red-100">Logged in as:</p>
                    <p class="font-bold text-white">{{ auth()->user()->name }}</p>
                </div>
                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <button type="submit" class="w-full text-left px-4 py-3 hover:bg-red-700 transition">
                        <span class="flex items-center">
                            <span class="mr-3">🚪</span>
                            Logout
                        </span>
                    </button>
                </form>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 overflow-auto">
            <!-- Top Navigation Bar -->
            <div class="bg-white border-b border-gray-200 shadow-sm">
                <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
                    <h2 class="text-xl font-semibold text-gray-800">@yield('page-title', 'Dashboard')</h2>
                    <div class="text-sm text-gray-600">
                        <span class="mr-4">{{ now()->format('d M Y H:i') }}</span>
                    </div>
                </div>
            </div>

            <!-- Main Content Area -->
            <div class="max-w-7xl mx-auto p-6">
                <!-- Flash Messages -->
                @if ($message = Session::get('success'))
                    <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                        {{ $message }}
                    </div>
                @endif

                @if ($message = Session::get('error'))
                    <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                        {{ $message }}
                    </div>
                @endif

                <!-- Content Yield -->
                @yield('content')
            </div>
        </div>
    </div>
</body>
</html>
