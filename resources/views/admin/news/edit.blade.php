@extends('layouts.admin')

@section('page-title', 'Edit News Article')

@section('content')
    <div class="max-w-2xl mx-auto">
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="p-6">
                <h3 class="text-2xl font-bold text-gray-800 mb-6">Edit News Article</h3>

                <form method="POST" action="{{ route('admin.news.update', $news) }}" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Title -->
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700">Title *</label>
                        <input type="text" 
                               id="title" 
                               name="title" 
                               value="{{ old('title', $news->title) }}"
                               placeholder="News article title"
                               required
                               class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('title') border-red-500 @enderror">
                        @error('title')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Content -->
                    <div>
                        <label for="content" class="block text-sm font-medium text-gray-700">Content *</label>
                        <textarea id="content" 
                                  name="content" 
                                  rows="8"
                                  placeholder="Article content..."
                                  required
                                  class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('content') border-red-500 @enderror">{{ old('content', $news->content) }}</textarea>
                        @error('content')
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
                            <option value="earthquake" {{ old('disaster_type', $news->disaster_type) === 'earthquake' ? 'selected' : '' }}>Earthquake</option>
                            <option value="flood" {{ old('disaster_type', $news->disaster_type) === 'flood' ? 'selected' : '' }}>Flood</option>
                            <option value="landslide" {{ old('disaster_type', $news->disaster_type) === 'landslide' ? 'selected' : '' }}>Landslide</option>
                            <option value="tsunami" {{ old('disaster_type', $news->disaster_type) === 'tsunami' ? 'selected' : '' }}>Tsunami</option>
                            <option value="tornado" {{ old('disaster_type', $news->disaster_type) === 'tornado' ? 'selected' : '' }}>Tornado</option>
                            <option value="hurricane" {{ old('disaster_type', $news->disaster_type) === 'hurricane' ? 'selected' : '' }}>Hurricane</option>
                            <option value="wildfire" {{ old('disaster_type', $news->disaster_type) === 'wildfire' ? 'selected' : '' }}>Wildfire</option>
                            <option value="volcano" {{ old('disaster_type', $news->disaster_type) === 'volcano' ? 'selected' : '' }}>Volcano</option>
                            <option value="drought" {{ old('disaster_type', $news->disaster_type) === 'drought' ? 'selected' : '' }}>Drought</option>
                            <option value="other" {{ old('disaster_type', $news->disaster_type) === 'other' ? 'selected' : '' }}>Other</option>
                        </select>
                        @error('disaster_type')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700">Status *</label>
                        <select id="status" 
                                name="status" 
                                required
                                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('status') border-red-500 @enderror">
                            <option value="draft" {{ old('status', $news->status) === 'draft' ? 'selected' : '' }}>Draft (Not Published)</option>
                            <option value="published" {{ old('status', $news->status) === 'published' ? 'selected' : '' }}>Publish</option>
                        </select>
                        @error('status')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Image -->
                    @if($news->image_path)
                        <div>
                            <p class="text-sm font-medium text-gray-700 mb-2">Current Image</p>
                            <img src="{{ Storage::url($news->image_path) }}" alt="Article image" class="max-w-xs rounded-lg border border-gray-200">
                        </div>
                    @endif

                    <div>
                        <label for="image_path" class="block text-sm font-medium text-gray-700">Change Featured Image (Optional)</label>
                        <div class="mt-2 flex items-center justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:border-gray-400 transition">
                            <div class="text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                    <path d="M28 8H12a4 4 0 00-4 4v20a4 4 0 004 4h24a4 4 0 004-4V16a4 4 0 00-4-4z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <circle cx="14" cy="20" r="2" fill="currentColor"/>
                                    <path d="M28 20L20 28m0 0l-4-4m4 4l12-12" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                <p class="mt-2 text-sm text-gray-600">
                                    <label for="image_path" class="relative cursor-pointer text-blue-600 hover:text-blue-500 font-medium">
                                        Click to upload
                                        <input id="image_path" type="file" name="image_path" accept="image/*" class="hidden" />
                                    </label>
                                    or drag and drop
                                </p>
                                <p class="text-xs text-gray-500">PNG, JPG, up to 5MB</p>
                            </div>
                        </div>
                        @error('image_path')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Buttons -->
                    <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                        <a href="{{ route('admin.news') }}" class="text-gray-600 hover:text-gray-800 font-medium">Cancel</a>
                        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition font-semibold">
                            Update Article
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
