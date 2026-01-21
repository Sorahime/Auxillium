@extends('layouts.admin')

@section('page-title', 'News Management')

@section('content')
    <div class="space-y-6">
        <div class="flex justify-between items-center">
            <h3 class="text-2xl font-bold text-gray-800">News & Articles</h3>
            <a href="{{ route('admin.news.create') }}" 
               class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition font-semibold">
                + Create News
            </a>
        </div>

        <!-- News Table -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <table class="w-full">
                <thead class="bg-gray-100 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Title</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Disaster Type</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Status</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Created</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Updated</th>
                        <th class="px-6 py-4 text-center text-sm font-semibold text-gray-700">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <tr class="hover:bg-gray-50">
                        <td colspan="6" class="px-6 py-8 text-center text-gray-600">
                            No news articles found. Create one to get started!
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Stats -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white rounded-lg shadow p-6">
                <p class="text-gray-600 text-sm font-medium">Published Articles</p>
                <p class="text-3xl font-bold text-gray-800 mt-2">0</p>
            </div>
            <div class="bg-white rounded-lg shadow p-6">
                <p class="text-gray-600 text-sm font-medium">Draft Articles</p>
                <p class="text-3xl font-bold text-gray-800 mt-2">0</p>
            </div>
            <div class="bg-white rounded-lg shadow p-6">
                <p class="text-gray-600 text-sm font-medium">Total Articles</p>
                <p class="text-3xl font-bold text-gray-800 mt-2">0</p>
            </div>
        </div>
    </div>
@endsection
