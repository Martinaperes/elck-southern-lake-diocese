@extends('admin.layouts.app')

@section('title', 'Add New Photo')

@section('content')
<style>
    /* Header Section */
    <style>
.create-header {
    background: linear-gradient(135deg, #2d3748 0%, #4a5568 100%);
    color: white;
    padding: 3rem 0;
    margin: -1.5rem -2rem 3rem;
    position: relative;
}

.create-header::before {
    content: '⛪';
    position: absolute;
    top: 50%;
    right: 10%;
    transform: translateY(-50%);
    font-size: 4rem;
    opacity: 0.1;
}

.create-header h1 {
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
    font-family: 'Georgia', serif;
}

.create-header p {
    font-size: 1.1rem;
    opacity: 0.8;
    font-style: italic;
}

.btn-add-photo {
    background: #d97706;
    color: white;
    padding: 0.75rem 1.5rem;
    border-radius: 6px;
    text-decoration: none;
    font-weight: 500;
    transition: all 0.3s ease;
    border: 2px solid #d97706;
}

.btn-add-photo:hover {
    background: transparent;
    color: #d97706;
    text-decoration: none;
}

    /* Form Cards */
    .form-card {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 6px 20px rgba(0,0,0,0.08);
        padding: 2rem;
        margin-bottom: 2rem;
        border: none;
    }
    .form-card h3 { font-size: 1.25rem; margin-bottom: 1.25rem; }

    /* Image Preview */
    .image-preview {
        border: 2px dashed #dee2e6;
        border-radius: 12px;
        padding: 2rem;
        text-align: center;
        background: #f8f9fa;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    .image-preview:hover { border-color: #4361ee; }
    .image-preview.has-image { border-style: solid; border-color: #28a745; background: #fff; }
    .preview-image { max-width: 100%; max-height: 300px; border-radius: 8px; display: none; }
    .upload-placeholder { color: #6c757d; }

    /* Inputs */
    .form-control, .form-select, .form-check-input {
        border: 2px solid #e9ecef;
        border-radius: 10px;
        padding: 0.75rem 1rem;
        transition: all 0.3s ease;
    }
    .form-control:focus, .form-select:focus {
        border-color: #4361ee;
        box-shadow: 0 0 0 0.2rem rgba(67,97,238,0.25);
    }

    /* Buttons */
    .btn-add-photo {
        background-color: #10b981;
        color: #fff;
        font-weight: 600;
        padding: 0.5rem 1rem;
        border-radius: 8px;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        text-decoration: none;
        transition: background 0.2s;
    }
    .btn-add-photo:hover { background-color: #0f766e; }
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

.btn-save {
    background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
    border: none;
    border-radius: 12px;
    padding: 1rem 2rem;
    font-weight: 600;
    font-size: 1.1rem;
    color: white;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
    position: relative;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    height: 56px;
}

.btn-save::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
    transition: left 0.5s;
}

.btn-save:hover::before {
    left: 100%;
}

.btn-save:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(59, 130, 246, 0.4);
}

.btn-cancel {
    background: white;
    border: 2px solid #64748b;
    color: #64748b;
    border-radius: 12px;
    padding: 1rem 2rem;
    font-weight: 600;
    font-size: 1.1rem;
    transition: all 0.3s ease;
    text-decoration: none;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    height: 56px;
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
    
    .btn-save, .btn-cancel {
        padding: 0.875rem 1.5rem;
        font-size: 1rem;
        height: 52px;
    }
}

    /* Stats */
    .stat-card {
        background: #f3f4f6;
        border-radius: 12px;
        padding: 1rem 1.5rem;
        text-align: center;
        font-weight: 600;
        color: #374151;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    }
    .stat-value { font-size: 1.5rem; color: #111827; font-weight: 700; }
    .stat-label { font-size: 0.875rem; color: #6b7280; }

    @media (max-width: 768px) {
        .create-header { padding: 2rem 0; margin: -1rem -1rem 2rem; }
    }
</style>

<!-- Header -->
<div class="create-header">
    <div class="container-fluid d-flex justify-content-between align-items-center flex-wrap">
        <div>
            <h1 class="fw-bold mb-1">Add New Photo</h1>
            <p class="mb-0">Upload a new image to your church gallery</p>
        </div>
        <a href="{{ route('admin.gallery.index') }}" class="btn-add-photo mb-2">
            <i class="fas fa-arrow-left"></i> Back to Gallery
        </a>
    </div>
</div>

<div class="container-fluid">
    <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data" id="galleryForm">
        @csrf

        <div class="row">
            <!-- Main Form -->
            <div class="col-lg-8">
                <!-- Image Upload -->
                <div class="form-card">
                    <h3><i class="fas fa-image text-primary me-2"></i>Upload Image</h3>
                    <label for="image" class="form-label fw-semibold">Photo *</label>
                    <div class="image-preview" id="imagePreview">
                        <img id="previewImage" class="preview-image mb-3" alt="Preview">
                        <div class="upload-placeholder" id="uploadPlaceholder">
                            <i class="fas fa-cloud-upload-alt fa-3x mb-2"></i>
                            <p class="mb-1">Click or drag & drop</p>
                            <small class="text-muted">PNG, JPG, GIF, WEBP up to 5MB</small>
                        </div>
                    </div>
                    <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror" accept="image/*" style="display: none;" required>
                    <button type="button" class="btn btn-outline-primary w-100 mt-2" onclick="document.getElementById('image').click()">
                        <i class="fas fa-folder-open me-2"></i>Choose Photo
                    </button>
                    @error('image') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                </div>

                <!-- Details -->
                <div class="form-card">
                    <h3><i class="fas fa-info-circle text-success me-2"></i>Details</h3>
                    <label for="title" class="form-label fw-semibold">Title *</label>
                    <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" placeholder="Enter image title" required>
                    @error('title') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror

                    <label for="description" class="form-label fw-semibold mt-3">Description</label>
                    <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" rows="5" placeholder="Optional description">{{ old('description') }}</textarea>
                    <small id="charCount" class="char-count">0/1000</small>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Publish Options -->
                <div class="form-card">
                    <h3><i class="fas fa-cogs text-warning me-2"></i>Publishing</h3>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                        <label class="form-check-label fw-semibold" for="is_active">Activate Photo</label>
                    </div>
                    <small class="text-muted">Visible images appear on the website</small>
                </div>

                <!-- Actions -->
                <div class="form-card actions-card">
    <h3><i class="fas fa-paper-plane text-info me-2"></i>Actions</h3>
    <div class="actions-buttons">
        <button type="submit" class="btn btn-save">
            <i class="fas fa-save me-2"></i>Save Photo
        </button>
        <a href="{{ route('admin.gallery.index') }}" class="btn btn-cancel">
            <i class="fas fa-times me-2"></i>Cancel
        </a>
    </div>
</div>

                <!-- Stats -->
                <div class="form-card">
                    <h3><i class="fas fa-chart-bar text-success me-2"></i>Gallery Stats</h3>
                    <div class="mt-3">
                        <div class="stat-card mb-2">
                            <div class="stat-value">{{ $totalGalleries ?? 0 }}</div>
                            <div class="stat-label">Total Images</div>
                        </div>
                        <div class="stat-card mb-2">
                            <div class="stat-value text-success">{{ $activeGalleries ?? 0 }}</div>
                            <div class="stat-label">Active Images</div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-value text-warning">{{ ($totalGalleries ?? 0) - ($activeGalleries ?? 0) }}</div>
                            <div class="stat-label">Inactive Images</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Image preview
        const imageInput = document.getElementById('image');
        const previewImage = document.getElementById('previewImage');
        const imagePreview = document.getElementById('imagePreview');
        const uploadPlaceholder = document.getElementById('uploadPlaceholder');

        imageInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function() {
                    previewImage.src = reader.result;
                    previewImage.style.display = 'block';
                    uploadPlaceholder.style.display = 'none';
                    imagePreview.classList.add('has-image');
                }
                reader.readAsDataURL(file);
            }
        });

        // Drag & drop
        imagePreview.addEventListener('dragover', e => { e.preventDefault(); imagePreview.style.borderColor='#4361ee'; });
        imagePreview.addEventListener('dragleave', e => { e.preventDefault(); imagePreview.style.borderColor=imagePreview.classList.contains('has-image')?'#28a745':'#dee2e6'; });
        imagePreview.addEventListener('drop', e => {
            e.preventDefault();
            const files = e.dataTransfer.files;
            if (files.length>0) { imageInput.files = files; imageInput.dispatchEvent(new Event('change')); }
        });
        imagePreview.addEventListener('click', () => imageInput.click());

        // Character count
        const descInput = document.getElementById('description');
        const charCount = document.getElementById('charCount');
        if(descInput) {
            const updateCount = () => {
                const len = descInput.value.length;
                charCount.textContent = `${len}/1000`;
                charCount.className = 'char-count'+(len>900?' danger':(len>750?' warning':''));
            }
            descInput.addEventListener('input', updateCount);
            updateCount();
        }
    });
</script>
@endsection
