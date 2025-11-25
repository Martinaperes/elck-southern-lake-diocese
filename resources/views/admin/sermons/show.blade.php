<!-- Revamped Sermon View Page -->
@extends('admin.layouts.app')

@section('title', 'View Sermon - ' . $sermon->title)

@section('content')
<style>
    body {
        background: #f3f6fb;
    }

    .header-section {
        background: linear-gradient(135deg, #0d6efd, #0a58ca);
        padding: 3rem 2rem;
        color: #ffffff;
        border-radius: 0 0 25px 25px;
        box-shadow: 0 4px 14px rgba(0, 0, 0, 0.15);
        margin-bottom: 2rem;
    }

    .header-section h1 {
        font-size: 2rem;
        font-weight: 700;
    }

    .detail-card {
        background: #ffffff;
        padding: 2rem;
        border-radius: 20px;
        box-shadow: 0 6px 18px rgba(0,0,0,0.07);
        margin-bottom: 2rem;
        border: none;
    }

    .section-title {
        font-weight: 700;
        font-size: 1.1rem;
        border-left: 4px solid #0d6efd;
        padding-left: 0.75rem;
        margin-bottom: 1.5rem;
        color: #0d6efd;
    }

    .detail-label {
        font-size: 0.85rem;
        color: #6c757d;
        font-weight: 600;
        margin-bottom: 4px;
    }

    .detail-value {
        font-size: 1.05rem;
        font-weight: 500;
        color: #2c3e50;
        margin-bottom: 1.25rem;
    }

    .scripture-tag {
        background: #e7f5ff;
        color: #0d6efd;
        padding: 6px 14px;
        font-size: 0.8rem;
        border-radius: 25px;
        margin-right: 6px;
        margin-bottom: 6px;
        display: inline-block;
    }

    .media-badge {
        padding: 10px 18px;
        background: #f8f9fa;
        border-radius: 14px;
        border: 1px solid #dbe1e7;
        font-weight: 500;
        margin-right: 6px;
        margin-bottom: 6px;
        display: inline-flex;
        align-items: center;
        color: #0a2c52;
        transition: 0.25s;
        text-decoration: none;
    }

    .media-badge:hover {
        background: #0d6efd;
        color: #ffffff;
        border-color: #0d6efd;
        transform: translateY(-3px);
    }

    .sidebar-btn {
        padding: 0.9rem 1.4rem;
        border-radius: 14px;
        width: 100%;
        font-weight: 600;
        margin-bottom: 0.75rem;
    }

    .danger-card {
        border-left: 4px solid #dc3545;
    }
</style>

<div class="header-section">
    <h1>{{ $sermon->title }}</h1>
    <p class="mb-0 opacity-75"><i class="fas fa-calendar"></i> {{ $sermon->sermon_date->format('F j, Y') }} · <i class="fas fa-user"></i> {{ $sermon->preacher }}</p>
</div>

<div class="container-fluid">
    <div class="row">
        <!-- Main Content -->
        <div class="col-lg-8">
            <!-- Basic Details -->
            <div class="detail-card">
                <div class="section-title">Basic Information</div>

                <div class="detail-label">Preacher</div>
                <div class="detail-value">{{ $sermon->preacher }}</div>

                <div class="detail-label">Sermon Date</div>
                <div class="detail-value">{{ $sermon->sermon_date->format('l, F j, Y') }}</div>

                <div class="detail-label">Duration</div>
                <div class="detail-value">{{ $sermon->duration_minutes ? $sermon->duration_minutes . ' minutes' : 'Not Specified' }}</div>

                @if($sermon->scripture_references)
                <div class="detail-label">Scripture References</div>
                <div class="detail-value">
                    @foreach(explode(',', $sermon->scripture_references) as $scripture)
                        <span class="scripture-tag">{{ trim($scripture) }}</span>
                    @endforeach
                </div>
                @endif

                @if($sermon->description)
                <div class="detail-label">Description</div>
                <div class="detail-value">{!! nl2br(e($sermon->description)) !!}</div>
                @endif
            </div>

            <!-- Media Section -->
            @if($sermon->audio_url || $sermon->video_url || $sermon->document_url)
            <div class="detail-card">
                <div class="section-title">Media Links</div>

                @if($sermon->audio_url)
                    <a class="media-badge" href="{{ $sermon->audio_url }}" target="_blank"><i class="fas fa-music me-1"></i> Audio Recording</a>
                @endif
                @if($sermon->video_url)
                    <a class="media-badge" href="{{ $sermon->video_url }}" target="_blank"><i class="fas fa-video me-1"></i> Video Recording</a>
                @endif
                @if($sermon->document_url)
                    <a class="media-badge" href="{{ $sermon->document_url }}" target="_blank"><i class="fas fa-file-pdf me-1"></i> Sermon Notes</a>
                @endif
            </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <div class="detail-card">
                <div class="section-title">Sermon Actions</div>

                <a href="{{ route('admin.sermons.edit', $sermon) }}" class="btn btn-primary sidebar-btn"><i class="fas fa-edit me-2"></i>Edit Sermon</a>

                <form action="{{ route('admin.sermons.toggle-publish', $sermon) }}" method="POST">
                    @csrf
                    <button class="btn {{ $sermon->is_published ? 'btn-warning' : 'btn-success' }} sidebar-btn" type="submit">
                        <i class="fas {{ $sermon->is_published ? 'fa-eye-slash' : 'fa-eye' }} me-2"></i>
                        {{ $sermon->is_published ? 'Unpublish' : 'Publish' }}
                    </button>
                </form>

                <a href="{{ route('admin.sermons.index') }}" class="btn btn-outline-secondary sidebar-btn"><i class="fas fa-arrow-left me-2"></i>Back to List</a>
            </div>

            <div class="detail-card">
                <div class="section-title">Metadata</div>

                <div class="detail-label">Created</div>
                <div class="detail-value">{{ $sermon->created_at->format('M j, Y g:i A') }}</div>

                <div class="detail-label">Last Updated</div>
                <div class="detail-value">{{ $sermon->updated_at->format('M j, Y g:i A') }}</div>

                <div class="detail-label">Sermon ID</div>
                <div class="detail-value">#{{ $sermon->id }}</div>
            </div>

            <div class="detail-card danger-card">
                <div class="section-title text-danger">Danger Zone</div>

                <form action="{{ route('admin.sermons.destroy', $sermon) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this sermon? This action cannot be undone.')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger sidebar-btn" type="submit"><i class="fas fa-trash me-2"></i>Delete Sermon</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection