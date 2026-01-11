@extends('admin.layouts.app')

@section('title', $sermon->title)

@section('content')
<div class="p-6">
    <!-- Success/Error Messages -->
    @if(session('success'))
        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg">
            <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
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
                    <h1 class="text-3xl font-bold text-white">{{ $sermon->title }}</h1>
                    <p class="text-gray-300 mt-1">Sermon details and spiritual content</p>
                </div>
            </div>
            
            <!-- Action Buttons -->
            <div class="flex space-x-3 mt-4 md:mt-0">
                <!-- Publish/Unpublish Toggle -->
                <!-- Publish/Unpublish Toggle -->
<form action="{{ route('admin.sermons.toggle-publish', $sermon) }}" method="POST" class="inline">
    @csrf
    <button type="submit"
            onclick="return confirm('{{ $sermon->is_published ? 'Unpublish this sermon? It will be hidden from members.' : 'Publish this sermon? It will be visible to members.' }}')"
            class="inline-flex items-center px-4 py-2 {{ $sermon->is_published ? 'bg-yellow-500 hover:bg-yellow-600' : 'bg-[#197b3b] hover:bg-[#15632f]' }} text-white font-medium rounded-lg transition-colors">
        <i class="fas {{ $sermon->is_published ? 'fa-eye-slash' : 'fa-eye' }} mr-2"></i>
        {{ $sermon->is_published ? 'Unpublish' : 'Publish' }}
    </button>
</form>
                
                <!-- Scripture of the Week Toggle -->
                <form action="{{ route('admin.sermons.toggle-featured', $sermon) }}" method="POST" class="inline">
                    @csrf
                    <button type="submit"
                            class="inline-flex items-center px-4 py-2 {{ $sermon->featured ? 'bg-gray-600 hover:bg-gray-700' : 'bg-yellow-500 hover:bg-yellow-600' }} text-white font-medium rounded-lg transition-colors">
                        <i class="fas fa-star mr-2"></i>
                        {{ $sermon->featured ? 'Remove Featured' : 'Set as Scripture of Week' }}
                    </button>
                </form>
                
                <!-- Edit Button -->
                <a href="{{ route('admin.sermons.edit', $sermon) }}"
                   class="inline-flex items-center px-4 py-2 bg-black hover:bg-gray-800 text-white font-medium rounded-lg transition-colors">
                    <i class="fas fa-edit mr-2"></i>
                    Edit
                </a>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Left Column - Sermon Details -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Sermon Card -->
            <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
                <div class="bg-gradient-to-r from-[#197b3b] to-green-700 px-6 py-4">
                    <div class="flex items-center justify-between">
                        <h2 class="text-xl font-semibold text-white">Sermon Details</h2>
                        <!-- Status Badges -->
                        <div class="flex space-x-2">
                            @if($sermon->is_published)
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-white bg-opacity-20 text-white">
                                <i class="fas fa-check-circle mr-1"></i>
                                Published
                            </span>
                            @else
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-800">
                                <i class="fas fa-pencil-alt mr-1"></i>
                                Draft
                            </span>
                            @endif
                            
                            @if($sermon->featured)
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                                <i class="fas fa-star mr-1"></i>
                                Scripture of the Week
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
                
                <div class="p-6">
                    <!-- Title -->
                    <h1 class="text-2xl font-bold text-gray-900 mb-4">{{ $sermon->title }}</h1>
                    
                    <!-- Scripture References -->
                    @if($sermon->scripture_references)
                    <div class="mb-6 p-4 bg-blue-50 border border-blue-100 rounded-lg">
                        <div class="flex items-center mb-2">
                            <i class="fas fa-bible text-blue-600 text-lg mr-3"></i>
                            <h3 class="text-lg font-semibold text-blue-800">Scripture References</h3>
                        </div>
                        <p class="text-blue-900 text-lg font-medium">{{ $sermon->formatted_scriptures }}</p>
                        <p class="text-sm text-blue-600 mt-2">
                            <i class="fas fa-info-circle mr-1"></i>
                            Focus on these scriptures for spiritual nourishment this week
                        </p>
                    </div>
                    @endif
                    
                    <!-- Description -->
                    @if($sermon->description)
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-3">Spiritual Notes & Reflection</h3>
                        <div class="prose max-w-none text-gray-700 bg-gray-50 p-4 rounded-lg border border-gray-200">
                            {!! nl2br(e($sermon->description)) !!}
                        </div>
                    </div>
                    @endif
                    
                    <!-- Media Section -->
                    <div class="mt-8">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Media & Resources</h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <!-- Video -->
                            @if($sermon->video_url)
                            <a href="{{ $sermon->video_url }}" target="_blank" 
                               class="bg-white border border-gray-200 rounded-xl p-4 hover:shadow-lg transition-shadow group">
                                <div class="flex items-center">
                                    <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center mr-4">
                                        <i class="fab fa-youtube text-red-600 text-xl"></i>
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-900 group-hover:text-red-600">Watch Video</p>
                                        <p class="text-sm text-gray-500 truncate max-w-xs">{{ $sermon->video_url }}</p>
                                    </div>
                                </div>
                            </a>
                            @endif
                            
                            <!-- Audio -->
                            @if($sermon->audio_url)
                            <a href="{{ $sermon->audio_url }}" target="_blank" 
                               class="bg-white border border-gray-200 rounded-xl p-4 hover:shadow-lg transition-shadow group">
                                <div class="flex items-center">
                                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mr-4">
                                        <i class="fas fa-headphones text-blue-600 text-xl"></i>
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-900 group-hover:text-blue-600">Listen Audio</p>
                                        <p class="text-sm text-gray-500 truncate max-w-xs">{{ $sermon->audio_url }}</p>
                                    </div>
                                </div>
                            </a>
                            @endif
                            
                            <!-- Document -->
                            @if($sermon->document_url)
                            <a href="{{ $sermon->document_url }}" target="_blank" 
                               class="bg-white border border-gray-200 rounded-xl p-4 hover:shadow-lg transition-shadow group">
                                <div class="flex items-center">
                                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mr-4">
                                        <i class="fas fa-file-alt text-green-600 text-xl"></i>
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-900 group-hover:text-green-600">View Notes</p>
                                        <p class="text-sm text-gray-500 truncate max-w-xs">{{ $sermon->document_url }}</p>
                                    </div>
                                </div>
                            </a>
                            @endif
                        </div>
                        
                        @if(!$sermon->video_url && !$sermon->audio_url && !$sermon->document_url)
                        <div class="text-center py-8 bg-gray-50 rounded-lg border border-dashed border-gray-300">
                            <i class="fas fa-cloud-upload-alt text-gray-300 text-4xl mb-3"></i>
                            <p class="text-gray-500">No media resources uploaded</p>
                            <a href="{{ route('admin.sermons.edit', $sermon) }}" class="text-[#197b3b] hover:underline mt-2 inline-block">
                                Add media resources
                            </a>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column - Sidebar -->
        <div class="space-y-6">
            <!-- Info Card -->
            <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
                <div class="bg-gradient-to-r from-black to-gray-800 px-6 py-4">
                    <h3 class="text-lg font-semibold text-white">Sermon Information</h3>
                </div>
                
                <div class="p-6">
                    <div class="space-y-4">
                        <!-- Preacher -->
                        <div>
                            <p class="text-sm text-gray-500">Preacher</p>
                            <p class="text-lg font-semibold text-gray-900">{{ $sermon->preacher }}</p>
                        </div>
                        
                        <!-- Date -->
                        <div>
                            <p class="text-sm text-gray-500">Date</p>
                            <p class="text-gray-900">{{ $sermon->sermon_date->format('F j, Y') }}</p>
                            <p class="text-xs text-gray-500">{{ $sermon->sermon_date->diffForHumans() }}</p>
                        </div>
                        
                        <!-- Duration -->
                        @if($sermon->duration_minutes)
                        <div>
                            <p class="text-sm text-gray-500">Duration</p>
                            <p class="text-gray-900">{{ $sermon->duration_formatted }}</p>
                        </div>
                        @endif
                        
                        <!-- Created/Updated -->
                        <div class="pt-4 border-t border-gray-200">
                            <p class="text-sm text-gray-500">Created</p>
                            <p class="text-gray-900">{{ $sermon->created_at->format('M d, Y \a\t h:i A') }}</p>
                            
                            <p class="text-sm text-gray-500 mt-2">Last Updated</p>
                            <p class="text-gray-900">{{ $sermon->updated_at->format('M d, Y \a\t h:i A') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions Card -->
            <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
                <div class="bg-gradient-to-r from-[#197b3b] to-green-700 px-6 py-4">
                    <h3 class="text-lg font-semibold text-white">Quick Actions</h3>
                </div>
                
                <div class="p-6">
                    <div class="space-y-3">
                        <!-- Edit -->
                        <a href="{{ route('admin.sermons.edit', $sermon) }}"
                           class="w-full flex items-center justify-center px-4 py-3 bg-gray-100 hover:bg-gray-200 text-gray-800 font-medium rounded-lg transition-colors">
                            <i class="fas fa-edit mr-2"></i>
                            Edit Sermon Details
                        </a>
                        
                        <!-- Duplicate -->
                        <button onclick="duplicateSermon()"
                                class="w-full flex items-center justify-center px-4 py-3 bg-blue-50 hover:bg-blue-100 text-blue-700 font-medium rounded-lg transition-colors">
                            <i class="fas fa-copy mr-2"></i>
                            Duplicate as New
                        </button>
                        
                        <!-- Delete -->
                        <form action="{{ route('admin.sermons.destroy', $sermon) }}" 
                              method="POST" 
                              onsubmit="return confirm('Are you sure you want to delete this sermon? This action cannot be undone.');"
                              class="w-full">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="w-full flex items-center justify-center px-4 py-3 bg-red-50 hover:bg-red-100 text-red-700 font-medium rounded-lg transition-colors">
                                <i class="fas fa-trash mr-2"></i>
                                Delete Sermon
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            
<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="hidden fixed inset-0 bg-black bg-opacity-50 overflow-y-auto h-full w-full z-50">
    <div class="relative top-4 mx-auto p-5 border w-full max-w-md shadow-lg rounded-2xl bg-white">
        <div class="text-center">
            <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100 mb-4">
                <i class="fas fa-exclamation-triangle text-red-600 text-xl"></i>
            </div>
            <h3 class="text-lg font-medium text-gray-900 mb-2">Delete Sermon</h3>
            <p class="text-sm text-gray-500 mb-4">
                Are you sure you want to delete "{{ $sermon->title }}"? This action cannot be undone.
            </p>
            <div class="flex justify-center space-x-3">
                <button onclick="closeDeleteModal()"
                        class="px-4 py-2 border border-gray-300 text-gray-700 hover:bg-gray-50 font-medium rounded-lg transition-colors">
                    Cancel
                </button>
                <form action="{{ route('admin.sermons.destroy', $sermon) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-medium rounded-lg transition-colors">
                        Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize any dynamic features
});

// Copy share link
function copyShareLink() {
    const link = window.location.href;
    navigator.clipboard.writeText(link).then(function() {
        // Show success message
        const button = event.target.closest('button');
        const originalText = button.innerHTML;
        button.innerHTML = '<i class="fas fa-check mr-2"></i>Copied!';
        button.classList.remove('bg-gray-100', 'hover:bg-gray-200');
        button.classList.add('bg-green-100', 'text-green-700');
        
        setTimeout(function() {
            button.innerHTML = originalText;
            button.classList.remove('bg-green-100', 'text-green-700');
            button.classList.add('bg-gray-100', 'hover:bg-gray-200');
        }, 2000);
    }).catch(function(err) {
        console.error('Failed to copy: ', err);
        alert('Failed to copy link to clipboard');
    });
}

// Duplicate sermon functionality
function duplicateSermon() {
    if (confirm('Create a copy of this sermon as a new draft?')) {
        // You would typically make an AJAX call or redirect to a duplicate endpoint
        // For now, we'll redirect to create page with query parameters
        const params = new URLSearchParams({
            duplicate: {{ $sermon->id }},
            title: 'Copy of {{ $sermon->title }}',
            scripture_references: '{{ $sermon->scripture_references }}',
            preacher: '{{ $sermon->preacher }}'
        });
        
        window.location.href = '{{ route("admin.sermons.create") }}?' + params.toString();
    }
}

// Modal functions
function openDeleteModal() {
    document.getElementById('deleteModal').classList.remove('hidden');
    document.body.classList.add('overflow-hidden');
}

function closeDeleteModal() {
    document.getElementById('deleteModal').classList.add('hidden');
    document.body.classList.remove('overflow-hidden');
}

// Auto-populate from query params if duplicating
const urlParams = new URLSearchParams(window.location.search);
if (urlParams.has('duplicated') && urlParams.get('duplicated') === 'true') {
    // Show success message for duplication
    const successDiv = document.createElement('div');
    successDiv.className = 'mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg';
    successDiv.innerHTML = '<i class="fas fa-check-circle mr-2"></i> Sermon duplicated successfully as a new draft!';
    document.querySelector('.p-6').insertBefore(successDiv, document.querySelector('.p-6').firstChild);
    
    // Remove the query parameter
    window.history.replaceState({}, document.title, window.location.pathname);
}

// Keyboard shortcuts
document.addEventListener('keydown', function(e) {
    // Ctrl/Cmd + E for edit
    if ((e.ctrlKey || e.metaKey) && e.key === 'e') {
        e.preventDefault();
        window.location.href = '{{ route("admin.sermons.edit", $sermon) }}';
    }
    
    // Escape to close modals
    if (e.key === 'Escape') {
        closeDeleteModal();
    }
});

// Auto-embed video if it's a YouTube URL
function embedYouTubeVideo() {
    const videoUrl = '{{ $sermon->video_url }}';
    if (videoUrl && videoUrl.includes('youtube.com') || videoUrl.includes('youtu.be')) {
        // You could add embedding logic here
        console.log('YouTube video detected:', videoUrl);
    }
}

// Initialize on page load
window.onload = function() {
    if ('{{ $sermon->video_url }}') {
        embedYouTubeVideo();
    }
};
</script>

<style>
.prose {
    line-height: 1.6;
}

.prose p {
    margin-bottom: 1rem;
}

.prose p:last-child {
    margin-bottom: 0;
}

/* Custom scrollbar */
::-webkit-scrollbar {
    width: 8px;
    height: 8px;
}

::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 4px;
}

::-webkit-scrollbar-thumb {
    background: #c1c1c1;
    border-radius: 4px;
}

::-webkit-scrollbar-thumb:hover {
    background: #a1a1a1;
}
</style>
@endsection