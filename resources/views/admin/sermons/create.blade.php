@extends('admin.layouts.app')

@section('title', 'Create Sermon')

@section('content')
<style>
    :root {
        --primary: #4361ee;
        --secondary: #3f37c9;
        --success: #4cc9f0;
        --info: #4895ef;
        --warning: #f72585;
        --light: #f8f9fa;
        --dark: #212529;
        --card-bg: #ffffff;
        --text-light: #6c757d;
        --gradient-primary: linear-gradient(135deg, #4361ee 0%, #3a0ca3 100%);
        --shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        --shadow-lg: 0 10px 40px rgba(0, 0, 0, 0.12);
    }

    .dashboard-container {
        min-height: 100vh;
        background-color: #f5f7fb;
    }

    .main-content {
        padding: 1.5rem 2rem;
    }

    .form-container {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 2rem;
    }

    .form-card, .sidebar-card {
        background: var(--card-bg);
        border-radius: 12px;
        padding: 2rem;
        box-shadow: var(--shadow);
        margin-bottom: 1.5rem;
        border: none;
    }

    .card-header {
        display: flex;
        align-items: center;
        margin-bottom: 1.5rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid #eee;
    }

    .card-header i {
        margin-right: 0.75rem;
        font-size: 1.4rem;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-label {
        font-weight: 500;
        display: block;
        margin-bottom: 0.5rem;
        color: var(--dark);
    }

    .input-with-icon {
        position: relative;
    }

    .input-with-icon i {
        position: absolute;
        left: 12px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--text-light);
    }

    .input-with-icon .form-control {
        padding-left: 40px;
        border: 2px solid #e9ecef;
        border-radius: 8px;
        height: 50px;
        transition: all 0.3s ease;
    }

    .input-with-icon .form-control:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 0.2rem rgba(67, 97, 238, 0.25);
    }

    .btn-submit {
        background: var(--gradient-primary);
        color: white;
        border: none;
        padding: 0.85rem 2rem;
        border-radius: 8px;
        font-weight: 500;
        width: 100%;
        margin-top: 1rem;
        transition: 0.3s ease;
        font-size: 1.1rem;
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-lg);
    }

    .tips-list {
        list-style: none;
        padding: 0;
    }

    .tips-list li {
        display: flex;
        align-items: flex-start;
        gap: 0.7rem;
        padding-bottom: 1rem;
        margin-bottom: 1rem;
        border-bottom: 1px solid #f1f1f1;
    }

    .tip-icon {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: rgba(67, 97, 238, 0.1);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--primary);
        flex-shrink: 0;
        margin-top: 0.2rem;
    }

    .is-invalid {
        border-color: #dc3545 !important;
    }

    .invalid-feedback {
        display: block;
        width: 100%;
        margin-top: 0.25rem;
        font-size: 0.875em;
        color: #dc3545;
    }

    .form-check-input:checked {
        background-color: var(--primary);
        border-color: var(--primary);
    }

    @media (max-width: 992px) {
        .form-container {
            grid-template-columns: 1fr;
        }
        
        .main-content {
            padding: 1rem;
        }
    }
</style>

<div class="dashboard-container">
    <div class="main-content">
        <!-- Success Message -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Error Messages -->
        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-triangle me-2"></i>
                Please fix the following errors:
                <ul class="mb-0 mt-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="form-container">
            <!-- FORM STARTS HERE -->
            <form action="{{ route('admin.sermons.store') }}" method="POST" id="sermonForm">
                @csrf

                <!-- LEFT SIDE FORM -->
                <div>
                    <!-- Basic Information Card -->
                    <div class="form-card">
                        <div class="card-header">
                            <i class="fas fa-info-circle text-primary"></i>
                            <h3 class="mb-0">Basic Information</h3>
                        </div>

                        <!-- Sermon Title -->
                        <div class="form-group">
                            <label class="form-label" for="title">Sermon Title *</label>
                            <div class="input-with-icon">
                                <i class="fas fa-heading"></i>
                                <input type="text" id="title" name="title" 
                                       class="form-control @error('title') is-invalid @enderror" 
                                       value="{{ old('title') }}" 
                                       placeholder="Enter sermon title" 
                                       required>
                            </div>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Preacher & Date -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Preacher *</label>
                                    <div class="input-with-icon">
                                        <i class="fas fa-user"></i>
                                        <input type="text" name="preacher" 
                                               class="form-control @error('preacher') is-invalid @enderror" 
                                               value="{{ old('preacher') }}" 
                                               placeholder="Preacher's name" 
                                               required>
                                    </div>
                                    @error('preacher')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Sermon Date *</label>
                                    <div class="input-with-icon">
                                        <i class="fas fa-calendar"></i>
                                        <input type="date" name="sermon_date" 
                                               class="form-control @error('sermon_date') is-invalid @enderror" 
                                               value="{{ old('sermon_date', date('Y-m-d')) }}" 
                                               required>
                                    </div>
                                    @error('sermon_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Scripture References -->
                        <div class="form-group">
                            <label class="form-label">Scripture References</label>
                            <div class="input-with-icon">
                                <i class="fas fa-book-bible"></i>
                                <input type="text" name="scripture_references" 
                                       class="form-control @error('scripture_references') is-invalid @enderror" 
                                       value="{{ old('scripture_references') }}" 
                                       placeholder="e.g., John 3:16, Romans 8:28">
                            </div>
                            <small class="text-muted">Separate multiple references with commas</small>
                            @error('scripture_references')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Duration -->
                        <div class="form-group">
                            <label class="form-label">Duration (minutes)</label>
                            <div class="input-with-icon">
                                <i class="fas fa-clock"></i>
                                <input type="number" name="duration_minutes" 
                                       class="form-control @error('duration_minutes') is-invalid @enderror" 
                                       value="{{ old('duration_minutes') }}" 
                                       placeholder="45" 
                                       min="1">
                            </div>
                            @error('duration_minutes')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div class="form-group">
                            <label class="form-label">Sermon Description</label>
                            <textarea name="description" 
                                      class="form-control @error('description') is-invalid @enderror" 
                                      rows="5" 
                                      placeholder="Share the key message and biblical insights...">{{ old('description') }}</textarea>
                            <div class="d-flex justify-content-between align-items-center mt-2">
                                <small class="text-muted">Describe the main themes and takeaways</small>
                                <span id="charCount" class="badge bg-light text-muted">0/2000</span>
                            </div>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Media Links Card -->
                    <div class="form-card">
                        <div class="card-header">
                            <i class="fas fa-photo-video text-success"></i>
                            <h3 class="mb-0">Media Links</h3>
                        </div>

                        <!-- Audio URL -->
                        <div class="form-group">
                            <label class="form-label">Audio Link</label>
                            <div class="input-with-icon">
                                <i class="fas fa-music"></i>
                                <input type="url" name="audio_url" 
                                       class="form-control @error('audio_url') is-invalid @enderror" 
                                       value="{{ old('audio_url') }}" 
                                       placeholder="https://example.com/audio/sermon.mp3">
                            </div>
                            <small class="text-muted">Link to audio recording (MP3, etc.)</small>
                            @error('audio_url')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Video URL -->
                        <div class="form-group">
                            <label class="form-label">Video Link</label>
                            <div class="input-with-icon">
                                <i class="fas fa-video"></i>
                                <input type="url" name="video_url" 
                                       class="form-control @error('video_url') is-invalid @enderror" 
                                       value="{{ old('video_url') }}" 
                                       placeholder="https://youtube.com/watch?v=...">
                            </div>
                            <small class="text-muted">Link to video recording (YouTube, Vimeo, etc.)</small>
                            @error('video_url')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Document URL -->
                        <div class="form-group">
                            <label class="form-label">Document Link</label>
                            <div class="input-with-icon">
                                <i class="fas fa-file-pdf"></i>
                                <input type="url" name="document_url" 
                                       class="form-control @error('document_url') is-invalid @enderror" 
                                       value="{{ old('document_url') }}" 
                                       placeholder="https://example.com/docs/sermon-notes.pdf">
                            </div>
                            <small class="text-muted">Link to sermon notes, slides, or PDF</small>
                            @error('document_url')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Publish Options -->
                    <div class="form-card">
                        <div class="form-group">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="is_published" id="is_published" value="1" 
                                       {{ old('is_published') ? 'checked' : '' }}>
                                <label class="form-check-label fw-semibold" for="is_published">
                                    Publish Sermon Immediately
                                </label>
                            </div>
                            <small class="text-muted">When published, this sermon will be visible to all users</small>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn-submit">
                        <i class="fas fa-save me-2"></i> Create Sermon
                    </button>
                </div>
            </form>

            <!-- RIGHT SIDEBAR -->
            <div>
                <!-- Tips Card -->
                <div class="sidebar-card">
                    <div class="card-header">
                        <i class="fas fa-lightbulb text-warning"></i>
                        <h3 class="mb-0">Tips & Best Practices</h3>
                    </div>
                    <ul class="tips-list">
                        <li>
                            <div class="tip-icon"><i class="fas fa-check"></i></div>
                            <div>
                                <h5 class="fw-semibold mb-1">Clear Titles</h5>
                                <p class="text-muted mb-0">Use engaging, descriptive sermon titles</p>
                            </div>
                        </li>
                        <li>
                            <div class="tip-icon"><i class="fas fa-check"></i></div>
                            <div>
                                <h5 class="fw-semibold mb-1">Scripture References</h5>
                                <p class="text-muted mb-0">Include relevant Bible passages</p>
                            </div>
                        </li>
                        <li>
                            <div class="tip-icon"><i class="fas fa-check"></i></div>
                            <div>
                                <h5 class="fw-semibold mb-1">Media Links</h5>
                                <p class="text-muted mb-0">Add audio, video or documents when available</p>
                            </div>
                        </li>
                        <li>
                            <div class="tip-icon"><i class="fas fa-check"></i></div>
                            <div>
                                <h5 class="fw-semibold mb-1">Descriptions</h5>
                                <p class="text-muted mb-0">Provide key themes and takeaways</p>
                            </div>
                        </li>
                    </ul>
                </div>

                <!-- Stats Card -->
                <div class="sidebar-card">
                    <div class="card-header">
                        <i class="fas fa-chart-bar text-info"></i>
                        <h3 class="mb-0">Sermon Stats</h3>
                    </div>
                    <div class="mt-3">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="text-muted">Total Sermons</span>
                            <span class="fw-bold text-primary">{{ $totalSermons ?? 0 }}</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="text-muted">Published</span>
                            <span class="fw-bold text-success">{{ $publishedSermons ?? 0 }}</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="text-muted">This Month</span>
                            <span class="fw-bold text-warning">{{ $thisMonthSermons ?? 0 }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Character count for description
        const descInput = document.querySelector('textarea[name="description"]');
        const charDisplay = document.getElementById('charCount');
        
        if (descInput && charDisplay) {
            descInput.addEventListener('input', function() {
                const len = this.value.length;
                charDisplay.textContent = len + '/2000';
                
                if (len > 1900) {
                    charDisplay.className = 'badge bg-danger';
                } else if (len > 1500) {
                    charDisplay.className = 'badge bg-warning';
                } else {
                    charDisplay.className = 'badge bg-light text-muted';
                }
            });

            // Initialize character count
            charDisplay.textContent = descInput.value.length + '/2000';
        }

        // Form validation
        const form = document.getElementById('sermonForm');
        form.addEventListener('submit', function(e) {
            const requiredFields = form.querySelectorAll('[required]');
            let isValid = true;

            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    isValid = false;
                    field.classList.add('is-invalid');
                }
            });

            if (!isValid) {
                e.preventDefault();
                // Scroll to first error
                const firstError = form.querySelector('.is-invalid');
                if (firstError) {
                    firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    firstError.focus();
                }
            }
        });

        // Remove invalid class when user starts typing
        const inputs = form.querySelectorAll('input, textarea');
        inputs.forEach(input => {
            input.addEventListener('input', function() {
                if (this.classList.contains('is-invalid')) {
                    this.classList.remove('is-invalid');
                }
            });
        });
    });
</script>
@endsection