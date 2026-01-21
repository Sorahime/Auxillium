@extends('layouts.admin')

@section('page-title', 'User Details')

@section('content')
    <div class="max-w-2xl">
        <div class="mb-6">
            <a href="{{ route('admin.users') }}" class="text-blue-600 hover:text-blue-800 font-semibold">
                ← Back to Users
            </a>
        </div>

        <!-- User Info Card -->
        <div class="bg-white rounded-lg shadow p-8 space-y-6">
            <div class="flex items-start justify-between border-b border-gray-200 pb-6">
                <div>
                    <h3 class="text-2xl font-bold text-gray-800">{{ $user->name }}</h3>
                    <p class="text-gray-600 text-sm mt-1">User ID: #{{ $user->id }}</p>
                </div>
                <span class="px-4 py-2 bg-green-100 text-green-800 rounded-full text-sm font-semibold">
                    Active
                </span>
            </div>

            <!-- User Details -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
                    <p class="text-gray-800">{{ $user->email }}</p>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Phone</label>
                    <p class="text-gray-800">{{ $user->phone ?? 'Not provided' }}</p>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Member Since</label>
                    <p class="text-gray-800">{{ $user->created_at->format('d M Y H:i') }}</p>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Last Updated</label>
                    <p class="text-gray-800">{{ $user->updated_at->format('d M Y H:i') }}</p>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Email Status</label>
                    @if($user->email_verified_at)
                        <p class="text-green-600">✓ Verified ({{ $user->email_verified_at->format('d M Y') }})</p>
                    @else
                        <p class="text-yellow-600">⚠ Not Verified</p>
                    @endif
                </div>
            </div>

            <!-- Actions -->
            <div class="border-t border-gray-200 pt-6">
                <h4 class="text-sm font-semibold text-gray-700 mb-4">Actions</h4>
                <div class="space-y-2">
                    <form method="POST" action="{{ route('admin.users.destroy', $user) }}" 
                          onsubmit="return confirm('Are you sure you want to delete this user? This action cannot be undone.');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full px-4 py-2 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 transition font-semibold text-left">
                            🗑️ Delete User
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Additional Info -->
        <div class="mt-6 bg-blue-50 border border-blue-200 rounded-lg p-4">
            <p class="text-sm text-blue-800">
                <strong>Note:</strong> This user is registered in the system and can access all user features including disaster reporting and SOS alerts.
            </p>
        </div>
    </div>
@endsection
