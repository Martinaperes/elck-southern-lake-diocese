@extends('admin.layouts.app')

@section('title', 'Newsletter Details')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="h3 mb-0">Newsletter Details</h1>
                <div>
                    @if($campaign->status === 'draft')
                        <a href="{{ route('admin.newsletter.edit', $campaign) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <form action="{{ route('admin.newsletter.send', $campaign) }}" 
                              method="POST" 
                              class="d-inline"
                              onsubmit="return confirm('Send this newsletter now?')">
                            @csrf
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-paper-plane"></i> Send Now
                            </button>
                        </form>
                    @endif
                    @if($campaign->status === 'scheduled')
                        <form action="{{ route('admin.newsletter.cancel', $campaign) }}" 
                              method="POST" 
                              class="d-inline"
                              onsubmit="return confirm('Cancel this scheduled newsletter?')">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-danger">
                                <i class="fas fa-times"></i> Cancel Schedule
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Content Preview</h5>
                </div>
                <div class="card-body">
                    @if($campaign->featured_image)
                        <div class="mb-4">
                            <img src="{{ asset('storage/' . $campaign->featured_image) }}" 
                                 alt="{{ $campaign->subject }}" 
                                 class="img-fluid rounded">
                        </div>
                    @endif
                    
                    <h2 class="mb-3">{{ $campaign->subject }}</h2>
                    
                    @if($campaign->category)
                        <div class="mb-3">
                            <span class="badge bg-info">{{ $campaign->category }}</span>
                            @if($campaign->is_featured)
                                <span class="badge bg-warning">Featured</span>
                            @endif
                        </div>
                    @endif
                    
                    @if($campaign->excerpt)
                        <div class="alert alert-light border">
                            <p class="mb-0"><strong>Summary:</strong> {{ $campaign->excerpt }}</p>
                        </div>
                    @endif
                    
                    <div class="newsletter-content">
                        {!! $campaign->content !!}
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Campaign Details</h5>
                </div>
                <div class="card-body">
                    <table class="table table-sm">
                        <tr>
                            <th>Status:</th>
                            <td>
                                @switch($campaign->status)
                                    @case('draft')
                                        <span class="badge bg-secondary">Draft</span>
                                        @break
                                    @case('scheduled')
                                        <span class="badge bg-info">Scheduled</span>
                                        @break
                                    @case('sent')
                                        <span class="badge bg-success">Sent</span>
                                        @break
                                    @case('cancelled')
                                        <span class="badge bg-danger">Cancelled</span>
                                        @break
                                @endswitch
                            </td>
                        </tr>
                        <tr>
                            <th>Created By:</th>
                            <td>{{ $campaign->creator->name ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Created At:</th>
                            <td>{{ $campaign->created_at->format('M d, Y H:i') }}</td>
                        </tr>
                        @if($campaign->scheduled_at)
                            <tr>
                                <th>Scheduled For:</th>
                                <td>{{ $campaign->scheduled_at->format('M d, Y H:i') }}</td>
                            </tr>
                        @endif
                        @if($campaign->sent_at)
                            <tr>
                                <th>Sent At:</th>
                                <td>{{ $campaign->sent_at->format('M d, Y H:i') }}</td>
                            </tr>
                        @endif
                        <tr>
                            <th>Sent Count:</th>
                            <td>{{ $campaign->sent_count ?? 0 }}</td>
                        </tr>
                        <tr>
                            <th>Opened:</th>
                            <td>{{ $campaign->opened_count ?? 0 }}</td>
                        </tr>
                        <tr>
                            <th>Clicked:</th>
                            <td>{{ $campaign->clicked_count ?? 0 }}</td>
                        </tr>
                    </table>
                    
                    @if($campaign->status === 'sent')
                        <div class="d-grid gap-2">
                            <a href="{{ route('admin.newsletter.analytics', $campaign) }}" 
                               class="btn btn-success">
                                <i class="fas fa-chart-bar"></i> View Analytics
                            </a>
                        </div>
                    @endif
                </div>
            </div>
            
            <div class="card mt-3">
                <div class="card-header">
                    <h5 class="card-title mb-0">Quick Actions</h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <form action="{{ route('admin.newsletter.duplicate', $campaign) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-secondary btn-block">
                                <i class="fas fa-copy"></i> Duplicate Campaign
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.newsletter-content img {
    max-width: 100%;
    height: auto;
}
.newsletter-content table {
    width: 100%;
    margin-bottom: 1rem;
    border-collapse: collapse;
}
.newsletter-content table, 
.newsletter-content th, 
.newsletter-content td {
    border: 1px solid #dee2e6;
}
.newsletter-content th,
.newsletter-content td {
    padding: 0.75rem;
}
</style>
@endpush
@endsection