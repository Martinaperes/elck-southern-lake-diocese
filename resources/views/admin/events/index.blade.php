@extends('admin.layouts.app')

@section('content')
<div class="relative flex h-screen w-full flex-col overflow-hidden bg-background-light dark:bg-background-dark">
    <!-- TopAppBar -->
    <header class="flex items-center bg-background-light dark:bg-background-dark p-4 pb-2 justify-between sticky top-0 z-10 border-b border-gray-200 dark:border-gray-800">
        <a href="{{ route('admin.dashboard') }}" class="text-gray-900 dark:text-white flex size-12 shrink-0 items-center justify-start cursor-pointer">
            <span class="material-symbols-outlined">chevron_left</span>
        </a>
        <h2 class="text-gray-900 dark:text-white text-lg font-bold leading-tight tracking-[-0.015em] flex-1 text-center uppercase tracking-widest">Events Calendar</h2>
        <div class="flex w-12 items-center justify-end">
            <button class="flex size-10 cursor-pointer items-center justify-center overflow-hidden rounded-full bg-transparent text-gray-900 dark:text-white">
                <span class="material-symbols-outlined">search</span>
            </button>
        </div>
    </header>

    <!-- Stats Summary -->
    <div class="px-4 py-3">
        <div class="grid grid-cols-4 gap-2">
            <div class="bg-white dark:bg-[#1c2620] rounded-lg p-3 text-center">
                <div class="text-2xl font-bold text-primary">{{ $totalEvents }}</div>
                <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">Total</div>
            </div>
            <div class="bg-white dark:bg-[#1c2620] rounded-lg p-3 text-center">
                <div class="text-2xl font-bold text-emerald-600">{{ $upcomingEvents }}</div>
                <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">Upcoming</div>
            </div>
            <div class="bg-white dark:bg-[#1c2620] rounded-lg p-3 text-center">
                <div class="text-2xl font-bold text-blue-600">{{ $publicEvents }}</div>
                <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">Public</div>
            </div>
            <div class="bg-white dark:bg-[#1c2620] rounded-lg p-3 text-center">
                <div class="text-2xl font-bold text-amber-600">{{ $thisMonthEvents }}</div>
                <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">This Month</div>
            </div>
        </div>
    </div>

    <!-- Calendar Section -->
    <div class="p-4">
        <div class="flex flex-col gap-2">
            <!-- Calendar Header -->
            <div class="flex items-center p-1 justify-between mb-2">
                <button class="text-gray-900 dark:text-white opacity-50 hover:opacity-100">
                    <span class="material-symbols-outlined">chevron_left</span>
                </button>
                <p class="text-gray-900 dark:text-white text-lg font-bold flex-1 text-center">
                    {{ now()->format('F Y') }}
                </p>
                <button class="text-gray-900 dark:text-white opacity-50 hover:opacity-100">
                    <span class="material-symbols-outlined">chevron_right</span>
                </button>
            </div>
            
            <!-- Days of Week -->
            <div class="grid grid-cols-7 gap-1 mb-2">
                <div class="text-primary text-[11px] font-bold uppercase flex h-10 w-full items-center justify-center">S</div>
                <div class="text-primary text-[11px] font-bold uppercase flex h-10 w-full items-center justify-center">M</div>
                <div class="text-primary text-[11px] font-bold uppercase flex h-10 w-full items-center justify-center">T</div>
                <div class="text-primary text-[11px] font-bold uppercase flex h-10 w-full items-center justify-center">W</div>
                <div class="text-primary text-[11px] font-bold uppercase flex h-10 w-full items-center justify-center">T</div>
                <div class="text-primary text-[11px] font-bold uppercase flex h-10 w-full items-center justify-center">F</div>
                <div class="text-primary text-[11px] font-bold uppercase flex h-10 w-full items-center justify-center">S</div>
            </div>
            
            <!-- Calendar Grid -->
            <div class="grid grid-cols-7 gap-1">
                @php
                    $firstDay = now()->startOfMonth()->startOfWeek();
                    $lastDay = now()->endOfMonth()->endOfWeek();
                    $currentDay = $firstDay->copy();
                @endphp
                
                @for($i = 0; $i < 42; $i++)
                    @php
                        $isCurrentMonth = $currentDay->month == now()->month;
                        $isToday = $currentDay->isToday();
                        $dayEvents = $events->filter(function($event) use ($currentDay) {
                            return $event->start_time->format('Y-m-d') == $currentDay->format('Y-m-d');
                        });
                        $hasEvents = $dayEvents->count() > 0;
                    @endphp
                    
                    <a href="{{ route('admin.events.index') }}?date={{ $currentDay->format('Y-m-d') }}" 
                       class="h-12 w-full flex flex-col items-center justify-center relative {{ $isCurrentMonth ? 'text-gray-900 dark:text-white' : 'text-gray-400' }}">
                        @if($isToday)
                            <div class="flex size-9 items-center justify-center rounded-full bg-primary text-white text-sm font-bold shadow-lg shadow-primary/30">
                                {{ $currentDay->format('j') }}
                            </div>
                        @else
                            <span class="text-sm">{{ $currentDay->format('j') }}</span>
                            @if($hasEvents)
                            <div class="absolute bottom-1.5 size-1 rounded-full bg-primary"></div>
                            @endif
                        @endif
                    </a>
                    
                    @php
                        $currentDay->addDay();
                    @endphp
                @endfor
            </div>
        </div>
    </div>

    <div class="w-full h-[1px] bg-gray-200 dark:bg-gray-800 my-2"></div>

    <!-- Today's Events Section -->
    <div class="px-4 pt-4 pb-2">
        <h3 class="text-gray-900 dark:text-white text-lg font-bold leading-tight tracking-[-0.015em]">
            Today's Events - {{ now()->format('M d') }}
        </h3>
        <p class="text-gray-500 text-xs font-medium uppercase tracking-wider mt-1">Today's Schedule</p>
    </div>

    <!-- Events List -->
    <main class="flex-1 overflow-y-auto hide-scrollbar pb-24">
        <div class="space-y-1">
            @php
                $todayEvents = $events->filter(function($event) {
                    return $event->start_time->format('Y-m-d') == now()->format('Y-m-d');
                })->sortBy('start_time');
            @endphp
            
            @forelse($todayEvents as $event)
            <a href="{{ route('admin.events.edit', $event) }}" 
               class="flex gap-4 bg-transparent px-4 py-4 justify-between border-b border-gray-100 dark:border-gray-800 active:bg-gray-800/50 transition-colors">
                <div class="flex items-start gap-4">
                    <div class="text-white flex items-center justify-center rounded-xl 
                        {{ $event->event_type == 'service' ? 'bg-primary' : 'bg-primary/20 text-primary' }} 
                        shrink-0 size-12 shadow-sm">
                        <span class="material-symbols-outlined">
                            @switch($event->event_type)
                                @case('service') event_available @break
                                @case('meeting') groups @break
                                @case('conference') conference_room @break
                                @case('workshop') construction @break
                                @default event
                            @endswitch
                        </span>
                    </div>
                    <div class="flex flex-1 flex-col justify-center">
                        <p class="text-gray-900 dark:text-white text-base font-semibold leading-tight">
                            {{ $event->title }}
                        </p>
                        <div class="flex items-center gap-1 mt-1 text-gray-500 dark:text-[#a0b6a8]">
                            <span class="material-symbols-outlined text-sm">location_on</span>
                            <p class="text-sm font-normal">{{ $event->location }}</p>
                        </div>
                        @if($event->description)
                        <p class="text-gray-500 dark:text-[#a0b6a8]/70 text-xs mt-1 italic">
                            {{ Str::limit($event->description, 50) }}
                        </p>
                        @endif
                    </div>
                </div>
                <div class="shrink-0 flex flex-col items-end">
                    <p class="text-primary text-sm font-bold">{{ $event->start_time->format('h:i A') }}</p>
                    <p class="text-gray-400 text-[10px] uppercase font-bold mt-1">
                        {{ $event->registrations_count ?? $event->registrations->count() }} registered
                    </p>
                </div>
            </a>
            @empty
            <div class="px-4 py-8 text-center">
                <span class="material-symbols-outlined text-gray-400 text-4xl">event_busy</span>
                <p class="text-gray-500 dark:text-gray-400 mt-2">No events scheduled for today</p>
            </div>
            @endforelse
        </div>

        <!-- All Upcoming Events -->
        <div class="px-4 pt-6 pb-2">
            <h3 class="text-gray-900 dark:text-white text-lg font-bold leading-tight tracking-[-0.015em]">
                All Upcoming Events
            </h3>
            <p class="text-gray-500 text-xs font-medium uppercase tracking-wider mt-1">Next 30 days</p>
        </div>

        <div class="space-y-1">
            @php
                $upcomingEventsList = $events->where('start_time', '>=', now())
                                              ->where('start_time', '<=', now()->addDays(30))
                                              ->sortBy('start_time');
            @endphp
            
            @forelse($upcomingEventsList as $event)
            <a href="{{ route('admin.events.edit', $event) }}" 
               class="flex gap-4 bg-transparent px-4 py-4 justify-between border-b border-gray-100 dark:border-gray-800 active:bg-gray-800/50 transition-colors">
                <div class="flex items-start gap-4">
                    <div class="text-primary flex flex-col items-center justify-center shrink-0 size-12">
                        <span class="text-lg font-bold">{{ $event->start_time->format('d') }}</span>
                        <span class="text-[10px] uppercase">{{ $event->start_time->format('M') }}</span>
                    </div>
                    <div class="flex flex-1 flex-col justify-center">
                        <p class="text-gray-900 dark:text-white text-base font-semibold leading-tight">
                            {{ $event->title }}
                        </p>
                        <div class="flex items-center gap-2 mt-1">
                            <span class="text-xs px-2 py-0.5 rounded-full 
                                {{ $event->is_public ? 'bg-emerald-100 text-emerald-800' : 'bg-gray-100 text-gray-800' }}">
                                {{ $event->is_public ? 'Public' : 'Private' }}
                            </span>
                            <span class="text-xs px-2 py-0.5 rounded-full bg-primary/10 text-primary">
                                {{ ucfirst($event->event_type) }}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="shrink-0 flex flex-col items-end justify-center">
                    <p class="text-primary text-sm font-bold">{{ $event->start_time->format('h:i A') }}</p>
                </div>
            </a>
            @empty
            <div class="px-4 py-8 text-center">
                <span class="material-symbols-outlined text-gray-400 text-4xl">calendar_today</span>
                <p class="text-gray-500 dark:text-gray-400 mt-2">No upcoming events</p>
            </div>
            @endforelse
        </div>
    </main>

    <!-- Floating Action Button -->
    <a href="{{ route('admin.events.create') }}" 
       class="absolute bottom-24 right-6 size-14 bg-primary text-white rounded-full shadow-2xl shadow-primary/50 flex items-center justify-center z-20 active:scale-95 transition-transform">
        <span class="material-symbols-outlined text-3xl">add</span>
    </a>

    <!-- iOS Bottom Tab Bar -->
    <nav class="absolute bottom-0 w-full bg-white dark:bg-[#0a120d] border-t border-gray-200 dark:border-gray-800 flex justify-around items-center px-4 pb-8 pt-3 z-30">
        <a href="{{ route('admin.dashboard') }}" class="flex flex-col items-center gap-1 cursor-pointer opacity-40 hover:opacity-100">
            <span class="material-symbols-outlined">dashboard</span>
            <span class="text-[10px] font-bold uppercase">Dashboard</span>
        </a>
        <div class="flex flex-col items-center gap-1 cursor-pointer text-primary">
            <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1">calendar_month</span>
            <span class="text-[10px] font-bold uppercase">Calendar</span>
        </div>
        <a href="{{ route('admin.members.index') }}" class="flex flex-col items-center gap-1 cursor-pointer opacity-40 hover:opacity-100">
            <span class="material-symbols-outlined">group</span>
            <span class="text-[10px] font-bold uppercase">Members</span>
        </a>
        <a href="#" class="flex flex-col items-center gap-1 cursor-pointer opacity-40 hover:opacity-100">
            <span class="material-symbols-outlined">settings</span>
            <span class="text-[10px] font-bold uppercase">Settings</span>
        </a>
    </nav>

    <!-- iOS Home Indicator -->
    <div class="absolute bottom-2 left-1/2 -translate-x-1/2 w-32 h-1 bg-gray-300 dark:bg-gray-700 rounded-full z-40"></div>
</div>

@if(session('success'))
<script>
    setTimeout(() => {
        alert('{{ session('success') }}');
    }, 100);
</script>
@endif

@if(session('error'))
<script>
    setTimeout(() => {
        alert('{{ session('error') }}');
    }, 100);
</script>
@endif

@push('styles')
<style>
    .hide-scrollbar::-webkit-scrollbar {
        display: none;
    }
    .hide-scrollbar {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
    .material-symbols-outlined {
        font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
    }
</style>
@endpush
@endsection