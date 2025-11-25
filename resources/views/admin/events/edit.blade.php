@extends('layouts.admin')

@section('title', 'Edit Event - ELCK Southern Lake Diocese')

@section('content')
<div class="container-fluid py-4">
    <!-- Page Header -->
    <div class="page-header rounded-xl shadow-lg p-4 mb-4 bg-gradient-to-r from-indigo-50 to-purple-50 border border-gray-200">
        <div class="d-flex flex-wrap justify-content-between align-items-center">
            <div>
                <h1 class="display-5 fw-bold gradient-text">Edit Event</h1>
                <p class="text-muted mb-0">Update event details and settings</p>
            </div>
            <div class="d-flex gap-2 flex-wrap mt-2 mt-sm-0">
                <a href="{{ route('admin.events.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-1"></i> Back to Events
                </a>
                <a href="{{ route('admin.events.registrations', $event) }}" class="btn btn-info text-white">
                    <i class="fas fa-users me-1"></i> View Registrations
                </a>
            </div>
        </div>
    </div>

    <!-- Form Card -->
    <div class="card shadow-sm rounded-4 p-4">
        <form method="POST" action="{{ route('admin.events.update', $event) }}" enctype="multipart/form-data" class="event-edit-form">
            @csrf
            @method('PUT')

            <div class="row g-4">
                <!-- Left Column: Event Details -->
                <div class="col-lg-8">
                    <div class="p-4 bg-white rounded-3 shadow-sm mb-4">
                        <h4 class="fw-bold mb-3">Event Information</h4>

                        <div class="mb-3">
                            <label for="title" class="form-label fw-semibold">Event Title *</label>
                            <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $event->title) }}" required placeholder="Enter event title">
                            @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label fw-semibold">Event Description</label>
                            <textarea name="description" id="description" rows="5" class="form-control @error('description') is-invalid @enderror" placeholder="Describe the event...">{{ old('description', $event->description) }}</textarea>
                            @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="start_time" class="form-label fw-semibold">Start Date & Time *</label>
                                <input type="datetime-local" name="start_time" id="start_time" class="form-control @error('start_time') is-invalid @enderror" value="{{ old('start_time', $event->start_time->format('Y-m-d\TH:i')) }}" required>
                                @error('start_time')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label for="end_time" class="form-label fw-semibold">End Date & Time</label>
                                <input type="datetime-local" name="end_time" id="end_time" class="form-control @error('end_time') is-invalid @enderror" value="{{ old('end_time', $event->end_time ? $event->end_time->format('Y-m-d\TH:i') : '') }}">
                                @error('end_time')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="mt-3">
                            <label for="location" class="form-label fw-semibold">Event Location *</label>
                            <input type="text" name="location" id="location" class="form-control @error('location') is-invalid @enderror" value="{{ old('location', $event->location) }}" required placeholder="Enter event location">
                            @error('location')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>

                <!-- Right Column: Poster & Settings -->
                <div class="col-lg-4 d-flex flex-column gap-4">
                    <!-- Poster -->
                    <div class="p-3 bg-white rounded-3 shadow-sm">
                        <h5 class="fw-bold mb-3">Event Poster</h5>
                        @if($event->poster)
                            <div class="position-relative mb-3">
                                <img src="{{ asset('storage/' . $event->poster) }}" class="img-fluid rounded-3 shadow-sm" style="height:200px; object-fit:cover;">
                                <span class="position-absolute top-0 start-0 bg-dark text-white px-2 py-1 rounded-bottom-end">Current Poster</span>
                            </div>
                        @else
                            <div class="d-flex align-items-center justify-content-center bg-light rounded-3 mb-3" style="height:200px;">
                                <i class="fas fa-image text-secondary fs-1"></i>
                            </div>
                        @endif

                        <input type="file" name="poster" id="poster" class="form-control @error('poster') is-invalid @enderror" accept="image/*">
                        @error('poster')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- Event Settings -->
                    <div class="p-3 bg-white rounded-3 shadow-sm">
                        <h5 class="fw-bold mb-3">Event Settings</h5>

                        <div class="mb-3">
                            <label for="event_type" class="form-label fw-semibold">Event Type *</label>
                            <select name="event_type" id="event_type" class="form-select @error('event_type') is-invalid @enderror" required>
                                <option value="">Select Event Type</option>
                                @foreach(['service'=>'Church Service','meeting'=>'Meeting','conference'=>'Conference','workshop'=>'Workshop','other'=>'Other'] as $key=>$label)
                                    <option value="{{ $key }}" {{ old('event_type', $event->event_type) == $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @error('event_type')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label for="ministry_id" class="form-label fw-semibold">Associated Ministry</label>
                            <select name="ministry_id" id="ministry_id" class="form-select @error('ministry_id') is-invalid @enderror">
                                <option value="">No Ministry</option>
                                @foreach($ministries as $ministry)
                                    <option value="{{ $ministry->id }}" {{ old('ministry_id', $event->ministry_id) == $ministry->id ? 'selected' : '' }}>
                                        {{ $ministry->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('ministry_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-check mb-3">
                            <input type="checkbox" name="is_public" class="form-check-input" id="is_public" value="1" {{ old('is_public', $event->is_public) ? 'checked' : '' }}>
                            <label class="form-check-label fw-semibold" for="is_public">Public Event</label>
                            <small class="text-muted d-block">Visible to all members and visitors</small>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="d-flex flex-column gap-2">
                        <button type="submit" class="btn btn-success fw-bold">
                            <i class="fas fa-save me-1"></i> Update Event
                        </button>
                        <a href="{{ route('admin.events.index') }}" class="btn btn-outline-secondary fw-bold">Cancel</a>
                        <button type="button" class="btn btn-danger fw-bold" onclick="confirmDelete()">
                            <i class="fas fa-trash me-1"></i> Delete Event
                        </button>
                    </div>
                </div>
            </div>
        </form>

        <!-- Hidden Delete Form -->
        <form id="delete-form" action="{{ route('admin.events.destroy', $event) }}" method="POST" class="d-none">
            @csrf
            @method('DELETE')
        </form>
    </div>
</div>

@push('styles')
<style>
.gradient-text {
    background: linear-gradient(135deg,#6366f1,#8b5cf6);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}
.card .form-control:focus {
    box-shadow: 0 0 0 3px rgba(99,102,241,0.15);
    border-color: #6366f1;
}
.btn-info {
    background: #3b82f6;
    border-color: #3b82f6;
}
.btn-info:hover {
    background: #2563eb;
}
</style>
@endpush

@push('scripts')
<script>
function confirmDelete(){
    if(confirm("Are you sure you want to delete this event?")) {
        document.getElementById('delete-form').submit();
    }
}
</script>
@endpush
@endsection
