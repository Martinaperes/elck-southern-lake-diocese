@extends('admin.layouts.app')

@section('newsletter-content')
<div class="row">
    <div class="col-md-8">
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Campaign Preview</h5>
                <span class="badge bg-{{ $campaign->status === 'draft' ? 'warning' : ($campaign->status === 'sent' ? 'success' : 'info') }}">
                    {{ ucfirst($campaign->status) }}
                </span>
            </div>
            <div class="card-body">
                @if($campaign->featured_image)
                <div class="mb-4 text-center">
                    <img src="{{ asset('storage/' . $campaign->featured_image) }}" 
                         alt="{{ $campaign->subject }}" class="img-fluid rounded">
                </div>
                @endif
                
                <h1 class="h3 mb-3">{{ $campaign->subject }}</h1>
                
                @if($campaign->excerpt)
                <div class="alert alert-light mb-4">
                    {{ $campaign->excerpt }}
                </div>
                @endif
                
                <div class="campaign-content mb-4">
                    {!! $campaign->content !!}
                </div>
                
                <hr>
                
                <div class="text-muted small">
                    <p>
                        <i class="fas fa-user"></i> Created by: {{ $campaign->creator->name ?? 'System' }}
                        <br>
                        <i class="fas fa-calendar"></i> Created: {{ $campaign->created_at->format('F d, Y \a\t h:i A') }}
                        @if($campaign->scheduled_at)
                        <br>
                        <i class="fas fa-clock"></i> Scheduled: {{ $campaign->scheduled_at->format('F d, Y \a\t h:i A') }}
                        @endif
                        @if($campaign->sent_at)
                        <br>
                        <i class="fas fa-paper-plane"></i> Sent: {{ $campaign->sent_at->format('F d, Y \a\t h:i A') }}
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <!-- Campaign Actions -->
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-white">
                <h6 class="mb-0">Campaign Actions</h6>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    @if($campaign->status === 'draft')
                    <a href="{{ route('admin.newsletter.edit', $campaign) }}" 
                       class="btn btn-primary">
                        <i class="fas fa-edit"></i> Edit Campaign
                    </a>
                    
                    <form action="{{ route('admin.newsletter.send', $campaign) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-success w-100" 
                                onclick="return confirm('Send this campaign to all active subscribers?')">
                            <i class="fas fa-paper-plane"></i> Send Now
                        </button>
                    </form>
                    @endif
                    
                    @if($campaign->status === 'scheduled')
                    <form action="{{ route('admin.newsletter.cancel', $campaign) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-warning w-100" 
                                onclick="return confirm('Cancel this scheduled campaign?')">
                            <i class="fas fa-ban"></i> Cancel Schedule
                        </button>
                    </form>
                    @endif
                    
                    <a href="{{ route('admin.newsletter.analytics', $campaign) }}" 
                       class="btn btn-dark">
                        <i class="fas fa-chart-bar"></i> View Analytics
                    </a>
                    
                    <form action="{{ route('admin.newsletter.duplicate', $campaign) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-secondary w-100" 
                                onclick="return confirm('Duplicate this campaign?')">
                            <i class="fas fa-copy"></i> Duplicate Campaign
                        </button>
                    </form>
                    
                    <a href="{{ route('admin.newsletter.campaigns') }}" 
                       class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left"></i> Back to Campaigns
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Campaign Stats -->
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white">
                <h6 class="mb-0">Campaign Statistics</h6>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-6 mb-3">
                        <div class="card bg-light">
                            <div class="card-body p-3">
                                <h3 class="text-success">{{ $campaign->sent_count }}</h3>
                                <small class="text-muted">Sent</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 mb-3">
                        <div class="card bg-light">
                            <div class="card-body p-3">
                                <h3 class="text-info">{{ $campaign->opened_count }}</h3>
                                <small class="text-muted">Opened</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card bg-light">
                            <div class="card-body p-3">
                                <h3 class="text-primary">{{ $campaign->clicked_count }}</h3>
                                <small class="text-muted">Clicked</small>
                            </div>
                        </div>
                    </div>
                    @if($campaign->sent_count > 0)
                    <div class="col-6">
                        <div class="card bg-light">
                            <div class="card-body p-3">
                                <h3 class="text-warning">
                                    {{ number_format(($campaign->opened_count / $campaign->sent_count) * 100, 1) }}%
                                </h3>
                                <small class="text-muted">Open Rate</small>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .campaign-content img {
        max-width: 100%;
        height: auto;
    }
    
    .campaign-content table {
        width: 100%;
        margin-bottom: 1rem;
        border-collapse: collapse;
    }
    
    .campaign-content table th,
    .campaign-content table td {
        padding: 0.75rem;
        border: 1px solid #dee2e6;
    }
</style>
@endpush
@endsection