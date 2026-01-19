@extends('admin.layouts.app')

@section('content')
<div class="min-h-screen bg-background-light dark:bg-background-dark p-4 md:p-6">
    
    <!-- Header -->
    <div class="mb-6">
        <div class="flex items-center justify-between">
            <div>
                <a href="{{ route('admin.events.index') }}" class="inline-flex items-center text-primary hover:text-primary/80 mb-4">
                    <span class="material-symbols-outlined mr-2">arrow_back</span>
                    Back to Events
                </a>
                <h1 class="text-2xl font-bold text-slate-900 dark:text-white">{{ $event->title }}</h1>
                <p class="text-slate-600 dark:text-slate-400">{{ $event->start_time->format('l, F j, Y • g:i A') }}</p>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('admin.events.edit', $event) }}" 
                   class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary/90">
                    Edit Event
                </a>
                <a href="{{ route('admin.events.registrations', $event) }}" 
                   class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                    View Registrations ({{ $event->registrations->count() }})
                </a>
            </div>
        </div>
    </div>

    <!-- Event Details -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Left Column -->
        <div class="lg:col-span-2">
            <div class="bg-white dark:bg-slate-800 rounded-xl shadow-lg p-6 mb-6">
                <!-- Poster -->
                @if($event->poster)
                    <img src="{{ $event->poster_url }}" alt="{{ $event->title }}" 
                         class="w-full h-64 object-cover rounded-lg mb-6">
                @endif

                <!-- Description -->
                <div class="prose dark:prose-invert max-w-none mb-6">
                    <h3 class="text-xl font-semibold mb-3">Event Description</h3>
                    <p class="text-slate-700 dark:text-slate-300">
                        {{ $event->description ?? 'No description provided.' }}
                    </p>
                </div>

                <!-- Details Grid -->
                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <h4 class="text-sm font-medium text-slate-500 dark:text-slate-400 mb-2">Date & Time</h4>
                        <p class="text-slate-900 dark:text-white">
                            {{ $event->start_time->format('F j, Y') }}<br>
                            {{ $event->start_time->format('g:i A') }}
                            @if($event->end_time)
                                - {{ $event->end_time->format('g:i A') }}
                            @endif
                        </p>
                    </div>
                    
                    <div>
                        <h4 class="text-sm font-medium text-slate-500 dark:text-slate-400 mb-2">Location</h4>
                        <p class="text-slate-900 dark:text-white">{{ $event->location }}</p>
                    </div>
                    
                    <div>
                        <h4 class="text-sm font-medium text-slate-500 dark:text-slate-400 mb-2">Event Type</h4>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                            @if($event->event_type == 'service') bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-300
                            @elseif($event->event_type == 'conference') bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300
                            @elseif($event->event_type == 'workshop') bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300
                            @else bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300 @endif">
                            {{ ucfirst($event->event_type) }}
                        </span>
                    </div>
                    
                    <div>
                        <h4 class="text-sm font-medium text-slate-500 dark:text-slate-400 mb-2">Visibility</h4>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                            {{ $event->is_public ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300' : 'bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-300' }}">
                            {{ $event->is_public ? 'Public' : 'Private' }}
                        </span>
                    </div>
                    
                    @if($event->ministry)
                    <div>
                        <h4 class="text-sm font-medium text-slate-500 dark:text-slate-400 mb-2">Ministry</h4>
                        <p class="text-slate-900 dark:text-white">{{ $event->ministry->name }}</p>
                    </div>
                    @endif
                    
                    <div>
                        <h4 class="text-sm font-medium text-slate-500 dark:text-slate-400 mb-2">Created</h4>
                        <p class="text-slate-900 dark:text-white">
                            {{ $event->created_at->format('M j, Y') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column - Actions & Stats -->
        <div class="space-y-6">
            <!-- Quick Stats -->
            <div class="bg-white dark:bg-slate-800 rounded-xl shadow-lg p-6">
                <h3 class="text-lg font-semibold text-slate-900 dark:text-white mb-4">Event Stats</h3>
                <div class="space-y-4">
                    <div>
                        <p class="text-sm text-slate-500 dark:text-slate-400">Total Registrations</p>
                        <p class="text-2xl font-bold text-slate-900 dark:text-white">
                            {{ $event->registrations->count() }}
                        </p>
                    </div>
                    <div>
                        <p class="text-sm text-slate-500 dark:text-slate-400">Confirmed</p>
                        <p class="text-2xl font-bold text-green-600 dark:text-green-400">
                            {{ $event->registrations->where('status', 'confirmed')->count() }}
                        </p>
                    </div>
                    <div>
                        <p class="text-sm text-slate-500 dark:text-slate-400">With Guests</p>
                        <p class="text-2xl font-bold text-blue-600 dark:text-blue-400">
                            {{ $event->registrations->where('number_of_guests', '>', 0)->count() }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white dark:bg-slate-800 rounded-xl shadow-lg p-6">
                <h3 class="text-lg font-semibold text-slate-900 dark:text-white mb-4">Quick Actions</h3>
                <div class="space-y-3">
                    <a href="{{ route('admin.events.registrations', $event) }}" 
                       class="flex items-center p-3 bg-blue-50 dark:bg-blue-900/20 hover:bg-blue-100 dark:hover:bg-blue-900/30 rounded-lg transition">
                        <span class="material-symbols-outlined text-blue-600 dark:text-blue-400 mr-3">
                            groups
                        </span>
                        <span class="font-medium text-blue-700 dark:text-blue-300">Manage Registrations</span>
                    </a>
                    
                    <a href="{{ route('admin.events.edit', $event) }}" 
                       class="flex items-center p-3 bg-green-50 dark:bg-green-900/20 hover:bg-green-100 dark:hover:bg-green-900/30 rounded-lg transition">
                        <span class="material-symbols-outlined text-green-600 dark:text-green-400 mr-3">
                            edit
                        </span>
                        <span class="font-medium text-green-700 dark:text-green-300">Edit Event Details</span>
                    </a>
                    
                    <form action="{{ route('admin.events.destroy', $event) }}" method="POST" 
                          onsubmit="return confirm('Are you sure you want to delete this event?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="w-full flex items-center p-3 bg-red-50 dark:bg-red-900/20 hover:bg-red-100 dark:hover:bg-red-900/30 rounded-lg transition text-left">
                            <span class="material-symbols-outlined text-red-600 dark:text-red-400 mr-3">
                                delete
                            </span>
                            <span class="font-medium text-red-700 dark:text-red-300">Delete Event</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection