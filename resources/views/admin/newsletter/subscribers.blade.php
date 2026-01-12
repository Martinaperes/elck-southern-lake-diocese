@extends('admin.layouts.app')

@section('newsletter-content')
<div class="row">
    <!-- Stats Cards -->
    <div class="col-md-4 mb-4">
        <div class="card border-left-success shadow-sm h-100">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Active Subscribers
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $activeCount }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-users fa-2x text-success"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-4 mb-4">
        <div class="card border-left-warning shadow-sm h-100">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Inactive Subscribers
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $inactiveCount }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-user-slash fa-2x text-warning"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-4 mb-4">
        <div class="card border-left-info shadow-sm h-100">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                            This Month
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $thisMonthCount }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar-alt fa-2x text-info"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0">Newsletter Subscribers</h5>
            </div>
            <div class="card-body">
                <!-- Search and Filter -->
                <form method="GET" action="{{ route('admin.newsletter.subscribers') }}" class="mb-4">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control" 
                                       placeholder="Search by email or name..." 
                                       value="{{ request('search') }}">
                                <button class="btn btn-outline-secondary" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <select name="status" class="form-select" onchange="this.form.submit()">
                                <option value="">All Status</option>
                                <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <a href="{{ route('admin.newsletter.subscribers') }}" class="btn btn-outline-secondary w-100">
                                <i class="fas fa-redo"></i> Reset
                            </a>
                        </div>
                    </div>
                </form>

                <!-- Subscribers Table -->
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Email</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Subscribed</th>
                                <th>Parish</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($subscribers as $subscriber)
                            <tr>
                                <td>
                                    <strong>{{ $subscriber->email }}</strong>
                                    @if($subscriber->unsubscribed_at)
                                    <br>
                                    <small class="text-danger">
                                        Unsubscribed: {{ $subscriber->unsubscribed_at->format('M d, Y') }}
                                    </small>
                                    @endif
                                </td>
                                <td>{{ $subscriber->name ?? 'N/A' }}</td>
                                <td>
                                    @if($subscriber->is_active)
                                    <span class="badge bg-success">Active</span>
                                    @else
                                    <span class="badge bg-danger">Inactive</span>
                                    @endif
                                </td>
                                <td>{{ $subscriber->subscribed_at->format('M d, Y') }}</td>
                                <td>{{ $subscriber->parish ?? 'N/A' }}</td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        @if(!$subscriber->is_active)
                                        <form action="{{ route('admin.newsletter.resubscribe', $subscriber) }}" 
                                              method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-outline-success" 
                                                    title="Reactivate" onclick="return confirm('Reactivate this subscriber?')">
                                                <i class="fas fa-user-check"></i>
                                            </button>
                                        </form>
                                        @endif
                                        
                                        <form action="{{ route('admin.newsletter.destroySubscriber', $subscriber) }}" 
                                              method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger" 
                                                    title="Delete" onclick="return confirm('Permanently delete this subscriber?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center py-4">
                                    <i class="fas fa-users fa-2x text-muted mb-3"></i>
                                    <h5>No subscribers found</h5>
                                    <p class="text-muted">No newsletter subscribers yet</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-4">
                    {{ $subscribers->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection