@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="text-center mb-5">
        <h2 class="fw-bold">Upcoming Events</h2>
        <p class="text-muted">Join us in our latest gatherings, worships, and community activities.</p>
    </div>

    {{-- Filters --}}
    <form class="row g-3 mb-5" method="GET">
        <div class="col-md-4">
            <input type="text" name="search" placeholder="Search events..." class="form-control shadow-sm" value="{{ request('search') }}">
        </div>
        <div class="col-md-4">
            <select name="event_type" class="form-select shadow-sm">
                <option value="">All Types</option>
                <option value="service" {{ request('event_type') == 'service' ? 'selected' : '' }}>Service</option>
                <option value="meeting" {{ request('event_type') == 'meeting' ? 'selected' : '' }}>Meeting</option>
                <option value="conference" {{ request('event_type') == 'conference' ? 'selected' : '' }}>Conference</option>
                <option value="training" {{ request('event_type') == 'training' ? 'selected' : '' }}>Training</option>
            </select>
        </div>
        <div class="col-md-4">
            <input type="date" name="date" class="form-control shadow-sm" value="{{ request('date') }}">
        </div>
    </form>

    {{-- Event Cards --}}
    @if($events->count())
        <div class="row">
            @foreach($events as $event)
                <div class="col-md-4 mb-4">
                    <div class="card border-0 shadow-sm h-100 rounded-4 overflow-hidden">
                        @if($event->poster)
                            <img src="{{ asset('storage/' . $event->poster) }}" class="card-img-top" style="height:220px;object-fit:cover;">
                        @else
                            <div class="bg-light d-flex align-items-center justify-content-center" style="height:220px;">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-secondary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                        @endif
                        <div class="card-body d-flex flex-column">
                            <h5 class="fw-semibold">{{ $event->title }}</h5>

                            <div class="text-muted small mb-2 d-flex align-items-center gap-2">
                                {{-- Calendar icon --}}
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <span>{{ $event->start_time->format('M d, Y') }}</span>
                            </div>

                            <div class="text-muted small mb-3 d-flex align-items-center gap-2">
                                {{-- Map Pin icon --}}
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-danger" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 11a4 4 0 100-8 4 4 0 000 8zm0 0v8m0 0l-3-3m3 3l3-3" />
                                </svg>
                                <span>{{ $event->location }}</span>
                            </div>

                            <p class="text-muted small flex-grow-1">{{ Str::limit($event->description, 100) }}</p>

                            <a href="{{ route('events.show', $event) }}" class="btn btn-outline-primary mt-auto w-100 rounded-pill">
                                View Details
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $events->links() }}
        </div>
    @else
        <div class="text-center py-5">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 mx-auto text-secondary mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
            <p class="text-muted">No events available at the moment. Please check back later.</p>
        </div>
    @endif
</div>
@endsection
