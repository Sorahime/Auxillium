@extends('layouts.admin')

@section('page-title', 'Edit Report')

@section('content')
    <div class="max-w-3xl">
        <div class="mb-6">
            <a href="{{ route('admin.reports.show', $report) }}" class="text-blue-600 hover:text-blue-800 font-semibold">
                ← Back to Report
            </a>
        </div>

        <div class="bg-white rounded-lg shadow p-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Edit Report</h2>

            <form method="POST" action="{{ route('admin.reports.update', $report) }}" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Report Info (Read Only) -->
                <div class="bg-gray-50 p-6 rounded-lg border border-gray-200 space-y-4">
                    <h3 class="font-semibold text-gray-700 mb-4">Report Information (Read Only)</h3>
                    
                    <div>
                        <label class="text-sm font-semibold text-gray-700">Title</label>
                        <p class="mt-1 text-gray-800 font-medium">{{ $report->title }}</p>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="text-sm font-semibold text-gray-700">Type</label>
                            <p class="mt-1 text-gray-800 font-medium">{{ ucfirst($report->disaster_type) }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-semibold text-gray-700">Reporter</label>
                            <p class="mt-1 text-gray-800 font-medium">{{ $report->user->name }}</p>
                        </div>
                    </div>

                    <div>
                        <label class="text-sm font-semibold text-gray-700">Location</label>
                        <p class="mt-1 text-gray-800 font-medium">{{ $report->location }}</p>
                    </div>
                </div>

                <!-- Coordinates (Editable) -->
                <div>
                    <h3 class="font-semibold text-gray-700 mb-4">Update Location Coordinates</h3>
                    
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="latitude" class="block text-sm font-semibold text-gray-700 mb-2">
                                Latitude
                            </label>
                            <input type="number" name="latitude" id="latitude" 
                                   step="0.00000001" min="-90" max="90"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                   value="{{ old('latitude', $report->latitude) }}" placeholder="-90 to 90">
                            @error('latitude')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="longitude" class="block text-sm font-semibold text-gray-700 mb-2">
                                Longitude
                            </label>
                            <input type="number" name="longitude" id="longitude" 
                                   step="0.00000001" min="-180" max="180"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                   value="{{ old('longitude', $report->longitude) }}" placeholder="-180 to 180">
                            @error('longitude')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Status -->
                <div>
                    <label for="status" class="block text-sm font-semibold text-gray-700 mb-2">
                        Status <span class="text-red-500">*</span>
                    </label>
                    <select name="status" id="status" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                            required>
                        <option value="pending" {{ $report->status === 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="verified" {{ $report->status === 'verified' ? 'selected' : '' }}>Verified</option>
                        <option value="resolved" {{ $report->status === 'resolved' ? 'selected' : '' }}>Resolved</option>
                    </select>
                    @error('status')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Admin Notes -->
                <div>
                    <label for="admin_notes" class="block text-sm font-semibold text-gray-700 mb-2">
                        Admin Notes
                    </label>
                    <textarea name="admin_notes" id="admin_notes" rows="6" 
                              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                              placeholder="Add your notes about this report...">{{ old('admin_notes', $report->admin_notes) }}</textarea>
                    @error('admin_notes')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Buttons -->
                <div class="flex space-x-4 pt-6 border-t border-gray-200">
                    <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition font-semibold">
                        Save Changes
                    </button>
                    <a href="{{ route('admin.reports.show', $report) }}" class="bg-gray-300 text-gray-800 px-6 py-2 rounded-lg hover:bg-gray-400 transition font-semibold">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
