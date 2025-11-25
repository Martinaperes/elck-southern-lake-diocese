
@if($registration)
<div class="registration-details">
    <div class="detail-section">
        <h4>Member Information</h4>
        <div class="detail-grid">
            <div class="detail-item">
                <label>Full Name:</label>
                <span>{{ $registration->member->first_name }} {{ $registration->member->last_name }}</span>
            </div>
            <div class="detail-item">
                <label>Email:</label>
                <span>{{ $registration->member->email }}</span>
            </div>
            <div class="detail-item">
                <label>Phone:</label>
                <span>{{ $registration->member->phone ?? 'N/A' }}</span>
            </div>
            <div class="detail-item">
                <label>Member ID:</label>
                <span>{{ $registration->member->id }}</span>
            </div>
        </div>
    </div>

    <div class="detail-section">
        <h4>Registration Details</h4>
        <div class="detail-grid">
            <div class="detail-item">
                <label>Number of Guests:</label>
                <span>{{ $registration->number_of_guests }}</span>
            </div>
            <div class="detail-item">
                <label>Status:</label>
                <span class="status-badge status-{{ $registration->status }}">
                    {{ ucfirst($registration->status) }}
                </span>
            </div>
            <div class="detail-item">
                <label>Registered On:</label>
                <span>{{ $registration->created_at->format('M d, Y \\a\\t h:i A') }}</span>
            </div>
            <div class="detail-item">
                <label>Last Updated:</label>
                <span>{{ $registration->updated_at->format('M d, Y \\a\\t h:i A') }}</span>
            </div>
        </div>
    </div>

    @if($registration->special_requirements)
    <div class="detail-section">
        <h4>Special Requirements</h4>
        <div class="requirements-content">
            <p>{{ $registration->special_requirements }}</p>
        </div>
    </div>
    @endif
</div>
@endif