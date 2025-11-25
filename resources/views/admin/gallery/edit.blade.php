@extends('admin.layouts.app')

@section('title', 'Edit Gallery Image')

@section('content')
<style>
    .edit-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 3rem 2rem;
    margin: -1.5rem -2rem 3rem;
    position: relative;
    overflow: hidden;
    border-radius: 0 0 16px 16px;
}

.edit-header::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100" fill="%23ffffff" opacity="0.08"><polygon points="0,0 1000,50 1000,100 0,100"/></svg>');
    background-size: cover;
}

.edit-header::after {
    content: '';
    position: absolute;
    top: -50%;
    right: -10%;
    width: 300px;
    height: 300px;
    background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0) 70%);
    border-radius: 50%;
}

.edit-header h1 {
    font-size: 2.5rem;
    font-weight: 800;
    margin-bottom: 0.5rem;
    background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    text-shadow: 0 2px 4px rgba(0,0,0,0.1);
    animation: slideInDown 0.6s ease-out;
}

.edit-header p {
    font-size: 1.1rem;
    opacity: 0.9;
    font-weight: 300;
    margin-bottom: 0;
    animation: slideInDown 0.6s ease-out 0.1s both;
}

.btn-back {
    background: rgba(255, 255, 255, 0.25);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.3);
    color: white;
    padding: 0.75rem 1.5rem;
    border-radius: 12px;
    font-weight: 500;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    animation: slideInDown 0.6s ease-out 0.2s both;
}

.btn-back:hover {
    background: rgba(255, 255, 255, 0.35);
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(0,0,0,0.15);
    color: white;
    text-decoration: none;
}

.btn-back i {
    transition: transform 0.3s ease;
}

.btn-back:hover i {
    transform: translateX(-3px);
}

@keyframes slideInDown {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .edit-header {
        text-align: center;
        padding: 2rem 1rem;
    }
    .btn-back {
        margin-top: 1rem;
        justify-content: center;
    }
}

@media (max-width: 576px) {
    .edit-header h1 {
        font-size: 2rem;
    }
    .edit-header::after {
        width: 200px;
        height: 200px;
        top: -30%;
        right: -20%;
    }
}

    .form-card {
        background: white;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        padding: 2rem;
        margin-bottom: 2rem;
        border: none;
    }

    .image-preview {
        border: 2px dashed #dee2e6;
        border-radius: 12px;
        padding: 2rem;
        text-align: center;
        background: #f8f9fa;
        transition: all 0.3s ease;
    }

    .image-preview.has-image {
        border-style: solid;
        border-color: #28a745;
        background: white;
    }

    .preview-image {
        max-width: 100%;
        max-height: 300px;
        border-radius: 8px;
    }

    .upload-placeholder {
        color: #6c757d;
    }

    .btn-upload {
        margin-top: 0.5rem;
    }

    .form-control, .form-select {
        border: 2px solid #e9ecef;
        border-radius: 10px;
        padding: 0.75rem 1rem;
        transition: all 0.3s ease;
    }
.actions-card {
    background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
    border: 1px solid #e2e8f0;
    border-radius: 16px;
    padding: 2rem;
    margin-bottom: 2rem;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
    position: relative;
    overflow: hidden;
}

.actions-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 4px;
    height: 100%;
    background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
}

.actions-card h3 {
    color: #1e293b;
    font-size: 1.25rem;
    font-weight: 700;
    margin-bottom: 1.5rem;
    display: flex;
    align-items: center;
}

.actions-card h3 i {
    background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    font-size: 1.5rem;
}

.actions-buttons {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1rem;
}

.btn-update {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    border: none;
    border-radius: 12px;
    padding: 1.125rem 2rem;
    font-weight: 600;
    font-size: 1.1rem;
    color: white;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
    position: relative;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    height: 60px;
}

.btn-update::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
    transition: left 0.5s;
}

.btn-update:hover::before {
    left: 100%;
}

.btn-update:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(16, 185, 129, 0.4);
    background: linear-gradient(135deg, #059669 0%, #10b981 100%);
}

.btn-cancel {
    background: white;
    border: 2px solid #64748b;
    color: #64748b;
    border-radius: 12px;
    padding: 1.125rem 2rem;
    font-weight: 600;
    font-size: 1.1rem;
    transition: all 0.3s ease;
    text-decoration: none;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    height: 60px;
    box-shadow: 0 2px 8px rgba(100, 116, 139, 0.1);
}

.btn-cancel:hover {
    background: #64748b;
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(100, 116, 139, 0.2);
    text-decoration: none;
}

/* Animation */
.actions-card {
    animation: slideInUp 0.6s ease-out;
}

@keyframes slideInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Responsive */
@media (max-width: 768px) {
    .actions-card {
        padding: 1.5rem;
    }
    
    .actions-buttons {
        grid-template-columns: 1fr;
        gap: 0.75rem;
    }
    
    .btn-update, .btn-cancel {
        padding: 1rem 1.5rem;
        font-size: 1rem;
        height: 56px;
    }
}
    .form-control:focus, .form-select:focus {
        border-color: #ff7eb3;
        box-shadow: 0 0 0 0.2rem rgba(255,126,179,0.25);
    }
</style>

<!-- Header Section -->
<div class="edit-header">
    <div class="container-fluid d-flex justify-content-between align-items-center flex-wrap">
        <div>
            <h1>Edit Gallery Image</h1>
            <p>Update image, title, description, or status</p>
        </div>
        <a href="{{ route('admin.gallery.index') }}" class="btn-back">
            <i class="fas fa-arrow-left"></i> Back to Gallery
        </a>
    </div>
</div>
<div class="container-fluid">
    <form action="{{ route('admin.gallery.update', $gallery) }}" method="POST" enctype="multipart/form-data" id="galleryEditForm">
        @csrf
        @method('PUT')

        <div class="row">
            <!-- Main Form -->
            <div class="col-lg-8">
                <!-- Image Upload -->
                <div class="form-card">
                    <h3 class="h5 fw-bold mb-4">
                        <i class="fas fa-image text-primary me-2"></i>Image Upload
                    </h3>

                    <div class="form-section">
                        <label for="image" class="form-label fw-semibold">Gallery Image</label>
                        <div class="image-preview has-image" id="imagePreview">
                            <img id="previewImage" class="preview-image mb-3" 
                                 src="{{ asset($gallery->image_url) }}" 
                                 alt="{{ $gallery->title }}">
                            <div class="upload-placeholder" id="uploadPlaceholder" style="display: none;">
                                <i class="fas fa-cloud-upload-alt fa-3x mb-3"></i>
                                <p class="mb-2">Click to upload or drag and drop</p>
                                <small class="text-muted">PNG, JPG, GIF, WEBP up to 5MB</small>
                            </div>
                        </div>
                        <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror" accept="image/*" style="display: none;">
                        <button type="button" class="btn btn-outline-primary w-100 btn-upload" onclick="document.getElementById('image').click()">
                            <i class="fas fa-folder-open me-2"></i>Choose New Image
                        </button>
                        @error('image')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Image Details -->
                <div class="form-card">
                    <h3 class="h5 fw-bold mb-4">
                        <i class="fas fa-info-circle text-success me-2"></i>Image Details
                    </h3>

                    <div class="form-section">
                        <label for="title" class="form-label fw-semibold">Image Title *</label>
                        <input type="text" name="title" id="title" 
                               class="form-control @error('title') is-invalid @enderror" 
                               value="{{ old('title', $gallery->title) }}" 
                               placeholder="Enter a descriptive title" required>
                        @error('title')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-section">
                        <label for="description" class="form-label fw-semibold">Description</label>
                        <textarea name="description" id="description" 
                                  class="form-control @error('description') is-invalid @enderror" 
                                  rows="5" 
                                  placeholder="Describe the image, event, or occasion...">{{ old('description', $gallery->description) }}</textarea>
                        <div class="d-flex justify-content-between align-items-center mt-2">
                            <small class="text-muted">Optional description</small>
                            <span id="charCount" class="char-count">0/1000</span>
                        </div>
                        @error('description')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Publishing Options -->
                <div class="form-card">
                    <h3 class="h5 fw-bold mb-4">
                        <i class="fas fa-cogs text-warning me-2"></i>Publishing
                    </h3>
                    <div class="form-section">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" 
                                   {{ old('is_active', $gallery->is_active) ? 'checked' : '' }}>
                            <label class="form-check-label fw-semibold" for="is_active">
                                Activate Image
                            </label>
                        </div>
                        <small class="text-muted">When active, this image will be visible on the website</small>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="form-card actions-card">
    <h3 class="h5 fw-bold mb-4">
        <i class="fas fa-paper-plane text-info me-2"></i>Actions
    </h3>
    <div class="actions-buttons">
        <button type="submit" class="btn btn-update">
            <i class="fas fa-save me-2"></i>Update Image
        </button>
        <a href="{{ route('admin.gallery.index') }}" class="btn btn-cancel">
            <i class="fas fa-times me-2"></i>Cancel
        </a>
    </div>
</div>
            </div>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const imageInput = document.getElementById('image');
    const imagePreview = document.getElementById('imagePreview');
    const previewImage = document.getElementById('previewImage');
    const uploadPlaceholder = document.getElementById('uploadPlaceholder');
    const descriptionInput = document.getElementById('description');
    const charDisplay = document.getElementById('charCount');

    // Image preview functionality
    imageInput.addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.addEventListener('load', function() {
                previewImage.src = reader.result;
                uploadPlaceholder.style.display = 'none';
                imagePreview.classList.add('has-image');
            });
            reader.readAsDataURL(file);
        }
    });

    // Character count for description
    if (descriptionInput && charDisplay) {
        const updateCharCount = function() {
            const len = this.value.length;
            charDisplay.textContent = len + '/1000';
            if (len > 900) charDisplay.className = 'char-count danger';
            else if (len > 750) charDisplay.className = 'char-count warning';
            else charDisplay.className = 'char-count';
        };
        descriptionInput.addEventListener('input', updateCharCount);
        updateCharCount.call(descriptionInput);
    }
});
</script>
@endsection
