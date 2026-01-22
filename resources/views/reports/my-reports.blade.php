@extends('layouts.app')

@section('title', 'My Reports')

@section('content')
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold text-gray-800">My Disaster Reports</h2>
                        <a href="{{ route('report.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition font-semibold">
                            + New Report
                        </a>
                    </div>

                    @if($reports->count() > 0)
                        <div class="space-y-4">
                            @foreach($reports as $report)
                                <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition">
                                    <div class="flex justify-between items-start">
                                        <div class="flex-1">
                                            <h3 class="text-lg font-semibold text-gray-800">{{ $report->title }}</h3>
                                            <p class="text-gray-600 text-sm mt-1">{{ Str::limit($report->description, 150) }}</p>
                                            
                                            <div class="flex items-center gap-4 mt-3 text-sm text-gray-600">
                                                <span class="px-3 py-1 bg-orange-100 text-orange-800 rounded-full font-semibold">
                                                    {{ ucfirst($report->disaster_type) }}
                                                </span>
                                                <span>
                                                    Status:
                                                    @if($report->status === 'pending')
                                                        <span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded font-semibold">Pending</span>
                                                    @elseif($report->status === 'verified')
                                                        <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded font-semibold">Verified</span>
                                                    @else
                                                        <span class="px-2 py-1 bg-green-100 text-green-800 rounded font-semibold">Resolved</span>
                                                    @endif
                                                </span>
                                                <span class="text-gray-500">{{ $report->created_at->format('d M Y H:i') }}</span>
                                            </div>
                                        </div>
                                        <a href="{{ route('report.show', $report) }}" class="ml-4 text-blue-600 hover:text-blue-800 font-semibold">
                                            View →
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Pagination -->
                        <div class="mt-6">
                            {{ $reports->links() }}
                        </div>
                    @else
                        <div class="text-center py-12">
                            <p class="text-gray-600 text-lg mb-4">You haven't submitted any reports yet.</p>
                            <a href="{{ route('report.create') }}" class="inline-block bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition font-semibold">
                                Submit Your First Report
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
