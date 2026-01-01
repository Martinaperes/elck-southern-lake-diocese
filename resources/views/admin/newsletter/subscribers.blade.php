{{-- resources/views/admin/newsletter/subscribers.blade.php --}}
@extends('admin.layouts.app')

@section('title', 'Newsletter Subscribers')

@section('content')
<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-brand-dark">Newsletter Subscribers</h1>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.newsletter.export.subscribers') }}" class="btn btn-outline-primary">
                <i class="fas fa-download me-2"></i>Export CSV
            </a>
        </div>
    </div>

    <div class="card shadow">
        <div class="card-body">
            <!-- Filters -->
            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search subscribers..." id="searchInput">
                        <button class="btn btn-outline-secondary" type="button" id="searchBtn">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="d-flex gap-2 justify-content-end">
                        <select class="form-select w-auto" id="statusFilter">
                            <option value="">All Status</option>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                        <select class="form-select w-auto" id="parishFilter">
                            <option value="">All Parishes</option>
                            <option value="cathedral">St. John's Cathedral</option>
                            <option value="imani">Imani Parish</option>
                            <option value="baraka">Baraka Parish</option>
                            <option value="visitor">Visitor / Non-member</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Stats -->
            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="card bg-primary text-white">
                        <div class="card-body">
                            <h6 class="card-title">Total Subscribers</h6>
                            <h2 class="mb-0">{{ $subscribers->total() }}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-success text-white">
                        <div class="card-body">
                            <h6 class="card-title">Active</h6>
                            <h2 class="mb-0">{{ $activeCount }}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-secondary text-white">
                        <div class="card-body">
                            <h6 class="card-title">Inactive</h6>
                            <h2 class="mb-0">{{ $inactiveCount }}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-info text-white">
                        <div class="card-body">
                            <h6 class="card-title">This Month</h6>
                            <h2 class="mb-0">{{ $thisMonthCount }}</h2>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Subscribers Table -->
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>
                                <input type="checkbox" id="selectAll">
                            </th>
                            <th>Email</th>
                            <th>Name</th>
                            <th>Parish</th>
                            <th>Status</th>
                            <th>Subscribed</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($subscribers as $subscriber)
                        <tr>
                            <td>
                                <input type="checkbox" class="subscriber-checkbox" value="{{ $subscriber->id }}">
                            </td>
                            <td>
                                <a href="mailto:{{ $subscriber->email }}" class="text-decoration-none">
                                    {{ $subscriber->email }}
                                </a>
                            </td>
                            <td>{{ $subscriber->name ?? '—' }}</td>
                            <td>
                                @if($subscriber->parish)
                                    <span class="badge bg-info">
                                        {{ ucfirst($subscriber->parish) }}
                                    </span>
                                @else
                                    <span class="badge bg-secondary">Not specified</span>
                                @endif
                            </td>
                            <td>
                                @if($subscriber->is_active)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-danger">Inactive</span>
                                @endif
                            </td>
                            <td>{{ $subscriber->subscribed_at->format('M j, Y') }}</td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    @if($subscriber->is_active)
                                        <form action="{{ route('admin.newsletter.unsubscribe', $subscriber) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-outline-danger" 
                                                    onclick="return confirm('Unsubscribe this user?')">
                                                Unsubscribe
                                            </button>
                                        </form>
                                    @else
                                        <form action="{{ route('admin.newsletter.resubscribe', $subscriber) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-outline-success">
                                                Resubscribe
                                            </button>
                                        </form>
                                    @endif
                                    <button type="button" class="btn btn-outline-info" data-bs-toggle="modal" 
                                            data-bs-target="#subscriberModal{{ $subscriber->id }}">
                                        Details
                                    </button>
                                </div>

                                <!-- Modal -->
                                <div class="modal fade" id="subscriberModal{{ $subscriber->id }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Subscriber Details</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <dl class="row">
                                                    <dt class="col-sm-4">Email:</dt>
                                                    <dd class="col-sm-8">{{ $subscriber->email }}</dd>
                                                    
                                                    <dt class="col-sm-4">Name:</dt>
                                                    <dd class="col-sm-8">{{ $subscriber->name ?? 'Not provided' }}</dd>
                                                    
                                                    <dt class="col-sm-4">Parish:</dt>
                                                    <dd class="col-sm-8">{{ $subscriber->parish ?? 'Not specified' }}</dd>
                                                    
                                                    <dt class="col-sm-4">Status:</dt>
                                                    <dd class="col-sm-8">
                                                        @if($subscriber->is_active)
                                                            <span class="badge bg-success">Active</span>
                                                        @else
                                                            <span class="badge bg-danger">Inactive</span>
                                                        @endif
                                                    </dd>
                                                    
                                                    <dt class="col-sm-4">Subscribed:</dt>
                                                    <dd class="col-sm-8">{{ $subscriber->subscribed_at->format('F j, Y, g:i A') }}</dd>
                                                    
                                                    @if($subscriber->unsubscribed_at)
                                                    <dt class="col-sm-4">Unsubscribed:</dt>
                                                    <dd class="col-sm-8">{{ $subscriber->unsubscribed_at->format('F j, Y, g:i A') }}</dd>
                                                    @endif
                                                    
                                                    <dt class="col-sm-4">Token:</dt>
                                                    <dd class="col-sm-8">
                                                        <small class="text-muted">{{ $subscriber->subscription_token }}</small>
                                                    </dd>
                                                </dl>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <a href="mailto:{{ $subscriber->email }}" class="btn btn-primary">
                                                    Send Email
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-4">No subscribers found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($subscribers->hasPages())
            <div class="d-flex justify-content-between align-items-center mt-4">
                <div>
                    Showing {{ $subscribers->firstItem() }} to {{ $subscribers->lastItem() }} of {{ $subscribers->total() }} entries
                </div>
                <div>
                    {{ $subscribers->links() }}
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Select all checkbox
        document.getElementById('selectAll').addEventListener('change', function(e) {
            const checkboxes = document.querySelectorAll('.subscriber-checkbox');
            checkboxes.forEach(cb => cb.checked = e.target.checked);
        });

        // Search functionality
        document.getElementById('searchBtn').addEventListener('click', function() {
            const searchTerm = document.getElementById('searchInput').value;
            const status = document.getElementById('statusFilter').value;
            const parish = document.getElementById('parishFilter').value;
            
            let url = new URL(window.location.href);
            url.searchParams.set('search', searchTerm);
            if (status) url.searchParams.set('status', status);
            if (parish) url.searchParams.set('parish', parish);
            
            window.location.href = url.toString();
        });
    });
</script>
@endsection