@extends('layouts.app')

@section('title', 'My SOS Alerts')

@section('content')
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold text-gray-800">My SOS Alerts</h2>
                        <a href="{{ route('sos.create') }}" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition font-semibold">
                            🚨 Send SOS
                        </a>
                    </div>

                    @if($alerts->count() > 0)
                        <div class="space-y-4">
                            @foreach($alerts as $alert)
                                <div class="border-l-4 border-red-600 bg-red-50 rounded-lg p-4 hover:shadow-md transition">
                                    <div class="flex justify-between items-start">
                                        <div class="flex-1">
                                            <h3 class="text-lg font-semibold text-red-800">🚨 {{ $alert->name }}</h3>
                                            <p class="text-gray-700 text-sm mt-1">{{ Str::limit($alert->description, 150) }}</p>
                                            
                                            <div class="flex items-center gap-4 mt-3 text-sm text-gray-600">
                                                <span class="text-gray-700">
                                                    <strong>Location:</strong> {{ $alert->location }}
                                                </span>
                                                <span>
                                                    @if($alert->status === 'active')
                                                        <span class="px-3 py-1 bg-red-100 text-red-800 rounded font-semibold animate-pulse">⏳ Active</span>
                                                    @elseif($alert->status === 'responded')
                                                        <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded font-semibold">✓ Responded</span>
                                                    @else
                                                        <span class="px-3 py-1 bg-green-100 text-green-800 rounded font-semibold">✓ Resolved</span>
                                                    @endif
                                                </span>
                                                <span class="text-gray-500">{{ $alert->created_at->format('d M Y H:i') }}</span>
                                            </div>
                                        </div>
                                        <a href="{{ route('sos.show', $alert) }}" class="ml-4 text-blue-600 hover:text-blue-800 font-semibold">
                                            View →
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Pagination -->
                        <div class="mt-6">
                            {{ $alerts->links() }}
                        </div>
                    @else
                        <div class="text-center py-12">
                            <p class="text-gray-600 text-lg mb-4">You haven't sent any SOS alerts yet.</p>
                            <a href="{{ route('sos.create') }}" class="inline-block bg-red-600 text-white px-6 py-2 rounded-lg hover:bg-red-700 transition font-semibold">
                                Send SOS Alert
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
