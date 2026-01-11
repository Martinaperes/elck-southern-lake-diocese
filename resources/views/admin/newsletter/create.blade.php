@extends('admin.layouts.app')

@section('title', 'Create Newsletter')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <h1 class="h3 mb-0">Create Newsletter Campaign</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Newsletter Details</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.newsletter.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label for="subject" class="form-label">Subject *</label>
                                    <input type="text" 
                                           class="form-control @error('subject') is-invalid @enderror" 
                                           id="subject" 
                                           name="subject" 
                                           value="{{ old('subject') }}" 
                                           required>
                                    @error('subject')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <label for="excerpt" class="form-label">Excerpt/Summary</label>
                                    <textarea class="form-control @error('excerpt') is-invalid @enderror" 
                                              id="excerpt" 
                                              name="excerpt" 
                                              rows="3">{{ old('excerpt') }}</textarea>
                                    @error('excerpt')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <label for="content" class="form-label">Content *</label>
                                    <textarea class="form-control @error('content') is-invalid @enderror" 
                                              id="content" 
                                              name="content" 
                                              rows="10" 
                                              required>{{ old('content') }}</textarea>
                                    @error('content')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h6 class="mb-0">Settings</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label for="category" class="form-label">Category</label>
                                            <select class="form-select @error('category') is-invalid @enderror" 
                                                    id="category" 
                                                    name="category">
                                                <option value="">Select Category</option>
                                                <option value="Announcements" {{ old('category') == 'Announcements' ? 'selected' : '' }}>Announcements</option>
                                                <option value="Events" {{ old('category') == 'Events' ? 'selected' : '' }}>Events</option>
                                                <option value="Sermons" {{ old('category') == 'Sermons' ? 'selected' : '' }}>Sermons</option>
                                                <option value="Updates" {{ old('category') == 'Updates' ? 'selected' : '' }}>Diocese Updates</option>
                                                <option value="Appointments" {{ old('category') == 'Appointments' ? 'selected' : '' }}>Appointments</option>
                                                <option value="General" {{ old('category') == 'General' ? 'selected' : '' }}>General</option>
                                            </select>
                                            @error('category')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label for="featured_image" class="form-label">Featured Image</label>
                                            <input type="file" 
                                                   class="form-control @error('featured_image') is-invalid @enderror" 
                                                   id="featured_image" 
                                                   name="featured_image" 
                                                   accept="image/*">
                                            @error('featured_image')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        
                                        <div class="mb-3 form-check">
                                            <input type="checkbox" 
                                                   class="form-check-input" 
                                                   id="is_featured" 
                                                   name="is_featured" 
                                                   value="1"
                                                   {{ old('is_featured') ? 'checked' : '' }}>
                                            <label class="form-check-label" for="is_featured">Mark as Featured</label>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label for="scheduled_at" class="form-label">Schedule Date & Time</label>
                                            <input type="datetime-local" 
                                                   class="form-control @error('scheduled_at') is-invalid @enderror" 
                                                   id="scheduled_at" 
                                                   name="scheduled_at"
                                                   value="{{ old('scheduled_at') }}">
                                            @error('scheduled_at')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label class="form-label">Send Options</label>
                                            <div class="form-check">
                                                <input class="form-check-input" 
                                                       type="radio" 
                                                       name="send_option" 
                                                       id="save_draft" 
                                                       value="draft" 
                                                       checked>
                                                <label class="form-check-label" for="save_draft">
                                                    Save as Draft
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" 
                                                       type="radio" 
                                                       name="send_option" 
                                                       id="send_now" 
                                                       value="now">
                                                <label class="form-check-label" for="send_now">
                                                    Send Immediately
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" 
                                                       type="radio" 
                                                       name="send_option" 
                                                       id="schedule" 
                                                       value="schedule">
                                                <label class="form-check-label" for="schedule">
                                                    Schedule for Later
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row mt-3">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Create Newsletter</button>
                                <a href="{{ route('admin.newsletter.campaigns') }}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const scheduleInput = document.getElementById('scheduled_at');
        const sendNowRadio = document.getElementById('send_now');
        const scheduleRadio = document.getElementById('schedule');
        const draftRadio = document.getElementById('save_draft');
        
        sendNowRadio.addEventListener('change', function() {
            if (this.checked) {
                scheduleInput.required = false;
            }
        });
        
        scheduleRadio.addEventListener('change', function() {
            if (this.checked) {
                scheduleInput.required = true;
            }
        });
        
        draftRadio.addEventListener('change', function() {
            if (this.checked) {
                scheduleInput.required = false;
            }
        });
    });
</script>
@endpush
@endsection