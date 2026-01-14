@extends('admin.layouts.app')

@section('content')
<div class="relative min-h-screen bg-background-light dark:bg-background-dark">
    <!-- Header -->
    <div class="sticky top-0 z-40 bg-background-light/95 dark:bg-background-dark/95 backdrop-blur-lg border-b border-gray-200/50 dark:border-gray-800/50">
        <div class="flex items-center justify-between p-4">
            <div class="flex items-center gap-4">
                <a href="{{ route('admin.dashboard') }}" 
                   class="flex items-center justify-center size-10 rounded-full bg-white dark:bg-surface-dark text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-white/5 transition-colors">
                    <span class="material-symbols-outlined text-xl">arrow_back</span>
                </a>
                <div>
                    <h1 class="text-xl font-bold text-gray-900 dark:text-white">Events Calendar</h1>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">Manage church events & schedules</p>
                </div>
            </div>
            <div class="flex items-center gap-2">
                <button class="flex items-center justify-center size-10 rounded-full bg-white dark:bg-surface-dark text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-white/5 transition-colors">
                    <span class="material-symbols-outlined text-xl">search</span>
                </button>
                <a href="{{ route('admin.events.create') }}" 
                   class="flex items-center gap-2 px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary/90 transition-colors shadow-lg shadow-primary/20">
                    <span class="material-symbols-outlined text-xl">add</span>
                    <span class="text-sm font-medium">New Event</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="p-4">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="bg-white dark:bg-surface-dark rounded-xl p-4 border border-gray-100 dark:border-gray-800 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Total Events</p>
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-white mt-1">{{ $totalEvents }}</h3>
                    </div>
                    <div class="flex items-center justify-center size-12 rounded-lg bg-primary/10">
                        <span class="material-symbols-outlined text-primary text-xl">event</span>
                    </div>
                </div>
                <div class="mt-3 text-xs text-gray-500 dark:text-gray-400">All time events</div>
            </div>

            <div class="bg-white dark:bg-surface-dark rounded-xl p-4 border border-gray-100 dark:border-gray-800 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Upcoming</p>
                        <h3 class="text-2xl font-bold text-emerald-600 dark:text-emerald-400 mt-1">{{ $upcomingEvents }}</h3>
                    </div>
                    <div class="flex items-center justify-center size-12 rounded-lg bg-emerald-100 dark:bg-emerald-900/20">
                        <span class="material-symbols-outlined text-emerald-600 dark:text-emerald-400 text-xl">upcoming</span>
                    </div>
                </div>
                <div class="mt-3 text-xs text-gray-500 dark:text-gray-400">Next 30 days</div>
            </div>

            <div class="bg-white dark:bg-surface-dark rounded-xl p-4 border border-gray-100 dark:border-gray-800 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Public Events</p>
                        <h3 class="text-2xl font-bold text-blue-600 dark:text-blue-400 mt-1">{{ $publicEvents }}</h3>
                    </div>
                    <div class="flex items-center justify-center size-12 rounded-lg bg-blue-100 dark:bg-blue-900/20">
                        <span class="material-symbols-outlined text-blue-600 dark:text-blue-400 text-xl">public</span>
                    </div>
                </div>
                <div class="mt-3 text-xs text-gray-500 dark:text-gray-400">Open to all</div>
            </div>

            <div class="bg-white dark:bg-surface-dark rounded-xl p-4 border border-gray-100 dark:border-gray-800 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">This Month</p>
                        <h3 class="text-2xl font-bold text-amber-600 dark:text-amber-400 mt-1">{{ $thisMonthEvents }}</h3>
                    </div>
                    <div class="flex items-center justify-center size-12 rounded-lg bg-amber-100 dark:bg-amber-900/20">
                        <span class="material-symbols-outlined text-amber-600 dark:text-amber-400 text-xl">calendar_month</span>
                    </div>
                </div>
                <div class="mt-3 text-xs text-gray-500 dark:text-gray-400">{{ now()->format('F') }} events</div>
            </div>
        </div>
    </div>

    <!-- Calendar & Events Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 p-4">
        <!-- Calendar Section -->
        <!-- Calendar Section -->
<div class="lg:col-span-2">
    <div class="bg-white dark:bg-surface-dark rounded-2xl border border-gray-100 dark:border-gray-800 shadow-sm overflow-hidden">
        <!-- Calendar Header with Navigation -->
        <div class="p-6 border-b border-gray-100 dark:border-gray-800">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-xl font-bold text-gray-900 dark:text-white">{{ $selectedDate->format('F Y') }}</h2>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Click on a date to view events</p>
                </div>
                <div class="flex items-center gap-2">
                    <!-- Today Button -->
                    <a href="{{ route('admin.events.index') }}" 
                       class="flex items-center justify-center size-10 rounded-full hover:bg-gray-100 dark:hover:bg-white/5 transition-colors">
                        <span class="material-symbols-outlined text-gray-600 dark:text-gray-400">today</span>
                    </a>
                    
                    <!-- Previous Month -->
@php
    $prevMonth = $selectedDate->copy()->subMonth();
@endphp
<a href="{{ route('admin.events.index', ['month' => (int)$prevMonth->month, 'year' => (int)$prevMonth->year]) }}" 
   class="flex items-center justify-center size-10 rounded-full hover:bg-gray-100 dark:hover:bg-white/5 transition-colors">
    <span class="material-symbols-outlined text-gray-600 dark:text-gray-400">chevron_left</span>
</a>

<!-- Next Month -->
@php
    $nextMonth = $selectedDate->copy()->addMonth();
@endphp
<a href="{{ route('admin.events.index', ['month' => (int)$nextMonth->month, 'year' => (int)$nextMonth->year]) }}" 
   class="flex items-center justify-center size-10 rounded-full hover:bg-gray-100 dark:hover:bg-white/5 transition-colors">
    <span class="material-symbols-outlined text-gray-600 dark:text-gray-400">chevron_right</span>
</a>
                </div>
            </div>

            <!-- Days of Week -->
            <div class="grid grid-cols-7 gap-1 mt-6">
                @foreach(['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'] as $day)
                    <div class="text-center py-2">
                        <span class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase">{{ $day }}</span>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Calendar Grid -->
<div class="p-4">
    <div class="grid grid-cols-7 gap-1">
        @php
            // Get first day of the month and find the start of the week
            $firstDayOfMonth = $selectedDate->copy()->startOfMonth();
            $startDate = $firstDayOfMonth->copy()->startOfWeek();
            
            // Get last day of the month and find the end of the week
            $lastDayOfMonth = $selectedDate->copy()->endOfMonth();
            $endDate = $lastDayOfMonth->copy()->endOfWeek();
            
            $currentDay = $startDate->copy();
            // Use $today passed from controller
        @endphp
        
        @while($currentDay->lte($endDate))
            @php
                $isCurrentMonth = $currentDay->month == $selectedDate->month;
                $isToday = $currentDay->isSameDay($today); // Now using $today
                $isWeekend = $currentDay->isWeekend();
                $dayEvents = $monthEvents->filter(function($event) use ($currentDay) {
                    return $event->start_time->isSameDay($currentDay);
                });
                $hasEvents = $dayEvents->count() > 0;
                $eventCount = $dayEvents->count();
            @endphp
            
            <a href="{{ route('admin.events.index') }}?date={{ $currentDay->format('Y-m-d') }}" 
               class="relative aspect-square flex flex-col items-center justify-center rounded-lg transition-all duration-200
                      {{ $isToday ? 'bg-primary text-white' : 
                         ($isCurrentMonth ? 'hover:bg-gray-50 dark:hover:bg-white/5' : 'opacity-40') }}
                      {{ $isWeekend && !$isToday ? 'text-gray-500 dark:text-gray-400' : '' }}">
                
                <span class="text-sm font-medium {{ $isToday ? 'text-white' : 
                    ($isCurrentMonth ? 'text-gray-900 dark:text-white' : 'text-gray-400 dark:text-gray-500') }}">
                    {{ $currentDay->format('j') }}
                </span>
                
                @if($hasEvents)
                    <div class="mt-1 flex items-center justify-center gap-0.5">
                        @foreach($dayEvents->take(3) as $event)
                            <div class="size-1.5 rounded-full 
                                {{ $isToday ? 'bg-white/80' : 
                                   ($event->event_type == 'service' ? 'bg-primary' :
                                    ($event->event_type == 'meeting' ? 'bg-blue-500' :
                                    ($event->event_type == 'conference' ? 'bg-purple-500' : 'bg-amber-500'))) }}">
                            </div>
                        @endforeach
                        @if($eventCount > 3)
                            <span class="text-[8px] {{ $isToday ? 'text-white/80' : 'text-gray-400' }}">+{{ $eventCount - 3 }}</span>
                        @endif
                    </div>
                @endif
                
                @if($isToday)
                    <div class="absolute inset-0 border-2 border-primary rounded-lg"></div>
                @endif
            </a>
            
            @php
                $currentDay->addDay();
            @endphp
        @endwhile
    </div>
</div>
    </div>
</div>

    <!-- All Events Sidebar -->
<div class="lg:col-span-1">
    <div class="bg-white dark:bg-surface-dark rounded-2xl border border-gray-100 dark:border-gray-800 shadow-sm h-full">
        <div class="p-6 border-b border-gray-100 dark:border-gray-800">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-xl font-bold text-gray-900 dark:text-white">All Events</h2>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Past and upcoming</p>
                </div>
                <div class="flex items-center gap-2">
                    <div class="flex items-center justify-center size-10 rounded-full bg-primary/10">
                        <span class="material-symbols-outlined text-primary text-xl">list</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="p-4">
            <!-- Filter Tabs -->
            <div class="flex border-b border-gray-200 dark:border-gray-700 mb-4">
                <a href="{{ route('admin.events.index', ['filter' => 'all']) }}" 
                   class="flex-1 text-center py-2 text-sm font-medium {{ !request()->has('filter') || request('filter') == 'all' ? 'text-primary border-b-2 border-primary' : 'text-gray-500 hover:text-gray-700 dark:text-gray-400' }}">
                    All
                </a>
                <a href="{{ route('admin.events.index', ['filter' => 'upcoming']) }}" 
                   class="flex-1 text-center py-2 text-sm font-medium {{ request('filter') == 'upcoming' ? 'text-primary border-b-2 border-primary' : 'text-gray-500 hover:text-gray-700 dark:text-gray-400' }}">
                    Upcoming
                </a>
                <a href="{{ route('admin.events.index', ['filter' => 'past']) }}" 
                   class="flex-1 text-center py-2 text-sm font-medium {{ request('filter') == 'past' ? 'text-primary border-b-2 border-primary' : 'text-gray-500 hover:text-gray-700 dark:text-gray-400' }}">
                    Past
                </a>
            </div>

            @if($allEvents->count() > 0)
                <div class="space-y-3 max-h-[500px] overflow-y-auto pr-2">
                    @foreach($allEvents as $event)
                        <a href="{{ route('admin.events.edit', $event) }}" 
                           class="group block p-4 rounded-xl border border-gray-100 dark:border-gray-800 hover:border-primary/30 dark:hover:border-primary/30 bg-white dark:bg-[#1c2620] hover:shadow-md transition-all duration-200">
                            <div class="flex items-start gap-3">
                                <div class="flex-shrink-0">
                                    <div class="flex flex-col items-center justify-center size-12 rounded-lg 
                                        {{ $event->start_time->isPast() ? 'bg-gray-100 dark:bg-gray-800' : 
                                           ($event->event_type == 'service' ? 'bg-primary/10' : 
                                           ($event->event_type == 'meeting' ? 'bg-blue-100 dark:bg-blue-900/20' :
                                           ($event->event_type == 'conference' ? 'bg-purple-100 dark:bg-purple-900/20' : 'bg-amber-100 dark:bg-amber-900/20'))) }}">
                                        <span class="text-xs font-semibold {{ $event->start_time->isPast() ? 'text-gray-500' : 'text-primary' }}">
                                            {{ $event->start_time->format('d') }}
                                        </span>
                                        <span class="text-[10px] text-gray-500">
                                            {{ $event->start_time->format('M') }}
                                        </span>
                                    </div>
                                </div>
                                
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-start justify-between">
                                        <h4 class="text-sm font-semibold text-gray-900 dark:text-white truncate">
                                            {{ $event->title }}
                                        </h4>
                                        <span class="text-xs font-medium {{ $event->start_time->isPast() ? 'text-gray-500' : 'text-primary' }}">
                                            {{ $event->start_time->format('h:i A') }}
                                        </span>
                                    </div>
                                    
                                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1 flex items-center gap-1">
                                        <span class="material-symbols-outlined text-xs">location_on</span>
                                        {{ $event->location }}
                                    </p>
                                    
                                    <div class="flex items-center gap-2 mt-2">
                                        <span class="text-xs px-2 py-1 rounded-full 
                                            {{ $event->is_public ? 'bg-emerald-100 text-emerald-800 dark:bg-emerald-900/30 dark:text-emerald-300' : 'bg-gray-100 text-gray-800 dark:bg-gray-800 dark:text-gray-300' }}">
                                            {{ $event->is_public ? 'Public' : 'Private' }}
                                        </span>
                                        <span class="text-xs px-2 py-1 rounded-full 
                                            {{ $event->event_type == 'service' ? 'bg-primary/10 text-primary' : 
                                               ($event->event_type == 'meeting' ? 'bg-blue-100 text-blue-800 dark:bg-blue-900/20 dark:text-blue-300' :
                                               ($event->event_type == 'conference' ? 'bg-purple-100 text-purple-800 dark:bg-purple-900/20 dark:text-purple-300' : 'bg-amber-100 text-amber-800 dark:bg-amber-900/20 dark:text-amber-300')) }}">
                                            {{ ucfirst($event->event_type) }}
                                        </span>
                                    </div>
                                    
                                    <div class="flex items-center justify-between mt-2">
                                        <span class="text-xs text-gray-500 dark:text-gray-400">
                                            {{ $event->start_time->isPast() ? 'Past event' : 'Upcoming' }}
                                        </span>
                                        @if($event->registrations_count > 0)
                                            <span class="text-xs text-gray-500 dark:text-gray-400">
                                                {{ $event->registrations_count }} registered
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12">
                    <div class="flex items-center justify-center size-16 mx-auto rounded-full bg-gray-100 dark:bg-gray-800">
                        <span class="material-symbols-outlined text-gray-400 text-2xl">event_note</span>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mt-4">No events yet</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">Create your first event to get started</p>
                    <a href="{{ route('admin.events.create') }}" 
                       class="inline-flex items-center gap-2 px-4 py-2 bg-primary text-white rounded-lg mt-4 hover:bg-primary/90 transition-colors">
                        <span class="material-symbols-outlined">add</span>
                        <span>Create event</span>
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
    <!-- Bottom Navigation Spacing -->
    <div class="h-24"></div>
</div>

@push('styles')
<style>
     .scrollbar-thin::-webkit-scrollbar {
        width: 4px;
    }
    
    .scrollbar-thin::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 4px;
    }
    
    .scrollbar-thin::-webkit-scrollbar-thumb {
        background: #197b3b;
        border-radius: 4px;
    }
    
    .scrollbar-thin::-webkit-scrollbar-thumb:hover {
        background: #156530;
    }
    
    .dark .scrollbar-thin::-webkit-scrollbar-track {
        background: #2d3d35;
    }
    
    .dark .scrollbar-thin::-webkit-scrollbar-thumb {
        background: #197b3b;
    }
    
    .line-clamp-2 {
        overflow: hidden;
        display: -webkit-box;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 2;
    }
    .line-clamp-2 {
        overflow: hidden;
        display: -webkit-box;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 2;
    }
    
    .shadow-sm {
        box-shadow: 0 1px 2px 0 rgb(0 0 0 / 0.05);
    }
    
    .shadow-md {
        box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
    }
    
    .shadow-lg {
        box-shadow: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
    }
    
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    .animate-fadeIn {
        animation: fadeIn 0.3s ease-out;
    }
</style>
@endpush

@if(session('success'))
<script>
    setTimeout(() => {
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
        });
        Toast.fire({
            icon: 'success',
            title: '{{ session('success') }}'
        });
    }, 100);
</script>
@endif

@if(session('error'))
<script>
    setTimeout(() => {
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
        });
        Toast.fire({
            icon: 'error',
            title: '{{ session('error') }}'
        });
    }, 100);
</script>
@endif
@endsection