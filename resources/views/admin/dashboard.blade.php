@extends('layouts.admin')

@section('page-title', 'Dashboard')

@section('content')
    <div class="space-y-6">
        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Total Users Card -->
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-medium">Total Users</p>
                        <p class="text-3xl font-bold text-gray-800 mt-2">{{ $totalUsers }}</p>
                    </div>
                    <div class="text-4xl text-blue-500">👥</div>
                </div>
                <a href="{{ route('admin.users') }}" class="text-blue-600 text-sm font-semibold mt-4 inline-block hover:underline">
                    View Users →
                </a>
            </div>

            <!-- Total Reports Card -->
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-medium">Total Reports</p>
                        <p class="text-3xl font-bold text-gray-800 mt-2">{{ $totalReports }}</p>
                    </div>
                    <div class="text-4xl text-orange-500">📋</div>
                </div>
                <a href="{{ route('admin.reports') }}" class="text-blue-600 text-sm font-semibold mt-4 inline-block hover:underline">
                    View Reports →
                </a>
            </div>

            <!-- Total SOS Alerts Card -->
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-medium">SOS Alerts</p>
                        <p class="text-3xl font-bold text-gray-800 mt-2">{{ $totalSos }}</p>
                    </div>
                    <div class="text-4xl text-red-500">🆘</div>
                </div>
                <a href="{{ route('admin.sos') }}" class="text-blue-600 text-sm font-semibold mt-4 inline-block hover:underline">
                    View SOS →
                </a>
            </div>

            <!-- Total News Card -->
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-medium">News Articles</p>
                        <p class="text-3xl font-bold text-gray-800 mt-2">{{ $totalNews }}</p>
                    </div>
                    <div class="text-4xl text-yellow-500">📰</div>
                </div>
                <a href="{{ route('admin.news') }}" class="text-blue-600 text-sm font-semibold mt-4 inline-block hover:underline">
                    View News →
                </a>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-bold text-gray-800 mb-4">Quick Actions</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <a href="{{ route('admin.news.create') }}" class="p-4 border-2 border-blue-500 rounded-lg text-center hover:bg-blue-50 transition">
                    <span class="text-2xl block mb-2">✍️</span>
                    <span class="text-sm font-semibold text-blue-600">Create News</span>
                </a>
                <a href="{{ route('admin.users') }}" class="p-4 border-2 border-green-500 rounded-lg text-center hover:bg-green-50 transition">
                    <span class="text-2xl block mb-2">👤</span>
                    <span class="text-sm font-semibold text-green-600">Manage Users</span>
                </a>
                <a href="{{ route('admin.reports') }}" class="p-4 border-2 border-orange-500 rounded-lg text-center hover:bg-orange-50 transition">
                    <span class="text-2xl block mb-2">📊</span>
                    <span class="text-sm font-semibold text-orange-600">View Reports</span>
                </a>
                <a href="{{ route('admin.sos') }}" class="p-4 border-2 border-red-500 rounded-lg text-center hover:bg-red-50 transition">
                    <span class="text-2xl block mb-2">🚨</span>
                    <span class="text-sm font-semibold text-red-600">SOS Alerts</span>
                </a>
            </div>
        </div>

        <!-- System Information -->
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-bold text-gray-800 mb-4">System Information</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <p class="text-sm text-gray-600">Laravel Version</p>
                    <p class="text-lg font-semibold text-gray-800">11.x</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Application</p>
                    <p class="text-lg font-semibold text-gray-800">Aplikasi Tanggap Bencana Alam</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Last Login</p>
                    <p class="text-lg font-semibold text-gray-800">{{ auth()->user()->updated_at->format('d M Y H:i') }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Current Time</p>
                    <p class="text-lg font-semibold text-gray-800">{{ now()->format('d M Y H:i:s') }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
