@extends('layouts.admin')

@section('page-title', 'Reports Management')

@section('content')
    <div class="space-y-6">
        <div class="flex justify-between items-center">
            <h3 class="text-2xl font-bold text-gray-800">Disaster Reports</h3>
            <span class="text-gray-600">Total Reports</span>
        </div>

        <!-- Reports Table -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <table class="w-full">
                <thead class="bg-gray-100 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Title</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Reporter</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Type</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Location</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Status</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Date</th>
                        <th class="px-6 py-4 text-center text-sm font-semibold text-gray-700">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <tr class="hover:bg-gray-50">
                        <td colspan="7" class="px-6 py-8 text-center text-gray-600">
                            Reports data will be populated from database
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
            <p class="text-sm text-blue-800">
                <strong>Note:</strong> This section will display all disaster reports submitted by users. 
                Admins can verify, edit, and manage reports here.
            </p>
        </div>
    </div>
@endsection
