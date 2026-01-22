@extends('layouts.admin')

@section('page-title', 'SOS Alerts Management')

@section('content')
    <div class="space-y-6">
        <div class="flex justify-between items-center">
            <h3 class="text-2xl font-bold text-gray-800">SOS Emergency Alerts</h3>
            <span class="text-gray-600 bg-red-100 px-3 py-1 rounded-full text-red-700 font-semibold">
                Total: {{ $sos->total() }}
            </span>
        </div>

        <!-- Status Counters -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded">
                <p class="text-sm text-red-700 font-semibold">Active SOS</p>
                <p class="text-3xl font-bold text-red-700 mt-2">
                    {{ \App\Models\Sos::where('status', 'active')->count() }}
                </p>
            </div>

            <div class="bg-yellow-50 border-l-4 border-yellow-500 p-4 rounded">
                <p class="text-sm text-yellow-700 font-semibold">Responded</p>
                <p class="text-3xl font-bold text-yellow-700 mt-2">
                    {{ \App\Models\Sos::where('status', 'responded')->count() }}
                </p>
            </div>

            <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded">
                <p class="text-sm text-green-700 font-semibold">Resolved</p>
                <p class="text-3xl font-bold text-green-700 mt-2">
                    {{ \App\Models\Sos::where('status', 'resolved')->count() }}
                </p>
            </div>
        </div>

        <!-- SOS Alerts Table -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <table class="w-full">
                <thead class="bg-gray-100 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Name</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Phone</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Location</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Status</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Time</th>
                        <th class="px-6 py-4 text-center text-sm font-semibold text-gray-700">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($sos as $alert)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 text-sm font-medium text-gray-800">{{ $alert->name }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $alert->phone }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $alert->location }}</td>
                            <td class="px-6 py-4">
                                @if($alert->status === 'active')
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Active</span>
                                @elseif($alert->status === 'responded')
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Responded</span>
                                @else
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Resolved</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $alert->created_at->format('d M Y H:i') }}</td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex justify-center space-x-2">
                                    <a href="{{ route('admin.sos.show', $alert) }}" 
                                       class="text-blue-600 hover:text-blue-800 font-semibold text-sm">
                                        View
                                    </a>
                                    <a href="{{ route('admin.sos.edit', $alert) }}" 
                                       class="text-green-600 hover:text-green-800 font-semibold text-sm">
                                        Respond
                                    </a>
                                    <form method="POST" action="{{ route('admin.sos.destroy', $alert) }}" 
                                          class="inline" 
                                          onsubmit="return confirm('Delete this SOS alert?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800 font-semibold text-sm">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-8 text-center text-gray-600">
                                No SOS alerts found
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="flex justify-center">
            {{ $sos->links() }}
        </div>
    </div>
@endsection
