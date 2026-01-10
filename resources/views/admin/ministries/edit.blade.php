@extends('admin.layouts.app')

@section('title', 'Edit Ministry: ' . $ministry->name)

@section('content')
<div class="p-6">
    <!-- Header Section -->
    <div class="mb-8">
        <div class="flex items-center space-x-4">
            <a href="{{ route('admin.ministries.index') }}" 
               class="inline-flex items-center px-4 py-2 text-gray-600 hover:text-gray-900 bg-white border border-gray-300 rounded-lg shadow-sm hover:bg-gray-50 transition-colors">
                <i class="fas fa-arrow-left mr-2"></i> Back to Ministries
            </a>
            <div>
                <h1 class="text-3xl font-bold text-white">Edit Ministry: {{ $ministry->name }}</h1>
                <p class="text-gray-600 mt-1">Update ministry information and details</p>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Form Section -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
                <div class="bg-gradient-to-r from-[#197b3b] to-green-700 px-6 py-4">
                    <h2 class="text-xl font-semibold text-white">Edit Ministry Details</h2>
                </div>
                
                <form action="{{ route('admin.ministries.update', $ministry) }}" method="POST" enctype="multipart/form-data" class="p-6">
                    @csrf
                    @method('PUT')
                    
                    @if($errors->any())
                        <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg">
                            <div class="flex items-center">
                                <i class="fas fa-exclamation-triangle mr-2"></i>
                                <strong>Please fix the following errors:</strong>
                            </div>
                            <ul class="mt-2 list-disc list-inside text-sm">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if(session('success'))
                        <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg">
                            <div class="flex items-center">
                                <i class="fas fa-check-circle mr-2"></i>
                                {{ session('success') }}
                            </div>
                        </div>
                    @endif

                    <!-- Basic Information -->
                    <div class="space-y-6">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                Ministry Name *
                            </label>
                            <input type="text" 
                                   name="name" 
                                   id="name"
                                   value="{{ old('name', $ministry->name) }}"
                                   required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#197b3b] focus:border-[#197b3b] transition-colors text-black"
                                   placeholder="e.g., Youth Ministry, Worship Team, etc.">
                            <p class="mt-1 text-sm text-gray-500">The official name of the ministry</p>
                        </div>

                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                                Description
                            </label>
                            <textarea name="description" 
                                      id="description" 
                                      rows="4"
                                      class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#197b3b] focus:border-[#197b3b] transition-colors text-black"
                                      placeholder="Describe the ministry's purpose, activities, and goals...">{{ old('description', $ministry->description) }}</textarea>
                            <p class="mt-1 text-sm text-gray-500">Brief description of the ministry's mission</p>
                        </div>

                        <!-- Leader Information -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="leader_name" class="block text-sm font-medium text-gray-700 mb-2">
                                    Leader Name
                                </label>
                                <input type="text" 
                                       name="leader_name" 
                                       id="leader_name"
                                       value="{{ old('leader_name', $ministry->leader_name) }}"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#197b3b] focus:border-[#197b3b] transition-colors text-black"
                                       placeholder="e.g., John Doe">
                            </div>

                            <div>
                                <label for="contact_email" class="block text-sm font-medium text-gray-700 mb-2">
                                    Contact Email
                                </label>
                                <input type="email" 
                                       name="contact_email" 
                                       id="contact_email"
                                       value="{{ old('contact_email', $ministry->contact_email) }}"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#197b3b] focus:border-[#197b3b] transition-colors text-black"
                                       placeholder="e.g., leader@elckchurch.org">
                            </div>
                        </div>

                        <!-- Schedule & Banner Image -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="meeting_schedule" class="block text-sm font-medium text-gray-700 mb-2">
                                    Meeting Schedule
                                </label>
                                <input type="text" 
                                       name="meeting_schedule" 
                                       id="meeting_schedule"
                                       value="{{ old('meeting_schedule', $ministry->meeting_schedule) }}"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#197b3b] focus:border-[#197b3b] transition-colors text-black"
                                       placeholder="e.g., Every Sunday at 2:00 PM">
                                <p class="mt-1 text-sm text-gray-500">Regular meeting time and frequency</p>
                            </div>

                            <!-- Banner Image Section -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Banner Image
                                </label>
                                
                                <!-- Current Banner Preview -->
                                @if($ministry->banner_url)
                                <div class="mb-3">
                                    <p class="text-sm text-gray-600 mb-2">Current Banner:</p>
                                    <div class="relative">
                                        <img src="{{ $ministry->banner_url }}" 
                                             alt="{{ $ministry->name }} banner"
                                             class="w-full h-32 object-cover rounded-lg border border-gray-200">
                                        @if($ministry->hasUploadedBanner)
                                        <button type="button"
                                                onclick="if(confirm('Remove uploaded banner?')) { document.getElementById('remove_banner').value = '1'; this.classList.add('hidden'); }"
                                                class="absolute top-2 right-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center hover:bg-red-600 transition-colors text-xs"
                                                title="Remove uploaded banner">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                        @endif
                                    </div>
                                    <p class="text-xs text-gray-500 mt-1">
                                        @if($ministry->hasUploadedBanner)
                                            Uploaded file
                                        @elseif(filter_var($ministry->image_url, FILTER_VALIDATE_URL))
                                            External URL
                                        @else
                                            Gallery image: {{ $ministry->image_url }}
                                        @endif
                                    </p>
                                    <input type="hidden" name="remove_banner" id="remove_banner" value="0">
                                </div>
                                @endif
                                
                                <!-- Option 1: Upload New Banner -->
                                <div class="mb-3">
                                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-3 text-center hover:border-[#197b3b] transition-colors cursor-pointer"
                                         onclick="document.getElementById('image_file').click()">
                                        <input type="file" 
                                               name="image_file" 
                                               id="image_file"
                                               accept="image/*"
                                               class="hidden"
                                               onchange="previewBannerImage(this)">
                                        <i class="fas fa-cloud-upload-alt text-gray-400 text-xl mb-1"></i>
                                        <p class="text-gray-600 text-sm">Upload New Banner</p>
                                        <p class="text-xs text-gray-500 mt-1">Click to browse (Max 5MB)</p>
                                    </div>
                                    
                                    <!-- New Image Preview -->
                                    <div id="bannerPreview" class="hidden mt-3">
                                        <div class="relative">
                                            <img id="bannerPreviewImage" 
                                                 class="w-full h-32 object-cover rounded-lg border border-gray-200">
                                            <button type="button" 
                                                    onclick="removeBannerPreview()"
                                                    class="absolute top-2 right-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center hover:bg-red-600 transition-colors text-xs">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                        <p class="text-xs text-gray-500 mt-1 text-center">New banner preview</p>
                                    </div>
                                </div>
                                
                                <!-- Option 2: Use Gallery Image -->
                                <div>
                                    <label for="image_url" class="block text-sm font-medium text-gray-700 mb-1">
                                        Or use gallery image:
                                    </label>
                                    <div class="flex space-x-2">
                                        <input type="text" 
                                               name="image_url" 
                                               id="image_url"
                                               value="{{ old('image_url', $ministry->image_url) }}"
                                               class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#197b3b] focus:border-[#197b3b] transition-colors text-black text-sm"
                                               placeholder="e.g., Youth-ministry.jpg">
                                        <button type="button"
                                                onclick="openGallerySelector()"
                                                class="px-3 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-medium rounded-lg transition-colors whitespace-nowrap">
                                            <i class="fas fa-images"></i>
                                        </button>
                                    </div>
                                    <p class="mt-1 text-xs text-gray-500">Enter filename from images/gallery folder</p>
                                </div>
                            </div>
                        </div>

                        <!-- Gallery Images Quick Select -->
                        <div class="mt-4">
                            <p class="text-sm font-medium text-gray-700 mb-2">Available Gallery Images:</p>
                            <div class="grid grid-cols-4 gap-2">
                                @if(isset($galleryImages) && count($galleryImages) > 0)
                                    @foreach($galleryImages as $image)
                                        <div class="cursor-pointer group" 
                                             onclick="selectGalleryImage('{{ $image }}')"
                                             title="Click to use: {{ $image }}">
                                            <div class="relative">
                                                <img src="{{ asset('images/gallery/' . $image) }}" 
                                                     alt="{{ $image }}"
                                                     class="w-full h-16 object-cover rounded border border-gray-200 group-hover:border-[#197b3b] transition-colors">
                                                <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-20 transition-opacity rounded"></div>
                                            </div>
                                            <p class="text-xs text-gray-600 truncate mt-1">{{ \Illuminate\Support\Str::limit($image, 10) }}</p>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="col-span-4 text-center py-4">
                                        <p class="text-gray-500 text-sm">No gallery images found</p>
                                    </div>
                                @endif
                            </div>
                            <p class="text-xs text-gray-500 mt-2 text-center">
                                Click any image to automatically fill the filename
                            </p>
                        </div>

                        <!-- Leader Photo -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Leader Photo
                            </label>
                            <div class="flex items-center space-x-6">
                                @if($ministry->leader_image)
                                    <div class="relative">
                                        <img src="{{ Storage::url($ministry->leader_image) }}" 
                                             alt="Current leader photo"
                                             class="w-20 h-20 rounded-lg object-cover border border-gray-200">
                                        <button type="button"
                                                onclick="if(confirm('Remove leader photo?')) { document.getElementById('remove_leader_image').value = '1'; this.parentElement.classList.add('hidden'); }"
                                                class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center hover:bg-red-600 transition-colors text-xs"
                                                title="Remove photo">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                    <div class="text-sm">
                                        <p class="text-gray-600">Current photo</p>
                                        <p class="text-gray-500 text-xs">Click X to remove</p>
                                    </div>
                                @endif
                                
                                <div class="flex-1">
                                    <input type="file" 
                                           name="leader_image" 
                                           id="leader_image"
                                           accept="image/*"
                                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#197b3b] focus:border-[#197b3b] transition-colors">
                                    <p class="mt-1 text-sm text-gray-500">Upload new leader photo (Max: 2MB, JPG/PNG/GIF)</p>
                                    <input type="hidden" name="remove_leader_image" id="remove_leader_image" value="0">
                                </div>
                            </div>
                        </div>

                        <!-- Status Toggle -->
                        <div class="flex items-center">
                            <input type="checkbox" 
                                   name="is_active" 
                                   id="is_active"
                                   value="1"
                                   {{ old('is_active', $ministry->is_active) ? 'checked' : '' }}
                                   class="w-4 h-4 text-[#197b3b] border-gray-300 rounded focus:ring-[#197b3b] focus:ring-2">
                            <label for="is_active" class="ml-2 text-sm font-medium text-gray-700">
                                Active Ministry
                            </label>
                            <p class="ml-4 text-sm text-gray-500">Inactive ministries won't appear on the website</p>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="mt-8 pt-6 border-t border-gray-200 flex justify-between">
                        <div>
                            <a href="{{ route('admin.ministries.show', $ministry) }}"
                               class="inline-flex items-center px-6 py-3 text-gray-600 hover:text-gray-900 font-medium">
                                <i class="fas fa-eye mr-2"></i>
                                View Ministry
                            </a>
                        </div>
                        
                        <div class="flex space-x-4">
                            <a href="{{ route('admin.ministries.index') }}"
                               class="inline-flex items-center px-6 py-3 border border-gray-300 text-gray-700 hover:bg-gray-50 font-medium rounded-lg transition-colors">
                                Cancel
                            </a>
                            <button type="submit"
                                    class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-[#197b3b] to-green-800 hover:from-green-800 hover:to-green-900 text-white font-semibold rounded-lg shadow-lg transition-all duration-200 transform hover:-translate-y-0.5">
                                <i class="fas fa-save mr-2"></i>
                                Update Ministry
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Danger Zone -->
            <div class="mt-8 bg-white rounded-2xl shadow-xl border border-red-200 overflow-hidden">
                <div class="bg-gradient-to-r from-red-600 to-red-700 px-6 py-4">
                    <h2 class="text-xl font-semibold text-white">Danger Zone</h2>
                </div>
                <div class="p-6">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                        <div>
                            <h3 class="font-semibold text-gray-900">Delete Ministry</h3>
                            <p class="text-gray-600 text-sm mt-1">
                                Once you delete a ministry, there is no going back. This will remove all ministry data including members and events.
                            </p>
                        </div>
                        <form action="{{ route('admin.ministries.destroy', $ministry) }}" 
                              method="POST"
                              onsubmit="return confirm('⚠️ WARNING: Are you absolutely sure?\n\nThis will permanently delete:\n• The ministry record\n• All ministry member associations\n• Ministry events\n\nThis action cannot be undone.');"
                              class="mt-4 md:mt-0">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white font-semibold rounded-lg shadow-lg transition-all duration-200">
                                <i class="fas fa-trash mr-2"></i>
                                Delete Ministry
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar Information -->
        <div class="space-y-6">
            <!-- Ministry Summary -->
            <div class="bg-white rounded-2xl shadow-xl border border-gray-100">
                <div class="bg-gradient-to-r from-black to-gray-800 px-6 py-4">
                    <h2 class="text-xl font-semibold text-white">Ministry Summary</h2>
                </div>
                <div class="p-6">
                    <div class="flex flex-col items-center text-center mb-6">
                        @if($ministry->banner_url)
                            <img src="{{ $ministry->banner_url }}" 
                                 alt="{{ $ministry->name }}"
                                 class="w-20 h-20 rounded-2xl object-cover border-4 border-white shadow-lg mb-3">
                        @else
                            <div class="w-20 h-20 rounded-2xl bg-gradient-to-br from-[#197b3b] to-green-700 flex items-center justify-center text-white font-bold text-2xl shadow-lg mb-3">
                                {{ strtoupper(substr($ministry->name, 0, 1)) }}
                            </div>
                        @endif
                        <h3 class="font-bold text-gray-900">{{ $ministry->name }}</h3>
                        <p class="text-gray-600 text-sm">ELCK Church Ministry</p>
                    </div>

                    <div class="space-y-4">
                        <div>
                            <h4 class="text-sm font-medium text-gray-500 mb-2">Current Status</h4>
                            @if($ministry->is_active)
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                    <i class="fas fa-check-circle mr-1"></i>
                                    Active
                                </span>
                            @else
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                                    <i class="fas fa-pause-circle mr-1"></i>
                                    Inactive
                                </span>
                            @endif
                        </div>

                        <div>
                            <h4 class="text-sm font-medium text-gray-500 mb-2">Members Count</h4>
                            <p class="text-lg font-semibold text-gray-900">
                                {{ $ministry->members()->where('is_active', true)->count() }} members
                            </p>
                        </div>

                        <div>
                            <h4 class="text-sm font-medium text-gray-500 mb-2">Created Date</h4>
                            <p class="text-gray-900">{{ $ministry->created_at->format('F j, Y') }}</p>
                            <p class="text-sm text-gray-500">{{ $ministry->created_at->diffForHumans() }}</p>
                        </div>

                        <div>
                            <h4 class="text-sm font-medium text-gray-500 mb-2">Last Updated</h4>
                            <p class="text-gray-900">{{ $ministry->updated_at->format('F j, Y') }}</p>
                            <p class="text-sm text-gray-500">{{ $ministry->updated_at->diffForHumans() }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white rounded-2xl shadow-xl border border-gray-100">
                <div class="bg-gradient-to-r from-[#197b3b] to-green-700 px-6 py-4">
                    <h2 class="text-xl font-semibold text-white">Quick Actions</h2>
                </div>
                <div class="p-6">
                    <div class="space-y-3">
                        <a href="{{ route('admin.ministries.show', $ministry) }}"
                           class="flex items-center p-3 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                            <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-eye text-blue-600"></i>
                            </div>
                            <div>
                                <h4 class="font-medium text-gray-900">View Ministry</h4>
                                <p class="text-sm text-gray-600">See full details</p>
                            </div>
                        </a>

                        <a href="{{ route('admin.ministries.events', $ministry) }}"
                           class="flex items-center p-3 border border-gray-200 rounded-lg hover:bg-green-50 transition-colors">
                            <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-calendar-alt text-[#197b3b]"></i>
                            </div>
                            <div>
                                <h4 class="font-medium text-gray-900">Manage Events</h4>
                                <p class="text-sm text-gray-600">View ministry events</p>
                            </div>
                        </a>

                        <a href="#"
                           class="flex items-center p-3 border border-gray-200 rounded-lg hover:bg-purple-50 transition-colors">
                            <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-users text-purple-600"></i>
                            </div>
                            <div>
                                <h4 class="font-medium text-gray-900">Manage Members</h4>
                                <p class="text-sm text-gray-600">Add/remove members</p>
                            </div>
                        </a>

                        <a href="#"
                           class="flex items-center p-3 border border-gray-200 rounded-lg hover:bg-orange-50 transition-colors">
                            <div class="w-10 h-10 bg-orange-100 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-chart-bar text-orange-600"></i>
                            </div>
                           
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Banner image preview for file upload
    function previewBannerImage(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('bannerPreviewImage').src = e.target.result;
                document.getElementById('bannerPreview').classList.remove('hidden');
                // Clear the text input when uploading new file
                document.getElementById('image_url').value = '';
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    window.previewBannerImage = previewBannerImage;

    function removeBannerPreview() {
        document.getElementById('image_file').value = '';
        document.getElementById('bannerPreview').classList.add('hidden');
    }

    window.removeBannerPreview = removeBannerPreview;

    // Select gallery image
    function selectGalleryImage(filename) {
        document.getElementById('image_url').value = filename;
        document.getElementById('image_file').value = ''; // Clear file input
        // Hide file preview if shown
        document.getElementById('bannerPreview').classList.add('hidden');
        
        // Show confirmation
        showNotification(`Selected: ${filename}`, 'success');
    }

    window.selectGalleryImage = selectGalleryImage;

    function openGallerySelector() {
        alert('Browse gallery images above. Click any image to select it.');
    }

    window.openGallerySelector = openGallerySelector;

    function showNotification(message, type = 'info') {
        // Simple notification
        const notification = document.createElement('div');
        notification.className = `fixed top-4 right-4 px-4 py-3 rounded-lg shadow-lg z-50 ${
            type === 'success' ? 'bg-green-100 text-green-800 border border-green-200' : 
            type === 'error' ? 'bg-red-100 text-red-800 border border-red-200' :
            'bg-blue-100 text-blue-800 border border-blue-200'
        }`;
        notification.innerHTML = `
            <div class="flex items-center">
                <i class="fas fa-${type === 'success' ? 'check-circle' : type === 'error' ? 'exclamation-circle' : 'info-circle'} mr-2"></i>
                <span>${message}</span>
            </div>
        `;
        document.body.appendChild(notification);
        
        // Remove after 3 seconds
        setTimeout(() => {
            notification.remove();
        }, 3000);
    }

    window.showNotification = showNotification;

    // Form validation
    const form = document.querySelector('form');
    if (form) {
        form.addEventListener('submit', function(e) {
            const nameInput = document.getElementById('name');
            if (!nameInput.value.trim()) {
                e.preventDefault();
                showNotification('Please enter a ministry name.', 'error');
                nameInput.focus();
            }
        });
    }
});
</script>
@endsection