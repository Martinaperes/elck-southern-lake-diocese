@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-8">
            <div class="card shadow-lg rounded-4 p-4">
                <h2 class="fw-bold mb-2">{{ $sermon->title }}</h2>
                <p class="text-muted mb-3">
                    Preacher: {{ $sermon->preacher }} | Date: {{ $sermon->sermon_date->format('M d, Y') }}
                </p>

                @if($sermon->scripture_references)
                    <p class="mb-3"><strong>Scripture References:</strong> {{ $sermon->scripture_references }}</p>
                @endif

                @if($sermon->description)
                    <p class="mb-4">{{ $sermon->description }}</p>
                @endif

                <div class="d-flex flex-column gap-2">
                    @if($sermon->audio_url)
                        <a href="{{ $sermon->audio_url }}" class="btn btn-outline-primary" target="_blank">Listen Audio</a>
                    @endif
                    @if($sermon->video_url)
                        <a href="{{ $sermon->video_url }}" class="btn btn-outline-success" target="_blank">Watch Video</a>
                    @endif
                    @if($sermon->document_url)
                        <a href="{{ $sermon->document_url }}" class="btn btn-outline-secondary" target="_blank">Download Document</a>
                    @endif
                </div>

                <a href="{{ route('sermons.index') }}" class="btn btn-secondary mt-4">← Back to Sermons</a>
            </div>
        </div>
    </div>
</div>
@endsection
