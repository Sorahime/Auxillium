@extends('layouts.app')

@section('title', 'Submit Disaster Report')

@section('content')
    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">Report Disaster or Emergency</h2>
                    
                    <form method="POST" action="{{ route('report.store') }}" enctype="multipart/form-data" class="space-y-6">
                        @csrf

                        <!-- Title -->
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700">Report Title *</label>
                            <input type="text" 
                                   id="title" 
                                   name="title" 
                                   value="{{ old('title') }}"
                                   placeholder="e.g., Flood in Downtown Area"
                                   required
                                   class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('title') border-red-500 @enderror">
                            @error('title')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700">Description *</label>
                            <textarea id="description" 
                                      name="description" 
                                      rows="4"
                                      placeholder="Provide detailed information about the disaster..."
                                      required
                                      class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
                            @error('description')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Disaster Type -->
                        <div>
                            <label for="disaster_type" class="block text-sm font-medium text-gray-700">Disaster Type *</label>
                            <select id="disaster_type" 
                                    name="disaster_type" 
                                    required
                                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('disaster_type') border-red-500 @enderror">
                                <option value="">-- Select Type --</option>
                                <option value="earthquake" {{ old('disaster_type') === 'earthquake' ? 'selected' : '' }}>Earthquake</option>
                                <option value="flood" {{ old('disaster_type') === 'flood' ? 'selected' : '' }}>Flood</option>
                                <option value="landslide" {{ old('disaster_type') === 'landslide' ? 'selected' : '' }}>Landslide</option>
                                <option value="tsunami" {{ old('disaster_type') === 'tsunami' ? 'selected' : '' }}>Tsunami</option>
                                <option value="tornado" {{ old('disaster_type') === 'tornado' ? 'selected' : '' }}>Tornado</option>
                                <option value="hurricane" {{ old('disaster_type') === 'hurricane' ? 'selected' : '' }}>Hurricane</option>
                                <option value="wildfire" {{ old('disaster_type') === 'wildfire' ? 'selected' : '' }}>Wildfire</option>
                                <option value="volcano" {{ old('disaster_type') === 'volcano' ? 'selected' : '' }}>Volcano</option>
                                <option value="drought" {{ old('disaster_type') === 'drought' ? 'selected' : '' }}>Drought</option>
                                <option value="other" {{ old('disaster_type') === 'other' ? 'selected' : '' }}>Other</option>
                            </select>
                            @error('disaster_type')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Location -->
                        <div>
                            <label for="location" class="block text-sm font-medium text-gray-700">Location/Address *</label>
                            <input type="text" 
                                   id="location" 
                                   name="location" 
                                   value="{{ old('location') }}"
                                   placeholder="e.g., Jalan Merdeka No. 123, Jakarta"
                                   required
                                   class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('location') border-red-500 @enderror">
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
                                       class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('latitude') border-red-500 @enderror">
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
                                       class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('longitude') border-red-500 @enderror">
                                @error('longitude')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Photo -->
                        <div>
                            <label for="photo" class="block text-sm font-medium text-gray-700">Photo (Optional)</label>
                            <div class="mt-2 flex items-center justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:border-gray-400 transition">
                                <div class="text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                        <path d="M28 8H12a4 4 0 00-4 4v20a4 4 0 004 4h24a4 4 0 004-4V16a4 4 0 00-4-4z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        <circle cx="14" cy="20" r="2" fill="currentColor"/>
                                        <path d="M28 20L20 28m0 0l-4-4m4 4l12-12" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    <p class="mt-2 text-sm text-gray-600">
                                        <label for="photo" class="relative cursor-pointer text-blue-600 hover:text-blue-500 font-medium">
                                            Click to upload
                                            <input id="photo" type="file" name="photo" accept="image/*" class="hidden" />
                                        </label>
                                        or drag and drop
                                    </p>
                                    <p class="text-xs text-gray-500">PNG, JPG, up to 5MB</p>
                                </div>
                            </div>
                            @error('photo')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Buttons -->
                        <div class="flex items-center justify-between pt-6">
                            <a href="{{ route('home') }}" class="text-gray-600 hover:text-gray-800 font-medium">Cancel</a>
                            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition font-semibold">
                                Submit Report
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
