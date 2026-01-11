@extends('admin.layouts.app')

@section('title', 'Newsletter Campaigns')

@section('content')
<div class="container-fluid px-4">

    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center py-4 border-bottom mb-4">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-1">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}" class="text-decoration-none text-dark">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">Newsletter Campaigns</li>
                </ol>
            </nav>
            <h1 class="h4 fw-bold mb-0 text-dark">Newsletter Campaigns</h1>
            <small class="text-muted">Create, schedule and track newsletters</small>
        </div>

        <a href="{{ route('admin.newsletter.create') }}" class="btn btn-success shadow-sm">
            <i class="fas fa-plus me-2"></i> New Campaign
        </a>
    </div>

    <!-- Stats Cards -->
    <div class="row mb-4">
        @php
            $sent = $campaigns->where('status','sent')->count();
            $scheduled = $campaigns->where('status','scheduled')->count();
            $draft = $campaigns->where('status','draft')->count();
        @endphp

        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <small class="text-muted">Total Campaigns</small>
                        <h4 class="fw-bold mb-0">{{ $campaigns->total() }}</h4>
                    </div>
                    <div class="icon-box bg-success bg-opacity-10">
                        <i class="fas fa-envelope text-success"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <small class="text-muted">Sent</small>
                        <h4 class="fw-bold mb-0">{{ $sent }}</h4>
                    </div>
                    <div class="icon-box bg-success bg-opacity-10">
                        <i class="fas fa-paper-plane text-success"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <small class="text-muted">Scheduled</small>
                        <h4 class="fw-bold mb-0">{{ $scheduled }}</h4>
                    </div>
                    <div class="icon-box bg-dark bg-opacity-10">
                        <i class="fas fa-clock text-dark"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <small class="text-muted">Drafts</small>
                        <h4 class="fw-bold mb-0">{{ $draft }}</h4>
                    </div>
                    <div class="icon-box bg-secondary bg-opacity-10">
                        <i class="fas fa-edit text-secondary"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Campaigns Table -->
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0 fw-bold">All Campaigns</h5>
            <a href="{{ route('admin.newsletter.subscribers') }}" class="btn btn-outline-dark btn-sm">
                <i class="fas fa-users me-1"></i> Subscribers
            </a>
        </div>

        <div class="card-body p-0">
            @if($campaigns->count())
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light text-uppercase small text-muted">
                            <tr>
                                <th>Subject</th>
                                <th>Status</th>
                                <th>Schedule</th>
                                <th>Sent</th>
                                <th>Performance</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($campaigns as $campaign)
                                <tr>
                                    <td>
                                        <strong class="d-block">{{ Str::limit($campaign->subject, 60) }}</strong>
                                        <small class="text-muted">
                                            {{ $campaign->created_at->format('M d, Y') }}
                                        </small>
                                    </td>

                                    <td>
                                        <span class="badge rounded-pill
                                            @if($campaign->status === 'sent') bg-success-subtle text-success
                                            @elseif($campaign->status === 'scheduled') bg-dark-subtle text-dark
                                            @elseif($campaign->status === 'draft') bg-secondary-subtle text-secondary
                                            @else bg-danger-subtle text-danger
                                            @endif">
                                            {{ ucfirst($campaign->status) }}
                                        </span>
                                    </td>

                                    <td>
                                        {{ $campaign->scheduled_at?->format('M d, Y h:i A') ?? '—' }}
                                    </td>

                                    <td>
                                        {{ $campaign->sent_at?->format('M d, Y') ?? '—' }}
                                    </td>

                                    <td>
                                        <small>
                                            <span class="fw-bold text-success">{{ $campaign->opened_count ?? 0 }}</span> Opened ·
                                            <span class="fw-bold text-dark">{{ $campaign->clicked_count ?? 0 }}</span> Clicked
                                        </small>
                                    </td>

                                    <td class="text-end">
                                        <div class="btn-group">
                                            <a href="{{ route('admin.newsletter.show',$campaign) }}" class="btn btn-sm btn-light border" data-bs-toggle="tooltip" title="View">
                                                <i class="fas fa-eye text-success"></i>
                                            </a>

                                            @if($campaign->status === 'draft')
                                                <a href="{{ route('admin.newsletter.edit',$campaign) }}" class="btn btn-sm btn-light border" title="Edit">
                                                    <i class="fas fa-edit text-dark"></i>
                                                </a>
                                            @endif

                                            @if($campaign->status === 'sent')
                                                <a href="{{ route('admin.newsletter.analytics',$campaign) }}" class="btn btn-sm btn-light border" title="Analytics">
                                                    <i class="fas fa-chart-bar text-success"></i>
                                                </a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="card-footer bg-white d-flex justify-content-between align-items-center">
                    <small class="text-muted">
                        Showing {{ $campaigns->firstItem() }}–{{ $campaigns->lastItem() }} of {{ $campaigns->total() }}
                    </small>
                    {{ $campaigns->links() }}
                </div>
            @else
                <div class="text-center py-5">
                    <div class="icon-box bg-success bg-opacity-10 mx-auto mb-3">
                        <i class="fas fa-envelope-open-text text-success fa-2x"></i>
                    </div>
                    <h5 class="fw-bold">No campaigns yet</h5>
                    <p class="text-muted">Create your first newsletter campaign</p>
                    <a href="{{ route('admin.newsletter.create') }}" class="btn btn-success">
                        <i class="fas fa-plus me-2"></i>Create Campaign
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
:root {
    --brand-green: #197b3b;
}

.btn-success,
.bg-success {
    background-color: var(--brand-green) !important;
    border-color: var(--brand-green) !important;
}

.text-success {
    color: var(--brand-green) !important;
}

.icon-box {
    width: 48px;
    height: 48px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.card {
    border-radius: 14px;
}

.table tbody tr:hover {
    background-color: rgba(25, 123, 59, 0.03);
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('[data-bs-toggle="tooltip"]').forEach(el => {
        new bootstrap.Tooltip(el)
    })
})
</script>
@endpush
