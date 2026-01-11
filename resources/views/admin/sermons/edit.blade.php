@extends('admin.layouts.app')

@section('title', 'Edit Sermon')

@section('content')
<div class="p-6">
    <!-- Success/Error Messages -->
    @if(session('success'))
        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg">
            <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg">
            <i class="fas fa-exclamation-triangle mr-2"></i>
            <ul class="list-disc ml-4">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Header -->
    <div class="mb-8">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
            <div class="flex items-center space-x-4">
                <a href="{{ route('admin.sermons.index') }}" 
                   class="inline-flex items-center px-4 py-2 text-gray-600 hover:text-gray-900 bg-white border border-gray-300 rounded-lg shadow-sm hover:bg-gray-50 transition-colors">
                    <i class="fas fa-arrow-left mr-2"></i> Back to Sermons
                </a>
                <div>
                    <h1 class="text-3xl font-bold text-white">Edit Sermon</h1>
                    <p class="text-gray-300 mt-1">Update sermon details and spiritual content</p>
                </div>
            </div>
            
            <!-- Quick Actions -->
            <div class="flex space-x-3 mt-4 md:mt-0">
                <a href="{{ route('admin.sermons.show', $sermon) }}"
                   class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-800 font-medium rounded-lg transition-colors">
                    <i class="fas fa-eye mr-2"></i>
                    Preview
                </a>
                @if(!$sermon->is_published)
                <form action="{{ route('admin.sermons.toggle-publish', $sermon) }}" method="POST" class="inline">
                    @csrf
                    <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-[#197b3b] hover:bg-[#15632f] text-white font-medium rounded-lg transition-colors">
                        <i class="fas fa-eye mr-2"></i>
                        Publish Now
                    </button>
                </form>
                @endif
            </div>
        </div>
    </div>

    <!-- Form -->
    <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
        <div class="bg-gradient-to-r from-black to-gray-800 px-6 py-4">
            <h2 class="text-xl font-semibold text-white">Edit Sermon Details</h2>
            <p class="text-gray-300 text-sm mt-1">Last updated: {{ $sermon->updated_at->format('M d, Y \a\t h:i A') }}</p>
        </div>
        
        <form action="{{ route('admin.sermons.update', $sermon) }}" method="POST" class="p-6">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Left Column -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Title -->
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                            Sermon Title *
                        </label>
                        <input type="text" 
                               name="title" 
                               id="title" 
                               value="{{ old('title', $sermon->title) }}"
                               required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#197b3b] focus:border-[#197b3b] transition-colors text-black"
                               placeholder="Enter sermon title">
                    </div>

                    <!-- Description (Using for spiritual notes) -->
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                            Spiritual Notes & Reflection
                        </label>
                        <textarea name="description" 
                                  id="description" 
                                  rows="6"
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#197b3b] focus:border-[#197b3b] transition-colors text-black"
                                  placeholder="Share spiritual insights, devotional thoughts, or reflection questions...">{{ old('description', $sermon->description) }}</textarea>
                        <p class="mt-1 text-xs text-gray-500">This nourishes members spiritually</p>
                    </div>

                    <!-- Scripture References -->
                    <div>
                        <label for="scripture_references" class="block text-sm font-medium text-gray-700 mb-2">
                            Scripture References *
                        </label>
                        <input type="text" 
                               name="scripture_references" 
                               id="scripture_references" 
                               value="{{ old('scripture_references', $sermon->scripture_references) }}"
                               required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#197b3b] focus:border-[#197b3b] transition-colors text-black"
                               placeholder="e.g., John 3:16, Romans 8:28, Philippians 4:13">
                        <p class="mt-1 text-xs text-gray-500">Separate multiple scriptures with commas</p>
                    </div>
                </div>

                <!-- Right Column -->
                <div class="space-y-6">
                    <!-- Preacher -->
                    <div>
                        <label for="preacher" class="block text-sm font-medium text-gray-700 mb-2">
                            Preacher/Speaker *
                        </label>
                        <input type="text" 
                               name="preacher" 
                               id="preacher" 
                               value="{{ old('preacher', $sermon->preacher) }}"
                               required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#197b3b] focus:border-[#197b3b] transition-colors text-black"
                               placeholder="Enter preacher's name">
                    </div>

                    <!-- Sermon Date -->
                    <div>
                        <label for="sermon_date" class="block text-sm font-medium text-gray-700 mb-2">
                            Sermon Date *
                        </label>
                        <input type="date" 
                               name="sermon_date" 
                               id="sermon_date" 
                               value="{{ old('sermon_date', $sermon->sermon_date->format('Y-m-d')) }}"
                               required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#197b3b] focus:border-[#197b3b] transition-colors text-black">
                    </div>

                    <!-- Duration -->
                    <div>
                        <label for="duration_minutes" class="block text-sm font-medium text-gray-700 mb-2">
                            Duration (minutes)
                        </label>
                        <input type="number" 
                               name="duration_minutes" 
                               id="duration_minutes" 
                               value="{{ old('duration_minutes', $sermon->duration_minutes) }}"
                               min="1"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#197b3b] focus:border-[#197b3b] transition-colors text-black"
                               placeholder="e.g., 45">
                    </div>

                    <!-- Scripture of the Week (Using featured field) -->
                    <div class="p-4 bg-yellow-50 border border-yellow-200 rounded-lg">
                        <div class="flex items-center">
                            <input type="checkbox" 
                                   name="featured" 
                                   id="featured"
                                   value="1"
                                   {{ old('featured', $sermon->featured) ? 'checked' : '' }}
                                   class="w-4 h-4 text-[#197b3b] border-gray-300 rounded focus:ring-[#197b3b] focus:ring-2">
                            <div class="ml-3">
                                <label for="featured" class="text-sm font-medium text-gray-700">
                                    Set as "Scripture of the Week"
                                </label>
                                <p class="text-xs text-gray-500">
                                    Featured for members' daily spiritual nourishment
                                </p>
                            </div>
                        </div>
                        @if($sermon->featured)
                        <div class="mt-2 text-xs text-yellow-700 bg-yellow-100 p-2 rounded">
                            <i class="fas fa-info-circle mr-1"></i>
                            Currently featured as Scripture of the Week
                        </div>
                        @endif
                    </div>

                    <!-- Media URLs -->
                    <div class="space-y-4">
                        <div>
                            <label for="video_url" class="block text-sm font-medium text-gray-700 mb-2">
                                Video URL (YouTube/Vimeo)
                            </label>
                            <input type="url" 
                                   name="video_url" 
                                   id="video_url" 
                                   value="{{ old('video_url', $sermon->video_url) }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#197b3b] focus:border-[#197b3b] transition-colors text-black"
                                   placeholder="https://youtube.com/watch?v=...">
                        </div>

                        <div>
                            <label for="audio_url" class="block text-sm font-medium text-gray-700 mb-2">
                                Audio URL
                            </label>
                            <input type="url" 
                                   name="audio_url" 
                                   id="audio_url" 
                                   value="{{ old('audio_url', $sermon->audio_url) }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#197b3b] focus:border-[#197b3b] transition-colors text-black"
                                   placeholder="https://example.com/audio.mp3">
                        </div>

                        <div>
                            <label for="document_url" class="block text-sm font-medium text-gray-700 mb-2">
                                Document URL (PDF/Notes)
                            </label>
                            <input type="url" 
                                   name="document_url" 
                                   id="document_url" 
                                   value="{{ old('document_url', $sermon->document_url) }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#197b3b] focus:border-[#197b3b] transition-colors text-black"
                                   placeholder="https://example.com/notes.pdf">
                        </div>
                    </div>

                    <!-- Status Section -->
                    <div class="space-y-4">
                        <!-- Publish Status -->
                        <div class="p-4 bg-gray-50 border border-gray-200 rounded-lg">
                            <div class="flex items-center">
                                <input type="checkbox" 
                                       name="is_published" 
                                       id="is_published"
                                       value="1"
                                       {{ old('is_published', $sermon->is_published) ? 'checked' : '' }}
                                       class="w-4 h-4 text-[#197b3b] border-gray-300 rounded focus:ring-[#197b3b] focus:ring-2">
                                <div class="ml-3">
                                    <label for="is_published" class="text-sm font-medium text-gray-700">
                                        Published
                                    </label>
                                    <p class="text-xs text-gray-500">
                                        Visible to members on the website
                                    </p>
                                </div>
                            </div>
                            <div class="mt-2 text-xs {{ $sermon->is_published ? 'text-green-700 bg-green-100' : 'text-gray-700 bg-gray-100' }} p-2 rounded">
                                <i class="fas {{ $sermon->is_published ? 'fa-eye' : 'fa-eye-slash' }} mr-1"></i>
                                Currently {{ $sermon->is_published ? 'published' : 'draft' }}
                            </div>
                        </div>

                        <!-- Created Info -->
                        <div class="p-3 bg-blue-50 border border-blue-100 rounded-lg text-xs text-blue-800">
                            <div class="flex items-center mb-1">
                                <i class="fas fa-calendar-plus mr-2"></i>
                                <span class="font-medium">Created:</span>
                                <span class="ml-1">{{ $sermon->created_at->format('M d, Y') }}</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-history mr-2"></i>
                                <span class="font-medium">Updated:</span>
                                <span class="ml-1">{{ $sermon->updated_at->format('M d, Y') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="mt-8 pt-6 border-t border-gray-200 flex justify-between items-center">
                <div class="flex space-x-3">
                    <!-- Quick Delete (with confirmation) -->
                    <form action="{{ route('admin.sermons.destroy', $sermon) }}" 
                          method="POST" 
                          onsubmit="return confirm('Are you sure you want to delete this sermon? This action cannot be undone.');">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-medium rounded-lg transition-colors">
                            <i class="fas fa-trash mr-2"></i>
                            Delete Sermon
                        </button>
                    </form>
                    
                    <!-- Reset Form -->
                    <button type="button"
                            onclick="resetForm()"
                            class="inline-flex items-center px-4 py-2 border border-gray-300 text-gray-700 hover:bg-gray-50 font-medium rounded-lg transition-colors">
                        <i class="fas fa-redo mr-2"></i>
                        Reset Changes
                    </button>
                </div>
                
                <div class="flex space-x-4">
                    <a href="{{ route('admin.sermons.index') }}" 
                       class="px-6 py-3 border border-gray-300 text-gray-700 hover:bg-gray-50 font-medium rounded-lg shadow-sm transition-colors">
                        Cancel
                    </a>
                    <button type="submit" 
                            class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-[#197b3b] to-green-800 hover:from-green-800 hover:to-green-900 text-white font-semibold rounded-lg shadow-lg transition-all duration-200 transform hover:-translate-y-0.5">
                        <i class="fas fa-save mr-2"></i> Update Sermon
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Preview Card -->
    <div class="mt-8 bg-gray-50 rounded-2xl shadow border border-gray-200 overflow-hidden">
        <div class="px-6 py-4 bg-gray-200">
            <h3 class="text-lg font-semibold text-gray-800">Preview</h3>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Current Values -->
                <div class="bg-white p-4 rounded-lg border border-gray-300">
                    <h4 class="font-medium text-gray-700 mb-3 pb-2 border-b">Current Values</h4>
                    <div class="space-y-3">
                        <div>
                            <p class="text-sm text-gray-500">Title</p>
                            <p class="text-gray-800 font-medium">{{ $sermon->title }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Scriptures</p>
                            <p class="text-gray-800">{{ $sermon->formatted_scriptures ?? 'No scriptures' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Preacher</p>
                            <p class="text-gray-800">{{ $sermon->preacher }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Date</p>
                            <p class="text-gray-800">{{ $sermon->sermon_date->format('F j, Y') }}</p>
                        </div>
                    </div>
                </div>
                
                <!-- Media Links -->
                <div class="bg-white p-4 rounded-lg border border-gray-300">
                    <h4 class="font-medium text-gray-700 mb-3 pb-2 border-b">Media Links</h4>
                    <div class="space-y-3">
                        @if($sermon->video_url)
                        <div class="flex items-center">
                            <i class="fas fa-video text-red-500 mr-3"></i>
                            <div>
                                <p class="text-sm text-gray-500">Video</p>
                                <a href="{{ $sermon->video_url }}" target="_blank" class="text-blue-600 hover:text-blue-800 text-sm truncate block max-w-xs">
                                    {{ $sermon->video_url }}
                                </a>
                            </div>
                        </div>
                        @endif
                        
                        @if($sermon->audio_url)
                        <div class="flex items-center">
                            <i class="fas fa-headphones text-blue-500 mr-3"></i>
                            <div>
                                <p class="text-sm text-gray-500">Audio</p>
                                <a href="{{ $sermon->audio_url }}" target="_blank" class="text-blue-600 hover:text-blue-800 text-sm truncate block max-w-xs">
                                    {{ $sermon->audio_url }}
                                </a>
                            </div>
                        </div>
                        @endif
                        
                        @if($sermon->document_url)
                        <div class="flex items-center">
                            <i class="fas fa-file-alt text-green-500 mr-3"></i>
                            <div>
                                <p class="text-sm text-gray-500">Document</p>
                                <a href="{{ $sermon->document_url }}" target="_blank" class="text-blue-600 hover:text-blue-800 text-sm truncate block max-w-xs">
                                    {{ $sermon->document_url }}
                                </a>
                            </div>
                        </div>
                        @endif
                        
                        @if(!$sermon->video_url && !$sermon->audio_url && !$sermon->document_url)
                        <p class="text-gray-500 text-sm">No media links added</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Auto-focus title field
    document.getElementById('title').focus();
    
    // Scripture of the week explanation
    const featuredCheckbox = document.getElementById('featured');
    if (featuredCheckbox) {
        featuredCheckbox.addEventListener('change', function() {
            if (this.checked) {
                if (!confirm('Setting this as "Scripture of the Week" will replace any current featured scripture for this week. Continue?')) {
                    this.checked = false;
                }
            }
        });
    }
    
    // Form reset function
    window.resetForm = function() {
        if (confirm('Reset all changes to original values?')) {
            // Get original values from data attributes or reload
            document.getElementById('title').value = "{{ addslashes($sermon->title) }}";
            document.getElementById('description').value = "{{ addslashes($sermon->description ?? '') }}";
            document.getElementById('scripture_references').value = "{{ addslashes($sermon->scripture_references ?? '') }}";
            document.getElementById('preacher').value = "{{ addslashes($sermon->preacher) }}";
            document.getElementById('sermon_date').value = "{{ $sermon->sermon_date->format('Y-m-d') }}";
            document.getElementById('duration_minutes').value = "{{ $sermon->duration_minutes ?? '' }}";
            document.getElementById('video_url').value = "{{ addslashes($sermon->video_url ?? '') }}";
            document.getElementById('audio_url').value = "{{ addslashes($sermon->audio_url ?? '') }}";
            document.getElementById('document_url').value = "{{ addslashes($sermon->document_url ?? '') }}";
            document.getElementById('featured').checked = {{ $sermon->featured ? 'true' : 'false' }};
            document.getElementById('is_published').checked = {{ $sermon->is_published ? 'true' : 'false' }};
        }
    };
    
    // Live preview updates (optional)
    const titleInput = document.getElementById('title');
    const descriptionInput = document.getElementById('description');
    
    if (titleInput) {
        titleInput.addEventListener('input', function() {
            // You could update a live preview here if needed
        });
    }
});
</script>

<style>
/* Custom scrollbar for textareas */
textarea::-webkit-scrollbar {
    width: 8px;
}

textarea::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 4px;
}

textarea::-webkit-scrollbar-thumb {
    background: #c1c1c1;
    border-radius: 4px;
}

textarea::-webkit-scrollbar-thumb:hover {
    background: #a1a1a1;
}
</style>
@endsection