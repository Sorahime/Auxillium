@extends('layouts.admin')

@section('page-title', 'Reports Management')

@section('content')
    <div class="space-y-6">
        <div class="flex justify-between items-center">
            <h3 class="text-2xl font-bold text-gray-800">Disaster Reports</h3>
            <span class="text-gray-600 bg-blue-100 px-3 py-1 rounded-full text-blue-700 font-semibold">
                Total: {{ $reports->total() }}
            </span>
        </div>

        <!-- Filter by Status -->
        <div class="bg-white rounded-lg shadow p-4">
            <div class="flex gap-2">
                <a href="?status=" class="px-4 py-2 rounded-lg border hover:bg-blue-50 transition">All</a>
                <a href="?status=pending" class="px-4 py-2 rounded-lg border border-yellow-300 bg-yellow-50">Pending</a>
                <a href="?status=verified" class="px-4 py-2 rounded-lg border border-green-300 bg-green-50">Verified</a>
                <a href="?status=resolved" class="px-4 py-2 rounded-lg border border-blue-300 bg-blue-50">Resolved</a>
            </div>
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
                    @forelse($reports as $report)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 text-sm font-medium text-gray-800">{{ $report->title }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $report->user->name }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">
                                <span class="px-2 py-1 bg-orange-100 text-orange-800 rounded text-xs font-semibold">
                                    {{ ucfirst($report->disaster_type) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $report->location }}</td>
                            <td class="px-6 py-4">
                                @if($report->status === 'pending')
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Pending</span>
                                @elseif($report->status === 'verified')
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Verified</span>
                                @else
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">Resolved</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $report->created_at->format('d M Y') }}</td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex justify-center space-x-2">
                                    <a href="{{ route('admin.reports.show', $report) }}" 
                                       class="text-blue-600 hover:text-blue-800 font-semibold text-sm">
                                        View
                                    </a>
                                    <a href="{{ route('admin.reports.edit', $report) }}" 
                                       class="text-green-600 hover:text-green-800 font-semibold text-sm">
                                        Edit
                                    </a>
                                    <form method="POST" action="{{ route('admin.reports.destroy', $report) }}" 
                                          class="inline" 
                                          onsubmit="return confirm('Delete this report?');">
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
                            <td colspan="7" class="px-6 py-8 text-center text-gray-600">
                                No reports found
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="flex justify-center">
            {{ $reports->links() }}
        </div>
    </div>
@endsection
