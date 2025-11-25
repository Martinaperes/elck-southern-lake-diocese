@extends('admin.layouts.app')

@section('title', 'Create New Ministry')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
        <div>
            <div class="flex items-center space-x-2">
                <a href="{{ route('admin.ministries.index') }}" 
                   class="text-blue-600 hover:text-blue-900">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <h1 class="text-2xl font-bold text-gray-900">Create New Ministry</h1>
            </div>
            <p class="text-gray-600 mt-1">Add a new ministry or group to your church</p>
        </div>
        <div class="flex space-x-2 mt-4 md:mt-0">
            <a href="{{ route('admin.ministries.index') }}" 
               class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                <i class="fas fa-list mr-2"></i> View All Ministries
            </a>
        </div>
    </div>

    <!-- Create Form -->
    <div class="max-w-4xl mx-auto">
        <form action="{{ route('admin.ministries.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Left Column - Ministry Information -->
                <div class="lg:col-span-2">
                    <!-- Basic Information Card -->
                    <div class="bg-white shadow-lg rounded-lg">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-900">Ministry Information</h3>
                            <p class="text-sm text-gray-600 mt-1">Enter the basic details about the ministry</p>
                        </div>
                        <div class="p-6 space-y-6">
                            <!-- Ministry Name -->
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                    Ministry Name <span class="text-red-500">*</span>
                                </label>
                                <input type="text" 
                                       name="name" 
                                       id="name"
                                       value="{{ old('name') }}"
                                       required
                                       placeholder="e.g., Youth Ministry, Worship Team, etc."
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('name') border-red-500 @enderror">
                                @error('name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Description -->
                            <div>
                                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                                    Description <span class="text-red-500">*</span>
                                </label>
                                <textarea name="description" 
                                          id="description"
                                          rows="4"
                                          required
                                          placeholder="Describe the purpose and activities of this ministry..."
                                          class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
                                @error('description')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Leader Name -->
                            <div>
                                <label for="leader_name" class="block text-sm font-medium text-gray-700 mb-2">
                                    Leader Name
                                </label>
                                <input type="text" 
                                       name="leader_name" 
                                       id="leader_name"
                                       value="{{ old('leader_name') }}"
                                       placeholder="Enter the name of the ministry leader"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('leader_name') border-red-500 @enderror">
                                @error('leader_name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Contact Email -->
                                <div>
                                    <label for="contact_email" class="block text-sm font-medium text-gray-700 mb-2">
                                        Contact Email
                                    </label>
                                    <input type="email" 
                                           name="contact_email" 
                                           id="contact_email"
                                           value="{{ old('contact_email') }}"
                                           placeholder="ministry@church.com"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('contact_email') border-red-500 @enderror">
                                    @error('contact_email')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Meeting Schedule -->
                                <div>
                                    <label for="meeting_schedule" class="block text-sm font-medium text-gray-700 mb-2">
                                        Meeting Schedule
                                    </label>
                                    <input type="text" 
                                           name="meeting_schedule" 
                                           id="meeting_schedule"
                                           value="{{ old('meeting_schedule') }}"
                                           placeholder="e.g., Every Sunday at 2:00 PM"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('meeting_schedule') border-red-500 @enderror">
                                    @error('meeting_schedule')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Image Upload -->
                            <div>
                                <label for="image" class="block text-sm font-medium text-gray-700 mb-2">
                                    Ministry Image
                                </label>
                                <div class="flex items-center justify-center w-full">
                                    <label for="image" class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 transition-colors duration-200">
                                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                            <i class="fas fa-cloud-upload-alt text-gray-400 text-2xl mb-2"></i>
                                            <p class="mb-1 text-sm text-gray-500">
                                                <span class="font-semibold">Click to upload</span> or drag and drop
                                            </p>
                                            <p class="text-xs text-gray-500">PNG, JPG, GIF (MAX. 2MB)</p>
                                        </div>
                                        <input id="image" 
                                               name="image" 
                                               type="file" 
                                               class="hidden" 
                                               accept="image/*"
                                               onchange="previewImage(this)" />
                                    </label>
                                </div>
                                @error('image')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                                
                                <!-- Image Preview -->
                                <div id="image-preview" class="mt-4 hidden">
                                    <p class="text-sm font-medium text-gray-700 mb-2">Image Preview:</p>
                                    <div class="relative inline-block">
                                        <img id="preview" class="h-48 w-48 object-cover rounded-lg border-2 border-gray-300 shadow-sm">
                                        <button type="button" 
                                                onclick="removeImage()"
                                                class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs hover:bg-red-600">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Status -->
                            <div class="flex items-center">
                                <input type="checkbox" 
                                       name="is_active" 
                                       id="is_active"
                                       value="1"
                                       {{ old('is_active', true) ? 'checked' : '' }}
                                       class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                <label for="is_active" class="ml-2 text-sm text-gray-700">
                                    Active Ministry
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column - Actions & Info -->
                <div class="lg:col-span-1">
                    <!-- Actions Card -->
                    <div class="bg-white shadow-lg rounded-lg sticky top-6">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-900">Create Ministry</h3>
                        </div>
                        <div class="p-6 space-y-4">
                            <button type="submit" 
                                    class="w-full inline-flex justify-center items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                <i class="fas fa-plus-circle mr-2"></i> Create Ministry
                            </button>
                            
                            <a href="{{ route('admin.ministries.index') }}" 
                               class="w-full inline-flex justify-center items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                <i class="fas fa-times mr-2"></i> Cancel
                            </a>
                        </div>
                    </div>

                    <!-- Quick Tips Card -->
                    <div class="bg-white shadow-lg rounded-lg mt-6">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-900">Quick Tips</h3>
                        </div>
                        <div class="p-6">
                            <div class="space-y-4">
                                <div class="flex items-start space-x-3">
                                    <i class="fas fa-info-circle text-blue-500 mt-1"></i>
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">Required Fields</p>
                                        <p class="text-sm text-gray-600">Name and description are required.</p>
                                    </div>
                                </div>
                                <div class="flex items-start space-x-3">
                                    <i class="fas fa-user text-green-500 mt-1"></i>
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">Leader Information</p>
                                        <p class="text-sm text-gray-600">Leader name is optional but recommended.</p>
                                    </div>
                                </div>
                                <div class="flex items-start space-x-3">
                                    <i class="fas fa-image text-purple-500 mt-1"></i>
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">Image Upload</p>
                                        <p class="text-sm text-gray-600">Upload images directly from your computer.</p>
                                    </div>
                                </div>
                                <div class="flex items-start space-x-3">
                                    <i class="fas fa-toggle-on text-orange-500 mt-1"></i>
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">Active Status</p>
                                        <p class="text-sm text-gray-600">Inactive ministries won't show to members.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Form Requirements Card -->
                    <div class="bg-white shadow-lg rounded-lg mt-6">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-900">Requirements</h3>
                        </div>
                        <div class="p-6">
                            <ul class="text-sm text-gray-600 space-y-2">
                                <li class="flex items-center">
                                    <i class="fas fa-check text-green-500 mr-2"></i>
                                    Ministry name must be unique
                                </li>
                                <li class="flex items-center">
                                    <i class="fas fa-check text-green-500 mr-2"></i>
                                    Description should be meaningful
                                </li>
                                <li class="flex items-center">
                                    <i class="fas fa-check text-green-500 mr-2"></i>
                                    Images: PNG, JPG, GIF up to 2MB
                                </li>
                                <li class="flex items-center">
                                    <i class="fas fa-check text-green-500 mr-2"></i>
                                    Valid email format if provided
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('styles')
<style>
    .drag-over {
        background-color: #f0f9ff;
        border-color: #3b82f6;
    }
</style>
@endpush

@push('scripts')
<script>
    function previewImage(input) {
        const preview = document.getElementById('preview');
        const previewContainer = document.getElementById('image-preview');
        
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                preview.src = e.target.result;
                previewContainer.classList.remove('hidden');
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }

    function removeImage() {
        const input = document.getElementById('image');
        const previewContainer = document.getElementById('image-preview');
        
        input.value = '';
        previewContainer.classList.add('hidden');
    }

    document.addEventListener('DOMContentLoaded', function() {
        // Drag and drop functionality
        const dropArea = document.querySelector('label[for="image"]');
        const fileInput = document.getElementById('image');

        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            dropArea.addEventListener(eventName, preventDefaults, false);
        });

        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }

        ['dragenter', 'dragover'].forEach(eventName => {
            dropArea.addEventListener(eventName, highlight, false);
        });

        ['dragleave', 'drop'].forEach(eventName => {
            dropArea.addEventListener(eventName, unhighlight, false);
        });

        function highlight() {
            dropArea.classList.add('drag-over');
        }

        function unhighlight() {
            dropArea.classList.remove('drag-over');
        }

        dropArea.addEventListener('drop', handleDrop, false);

        function handleDrop(e) {
            const dt = e.dataTransfer;
            const files = dt.files;
            fileInput.files = files;
            previewImage(fileInput);
        }

        // Form validation
        const form = document.querySelector('form');
        form.addEventListener('submit', function(e) {
            const name = document.getElementById('name').value.trim();
            const description = document.getElementById('description').value.trim();
            
            if (!name) {
                e.preventDefault();
                alert('Please enter a ministry name.');
                document.getElementById('name').focus();
                return;
            }
            
            if (!description) {
                e.preventDefault();
                alert('Please enter a ministry description.');
                document.getElementById('description').focus();
                return;
            }
        });
    });
</script>
@endpush