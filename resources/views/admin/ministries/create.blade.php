@extends('admin.layouts.app')

@section('title', 'Create New Ministry')

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
                <h1 class="text-3xl font-bold text-white">Create New Ministry</h1>
                <p class="text-gray-600 mt-1">Add a new ministry to the ELCK Church</p>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Form Section -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
                <div class="bg-gradient-to-r from-[#197b3b] to-green-700 px-6 py-4">
                    <h2 class="text-xl font-semibold text-white">Ministry Details</h2>
                </div>
                
                <form action="{{ route('admin.ministries.store') }}" method="POST" enctype="multipart/form-data" class="p-6">
                    @csrf
                    
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

                    <!-- Basic Information -->
                    <div class="space-y-6">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                Ministry Name *
                            </label>
                            <input type="text" 
                                   name="name" 
                                   id="name"
                                   value="{{ old('name') }}"
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
                                      placeholder="Describe the ministry's purpose, activities, and goals...">{{ old('description') }}</textarea>
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
                                       value="{{ old('leader_name') }}"
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
                                       value="{{ old('contact_email') }}"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#197b3b] focus:border-[#197b3b] transition-colors text-black"
                                       placeholder="e.g., leader@elckchurch.org">
                            </div>
                        </div>

                        <!-- Schedule & Status -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="meeting_schedule" class="block text-sm font-medium text-gray-700 mb-2">
                                    Meeting Schedule
                                </label>
                                <input type="text" 
                                       name="meeting_schedule" 
                                       id="meeting_schedule"
                                       value="{{ old('meeting_schedule') }}"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#197b3b] focus:border-[#197b3b] transition-colors text-black"
                                       placeholder="e.g., Every Sunday at 2:00 PM">
                                <p class="mt-1 text-sm text-gray-500">Regular meeting time and frequency</p>
                            </div>

                            <div>
                                <label for="image_url" class="block text-sm font-medium text-gray-700 mb-2">
                                    Image URL (Optional)
                                </label>
                                <input type="url" 
                                       name="image_url" 
                                       id="image_url"
                                       value="{{ old('image_url') }}"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#197b3b] focus:border-[#197b3b] transition-colors text-black"
                                       placeholder="https://example.com/image.jpg">
                                <p class="mt-1 text-sm text-gray-500">External image URL for ministry</p>
                            </div>
                        </div>

                        <!-- File Upload -->
                        <div>
                            <label for="leader_image" class="block text-sm font-medium text-gray-700 mb-2">
                                Leader Photo (Optional)
                            </label>
                            <div class="flex items-center space-x-4">
                                <input type="file" 
                                       name="leader_image" 
                                       id="leader_image"
                                       accept="image/*"
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#197b3b] focus:border-[#197b3b] transition-colors">
                            </div>
                            <p class="mt-1 text-sm text-gray-500">Upload a photo of the ministry leader (Max: 2MB, JPG/PNG/GIF)</p>
                        </div>

                        <!-- Status Toggle -->
                        <div class="flex items-center">
                            <input type="checkbox" 
                                   name="is_active" 
                                   id="is_active"
                                   value="1"
                                   {{ old('is_active', true) ? 'checked' : '' }}
                                   class="w-4 h-4 text-[#197b3b] border-gray-300 rounded focus:ring-[#197b3b] focus:ring-2">
                            <label for="is_active" class="ml-2 text-sm font-medium text-gray-700">
                                Active Ministry
                            </label>
                            <p class="ml-4 text-sm text-gray-500">Inactive ministries won't appear on the website</p>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="mt-8 pt-6 border-t border-gray-200 flex justify-end space-x-4">
                        <a href="{{ route('admin.ministries.index') }}"
                           class="inline-flex items-center px-6 py-3 border border-gray-300 text-gray-700 hover:bg-gray-50 font-medium rounded-lg transition-colors">
                            Cancel
                        </a>
                        <button type="submit"
                                class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-[#197b3b] to-green-800 hover:from-green-800 hover:to-green-900 text-white font-semibold rounded-lg shadow-lg transition-all duration-200 transform hover:-translate-y-0.5">
                            <i class="fas fa-plus mr-2"></i>
                            Create Ministry
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Help & Guidelines -->
        <div class="space-y-6">
            <!-- Guidelines Card -->
            <div class="bg-white rounded-2xl shadow-xl border border-gray-100">
                <div class="bg-gradient-to-r from-black to-gray-800 px-6 py-4">
                    <h2 class="text-xl font-semibold text-white">Guidelines</h2>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        <div class="flex items-start space-x-3">
                            <div class="w-8 h-8 rounded-full bg-green-100 flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-info text-[#197b3b]"></i>
                            </div>
                            <div>
                                <h4 class="font-medium text-gray-900">Required Fields</h4>
                                <p class="text-sm text-gray-600">Ministry name is required. All other fields are optional but recommended.</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start space-x-3">
                            <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-image text-blue-600"></i>
                            </div>
                            <div>
                                <h4 class="font-medium text-gray-900">Image Guidelines</h4>
                                <p class="text-sm text-gray-600">Leader photos should be professional and appropriate for church context.</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start space-x-3">
                            <div class="w-8 h-8 rounded-full bg-purple-100 flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-calendar-check text-purple-600"></i>
                            </div>
                            <div>
                                <h4 class="font-medium text-gray-900">Meeting Schedule</h4>
                                <p class="text-sm text-gray-600">Be specific about days, times, and location for better member engagement.</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start space-x-3">
                            <div class="w-8 h-8 rounded-full bg-orange-100 flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-users text-orange-600"></i>
                            </div>
                            <div>
                                <h4 class="font-medium text-gray-900">Member Management</h4>
                                <p class="text-sm text-gray-600">Add members to this ministry after creating it from the ministry details page.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Preview Card -->
            <div class="bg-white rounded-2xl shadow-xl border border-gray-100">
                <div class="bg-gradient-to-r from-[#197b3b] to-green-700 px-6 py-4">
                    <h2 class="text-xl font-semibold text-white">Preview</h2>
                </div>
                <div class="p-6">
                    <div class="text-center">
                        <div class="w-20 h-20 rounded-2xl bg-gradient-to-br from-[#197b3b] to-green-700 mx-auto flex items-center justify-center mb-4">
                            <span id="previewInitial" class="text-white font-bold text-2xl">M</span>
                        </div>
                        <h3 id="previewName" class="font-bold text-gray-900 text-lg">Ministry Name</h3>
                        <p id="previewLeader" class="text-gray-600 text-sm mt-1">No leader assigned</p>
                        
                        <div class="mt-4 space-y-2">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-500">Status:</span>
                                <span id="previewStatus" class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-green-100 text-green-800">
                                    Active
                                </span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-500">Schedule:</span>
                                <span id="previewSchedule" class="text-gray-900">Not set</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Preview functionality
    const nameInput = document.getElementById('name');
    const leaderInput = document.getElementById('leader_name');
    const statusCheckbox = document.getElementById('is_active');
    const scheduleInput = document.getElementById('meeting_schedule');
    const previewInitial = document.getElementById('previewInitial');
    const previewName = document.getElementById('previewName');
    const previewLeader = document.getElementById('previewLeader');
    const previewStatus = document.getElementById('previewStatus');
    const previewSchedule = document.getElementById('previewSchedule');

    // Update preview on input
    nameInput.addEventListener('input', function() {
        const name = this.value.trim();
        previewName.textContent = name || 'Ministry Name';
        previewInitial.textContent = name ? name.charAt(0).toUpperCase() : 'M';
    });

    leaderInput.addEventListener('input', function() {
        const leader = this.value.trim();
        previewLeader.textContent = leader || 'No leader assigned';
    });

    scheduleInput.addEventListener('input', function() {
        const schedule = this.value.trim();
        previewSchedule.textContent = schedule || 'Not set';
    });

    statusCheckbox.addEventListener('change', function() {
        if (this.checked) {
            previewStatus.textContent = 'Active';
            previewStatus.className = 'inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-green-100 text-green-800';
        } else {
            previewStatus.textContent = 'Inactive';
            previewStatus.className = 'inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-red-100 text-red-800';
        }
    });

    // File upload preview
    const fileInput = document.getElementById('leader_image');
    const previewImage = document.getElementById('previewImage');
    
    if (fileInput && previewImage) {
        fileInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    previewImage.classList.remove('hidden');
                }
                reader.readAsDataURL(file);
            }
        });
    }
});
</script>
@endsection