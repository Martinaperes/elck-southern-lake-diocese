{{-- resources/views/admin/sermons/edit.blade.php --}}
@extends('admin.layouts.app')

@section('title', 'Edit Sermon')

@section('content')
<style>
    /* Modern dashboard enhancements */
    .page-hero {
        background: linear-gradient(135deg, #0d6efd, #6610f2);
        border-radius: 18px;
        padding: 35px 45px;
        color: #fff;
        box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        animation: fadeInDown 0.6s ease;
    }

    @keyframes fadeInDown {
        from { opacity: 0; transform: translateY(-10px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    .section-card {
        background: #fff;
        border-radius: 18px;
        padding: 35px;
        box-shadow: 0 8px 25px rgba(0,0,0,0.08);
        transition: 0.3s ease;
        animation: fadeInUp 0.6s ease;
    }

    .section-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 30px rgba(0,0,0,0.12);
    }

    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(15px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    .form-control,
    .form-select {
        border-radius: 12px;
        padding: 12px 15px;
        font-size: 15px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        border: 1px solid #e0e6f0;
        transition: 0.2s;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 4px rgba(13,110,253,0.15);
    }

    .btn-primary {
        border-radius: 12px;
        padding: 12px 28px;
        font-size: 16px;
        font-weight: 600;
        box-shadow: 0 8px 20px rgba(13,110,253,0.3);
        transition: 0.25s ease;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 28px rgba(13,110,253,0.45);
    }
</style>

<div class="container-fluid px-4 py-4">

    <!-- Modern Header / Hero Section -->
    <div class="page-hero mb-4">
        <h1 class="h2 fw-bold mb-2">✏️ Edit Sermon</h1>
        <p class="m-0 opacity-75">Update details, upload audio, and manage sermon metadata.</p>
    </div>

    <a href="{{ route('admin.sermons.index') }}" class="btn btn-outline-light text-dark border-0 bg-white shadow-sm mb-4 rounded-pill px-4 py-2">
        <i class="fas fa-arrow-left me-2"></i>Back to Sermons
    </a>

    <!-- Content Card -->
    <div class="section-card">
        <form action="{{ route('admin.sermons.update', $sermon->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row g-4">

                <!-- Title -->
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Sermon Title <span class="text-danger">*</span></label>
                    <input type="text" name="title" value="{{ old('title', $sermon->title) }}" class="form-control" required>
                </div>

                <!-- Preacher -->
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Preacher <span class="text-danger">*</span></label>
                    <input type="text" name="preacher" value="{{ old('preacher', $sermon->preacher) }}" class="form-control" required>
                </div>

                <!-- Date -->
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Date Preached <span class="text-danger">*</span></label>
                    <input type="date" name="date" value="{{ old('date', $sermon->date) }}" class="form-control" required>
                </div>

                <!-- Category -->
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Category</label>
                    <select name="category" class="form-select">
                        <option value="Sunday" {{ $sermon->category == 'Sunday' ? 'selected' : '' }}>Sunday Service</option>
                        <option value="Youth" {{ $sermon->category == 'Youth' ? 'selected' : '' }}>Youth Service</option>
                        <option value="Midweek" {{ $sermon->category == 'Midweek' ? 'selected' : '' }}>Midweek Service</option>
                    </select>
                </div>

                <!-- Description -->
                <div class="col-12">
                    <label class="form-label fw-semibold">Description</label>
                    <textarea name="description" rows="4" class="form-control">{{ old('description', $sermon->description) }}</textarea>
                </div>

                <!-- Video URL -->
                <div class="col-12">
                    <label class="form-label fw-semibold">Video URL (Optional)</label>
                    <input type="text" name="video_url" value="{{ old('video_url', $sermon->video_url) }}" class="form-control">
                </div>

                <!-- File Upload -->
                <div class="col-12">
                    <label class="form-label fw-semibold">Upload New Audio (Optional)</label>
                    <input type="file" name="audio" class="form-control">

                    @if($sermon->audio)
                    <p class="mt-2 text-muted small">Current File: <strong>{{ $sermon->audio }}</strong></p>
                    @endif
                </div>
            </div>

            <!-- Submit -->
            <div class="mt-5 d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-2"></i>Save Changes
                </button>
            </div>
        </form>
    </div>
</div>
@endsection