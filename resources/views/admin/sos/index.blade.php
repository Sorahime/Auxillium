@extends('layouts.admin')

@section('page-title', 'SOS Alerts Management')

@section('content')
    <div class="space-y-6">
        <div class="flex justify-between items-center">
            <h3 class="text-2xl font-bold text-gray-800">SOS Emergency Alerts</h3>
            <span class="text-gray-600 bg-red-100 px-3 py-1 rounded-full text-red-700 font-semibold">
                Active Alerts
            </span>
        </div>

        <!-- SOS Alerts Table -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <table class="w-full">
                <thead class="bg-gray-100 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">User</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Location</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Description</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Status</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Time</th>
                        <th class="px-6 py-4 text-center text-sm font-semibold text-gray-700">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <tr class="hover:bg-gray-50">
                        <td colspan="6" class="px-6 py-8 text-center text-gray-600">
                            SOS alerts data will be populated from database
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Active SOS Count -->
            <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded">
                <p class="text-sm text-red-700 font-semibold">Active SOS</p>
                <p class="text-3xl font-bold text-red-700 mt-2">0</p>
            </div>

            <!-- Responded Count -->
            <div class="bg-yellow-50 border-l-4 border-yellow-500 p-4 rounded">
                <p class="text-sm text-yellow-700 font-semibold">Responded</p>
                <p class="text-3xl font-bold text-yellow-700 mt-2">0</p>
            </div>

            <!-- Resolved Count -->
            <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded">
                <p class="text-sm text-green-700 font-semibold">Resolved</p>
                <p class="text-3xl font-bold text-green-700 mt-2">0</p>
            </div>
        </div>

        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
            <p class="text-sm text-blue-800">
                <strong>Note:</strong> This section displays emergency SOS alerts from users. 
                Admins can view alert details, dispatch help, and mark as resolved.
            </p>
        </div>
    </div>
@endsection
