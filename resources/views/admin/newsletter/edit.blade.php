@extends('admin.layouts.app')

@section('newsletter-content')
<div class="row">
    <div class="col-12">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    <i class="fas fa-edit text-[#197b3b]"></i> Edit Campaign: {{ $campaign->subject }}
                </h5>
                <span class="badge bg-warning">Draft</span>
            </div>
            <div class="card-body">
                @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                <form action="{{ route('admin.newsletter.update', $campaign) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="row">
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label for="subject" class="form-label">Subject *</label>
                                <input type="text" class="form-control @error('subject') is-invalid @enderror" 
                                       id="subject" name="subject" value="{{ old('subject', $campaign->subject) }}" required>
                                @error('subject')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label for="excerpt" class="form-label">Excerpt (Brief Summary)</label>
                                <textarea class="form-control @error('excerpt') is-invalid @enderror" 
                                          id="excerpt" name="excerpt" rows="2">{{ old('excerpt', $campaign->excerpt) }}</textarea>
                                @error('excerpt')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label for="content" class="form-label">Content *</label>
                                <textarea class="form-control @error('content') is-invalid @enderror" 
                                          id="content" name="content" rows="10" required>{{ old('content', $campaign->content) }}</textarea>
                                @error('content')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="card border-0 shadow-sm mb-4">
                                <div class="card-header bg-light">
                                    <h6 class="mb-0">Campaign Settings</h6>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label for="category" class="form-label">Category</label>
                                        <input type="text" class="form-control" id="category" 
                                               name="category" value="{{ old('category', $campaign->category) }}">
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label class="form-label">Featured Image</label>
                                        @if($campaign->featured_image)
                                        <div class="mb-2">
                                            <img src="{{ asset('storage/' . $campaign->featured_image) }}" 
                                                 alt="Current image" class="img-fluid rounded mb-2" style="max-height: 150px;">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" 
                                                       id="remove_image" name="remove_image" value="1">
                                                <label class="form-check-label" for="remove_image">
                                                    Remove current image
                                                </label>
                                            </div>
                                        </div>
                                        @endif
                                        <input type="file" class="form-control" 
                                               id="featured_image" name="featured_image" 
                                               accept="image/*">
                                        <div class="form-text">Upload new image to replace current</div>
                                    </div>
                                    
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="checkbox" 
                                               id="is_featured" name="is_featured" value="1"
                                               {{ old('is_featured', $campaign->is_featured) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_featured">
                                            Mark as Featured Campaign
                                        </label>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-save"></i> Update Campaign
                                </button>
                                <a href="{{ route('admin.newsletter.show', $campaign) }}" 
                                   class="btn btn-outline-secondary">
                                    <i class="fas fa-times"></i> Cancel
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/35.0.1/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#content'), {
            toolbar: [
                'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 
                'numberedList', 'blockQuote', 'insertTable', 'undo', 'redo'
            ]
        })
        .catch(error => {
            console.error(error);
        });
</script>
@endpush
@endsection