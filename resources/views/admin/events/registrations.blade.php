{{-- resources/views/admin/events/registrations.blade.php --}}
@extends('admin.layouts.app')

@section('title', 'Event Registrations - ELCT Southern Lake Diocese')

@section('content')
<div class="container-fluid px-4">
    <!-- Page Header -->
    <div class="page-header-bg">
        <div class="d-sm-flex align-items-center justify-content-between py-4">
            <div>
                <h1 class="page-title">Event Registrations</h1>
                <p class="page-subtitle">Manage registrations for: <strong>{{ $event->title }}</strong></p>
                <div class="event-details mt-2">
                    <span class="event-date">
                        <i class="fas fa-calendar"></i>
                        {{ $event->start_time->format('M d, Y') }}
                    </span>
                    <span class="event-location">
                        <i class="fas fa-map-marker-alt"></i>
                        {{ $event->location }}
                    </span>
                    <span class="event-type event-type-{{ $event->event_type }}">
                        {{ ucfirst($event->event_type) }}
                    </span>
                </div>
            </div>
            <div class="header-actions">
                <a href="{{ route('admin.events.index') }}" class="btn-back">
                    <i class="fas fa-arrow-left"></i>
                    <span>Back to Events</span>
                </a>
                <a href="{{ route('admin.events.edit', $event->id) }}" class="btn-edit-event">
                    <i class="fas fa-edit"></i>
                    <span>Edit Event</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon-wrapper">
                <div class="stat-icon bg-primary">
                    <i class="fas fa-users"></i>
                </div>
            </div>
            <div class="stat-content">
                <h3 class="stat-number">{{ $registrations->total() }}</h3>
                <p class="stat-label">Total Registrations</p>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon-wrapper">
                <div class="stat-icon bg-success">
                    <i class="fas fa-check-circle"></i>
                </div>
            </div>
            <div class="stat-content">
                <h3 class="stat-number">{{ $registrations->where('status', 'confirmed')->count() }}</h3>
                <p class="stat-label">Confirmed</p>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon-wrapper">
                <div class="stat-icon bg-info">
                    <i class="fas fa-user-clock"></i>
                </div>
            </div>
            <div class="stat-content">
                <h3 class="stat-number">{{ $registrations->where('status', 'registered')->count() }}</h3>
                <p class="stat-label">Registered</p>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon-wrapper">
                <div class="stat-icon bg-warning">
                    <i class="fas fa-user-check"></i>
                </div>
            </div>
            <div class="stat-content">
                <h3 class="stat-number">{{ $registrations->where('status', 'attended')->count() }}</h3>
                <p class="stat-label">Attended</p>
            </div>
        </div>
    </div>

    <!-- Registrations Table -->
    <div class="main-card">
        <div class="card-header-custom">
            <div class="header-left">
                <h2 class="card-title">Registrations List</h2>
                <p class="card-subtitle">{{ $registrations->total() }} people registered for this event</p>
            </div>
            <div class="header-actions">
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Search registrations..." class="search-input" id="searchRegistrations">
                </div>
                <div class="filter-dropdown">
                    <button class="filter-btn">
                        <i class="fas fa-filter"></i>
                        Filter by Status
                        <i class="fas fa-chevron-down"></i>
                    </button>
                    <div class="filter-menu">
                        <a href="{{ request()->fullUrlWithQuery(['status' => 'all']) }}" class="filter-item">
                            <i class="fas fa-list"></i>
                            All Registrations
                        </a>
                        <a href="{{ request()->fullUrlWithQuery(['status' => 'registered']) }}" class="filter-item">
                            <i class="fas fa-user-clock"></i>
                            Registered
                        </a>
                        <a href="{{ request()->fullUrlWithQuery(['status' => 'confirmed']) }}" class="filter-item">
                            <i class="fas fa-check-circle"></i>
                            Confirmed
                        </a>
                        <a href="{{ request()->fullUrlWithQuery(['status' => 'attended']) }}" class="filter-item">
                            <i class="fas fa-user-check"></i>
                            Attended
                        </a>
                        <a href="{{ request()->fullUrlWithQuery(['status' => 'cancelled']) }}" class="filter-item">
                            <i class="fas fa-times-circle"></i>
                            Cancelled
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body">
            @if(session('success'))
                <div class="alert-success-custom">
                    <div class="alert-content">
                        <i class="fas fa-check-circle"></i>
                        <span>{{ session('success') }}</span>
                    </div>
                    <button class="alert-close">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            @endif

            <div class="table-container">
                <table class="modern-table">
                    <thead>
                        <tr>
                            <th class="table-member">Member</th>
                            <th class="table-contact">Contact Info</th>
                            <th class="table-guests">Guests</th>
                            <th class="table-requirements">Special Requirements</th>
                            <th class="table-status">Status</th>
                            <th class="table-date">Registered On</th>
                            <th class="table-actions">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($registrations as $registration)
                        <tr class="table-row registration-row" data-status="{{ $registration->status }}">
                            <td class="table-member">
                                <div class="member-info">
                                    <div class="member-avatar">
                                        {{ substr($registration->member->first_name, 0, 1) }}{{ substr($registration->member->last_name, 0, 1) }}
                                    </div>
                                    <div class="member-details">
                                        <h4 class="member-name">
                                            {{ $registration->member->first_name }} {{ $registration->member->last_name }}
                                        </h4>
                                        <p class="member-id">ID: {{ $registration->member->id }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="table-contact">
                                <div class="contact-info">
                                    <div class="contact-email">
                                        <i class="fas fa-envelope"></i>
                                        {{ $registration->member->email }}
                                    </div>
                                    @if($registration->member->phone)
                                    <div class="contact-phone">
                                        <i class="fas fa-phone"></i>
                                        {{ $registration->member->phone }}
                                    </div>
                                    @endif
                                </div>
                            </td>
                            <td class="table-guests">
                                <div class="guests-count">
                                    <span class="guests-number">{{ $registration->number_of_guests }}</span>
                                    <span class="guests-label">guest(s)</span>
                                </div>
                            </td>
                            <td class="table-requirements">
                                @if($registration->special_requirements)
                                <div class="requirements-info">
                                    <i class="fas fa-info-circle"></i>
                                    <span class="requirements-text" title="{{ $registration->special_requirements }}">
                                        {{ Str::limit($registration->special_requirements, 50) }}
                                    </span>
                                </div>
                                @else
                                <span class="no-requirements">—</span>
                                @endif
                            </td>
                            <td class="table-status">
                                <div class="status-selector">
                                    <select class="status-select {{ $registration->status }}" 
                                            data-registration-id="{{ $registration->id }}"
                                            onchange="updateRegistrationStatus(this)">
                                        <option value="registered" {{ $registration->status == 'registered' ? 'selected' : '' }}>Registered</option>
                                        <option value="confirmed" {{ $registration->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                        <option value="attended" {{ $registration->status == 'attended' ? 'selected' : '' }}>Attended</option>
                                        <option value="cancelled" {{ $registration->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                    </select>
                                </div>
                            </td>
                            <td class="table-date">
                                <div class="date-info">
                                    <div class="date-main">{{ $registration->created_at->format('M d, Y') }}</div>
                                    <div class="date-time">{{ $registration->created_at->format('h:i A') }}</div>
                                </div>
                            </td>
                            <td class="table-actions">
                                <div class="action-buttons">
                                    <button class="action-btn view-btn" title="View Details" onclick="viewRegistration({{ $registration->id }})">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="action-btn delete-btn" title="Delete Registration" onclick="confirmDelete({{ $registration->id }})">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                                
                                <!-- Delete Form -->
                                <form id="delete-form-{{ $registration->id }}" 
                                      action="{{ route('admin.events.registrations.destroy', ['event' => $event->id, 'registration' => $registration->id]) }}" 
                                      method="POST" class="d-none">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="empty-state">
                                <div class="empty-content">
                                    <i class="fas fa-users-slash empty-icon"></i>
                                    <h3>No Registrations Yet</h3>
                                    <p>No one has registered for this event yet.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($registrations->hasPages())
            <div class="pagination-container">
                <div class="pagination-info">
                    Showing <strong>{{ $registrations->firstItem() }}</strong> to <strong>{{ $registrations->lastItem() }}</strong> of <strong>{{ $registrations->total() }}</strong> registrations
                </div>
                <div class="pagination">
                    {{ $registrations->links() }}
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<!-- Registration Details Modal -->
<div class="modal fade" id="registrationModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Registration Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body" id="registrationDetails">
                <!-- Content will be loaded via AJAX -->
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
/* Event Details in Header */
.event-details {
    display: flex;
    gap: 1.5rem;
    flex-wrap: wrap;
}

.event-details span {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    background: rgba(99, 102, 241, 0.1);
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-size: 0.9rem;
    color: var(--primary);
    font-weight: 500;
}

.event-type {
    background: rgba(139, 92, 246, 0.1) !important;
    color: var(--secondary) !important;
}

/* Header Actions */
.btn-edit-event {
    background: var(--info);
    color: white;
    border: none;
    padding: 1rem 1.5rem;
    border-radius: var(--radius);
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 0.75rem;
    text-decoration: none;
    transition: all 0.3s ease;
}

.btn-edit-event:hover {
    background: #0891b2;
    color: white;
    transform: translateY(-2px);
}

/* Member Info */
.member-info {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.member-avatar {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--primary), var(--secondary));
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: 700;
    font-size: 1.1rem;
}

.member-name {
    font-weight: 600;
    color: var(--dark);
    margin: 0 0 0.25rem 0;
    font-size: 1rem;
}

.member-id {
    color: var(--gray-500);
    font-size: 0.8rem;
    margin: 0;
}

/* Contact Info */
.contact-info {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.contact-email,
.contact-phone {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.9rem;
    color: var(--gray-700);
}

.contact-email i {
    color: var(--primary);
}

.contact-phone i {
    color: var(--success);
}

/* Guests Count */
.guests-count {
    text-align: center;
}

.guests-number {
    display: block;
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--primary);
    line-height: 1;
}

.guests-label {
    font-size: 0.8rem;
    color: var(--gray-500);
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

/* Requirements */
.requirements-info {
    display: flex;
    align-items: flex-start;
    gap: 0.5rem;
}

.requirements-info i {
    color: var(--warning);
    margin-top: 0.2rem;
    flex-shrink: 0;
}

.requirements-text {
    font-size: 0.85rem;
    color: var(--gray-700);
    line-height: 1.4;
}

.no-requirements {
    color: var(--gray-400);
    font-style: italic;
}

/* Status Selector */
.status-selector {
    position: relative;
}

.status-select {
    width: 100%;
    padding: 0.5rem 2rem 0.5rem 1rem;
    border: 2px solid var(--gray-200);
    border-radius: var(--radius);
    font-size: 0.8rem;
    font-weight: 600;
    cursor: pointer;
    appearance: none;
    background: white;
    transition: all 0.3s ease;
    position: relative;
}

.status-select:focus {
    outline: none;
    border-color: var(--primary);
}

/* Status Colors */
.status-select.registered {
    background: rgba(59, 130, 246, 0.1);
    border-color: rgba(59, 130, 246, 0.3);
    color: #3b82f6;
}

.status-select.confirmed {
    background: rgba(16, 185, 129, 0.1);
    border-color: rgba(16, 185, 129, 0.3);
    color: #10b981;
}

.status-select.attended {
    background: rgba(139, 92, 246, 0.1);
    border-color: rgba(139, 92, 246, 0.3);
    color: #8b5cf6;
}

.status-select.cancelled {
    background: rgba(239, 68, 68, 0.1);
    border-color: rgba(239, 68, 68, 0.3);
    color: #ef4444;
}

/* Date Info */
.date-info {
    text-align: center;
}

.date-main {
    font-weight: 600;
    color: var(--dark);
    margin-bottom: 0.25rem;
}

.date-time {
    color: var(--gray-500);
    font-size: 0.8rem;
}

/* Modal */
.modal-content {
    border: none;
    border-radius: var(--radius-xl);
    box-shadow: var(--shadow-xl);
}

.modal-header {
    background: linear-gradient(135deg, var(--primary), var(--secondary));
    color: white;
    border: none;
    border-radius: var(--radius-xl) var(--radius-xl) 0 0;
    padding: 1.5rem 2rem;
}

.modal-title {
    font-weight: 700;
    margin: 0;
}

.modal-header .close {
    color: white;
    opacity: 0.8;
    border: none;
    background: none;
    font-size: 1.5rem;
    transition: opacity 0.3s ease;
}

.modal-header .close:hover {
    opacity: 1;
}

.modal-body {
    padding: 2rem;
}

/* Responsive */
@media (max-width: 768px) {
    .event-details {
        flex-direction: column;
        gap: 0.5rem;
    }
    
    .member-info {
        flex-direction: column;
        text-align: center;
        gap: 0.5rem;
    }
    
    .contact-info {
        align-items: center;
    }
    
    .header-actions {
        flex-direction: column;
        gap: 1rem;
    }
}
</style>
@endpush

@push('scripts')
<script>
// Update registration status
function updateRegistrationStatus(select) {
    const registrationId = select.dataset.registrationId;
    const newStatus = select.value;
    
    // Show loading state
    select.disabled = true;
    
    fetch(`/admin/events/{{ $event->id }}/registrations/${registrationId}/status`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
            status: newStatus
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Update select class
            select.className = `status-select ${newStatus}`;
            
            // Show success message
            Swal.fire({
                title: 'Success!',
                text: 'Registration status updated successfully',
                icon: 'success',
                confirmButtonColor: 'var(--primary)',
                timer: 2000
            });
        }
    })
    .catch(error => {
        console.error('Error:', error);
        Swal.fire({
            title: 'Error!',
            text: 'Failed to update status',
            icon: 'error',
            confirmButtonColor: 'var(--danger)'
        });
    })
    .finally(() => {
        select.disabled = false;
    });
}

// View registration details
function viewRegistration(registrationId) {
    fetch(`/admin/events/{{ $event->id }}/registrations/${registrationId}/details`)
        .then(response => response.text())
        .then(html => {
            document.getElementById('registrationDetails').innerHTML = html;
            $('#registrationModal').modal('show');
        })
        .catch(error => {
            console.error('Error:', error);
            Swal.fire({
                title: 'Error!',
                text: 'Failed to load registration details',
                icon: 'error',
                confirmButtonColor: 'var(--danger)'
            });
        });
}

// Delete confirmation
function confirmDelete(registrationId) {
    Swal.fire({
        title: 'Are you sure?',
        text: "This registration will be permanently deleted!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: 'var(--danger)',
        cancelButtonColor: 'var(--gray-600)',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel',
        background: 'white',
        borderRadius: '20px',
        padding: '2rem'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById(`delete-form-${registrationId}`).submit();
        }
    });
}

// Search functionality
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchRegistrations');
    const tableRows = document.querySelectorAll('.registration-row');
    
    searchInput.addEventListener('input', function(e) {
        const searchTerm = e.target.value.toLowerCase();
        
        tableRows.forEach(row => {
            const memberName = row.querySelector('.member-name').textContent.toLowerCase();
            const memberEmail = row.querySelector('.contact-email').textContent.toLowerCase();
            
            if (memberName.includes(searchTerm) || memberEmail.includes(searchTerm)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
});
</script>
@endpush