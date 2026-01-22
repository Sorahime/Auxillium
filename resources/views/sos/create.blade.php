@extends('layouts.app')

@section('title', 'Send SOS Alert')

@section('content')
    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="text-2xl font-bold text-red-600 mb-2">🚨 EMERGENCY SOS ALERT</h2>
                    <p class="text-gray-600 mb-6">Send an immediate emergency alert. Help will be dispatched to your location.</p>
                    
                    <form method="POST" action="{{ route('sos.store') }}" class="space-y-6">
                        @csrf

                        <!-- Person's Name -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Your Full Name *</label>
                            <input type="text" 
                                   id="name" 
                                   name="name" 
                                   value="{{ old('name', auth()->user()->name) }}"
                                   placeholder="e.g., John Doe"
                                   required
                                   class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 @error('name') border-red-500 @enderror">
                            @error('name')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Phone Number -->
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700">Contact Phone Number *</label>
                            <input type="tel" 
                                   id="phone" 
                                   name="phone" 
                                   value="{{ old('phone', auth()->user()->phone) }}"
                                   placeholder="e.g., 081234567890"
                                   required
                                   class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 @error('phone') border-red-500 @enderror">
                            @error('phone')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Emergency Description -->
                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700">Emergency Description *</label>
                            <textarea id="description" 
                                      name="description" 
                                      rows="4"
                                      placeholder="Briefly describe your emergency situation..."
                                      required
                                      class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
                            <p class="mt-1 text-xs text-gray-500">Be specific about your situation to help rescue teams respond faster</p>
                            @error('description')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Location -->
                        <div>
                            <label for="location" class="block text-sm font-medium text-gray-700">Your Location/Address *</label>
                            <input type="text" 
                                   id="location" 
                                   name="location" 
                                   value="{{ old('location') }}"
                                   placeholder="e.g., Jalan Merdeka No. 123, Jakarta"
                                   required
                                   class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 @error('location') border-red-500 @enderror">
                            @error('location')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Coordinates (Optional) -->
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="latitude" class="block text-sm font-medium text-gray-700">Latitude (Optional)</label>
                                <input type="number" 
                                       id="latitude" 
                                       name="latitude" 
                                       value="{{ old('latitude') }}"
                                       step="0.00000001"
                                       min="-90"
                                       max="90"
                                       placeholder="e.g., -6.2088"
                                       class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 @error('latitude') border-red-500 @enderror">
                                @error('latitude')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="longitude" class="block text-sm font-medium text-gray-700">Longitude (Optional)</label>
                                <input type="number" 
                                       id="longitude" 
                                       name="longitude" 
                                       value="{{ old('longitude') }}"
                                       step="0.00000001"
                                       min="-180"
                                       max="180"
                                       placeholder="e.g., 106.8456"
                                       class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 @error('longitude') border-red-500 @enderror">
                                @error('longitude')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Alert -->
                        <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                            <p class="text-sm text-red-800">
                                <strong>⚠️ Important:</strong> Send this alert only if you or someone nearby needs immediate emergency assistance. False alerts may delay help to others.
                            </p>
                        </div>

                        <!-- Buttons -->
                        <div class="flex items-center justify-between pt-6">
                            <a href="{{ route('home') }}" class="text-gray-600 hover:text-gray-800 font-medium">Cancel</a>
                            <button type="submit" class="bg-red-600 text-white px-8 py-3 rounded-lg hover:bg-red-700 transition font-bold text-lg">
                                🚨 SEND SOS ALERT
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
