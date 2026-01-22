@extends('layouts.admin')

@section('page-title', 'SOS Alert Details')

@section('content')
    <div class="space-y-6">
        <div class="mb-6">
            <a href="{{ route('admin.sos') }}" class="text-blue-600 hover:text-blue-800 font-semibold">
                ← Back to SOS Alerts
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Alert Info Card -->
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-start justify-between mb-6">
                        <h2 class="text-2xl font-bold text-gray-800">Emergency SOS Alert</h2>
                        @if($sos->status === 'active')
                            <span class="px-4 py-2 bg-red-100 text-red-700 rounded-full font-semibold">🔴 ACTIVE</span>
                        @elseif($sos->status === 'responded')
                            <span class="px-4 py-2 bg-yellow-100 text-yellow-700 rounded-full font-semibold">🟡 RESPONDED</span>
                        @else
                            <span class="px-4 py-2 bg-green-100 text-green-700 rounded-full font-semibold">✓ RESOLVED</span>
                        @endif
                    </div>
                    
                    <div class="space-y-4">
                        <div>
                            <label class="text-sm font-semibold text-gray-600">Person in Distress</label>
                            <p class="text-gray-800 text-lg font-semibold">{{ $sos->name }}</p>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="text-sm font-semibold text-gray-600">Phone</label>
                                <a href="tel:{{ $sos->phone }}" class="text-blue-600 hover:text-blue-800 font-semibold">
                                    {{ $sos->phone }}
                                </a>
                            </div>
                            <div>
                                <label class="text-sm font-semibold text-gray-600">From User</label>
                                <p class="text-gray-800">{{ $sos->user->name }}</p>
                            </div>
                        </div>

                        <div>
                            <label class="text-sm font-semibold text-gray-600">Location</label>
                            <p class="text-gray-800 font-medium">{{ $sos->location }}</p>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="text-sm font-semibold text-gray-600">Latitude</label>
                                <p class="text-gray-800">{{ $sos->latitude ?? 'Not provided' }}</p>
                            </div>
                            <div>
                                <label class="text-sm font-semibold text-gray-600">Longitude</label>
                                <p class="text-gray-800">{{ $sos->longitude ?? 'Not provided' }}</p>
                            </div>
                        </div>

                        <div>
                            <label class="text-sm font-semibold text-gray-600">Description</label>
                            <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded mt-2 text-gray-800">
                                {{ $sos->description }}
                            </div>
                        </div>

                        <div>
                            <label class="text-sm font-semibold text-gray-600">Alert Time</label>
                            <p class="text-gray-800">{{ $sos->created_at->format('d M Y H:i') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Admin Response -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Admin Response</h3>
                    <div class="bg-blue-50 border-l-4 border-blue-500 p-4 rounded">
                        <p class="text-gray-800">{{ $sos->admin_response ?? 'No response yet' }}</p>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Quick Actions -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Actions</h3>
                    <div class="space-y-2">
                        <a href="{{ route('admin.sos.edit', $sos) }}" 
                           class="block px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition text-center font-semibold">
                            📝 Respond to Alert
                        </a>
                        <form method="POST" action="{{ route('admin.sos.destroy', $sos) }}" 
                              onsubmit="return confirm('Delete this SOS alert?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full px-4 py-2 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 transition font-semibold">
                                🗑️ Delete Alert
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Status Info -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Current Status</h3>
                    <div class="space-y-3">
                        <div>
                            @if($sos->status === 'active')
                                <p class="text-red-700 font-semibold">🔴 ACTIVE - Awaiting Response</p>
                            @elseif($sos->status === 'responded')
                                <p class="text-yellow-700 font-semibold">🟡 RESPONDED - Help Dispatched</p>
                            @else
                                <p class="text-green-700 font-semibold">✓ RESOLVED - Issue Resolved</p>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Alert Info -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Info</h3>
                    <div class="space-y-2 text-sm text-gray-600">
                        <p><strong>Alert ID:</strong> #{{ $sos->id }}</p>
                        <p><strong>Reported:</strong> {{ $sos->created_at->diffForHumans() }}</p>
                        <p><strong>Last Updated:</strong> {{ $sos->updated_at->diffForHumans() }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
