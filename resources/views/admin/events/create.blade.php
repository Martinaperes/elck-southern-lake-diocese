{{-- resources/views/admin/events/create.blade.php --}}
@extends('admin.layouts.app')

@section('title', 'Create Event - ELCT Southern Lake Diocese')

@section('content')
<div class="container-fluid px-4 py-2">

    <!-- Page Header -->
    <div class="mb-5 p-6 rounded-2xl shadow bg-gradient-to-r from-indigo-100/60 to-purple-100/60 border border-indigo-200">
        <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between">
            <div>
                <h1 class="text-4xl font-extrabold text-gray-800">Create New Event</h1>
                <p class="text-gray-600 mt-2 text-lg">Fill in the details to register a new event</p>
            </div>

            <a href="{{ route('admin.events.index') }}"
               class="inline-flex items-center gap-2 px-5 py-2.5 rounded-lg bg-white border border-gray-300 text-gray-700 hover:bg-gray-100 transition font-medium shadow-sm">
                <i class="fas fa-arrow-left"></i>
                Back to Events
            </a>
        </div>
    </div>

    <!-- Main Form Card -->
    <div class="bg-white shadow-xl border border-gray-200 rounded-2xl p-4">
        <form action="{{ route('admin.events.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row g-4">

                <!-- Left Column -->
                <div class="col-lg-7">
                    <div class="p-4 border rounded-xl bg-gray-50/70">
                        <h3 class="text-xl font-bold mb-3 text-indigo-700">Event Information</h3>

                        <div class="mb-3">
                            <label class="form-label font-semibold">Event Title *</label>
                            <input type="text" name="title" class="form-control rounded-lg @error('title') is-invalid @enderror"
                                   value="{{ old('title') }}" placeholder="Enter event title" required>
                            @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label font-semibold">Event Description</label>
                            <textarea name="description" rows="4"
                                class="form-control rounded-lg @error('description') is-invalid @enderror"
                                placeholder="Describe the event...">{{ old('description') }}</textarea>
                            @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label font-semibold">Start Date & Time *</label>
                                <input type="datetime-local"
                                       name="start_time"
                                       class="form-control rounded-lg @error('start_time') is-invalid @enderror"
                                       value="{{ old('start_time') }}" required>
                                @error('start_time') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label font-semibold">End Date & Time</label>
                                <input type="datetime-local"
                                       name="end_time"
                                       class="form-control rounded-lg @error('end_time') is-invalid @enderror"
                                       value="{{ old('end_time') }}">
                                @error('end_time') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label font-semibold">Event Location *</label>
                            <input type="text"
                                   name="location"
                                   class="form-control rounded-lg @error('location') is-invalid @enderror"
                                   placeholder="Enter event location"
                                   value="{{ old('location') }}" required>
                            @error('location') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                    </div>
                </div>

                <!-- Right Column -->
                <div class="col-lg-5">

                    <!-- Poster Upload -->
                    <div class="p-4 mb-4 border rounded-xl bg-gray-50/70">
                        <h3 class="text-xl font-bold mb-3 text-indigo-700">Event Poster</h3>

                        <div class="w-full border-2 border-dashed border-indigo-300 rounded-xl p-4 text-center cursor-pointer hover:bg-indigo-50 transition"
                             onclick="document.getElementById('poster').click()">

                            <div id="uploadPlaceholder" class="text-gray-500">
                                <i class="fas fa-cloud-upload-alt text-4xl mb-2 text-indigo-600"></i>
                                <p class="font-medium">Click to upload event poster</p>
                                <p class="text-sm text-gray-400">PNG, JPG, JPEG | Max 5MB</p>
                            </div>

                            <img id="posterPreview" class="rounded-xl shadow mt-3 w-100 d-none" alt="Poster Preview">
                            <input type="file" class="d-none" id="poster" name="poster" accept="image/*">
                        </div>

                        @error('poster') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <!-- Event Settings -->
                    <div class="p-4 border rounded-xl bg-gray-50/70">
                        <h3 class="text-xl font-bold mb-3 text-indigo-700">Event Settings</h3>

                        <div class="mb-3">
                            <label class="form-label font-semibold">Event Type *</label>
                            <select name="event_type" class="form-select rounded-lg @error('event_type') is-invalid @enderror">
                                <option value="">Select Event Type</option>
                                @foreach ($eventTypes as $value => $label)
                                    <option value="{{ $value }}" {{ old('event_type') == $value ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                            @error('event_type') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label font-semibold">Associated Ministry</label>
                            <select name="ministry_id" class="form-select rounded-lg">
                                <option value="">No Ministry</option>
                                @foreach ($ministries as $ministry)
                                    <option value="{{ $ministry->id }}" {{ old('ministry_id') == $ministry->id ? 'selected' : '' }}>
                                        {{ $ministry->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-check mt-2">
                            <input class="form-check-input" type="checkbox" name="is_public" id="is_public"
                                   value="1" {{ old('is_public', true) ? 'checked' : '' }}>
                            <label class="form-check-label fw-semibold" for="is_public">
                                Public Event
                            </label>
                            <small class="text-muted d-block">If checked, this event will be visible to everyone.</small>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Submit Buttons -->
            <div class="mt-4 d-flex gap-3">
                <button type="submit"
                        class="px-5 py-2.5 bg-indigo-600 text-white rounded-lg shadow hover:bg-indigo-700 transition fw-bold">
                    <i class="fas fa-plus me-1"></i> Create Event
                </button>

                <a href="{{ route('admin.events.index') }}"
                   class="px-5 py-2.5 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
                    Cancel
                </a>
            </div>

        </form>
    </div>
</div>

{{-- Live Preview Script --}}
<script>
    document.getElementById('poster').addEventListener('change', function(e) {
        const preview = document.getElementById('posterPreview');
        const placeholder = document.getElementById('uploadPlaceholder');

        preview.src = URL.createObjectURL(this.files[0]);
        preview.classList.remove('d-none');
        placeholder.classList.add('d-none');
    });
</script>

@endsection
