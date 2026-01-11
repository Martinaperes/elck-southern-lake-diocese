@extends('admin.layouts.app')

@section('title', 'Upload Sermon')

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
                    <h1 class="text-3xl font-bold text-white">Upload New Sermon</h1>
                    <p class="text-gray-300 mt-1">Share sermons, scriptures, and spiritual content</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Form -->
    <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
        <div class="bg-gradient-to-r from-black to-gray-800 px-6 py-4">
            <h2 class="text-xl font-semibold text-white">Sermon Details</h2>
        </div>
        
        <form action="{{ route('admin.sermons.store') }}" method="POST" class="p-6">
            @csrf
            
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
                               value="{{ old('title') }}"
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
                                  placeholder="Share spiritual insights, devotional thoughts, or reflection questions...">{{ old('description') }}</textarea>
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
                               value="{{ old('scripture_references') }}"
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
                               value="{{ old('preacher') }}"
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
                               value="{{ old('sermon_date', date('Y-m-d')) }}"
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
                               value="{{ old('duration_minutes') }}"
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
                                   value="{{ old('video_url') }}"
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
                                   value="{{ old('audio_url') }}"
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
                                   value="{{ old('document_url') }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#197b3b] focus:border-[#197b3b] transition-colors text-black"
                                   placeholder="https://example.com/notes.pdf">
                        </div>
                    </div>

                    <!-- Publish Status -->
                    <div class="flex items-center p-4 bg-gray-50 border border-gray-200 rounded-lg">
                        <input type="checkbox" 
                               name="is_published" 
                               id="is_published"
                               value="1"
                               checked
                               class="w-4 h-4 text-[#197b3b] border-gray-300 rounded focus:ring-[#197b3b] focus:ring-2">
                        <div class="ml-3">
                            <label for="is_published" class="text-sm font-medium text-gray-700">
                                Publish Immediately
                            </label>
                            <p class="text-xs text-gray-500">Visible to members on the website</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="mt-8 pt-6 border-t border-gray-200 flex justify-end space-x-4">
                <a href="{{ route('admin.sermons.index') }}" 
                   class="px-6 py-3 border border-gray-300 text-gray-700 hover:bg-gray-50 font-medium rounded-lg shadow-sm transition-colors">
                    Cancel
                </a>
                <button type="submit" 
                        class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-[#197b3b] to-green-800 hover:from-green-800 hover:to-green-900 text-white font-semibold rounded-lg shadow-lg transition-all duration-200 transform hover:-translate-y-0.5">
                    <i class="fas fa-save mr-2"></i> Upload Sermon
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Auto-focus title field
    document.getElementById('title').focus();
    
    // Set default time if not provided
    if (!document.getElementById('sermon_date').value) {
        document.getElementById('sermon_date').value = new Date().toISOString().split('T')[0];
    }
    
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
});
</script>
@endsection