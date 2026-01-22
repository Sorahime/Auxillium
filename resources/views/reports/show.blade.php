@extends('layouts.app')

@section('title', 'Report Details')

@section('content')
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-between items-start mb-6">
                        <div>
                            <h2 class="text-3xl font-bold text-gray-800">{{ $report->title }}</h2>
                            <p class="text-gray-600 mt-1">Submitted by {{ $report->user->name }} on {{ $report->created_at->format('d M Y H:i') }}</p>
                        </div>
                        <a href="{{ route('report.my') }}" class="text-blue-600 hover:text-blue-800 font-semibold">← Back to My Reports</a>
                    </div>

                    <!-- Status and Type -->
                    <div class="flex gap-4 mb-6">
                        <span class="px-4 py-2 bg-orange-100 text-orange-800 rounded-full font-semibold">
                            {{ ucfirst($report->disaster_type) }}
                        </span>
                        @if($report->status === 'pending')
                            <span class="px-4 py-2 bg-yellow-100 text-yellow-800 rounded-full font-semibold">⏳ Pending Review</span>
                        @elseif($report->status === 'verified')
                            <span class="px-4 py-2 bg-blue-100 text-blue-800 rounded-full font-semibold">✓ Verified</span>
                        @else
                            <span class="px-4 py-2 bg-green-100 text-green-800 rounded-full font-semibold">✓ Resolved</span>
                        @endif
                    </div>

                    <!-- Description -->
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-3">Description</h3>
                        <p class="text-gray-700 whitespace-pre-line">{{ $report->description }}</p>
                    </div>

                    <!-- Location Info -->
                    <div class="grid grid-cols-2 gap-6 mb-6">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800 mb-2">Location</h3>
                            <p class="text-gray-700">{{ $report->location }}</p>
                        </div>
                        
                        @if($report->latitude && $report->longitude)
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800 mb-2">Coordinates</h3>
                                <p class="text-gray-700">
                                    <strong>Latitude:</strong> {{ $report->latitude }}<br>
                                    <strong>Longitude:</strong> {{ $report->longitude }}
                                </p>
                            </div>
                        @endif
                    </div>

                    <!-- Photo -->
                    @if($report->photo_path)
                        <div class="mb-6">
                            <h3 class="text-lg font-semibold text-gray-800 mb-3">Attached Photo</h3>
                            <img src="{{ Storage::url($report->photo_path) }}" alt="Report photo" class="max-w-2xl rounded-lg border border-gray-200">
                        </div>
                    @endif

                    <!-- Admin Notes (if available) -->
                    @if($report->admin_notes && auth()->user()->isAdmin())
                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
                            <h3 class="text-lg font-semibold text-blue-800 mb-2">Admin Notes</h3>
                            <p class="text-blue-700">{{ $report->admin_notes }}</p>
                        </div>
                    @endif

                    <!-- Admin Actions (if user is admin) -->
                    @if(auth()->user()->isAdmin())
                        <div class="border-t border-gray-200 pt-6 mt-6">
                            <a href="{{ route('admin.reports.edit', $report) }}" class="inline-block bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition font-semibold">
                                Edit Report
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
