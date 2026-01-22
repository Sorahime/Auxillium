@extends('layouts.admin')

@section('page-title', 'Report Details')

@section('content')
    <div class="space-y-6">
        <div class="mb-6">
            <a href="{{ route('admin.reports') }}" class="text-blue-600 hover:text-blue-800 font-semibold">
                ← Back to Reports
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Report Info Card -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h2 class="text-2xl font-bold text-gray-800 mb-4">{{ $report->title }}</h2>
                    
                    <div class="space-y-4">
                        <div>
                            <label class="text-sm font-semibold text-gray-600">Reporter</label>
                            <p class="text-gray-800 text-lg">{{ $report->user->name }}</p>
                            <p class="text-sm text-gray-600">{{ $report->user->email }} | {{ $report->user->phone }}</p>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="text-sm font-semibold text-gray-600">Disaster Type</label>
                                <span class="text-gray-800 bg-orange-100 px-3 py-1 rounded text-sm font-semibold inline-block mt-1">
                                    {{ ucfirst($report->disaster_type) }}
                                </span>
                            </div>
                            <div>
                                <label class="text-sm font-semibold text-gray-600">Status</label>
                                <div class="mt-1">
                                    @if($report->status === 'pending')
                                        <span class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded text-sm font-semibold">Pending</span>
                                    @elseif($report->status === 'verified')
                                        <span class="px-3 py-1 bg-green-100 text-green-800 rounded text-sm font-semibold">Verified</span>
                                    @else
                                        <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded text-sm font-semibold">Resolved</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div>
                            <label class="text-sm font-semibold text-gray-600">Location</label>
                            <p class="text-gray-800">{{ $report->location }}</p>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="text-sm font-semibold text-gray-600">Latitude</label>
                                <p class="text-gray-800">{{ $report->latitude ?? 'Not provided' }}</p>
                            </div>
                            <div>
                                <label class="text-sm font-semibold text-gray-600">Longitude</label>
                                <p class="text-gray-800">{{ $report->longitude ?? 'Not provided' }}</p>
                            </div>
                        </div>

                        <div>
                            <label class="text-sm font-semibold text-gray-600">Description</label>
                            <div class="bg-gray-50 p-4 rounded mt-2 text-gray-800">
                                {{ $report->description }}
                            </div>
                        </div>

                        <div>
                            <label class="text-sm font-semibold text-gray-600">Report Date</label>
                            <p class="text-gray-800">{{ $report->created_at->format('d M Y H:i') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Admin Notes -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Admin Notes</h3>
                    <div class="bg-blue-50 border-l-4 border-blue-500 p-4 rounded">
                        <p class="text-gray-800">{{ $report->admin_notes ?? 'No notes yet' }}</p>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Quick Actions -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Actions</h3>
                    <div class="space-y-2">
                        <a href="{{ route('admin.reports.edit', $report) }}" 
                           class="block px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition text-center font-semibold">
                            ✏️ Edit Report
                        </a>
                        <form method="POST" action="{{ route('admin.reports.destroy', $report) }}" 
                              onsubmit="return confirm('Delete this report?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full px-4 py-2 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 transition font-semibold">
                                🗑️ Delete Report
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Status Info -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Status</h3>
                    <div class="space-y-3">
                        <div>
                            <p class="text-sm text-gray-600 mb-2">Current Status:</p>
                            @if($report->status === 'pending')
                                <p class="text-yellow-700 font-semibold">⚠️ Pending Review</p>
                            @elseif($report->status === 'verified')
                                <p class="text-green-700 font-semibold">✓ Verified</p>
                            @else
                                <p class="text-blue-700 font-semibold">✓ Resolved</p>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Report Info -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Info</h3>
                    <div class="space-y-2 text-sm text-gray-600">
                        <p><strong>Report ID:</strong> #{{ $report->id }}</p>
                        <p><strong>Created:</strong> {{ $report->created_at->diffForHumans() }}</p>
                        <p><strong>Last Updated:</strong> {{ $report->updated_at->diffForHumans() }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
