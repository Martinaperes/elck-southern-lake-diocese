<div class="p-4">
    <div class="row">
        @if($event->poster_url)
        <div class="col-md-4">
            <img src="{{ $event->poster_url }}" alt="{{ $event->title }}" class="img-fluid rounded mb-3">
        </div>
        <div class="col-md-8">
        @else
        <div class="col-12">
        @endif
            <h4 class="mb-3">{{ $event->title }}</h4>
            
            <div class="mb-3">
                @if($event->ministry)
                <span class="badge bg-primary me-2">{{ $event->ministry->name }}</span>
                @endif
                <span class="badge bg-info">{{ ucfirst($event->event_type) }}</span>
            </div>
            
            <div class="mb-3">
                <h6>Date & Time</h6>
                <p class="mb-1">
                    <i class="far fa-calendar-alt me-2"></i>
                    {{ $event->start_time->format('l, F j, Y') }}
                </p>
                <p class="mb-0">
                    <i class="far fa-clock me-2"></i>
                    {{ $event->start_time->format('h:i A') }}
                    @if($event->end_time)
                    - {{ $event->end_time->format('h:i A') }}
                    @endif
                </p>
            </div>
            
            <div class="mb-3">
                <h6>Location</h6>
                <p class="mb-0">
                    <i class="fas fa-map-marker-alt me-2"></i>
                    {{ $event->location }}
                </p>
            </div>
            
            @if($event->description)
            <div class="mb-4">
                <h6>Description</h6>
                <p class="mb-0">{{ $event->description }}</p>
            </div>
            @endif
            
            @auth
            @if($event->start_time->isFuture())
            <div class="mt-4 pt-3 border-top">
                <h6>Register for this Event</h6>
                <form id="eventRegistrationForm" action="{{ route('events.register', $event) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="number_of_guests" class="form-label">Number of Guests</label>
                        <input type="number" class="form-control" id="number_of_guests" name="number_of_guests" min="0" max="10" value="0" required>
                    </div>
                    <div class="mb-3">
                        <label for="special_requirements" class="form-label">Special Requirements (Optional)</label>
                        <textarea class="form-control" id="special_requirements" name="special_requirements" rows="2"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Register Now</button>
                </form>
            </div>
            @endif
            @else
            <div class="alert alert-info mt-3">
                <a href="{{ route('login') }}">Login</a> to register for this event.
            </div>
            @endauth
        </div>
    </div>
</div>