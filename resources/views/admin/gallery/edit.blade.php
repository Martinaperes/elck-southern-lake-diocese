@extends('admin.layouts.app')

@section('content')
<div class="min-h-screen bg-background-light dark:bg-background-dark">
    
    <!-- Header -->
    <div class="sticky top-0 z-10 bg-background-dark border-b border-white/10 p-4">
        <div class="flex items-center">
            <a href="{{ route('admin.gallery.index') }}" class="mr-4 text-white">
                <span class="material-symbols-outlined">chevron_left</span>
            </a>
            <h1 class="text-lg font-bold text-white leading-tight tracking-tight">Edit: {{ $gallery->title }}</h1>
        </div>
    </div>

    <!-- Form -->
    <form action="{{ route('admin.gallery.update', $gallery) }}" method="POST" enctype="multipart/form-data" class="p-4 space-y-6 pb-24">
        @csrf
        @method('PUT')
        
        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-4">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Current Image -->
        <div>
            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Current Image</label>
            <div class="relative aspect-[4/5] rounded-xl overflow-hidden bg-slate-100 dark:bg-slate-800 border border-slate-300 dark:border-slate-700">
                <img src="{{ asset($gallery->image_url) }}" alt="{{ $gallery->title }}" 
                     class="absolute inset-0 w-full h-full object-cover">
            </div>
            <p class="text-sm text-slate-500 dark:text-slate-400 mt-2">
                Upload new image below to replace current
            </p>
        </div>

        <!-- New Image Upload -->
        <div>
            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Replace Image (Optional)</label>
            <div class="border-2 border-dashed border-slate-300 dark:border-slate-700 rounded-xl p-6 text-center hover:border-primary transition-colors cursor-pointer"
                 onclick="document.getElementById('imageInput').click()">
                <input type="file" name="image" id="imageInput" accept="image/*" class="hidden" onchange="previewFile()">
                <div class="flex flex-col items-center justify-center">
                    <span class="material-symbols-outlined text-3xl text-slate-400 dark:text-slate-600 mb-2">
                        cloud_upload
                    </span>
                    <p class="text-slate-900 dark:text-white font-medium mb-1">Click to upload new image</p>
                    <p class="text-sm text-slate-500 dark:text-slate-400">Leave empty to keep current</p>
                </div>
            </div>
            @error('image')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- New Image Preview -->
        <div id="imagePreview" class="hidden">
            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">New Image Preview</label>
            <div class="relative aspect-[4/5] rounded-xl overflow-hidden bg-slate-100 dark:bg-slate-800 border border-slate-300 dark:border-slate-700">
                <img id="previewImage" src="" alt="Preview" class="absolute inset-0 w-full h-full object-cover">
                <button type="button" onclick="removeImage()" 
                        class="absolute top-2 right-2 size-8 rounded-full bg-black/60 text-white flex items-center justify-center">
                    <span class="material-symbols-outlined text-[18px]">close</span>
                </button>
            </div>
        </div>

        <!-- Title -->
        <div>
            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Title *</label>
            <input type="text" name="title" required
                   class="w-full px-4 py-3 bg-white dark:bg-slate-800 border border-slate-300 dark:border-slate-700 rounded-lg text-slate-900 dark:text-white"
                   placeholder="Enter image title" 
                   value="{{ old('title', $gallery->title) }}">
            @error('title')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Description -->
        <div>
            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Description</label>
            <textarea name="description" rows="3"
                      class="w-full px-4 py-3 bg-white dark:bg-slate-800 border border-slate-300 dark:border-slate-700 rounded-lg text-slate-900 dark:text-white"
                      placeholder="Optional description...">{{ old('description', $gallery->description) }}</textarea>
            @error('description')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Status -->
        <div class="flex items-center justify-between p-4 bg-slate-50 dark:bg-slate-900/50 rounded-lg">
            <div>
                <p class="font-medium text-slate-900 dark:text-white">Active</p>
                <p class="text-sm text-slate-500 dark:text-slate-400">Show in gallery</p>
            </div>
            <input type="hidden" name="is_active" value="0">
            <input type="checkbox" name="is_active" value="1" 
                   {{ old('is_active', $gallery->is_active) ? 'checked' : '' }}
                   class="h-5 w-5 rounded border-slate-300 text-primary">
        </div>

        <!-- Action Buttons -->
        <div class="flex items-center justify-between pt-6 border-t border-slate-200 dark:border-slate-800">
            <div class="flex space-x-3">
                <a href="{{ route('admin.gallery.index') }}" 
                   class="px-6 py-3 border border-slate-300 dark:border-slate-700 text-slate-700 dark:text-slate-300 rounded-lg hover:bg-slate-50 dark:hover:bg-slate-800 transition">
                    Cancel
                </a>
                
                <button type="button" 
                        onclick="if(confirm('Are you sure you want to delete this image?')) { document.getElementById('delete-form').submit(); }"
                        class="px-6 py-3 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
                    Delete Image
                </button>
            </div>
            
            <button type="submit" 
                    class="px-6 py-3 bg-primary hover:bg-primary/90 text-white font-bold rounded-lg shadow-lg shadow-primary/20 flex items-center justify-center gap-2">
                <span class="material-symbols-outlined">save</span>
                Update Image
            </button>
        </div>
    </form>

    <!-- Delete Form (Hidden) -->
    <form id="delete-form" action="{{ route('admin.gallery.destroy', $gallery) }}" method="POST" class="hidden">
        @csrf
        @method('DELETE')
    </form>
</div>

<script>
function previewFile() {
    const preview = document.getElementById('imagePreview');
    const previewImage = document.getElementById('previewImage');
    const fileInput = document.getElementById('imageInput');
    const file = fileInput.files[0];
    
    if (file) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            previewImage.src = e.target.result;
            preview.classList.remove('hidden');
        }
        
        reader.readAsDataURL(file);
    }
}

function removeImage() {
    const preview = document.getElementById('imagePreview');
    const fileInput = document.getElementById('imageInput');
    
    fileInput.value = '';
    preview.classList.add('hidden');
}

// File size validation
document.getElementById('imageInput').addEventListener('change', function(e) {
    const file = e.target.files[0];
    const maxSize = 5 * 1024 * 1024; // 5MB in bytes
    
    if (file && file.size > maxSize) {
        alert('File is too large! Maximum size is 5MB.');
        e.target.value = '';
        document.getElementById('imagePreview').classList.add('hidden');
    }
});
</script>
@endsection