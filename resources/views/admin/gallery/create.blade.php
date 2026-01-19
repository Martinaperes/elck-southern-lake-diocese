@extends('admin.layouts.app')

@section('content')
<div class="min-h-screen bg-background-light dark:bg-background-dark">
    
    <!-- Header -->
    <div class="sticky top-0 z-10 bg-background-dark border-b border-white/10 p-4">
        <div class="flex items-center">
            <a href="{{ route('admin.gallery.index') }}" class="mr-4 text-white">
                <span class="material-symbols-outlined">chevron_left</span>
            </a>
            <h1 class="text-lg font-bold text-white leading-tight tracking-tight">Add Gallery Image</h1>
        </div>
    </div>

    <!-- Form -->
    <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data" class="p-4 space-y-6 pb-24">
        @csrf
        
        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-4">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Image Preview -->
        <div id="imagePreview" class="hidden">
            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Preview</label>
            <div class="relative aspect-[4/5] rounded-xl overflow-hidden bg-slate-100 dark:bg-slate-800 border border-slate-300 dark:border-slate-700">
                <img id="previewImage" src="" alt="Preview" class="absolute inset-0 w-full h-full object-cover">
                <button type="button" onclick="removeImage()" 
                        class="absolute top-2 right-2 size-8 rounded-full bg-black/60 text-white flex items-center justify-center">
                    <span class="material-symbols-outlined text-[18px]">close</span>
                </button>
            </div>
        </div>

        <!-- Image Upload -->
        <div id="uploadArea">
            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Image *</label>
            <div class="border-2 border-dashed border-slate-300 dark:border-slate-700 rounded-xl p-8 text-center hover:border-primary transition-colors cursor-pointer"
                 onclick="document.getElementById('imageInput').click()">
                <input type="file" name="image" id="imageInput" accept="image/*" class="hidden" required onchange="previewFile()">
                <div class="flex flex-col items-center justify-center">
                    <span class="material-symbols-outlined text-4xl text-slate-400 dark:text-slate-600 mb-3">
                        cloud_upload
                    </span>
                    <p class="text-slate-900 dark:text-white font-medium mb-1">Click to upload</p>
                    <p class="text-sm text-slate-500 dark:text-slate-400">PNG, JPG, GIF, WebP up to 5MB</p>
                    <p class="text-xs text-slate-400 dark:text-slate-500 mt-2">Recommended: 4:5 aspect ratio</p>
                </div>
            </div>
            @error('image')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Title -->
        <div>
            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Title *</label>
            <input type="text" name="title" required
                   class="w-full px-4 py-3 bg-white dark:bg-slate-800 border border-slate-300 dark:border-slate-700 rounded-lg text-slate-900 dark:text-white"
                   placeholder="Enter image title" 
                   value="{{ old('title') }}">
            @error('title')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Description -->
        <div>
            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Description</label>
            <textarea name="description" rows="3"
                      class="w-full px-4 py-3 bg-white dark:bg-slate-800 border border-slate-300 dark:border-slate-700 rounded-lg text-slate-900 dark:text-white"
                      placeholder="Optional description...">{{ old('description') }}</textarea>
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
                   {{ old('is_active', true) ? 'checked' : '' }}
                   class="h-5 w-5 rounded border-slate-300 text-primary">
        </div>

        <!-- Submit Button -->
        <div class="pt-6">
            <button type="submit" 
                    class="w-full bg-primary hover:bg-primary/90 text-white font-bold py-4 rounded-lg shadow-lg shadow-primary/20 flex items-center justify-center gap-2">
                <span class="material-symbols-outlined">save</span>
                Add to Gallery
            </button>
        </div>
    </form>
</div>

<script>
function previewFile() {
    const preview = document.getElementById('imagePreview');
    const previewImage = document.getElementById('previewImage');
    const uploadArea = document.getElementById('uploadArea');
    const fileInput = document.getElementById('imageInput');
    const file = fileInput.files[0];
    
    if (file) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            previewImage.src = e.target.result;
            preview.classList.remove('hidden');
            uploadArea.classList.add('hidden');
        }
        
        reader.readAsDataURL(file);
    }
}

function removeImage() {
    const preview = document.getElementById('imagePreview');
    const uploadArea = document.getElementById('uploadArea');
    const fileInput = document.getElementById('imageInput');
    
    fileInput.value = '';
    preview.classList.add('hidden');
    uploadArea.classList.remove('hidden');
}

// File size validation
document.getElementById('imageInput').addEventListener('change', function(e) {
    const file = e.target.files[0];
    const maxSize = 5 * 1024 * 1024; // 5MB in bytes
    
    if (file && file.size > maxSize) {
        alert('File is too large! Maximum size is 5MB.');
        e.target.value = '';
    }
});
</script>
@endsection