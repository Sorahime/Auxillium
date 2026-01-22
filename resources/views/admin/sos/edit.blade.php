@extends('layouts.admin')

@section('page-title', 'Respond to SOS Alert')

@section('content')
    <div class="max-w-3xl">
        <div class="mb-6">
            <a href="{{ route('admin.sos.show', $sos) }}" class="text-blue-600 hover:text-blue-800 font-semibold">
                ← Back to Alert
            </a>
        </div>

        <div class="bg-white rounded-lg shadow p-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Respond to SOS Alert</h2>

            <form method="POST" action="{{ route('admin.sos.update', $sos) }}" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Alert Info (Read Only) -->
                <div class="bg-gray-50 p-6 rounded-lg border border-gray-200 space-y-4">
                    <h3 class="font-semibold text-gray-700 mb-4">Alert Information (Read Only)</h3>
                    
                    <div>
                        <label class="text-sm font-semibold text-gray-700">Person in Distress</label>
                        <p class="mt-1 text-gray-800 font-medium">{{ $sos->name }}</p>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="text-sm font-semibold text-gray-700">Phone</label>
                            <p class="mt-1 text-gray-800 font-medium">{{ $sos->phone }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-semibold text-gray-700">Location</label>
                            <p class="mt-1 text-gray-800 font-medium">{{ $sos->location }}</p>
                        </div>
                    </div>

                    <div>
                        <label class="text-sm font-semibold text-gray-700">Description</label>
                        <p class="mt-1 text-gray-800">{{ $sos->description }}</p>
                    </div>
                </div>

                <!-- Status -->
                <div>
                    <label for="status" class="block text-sm font-semibold text-gray-700 mb-2">
                        Response Status <span class="text-red-500">*</span>
                    </label>
                    <select name="status" id="status" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                            required>
                        <option value="">-- Select Status --</option>
                        <option value="active" {{ $sos->status === 'active' ? 'selected' : '' }}>Active (No Response Yet)</option>
                        <option value="responded" {{ $sos->status === 'responded' ? 'selected' : '' }}>Responded (Help Dispatched)</option>
                        <option value="resolved" {{ $sos->status === 'resolved' ? 'selected' : '' }}>Resolved (Issue Resolved)</option>
                    </select>
                    @error('status')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Admin Response -->
                <div>
                    <label for="admin_response" class="block text-sm font-semibold text-gray-700 mb-2">
                        Response Notes <span class="text-red-500">*</span>
                    </label>
                    <textarea name="admin_response" id="admin_response" rows="6" 
                              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                              placeholder="Describe your response actions..."
                              required>{{ old('admin_response', $sos->admin_response) }}</textarea>
                    <p class="text-sm text-gray-600 mt-2">Include: who you dispatched, arrival time, actions taken, etc.</p>
                    @error('admin_response')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Buttons -->
                <div class="flex space-x-4 pt-6 border-t border-gray-200">
                    <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition font-semibold">
                        Save Response
                    </button>
                    <a href="{{ route('admin.sos.show', $sos) }}" class="bg-gray-300 text-gray-800 px-6 py-2 rounded-lg hover:bg-gray-400 transition font-semibold">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
