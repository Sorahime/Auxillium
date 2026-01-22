@extends('layouts.app')

@section('title', 'SOS Alert Details')

@section('content')
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-between items-start mb-6">
                        <div>
                            <h2 class="text-3xl font-bold text-red-600">🚨 SOS Alert</h2>
                            <p class="text-gray-600 mt-1">Alert ID: {{ $sos->id }} | Sent on {{ $sos->created_at->format('d M Y H:i:s') }}</p>
                        </div>
                        <a href="{{ route('sos.my') }}" class="text-blue-600 hover:text-blue-800 font-semibold">← Back to My Alerts</a>
                    </div>

                    <!-- Status -->
                    <div class="mb-6">
                        @if($sos->status === 'active')
                            <span class="px-4 py-2 bg-red-100 text-red-800 rounded-full font-semibold animate-pulse">⏳ Alert Active - Help Dispatched</span>
                        @elseif($sos->status === 'responded')
                            <span class="px-4 py-2 bg-blue-100 text-blue-800 rounded-full font-semibold">✓ Responders En Route</span>
                        @else
                            <span class="px-4 py-2 bg-green-100 text-green-800 rounded-full font-semibold">✓ Alert Resolved</span>
                        @endif
                    </div>

                    <!-- Contact Information -->
                    <div class="grid grid-cols-2 gap-6 mb-6">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800 mb-2">Person in Distress</h3>
                            <p class="text-gray-700"><strong>Name:</strong> {{ $sos->name }}</p>
                            @if($sos->phone)
                                <p class="text-gray-700"><strong>Phone:</strong> <a href="tel:{{ $sos->phone }}" class="text-blue-600 hover:text-blue-800">{{ $sos->phone }}</a></p>
                            @endif
                        </div>
                        
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800 mb-2">Location</h3>
                            <p class="text-gray-700">{{ $sos->location }}</p>
                            @if($sos->latitude && $sos->longitude)
                                <p class="text-sm text-gray-600 mt-2">
                                    Lat: {{ $sos->latitude }} | Lng: {{ $sos->longitude }}
                                </p>
                            @endif
                        </div>
                    </div>

                    <!-- Emergency Description -->
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-3">Emergency Description</h3>
                        <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                            <p class="text-gray-800 whitespace-pre-line">{{ $sos->description }}</p>
                        </div>
                    </div>

                    <!-- Admin Response -->
                    @if($sos->admin_response)
                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
                            <h3 class="text-lg font-semibold text-blue-800 mb-2">Admin Response</h3>
                            <p class="text-blue-700">{{ $sos->admin_response }}</p>
                        </div>
                    @endif

                    <!-- Admin Actions (if user is admin) -->
                    @if(auth()->user()->isAdmin())
                        <div class="border-t border-gray-200 pt-6 mt-6">
                            <a href="{{ route('admin.sos.edit', $sos) }}" class="inline-block bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition font-semibold">
                                Respond to SOS Alert
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
