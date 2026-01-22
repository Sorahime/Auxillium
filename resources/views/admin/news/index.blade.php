@extends('layouts.admin')

@section('page-title', 'News Management')

@section('content')
    <div class="space-y-6">
        <div class="flex justify-between items-center">
            <h3 class="text-2xl font-bold text-gray-800">News & Articles</h3>
            <a href="{{ route('admin.news.create') }}" 
               class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition font-semibold">
                + Create News
            </a>
        </div>

        <!-- News Table -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <table class="w-full">
                <thead class="bg-gray-100 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Title</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Disaster Type</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Status</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Created</th>
                        <th class="px-6 py-4 text-center text-sm font-semibold text-gray-700">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($news as $article)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 text-sm font-medium text-gray-800">{{ $article->title }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">
                                <span class="px-2 py-1 bg-orange-100 text-orange-800 rounded text-xs font-semibold">
                                    {{ ucfirst($article->disaster_type) }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                @if($article->status === 'published')
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Published</span>
                                @else
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">Draft</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $article->created_at->format('d M Y') }}</td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex justify-center space-x-2">
                                    <a href="{{ route('admin.news.edit', $article) }}" 
                                       class="text-blue-600 hover:text-blue-800 font-semibold text-sm">
                                        Edit
                                    </a>
                                    <form method="POST" action="{{ route('admin.news.destroy', $article) }}" 
                                          class="inline" 
                                          onsubmit="return confirm('Delete this article?');">
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
                            <td colspan="5" class="px-6 py-8 text-center text-gray-600">
                                No news articles found. Create one to get started!
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="flex justify-center">
            {{ $news->links() }}
        </div>
    </div>
@endsection
