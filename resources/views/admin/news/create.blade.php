@extends('layouts.admin')

@section('page-title', 'Create News')

@section('content')
    <div class="max-w-2xl">
        <div class="bg-white rounded-lg shadow p-8">
            <h3 class="text-2xl font-bold text-gray-800 mb-6">Create New Article</h3>

            <form method="POST" action="{{ route('admin.news.store') }}" class="space-y-6">
                @csrf

                <!-- Title -->
                <div>
                    <label for="title" class="block text-sm font-semibold text-gray-700 mb-2">
                        Article Title <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="title" id="title" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('title') border-red-500 @enderror"
                           value="{{ old('title') }}" required>
                    @error('title')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Disaster Type -->
                <div>
                    <label for="disaster_type" class="block text-sm font-semibold text-gray-700 mb-2">
                        Disaster Type <span class="text-red-500">*</span>
                    </label>
                    <select name="disaster_type" id="disaster_type" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('disaster_type') border-red-500 @enderror"
                            required>
                        <option value="">-- Select Disaster Type --</option>
                        <option value="flood" {{ old('disaster_type') === 'flood' ? 'selected' : '' }}>Flood/Banjir</option>
                        <option value="earthquake" {{ old('disaster_type') === 'earthquake' ? 'selected' : '' }}>Earthquake/Gempa Bumi</option>
                        <option value="landslide" {{ old('disaster_type') === 'landslide' ? 'selected' : '' }}>Landslide/Tanah Longsor</option>
                        <option value="tsunami" {{ old('disaster_type') === 'tsunami' ? 'selected' : '' }}>Tsunami</option>
                        <option value="cyclone" {{ old('disaster_type') === 'cyclone' ? 'selected' : '' }}>Cyclone/Puting Beliung</option>
                        <option value="volcanic" {{ old('disaster_type') === 'volcanic' ? 'selected' : '' }}>Volcanic/Letusan Gunung Api</option>
                        <option value="wildfire" {{ old('disaster_type') === 'wildfire' ? 'selected' : '' }}>Wildfire/Kebakaran Hutan</option>
                        <option value="drought" {{ old('disaster_type') === 'drought' ? 'selected' : '' }}>Drought/Kekeringan</option>
                        <option value="other" {{ old('disaster_type') === 'other' ? 'selected' : '' }}>Other/Lainnya</option>
                    </select>
                    @error('disaster_type')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Content -->
                <div>
                    <label for="content" class="block text-sm font-semibold text-gray-700 mb-2">
                        Content <span class="text-red-500">*</span>
                    </label>
                    <textarea name="content" id="content" rows="12" 
                              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('content') border-red-500 @enderror"
                              required>{{ old('content') }}</textarea>
                    <p class="text-gray-500 text-sm mt-2">Provide detailed article content about the disaster</p>
                    @error('content')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Status -->
                <div>
                    <label for="status" class="block text-sm font-semibold text-gray-700 mb-2">
                        Status <span class="text-red-500">*</span>
                    </label>
                    <div class="space-y-2">
                        <label class="flex items-center">
                            <input type="radio" name="status" value="published" 
                                   {{ old('status') === 'published' ? 'checked' : '' }} class="mr-3">
                            <span class="text-gray-700">Publish Immediately</span>
                        </label>
                        <label class="flex items-center">
                            <input type="radio" name="status" value="draft" 
                                   {{ old('status') === 'draft' ? 'checked' : '' }} class="mr-3">
                            <span class="text-gray-700">Save as Draft</span>
                        </label>
                    </div>
                    @error('status')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Buttons -->
                <div class="flex space-x-4 pt-6 border-t border-gray-200">
                    <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition font-semibold">
                        Create Article
                    </button>
                    <a href="{{ route('admin.news') }}" class="bg-gray-300 text-gray-800 px-6 py-2 rounded-lg hover:bg-gray-400 transition font-semibold">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
