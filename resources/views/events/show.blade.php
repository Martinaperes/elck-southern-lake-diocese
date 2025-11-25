{{-- resources/views/admin/sermons/show.blade.php --}}
@extends('admin.layouts.app')

@section('title', $sermon->title . ' - ELCT Southern Lake Diocese')

@section('content')
<div class="container-fluid px-4">
    <!-- Page Header -->
    <div class="page-header-bg">
        <div class="d-sm-flex align-items-center justify-content-between py-4">
            <div>
                <h1 class="page-title">{{ $sermon->title }}</h1>
                <p class="page-subtitle">Sermon Details</p>
            </div>
            <a href="{{ route('admin.sermons.index') }}" class="btn btn-outline-light">
                <i class="fas fa-arrow-left me-2"></i>
                Back to Sermons
            </a>
        </div>
    </div>

    <!-- Sermon Details -->
    <div class="card main-card border-0 shadow-sm mt-4">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-8">
                    <h4 class="mb-3">Sermon Information</h4>
                    <p><strong>Description:</strong> {{ $sermon->description ?? 'No description' }}</p>
                    <p><strong>Scripture References:</strong> {{ $sermon->scripture_references ?? 'No scriptures' }}</p>
                    
                    @if($sermon->audio_url || $sermon->video_url || $sermon->document_url)
                    <h5 class="mt-4">Media Links</h5>
                    <div class="d-flex gap-2 flex-wrap">
                        @if($sermon->audio_url)
                        <a href="{{ $sermon->audio_url }}" target="_blank" class="btn btn-outline-primary">
                            <i class="fas fa-volume-up me-2"></i>Audio
                        </a>
                        @endif
                        @if($sermon->video_url)
                        <a href="{{ $sermon->video_url }}" target="_blank" class="btn btn-outline-danger">
                            <i class="fas fa-video me-2"></i>Video
                        </a>
                        @endif
                        @if($sermon->document_url)
                        <a href="{{ $sermon->document_url }}" target="_blank" class="btn btn-outline-warning">
                            <i class="fas fa-file-pdf me-2"></i>Document
                        </a>
                        @endif
                    </div>
                    @endif
                </div>
                <div class="col-lg-4">
                    <h4 class="mb-3">Details</h4>
                    <p><strong>Preacher:</strong> {{ $sermon->preacher }}</p>
                    <p><strong>Date:</strong> {{ $sermon->sermon_date->format('F j, Y') }}</p>
                    <p><strong>Duration:</strong> {{ $sermon->duration_formatted ?? 'Not specified' }}</p>
                    <p><strong>Status:</strong> 
                        <span class="badge {{ $sermon->is_published ? 'bg-success' : 'bg-secondary' }}">
                            {{ $sermon->is_published ? 'Published' : 'Draft' }}
                        </span>
                    </p>
                    <p><strong>Created:</strong> {{ $sermon->created_at->format('F j, Y g:i A') }}</p>
                    <p><strong>Last Updated:</strong> {{ $sermon->updated_at->format('F j, Y g:i A') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection