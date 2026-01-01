{{-- resources/views/events/index.blade.php --}}
@extends('layouts.app')

@section('content')
<main class="flex-grow">
    <div class="max-w-[1440px] mx-auto px-3 sm:px-4 md:px-6 lg:px-8 py-4 sm:py-6 lg:py-8 xl:py-12">
        {{-- Mobile Search Bar (Hidden on desktop) --}}
        <div class="lg:hidden mb-6">
            <div class="relative">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-text-secondary-light dark:text-text-secondary-dark">
                    <span class="material-symbols-outlined text-xl">search</span>
                </span>
                <input class="w-full py-3 pl-10 pr-4 text-sm text-text-main-light dark:text-text-main-dark bg-background-light dark:bg-surface-dark border border-border-light dark:border-border-dark rounded-lg focus:outline-none focus:ring-2 focus:ring-[#197b3b] focus:border-transparent placeholder-text-secondary-light dark:placeholder-text-secondary-dark sans-text" 
                       placeholder="Search events..." type="text"/>
            </div>
        </div>

        {{-- Header Section --}}
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 sm:gap-6 mb-6 sm:mb-8 lg:mb-10">
            <div class="max-w-2xl">
                <h1 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-black text-text-main-light dark:text-text-main-dark tracking-tight mb-2 sm:mb-3">Diocesan Events & Gatherings</h1>
                <p class="text-sm sm:text-base lg:text-lg text-text-secondary-light dark:text-text-secondary-dark leading-relaxed sans-text">
                    Join us in worship and community service to strengthen our faith together.
                </p>
            </div>
            <div class="flex flex-col sm:flex-row gap-2 sm:gap-3 shrink-0 mt-4 sm:mt-0">
                
            </div>
        </div>

        {{-- Mobile Filter Toggle --}}
        <div class="lg:hidden mb-6">
            <button id="filterToggle" class="w-full flex items-center justify-between p-4 bg-surface-light dark:bg-surface-dark rounded-xl border border-border-light dark:border-border-dark shadow-sm">
                <span class="flex items-center gap-2 text-text-main-light dark:text-text-main-dark font-medium sans-text">
                    <span class="material-symbols-outlined text-[#197b3b]">filter_list</span>
                    Filters & Highlights
                </span>
                <span class="material-symbols-outlined text-text-secondary-light dark:text-text-secondary-dark" id="filterToggleIcon">
                    expand_more
                </span>
            </button>
        </div>

        {{-- Main Content Grid --}}
        <div class="lg:grid lg:grid-cols-12 gap-6 lg:gap-8">
            {{-- Left Sidebar - 3 columns (Hidden on mobile, shown when toggled) --}}
            <aside id="sidebar" class="hidden lg:block lg:col-span-3 space-y-6 lg:space-y-8">
                {{-- Filter by Ministry --}}
                <div class="bg-surface-light dark:bg-surface-dark rounded-xl border border-border-light dark:border-border-dark p-4 sm:p-5 shadow-sm">
                    <h3 class="text-base sm:text-lg font-bold text-text-main-light dark:text-text-main-dark mb-3 sm:mb-4 flex items-center gap-2">
                        <span class="material-symbols-outlined text-[#197b3b]">filter_list</span>
                        Filter by Ministry
                    </h3>
                    <div class="space-y-2 sm:space-y-3 sans-text">
                        @foreach($ministries as $ministry)
                            <label class="flex items-center gap-2 sm:gap-3 cursor-pointer group">
                                <input class="ministry-filter size-4 sm:size-5 rounded border-stone-300 text-[#197b3b] focus:ring-[#197b3b] cursor-pointer transition-colors" 
                                       type="checkbox" 
                                       value="{{ $ministry->id }}"
                                       id="ministry_{{ $ministry->id }}"
                                       @if(in_array($ministry->id, $ministryFilters)) checked @endif>
                                <span class="text-sm sm:text-base text-text-main-light dark:text-text-main-dark group-hover:text-[#197b3b] transition-colors">
                                    {{ $ministry->name }}
                                </span>
                            </label>
                        @endforeach
                    </div>

                    {{-- Quick Stats --}}
                    <div class="mt-4 sm:mt-6 pt-4 sm:pt-6 border-t border-border-light dark:border-border-dark">
                        <div class="grid grid-cols-2 gap-3 sm:gap-4">
                            <div class="text-center p-2 sm:p-3 bg-emerald-50 dark:bg-emerald-900/20 rounded-lg">
                                <div class="text-xl sm:text-2xl font-bold text-[#197b3b] dark:text-emerald-300">{{ $totalEvents }}</div>
                                <div class="text-xs text-text-secondary-light dark:text-text-secondary-dark mt-1">This Month</div>
                            </div>
                            <div class="text-center p-2 sm:p-3 bg-amber-50 dark:bg-amber-900/20 rounded-lg">
                                <div class="text-xl sm:text-2xl font-bold text-amber-600 dark:text-amber-300">{{ $thisWeekEvents }}</div>
                                <div class="text-xs text-text-secondary-light dark:text-text-secondary-dark mt-1">This Week</div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Upcoming Highlights --}}
                <div class="bg-surface-light dark:bg-surface-dark rounded-xl border border-border-light dark:border-border-dark p-4 sm:p-5 shadow-sm">
                    <div class="flex items-center justify-between mb-3 sm:mb-4">
                        <h3 class="text-base sm:text-lg font-bold text-text-main-light dark:text-text-main-dark">Upcoming Highlights</h3>
                        <span class="text-xs font-medium px-2 py-1 rounded-full bg-[#197b3b] text-white">
                            {{ $featuredEvents->count() }}
                        </span>
                    </div>
                    <div class="space-y-4">
                        @foreach($featuredEvents as $event)
                            <div class="group cursor-pointer" onclick="showEventModal('{{ route('events.modal', $event) }}')">
                                <div class="relative rounded-lg overflow-hidden mb-2 sm:mb-3">
                                    @if($event->poster_url)
                                        <img alt="{{ $event->title }}" 
                                             class="w-full h-32 sm:h-40 object-cover group-hover:scale-105 transition-transform duration-300" 
                                             src="{{ $event->poster_url }}">
                                    @else
                                        <div class="w-full h-32 sm:h-40 bg-gradient-to-br from-emerald-500 to-[#197b3b] flex items-center justify-center">
                                            <span class="material-symbols-outlined text-4xl sm:text-5xl text-white/80">
                                                {{ $event->event_type === 'service' ? 'church' : 
                                                   ($event->event_type === 'meeting' ? 'groups' : 
                                                   ($event->event_type === 'outreach' ? 'volunteer_activism' : 'event')) }}
                                            </span>
                                        </div>
                                    @endif
                                    <div class="absolute top-2 left-2 sm:top-3 sm:left-3 bg-white/95 dark:bg-gray-900/95 backdrop-blur-sm px-2 py-1 sm:px-3 sm:py-1.5 rounded-lg shadow-sm">
                                        <div class="text-xs sm:text-sm font-bold text-[#197b3b]">{{ $event->start_time->format('M') }}</div>
                                        <div class="text-lg sm:text-xl font-black text-gray-900 dark:text-white">{{ $event->start_time->format('d') }}</div>
                                    </div>
                                </div>
                                <h4 class="text-sm sm:text-base font-bold text-text-main-light dark:text-text-main-dark leading-tight group-hover:text-[#197b3b] transition-colors mb-1 sm:mb-2">
                                    {{ Str::limit($event->title, 40) }}
                                </h4>
                                <div class="flex items-center text-xs sm:text-sm text-text-secondary-light dark:text-text-secondary-dark sans-text mb-1">
                                    <span class="material-symbols-outlined text-xs sm:text-base mr-1">schedule</span>
                                    <span>{{ $event->start_time->format('g:i A') }}</span>
                                </div>
                            </div>
                            @if(!$loop->last)
                                <hr class="border-border-light dark:border-border-dark">
                            @endif
                        @endforeach

                        @if($featuredEvents->isEmpty())
                            <div class="text-center py-4">
                                <div class="w-12 h-12 sm:w-16 sm:h-16 mx-auto mb-3 sm:mb-4 rounded-full bg-emerald-100 dark:bg-emerald-900/30 flex items-center justify-center">
                                    <span class="material-symbols-outlined text-xl sm:text-2xl text-emerald-600 dark:text-emerald-400">
                                        calendar_today
                                    </span>
                                </div>
                                <p class="text-sm text-text-secondary-light dark:text-text-secondary-dark sans-text">
                                    No upcoming events
                                </p>
                            </div>
                        @endif
                    </div>
                </div>
            </aside>

            {{-- Main Content - 9 columns --}}
            <div class="lg:col-span-9 flex flex-col gap-4 sm:gap-6">
                {{-- Calendar Navigation --}}
                <div class="bg-surface-light dark:bg-surface-dark p-3 sm:p-4 rounded-xl border border-border-light dark:border-border-dark shadow-sm flex flex-col sm:flex-row items-center justify-between gap-3 sm:gap-4">
                    <div class="flex items-center gap-2 sm:gap-4 w-full justify-between sm:justify-start">
                        <a href="{{ route('events.index', array_merge(request()->except('month'), ['month' => $currentMonth->copy()->subMonth()->format('Y-m')])) }}" 
                           class="p-1.5 sm:p-2 hover:bg-emerald-50 dark:hover:bg-emerald-900/10 rounded-lg text-text-main-light dark:text-text-main-dark transition-colors">
                            
                        <h2 class="text-lg sm:text-xl font-bold text-text-main-light dark:text-text-main-dark text-center min-w-[120px] sm:min-w-[140px]">
                            {{ $currentMonth->format('F Y') }}
                        </h2>
                        <a href="{{ route('events.index', array_merge(request()->except('month'), ['month' => $currentMonth->copy()->addMonth()->format('Y-m')])) }}" 
                           class="p-1.5 sm:p-2 hover:bg-emerald-50 dark:hover:bg-emerald-900/10 rounded-lg text-text-main-light dark:text-text-main-dark transition-colors">
                            
                        </a>
                    </div>
                    <div class="flex items-center gap-1 sm:gap-2 w-full sm:w-auto">
                        <button class="px-3 py-1.5 sm:px-4 sm:py-2 text-xs sm:text-sm font-medium bg-[#197b3b] text-white rounded-lg shadow-sm hover:bg-[#146330] transition-colors flex-1 sm:flex-none">
                            Month
                        </button>
                        <button class="px-3 py-1.5 sm:px-4 sm:py-2 text-xs sm:text-sm font-medium bg-background-light dark:bg-surface-dark text-text-secondary-light dark:text-text-secondary-dark border border-border-light dark:border-border-dark hover:bg-emerald-50 dark:hover:bg-emerald-900/10 rounded-lg transition-colors flex-1 sm:flex-none">
                            Week
                        </button>
                        <button class="px-3 py-1.5 sm:px-4 sm:py-2 text-xs sm:text-sm font-medium bg-background-light dark:bg-surface-dark text-text-secondary-light dark:text-text-secondary-dark border border-border-light dark:border-border-dark hover:bg-emerald-50 dark:hover:bg-emerald-900/10 rounded-lg transition-colors flex-1 sm:flex-none">
                            List
                        </button>
                    </div>
                </div>

                {{-- Calendar Grid --}}
                <div class="bg-surface-light dark:bg-surface-dark rounded-xl border border-border-light dark:border-border-dark shadow-sm overflow-hidden flex-grow flex flex-col">
                    {{-- Calendar Headers --}}
                    <div class="grid grid-cols-7 border-b border-border-light dark:border-border-dark bg-emerald-50/50 dark:bg-emerald-900/10">
                        @foreach(['S', 'M', 'T', 'W', 'T', 'F', 'S'] as $day)
                            <div class="py-2 sm:py-3 text-center text-xs font-bold uppercase tracking-wider text-text-secondary-light dark:text-text-secondary-dark">
                                {{ $day }}
                            </div>
                        @endforeach
                    </div>

                    {{-- Calendar Days --}}
                    <div class="grid grid-cols-7 auto-rows-fr bg-border-light dark:bg-border-dark gap-[1px]">
                        @foreach($calendar as $week)
                            @foreach($week as $day)
                                <div class="min-h-[80px] sm:min-h-[100px] lg:min-h-[120px] {{ $day['is_current_month'] ? 'bg-surface-light dark:bg-surface-dark' : 'bg-emerald-50/30 dark:bg-surface-dark/50' }} p-1 sm:p-2 flex flex-col gap-0.5 sm:gap-1 hover:bg-emerald-50 dark:hover:bg-emerald-900/10 transition-colors group relative">
                                    {{-- Day Number --}}
                                    @if($day['date'] == now()->format('Y-m-d'))
                                        <span class="absolute top-1 right-1 sm:top-2 sm:right-2 text-white bg-[#197b3b] font-bold text-xs sm:text-sm size-5 sm:size-6 lg:size-7 flex items-center justify-center rounded-full shadow-md z-10">
                                            {{ $day['day'] }}
                                        </span>
                                    @else
                                        <span class="absolute top-1 right-1 sm:top-2 sm:right-2 text-text-main-light dark:text-text-main-dark font-medium text-xs sm:text-sm size-5 sm:size-6 lg:size-7 flex items-center justify-center rounded-full group-hover:bg-emerald-100 dark:group-hover:bg-emerald-900/20 group-hover:text-[#197b3b] {{ !$day['is_current_month'] ? 'text-text-secondary-light/40 dark:text-text-secondary-dark/40' : '' }}">
                                            {{ $day['day'] }}
                                        </span>
                                    @endif

                                    {{-- Events for this day --}}
                                    <div class="mt-4 sm:mt-5 lg:mt-8 space-y-0.5 sm:space-y-1">
                                        @if(isset($eventsByDate[$day['date']]))
                                            @foreach($eventsByDate[$day['date']] as $event)
                                                @php
                                                    $colors = [
                                                        'service' => ['bg' => 'amber', 'text' => 'amber', 'border' => 'amber-500'],
                                                        'meeting' => ['bg' => 'teal', 'text' => 'teal', 'border' => 'teal-500'],
                                                        'conference' => ['bg' => 'blue', 'text' => 'blue', 'border' => 'blue-500'],
                                                        'workshop' => ['bg' => 'purple', 'text' => 'purple', 'border' => 'purple-500'],
                                                        'outreach' => ['bg' => 'indigo', 'text' => 'indigo', 'border' => 'indigo-500'],
                                                        'special' => ['bg' => 'rose', 'text' => 'rose', 'border' => 'rose-500'],
                                                        'retreat' => ['bg' => 'emerald', 'text' => 'emerald', 'border' => 'emerald-500'],
                                                        'training' => ['bg' => 'cyan', 'text' => 'cyan', 'border' => 'cyan-500'],
                                                    ];
                                                    $color = $colors[$event->event_type] ?? ['bg' => 'emerald', 'text' => 'emerald', 'border' => 'emerald-500'];
                                                @endphp
                                                
                                                <button class="event-button w-full text-left bg-{{ $color['bg'] }}-50 dark:bg-{{ $color['bg'] }}-900/30 text-{{ $color['text'] }}-700 dark:text-{{ $color['text'] }}-300 text-[10px] xs:text-xs px-1.5 py-0.5 sm:px-2 sm:py-1 rounded truncate border-l-2 sm:border-l-3 border-{{ $color['border'] }} sans-text font-medium hover:bg-{{ $color['bg'] }}-100 dark:hover:bg-{{ $color['bg'] }}-900/40 transition-colors"
                                                        onclick="showEventModal('{{ route('events.modal', $event) }}')"
                                                        data-bs-toggle="tooltip"
                                                        title="{{ $event->title }} ({{ $event->start_time->format('g:i A') }})">
                                                    <div class="flex items-center gap-0.5 sm:gap-1">
                                                        <span class="material-symbols-outlined text-[10px] sm:text-xs">
                                                            {{ $event->event_type === 'service' ? 'church' : 
                                                               ($event->event_type === 'meeting' ? 'groups' : 
                                                               ($event->event_type === 'outreach' ? 'volunteer_activism' : 'event')) }}
                                                        </span>
                                                        <span class="truncate">{{ Str::limit($event->title, 8) }}</span>
                                                    </div>
                                                </button>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        @endforeach
                    </div>
                </div>

                {{-- Event Legend (Hidden on small mobile, shown on tablet+) --}}
                <div class="hidden sm:block bg-surface-light dark:bg-surface-dark rounded-xl border border-border-light dark:border-border-dark p-3 sm:p-4 shadow-sm">
                    <h4 class="text-xs sm:text-sm font-bold text-text-main-light dark:text-text-main-dark mb-2 sm:mb-3 sans-text">Event Legend</h4>
                    <div class="flex flex-wrap gap-2 sm:gap-3">
                        @foreach($eventTypes as $key => $type)
                            @php
                                $legendColors = [
                                    'service' => 'bg-amber-500',
                                    'meeting' => 'bg-teal-500',
                                    'conference' => 'bg-blue-500',
                                    'workshop' => 'bg-purple-500',
                                    'outreach' => 'bg-indigo-500',
                                    'special' => 'bg-rose-500',
                                    'retreat' => 'bg-emerald-500',
                                    'training' => 'bg-cyan-500',
                                ];
                                $colorClass = $legendColors[$key] ?? 'bg-emerald-500';
                            @endphp
                            <div class="flex items-center gap-1 sm:gap-2">
                                <div class="w-2 h-2 sm:w-3 sm:h-3 rounded-full {{ $colorClass }}"></div>
                                <span class="text-xs text-text-secondary-light dark:text-text-secondary-dark sans-text">{{ Str::limit($type, 12) }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        {{-- All Events This Month --}}
        @if($monthEvents->count() > 0)
            <div class="mt-8 sm:mt-10 lg:mt-12">
                <div class="flex items-center justify-between mb-4 sm:mb-6">
                    <h3 class="text-lg sm:text-xl lg:text-2xl font-bold text-text-main-light dark:text-text-main-dark">
                        Events This Month
                    </h3>
                    <div class="text-xs sm:text-sm text-text-secondary-light dark:text-text-secondary-dark sans-text">
                        <span class="font-medium text-[#197b3b]">{{ $monthEvents->total() }}</span> total
                    </div>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
                    @foreach($monthEvents as $event)
                        @php
                            $eventColorClasses = [
                                'service' => 'border-l-4 border-amber-500',
                                'meeting' => 'border-l-4 border-teal-500',
                                'conference' => 'border-l-4 border-blue-500',
                                'workshop' => 'border-l-4 border-purple-500',
                                'outreach' => 'border-l-4 border-indigo-500',
                                'special' => 'border-l-4 border-rose-500',
                                'retreat' => 'border-l-4 border-emerald-500',
                                'training' => 'border-l-4 border-cyan-500',
                            ];
                            $borderClass = $eventColorClasses[$event->event_type] ?? 'border-l-4 border-emerald-500';
                        @endphp
                        
                        <div class="bg-surface-light dark:bg-surface-dark rounded-xl border border-border-light dark:border-border-dark p-4 shadow-sm hover:shadow-md transition-shadow {{ $borderClass }} hover:translate-y-[-2px] transition-transform">
                            <div class="flex justify-between items-start mb-3">
                                <span class="px-2 py-1 bg-emerald-100 dark:bg-emerald-900/30 text-emerald-800 dark:text-emerald-300 text-xs font-medium rounded-full sans-text">
                                    {{ Str::limit($event->ministry->name ?? 'General', 12) }}
                                </span>
                                <div class="flex items-center gap-1 text-xs sm:text-sm text-text-secondary-light dark:text-text-secondary-dark sans-text">
                                    <span class="material-symbols-outlined text-sm">calendar_month</span>
                                    <span>{{ $event->start_time->format('M d') }}</span>
                                </div>
                            </div>
                            <h4 class="text-base sm:text-lg font-bold text-text-main-light dark:text-text-main-dark mb-2 sm:mb-3">
                                {{ Str::limit($event->title, 40) }}
                            </h4>
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-2">
                                    <div class="flex items-center gap-1 text-xs sm:text-sm text-text-secondary-light dark:text-text-secondary-dark sans-text">
                                        <span class="material-symbols-outlined text-sm">schedule</span>
                                        <span>{{ $event->start_time->format('g:i A') }}</span>
                                    </div>
                                </div>
                                <button class="px-2 py-1 sm:px-3 sm:py-1.5 text-xs sm:text-sm font-medium text-[#197b3b] hover:text-[#146330] hover:bg-emerald-50 dark:hover:bg-emerald-900/10 rounded-lg transition-colors sans-text"
                                        onclick="showEventModal('{{ route('events.modal', $event) }}')">
                                    Details
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>

                @if($monthEvents->hasPages())
                    <div class="mt-6 sm:mt-8 flex justify-center">
                        {{ $monthEvents->onEachSide(1)->links('pagination::tailwind') }}
                    </div>
                @endif
            </div>
        @endif
    </div>
</main>

<!-- Event Modal -->
<div class="modal fade" id="eventModal" tabindex="-1" aria-labelledby="eventModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body p-0" id="eventModalContent">
                <!-- Content loaded via AJAX -->
            </div>
        </div>
    </div>
</div>

@endsection

@push('styles')
<style>
    /* Add to your main CSS file or in a style tag */
:root {
    --primary-color: #197b3b;
    --primary-hover: #146330;
    --primary-light: #e8f5e9;
    --amber-50: #fffbeb;
    --amber-500: #f59e0b;
    --teal-50: #f0fdfa;
    --teal-500: #14b8a6;
    --blue-50: #eff6ff;
    --blue-500: #3b82f6;
    --purple-50: #faf5ff;
    --purple-500: #8b5cf6;
    --indigo-50: #eef2ff;
    --indigo-500: #6366f1;
    --rose-50: #fff1f2;
    --rose-500: #f43f5e;
    --emerald-50: #ecfdf5;
    --emerald-500: #10b981;
    --cyan-50: #ecfeff;
    --cyan-500: #06b6d4;
}

/* For dark mode */
.dark {
    --amber-900: #78350f;
    --teal-900: #134e4a;
    --blue-900: #1e3a8a;
    --purple-900: #4c1d95;
    --indigo-900: #312e81;
    --rose-900: #881337;
    --emerald-900: #064e3b;
    --cyan-900: #164e63;
}
    .sans-text {
        font-family: "Noto Sans", sans-serif;
    }
    
    .event-button {
        transition: all 0.2s;
    }
    
    .event-button:hover {
        transform: translateX(2px);
        opacity: 0.9;
    }
    
    /* Responsive calendar heights */
    @media (max-width: 640px) {
        .min-h-\[80px\] {
            min-height: 80px;
        }
    }
    
    @media (min-width: 641px) and (max-width: 1024px) {
        .min-h-\[100px\] {
            min-height: 100px;
        }
    }
    
    /* Mobile sidebar animation */
    #sidebar {
        transition: all 0.3s ease;
    }
    
    #sidebar.active {
        display: block;
        animation: slideDown 0.3s ease;
    }
    
    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    /* Better touch targets */
    @media (max-width: 640px) {
        button, a, input, select {
            min-height: 44px;
            min-width: 44px;
        }
        
        .material-symbols-outlined {
            font-size: 20px !important;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });

        // Mobile filter toggle
        const filterToggle = document.getElementById('filterToggle');
        const sidebar = document.getElementById('sidebar');
        const filterToggleIcon = document.getElementById('filterToggleIcon');
        
        if (filterToggle && sidebar) {
            filterToggle.addEventListener('click', function() {
                sidebar.classList.toggle('active');
                sidebar.classList.toggle('hidden');
                
                if (sidebar.classList.contains('active')) {
                    filterToggleIcon.textContent = 'expand_less';
                } else {
                    filterToggleIcon.textContent = 'expand_more';
                }
            });
        }

        // Ministry filter functionality
        const ministryFilters = document.querySelectorAll('.ministry-filter');
        
        function updateFilters() {
            const selectedMinistries = Array.from(ministryFilters)
                .filter(cb => cb.checked)
                .map(cb => cb.value);
            
            let params = new URLSearchParams(window.location.search);
            
            if (selectedMinistries.length > 0) {
                params.set('ministry', selectedMinistries.join(','));
            } else {
                params.delete('ministry');
            }
            
            // Keep month parameter if exists
            const month = params.get('month');
            if (!month) {
                params.delete('month');
            }
            
            window.location.href = '{{ route("events.index") }}?' + params.toString();
        }
        
        ministryFilters.forEach(filter => {
            filter.addEventListener('change', updateFilters);
        });

        // Mobile event button handling
        document.querySelectorAll('.event-button').forEach(button => {
            button.addEventListener('touchstart', function() {
                this.classList.add('active');
            });
            
            button.addEventListener('touchend', function() {
                this.classList.remove('active');
            });
        });

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(event) {
            if (window.innerWidth < 1024) {
                const sidebar = document.getElementById('sidebar');
                const filterToggle = document.getElementById('filterToggle');
                
                if (sidebar && sidebar.classList.contains('active') && 
                    !sidebar.contains(event.target) && 
                    !filterToggle.contains(event.target)) {
                    sidebar.classList.remove('active');
                    sidebar.classList.add('hidden');
                    document.getElementById('filterToggleIcon').textContent = 'expand_more';
                }
            }
        });
    });

    function showEventModal(url) {
        fetch(url)
            .then(response => response.text())
            .then(html => {
                document.getElementById('eventModalContent').innerHTML = html;
                const eventModal = new bootstrap.Modal(document.getElementById('eventModal'));
                eventModal.show();
                
                // Handle registration form submission
                const registrationForm = document.getElementById('eventRegistrationForm');
                if (registrationForm) {
                    registrationForm.addEventListener('submit', function(e) {
                        e.preventDefault();
                        
                        fetch(this.action, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            },
                            body: JSON.stringify({
                                number_of_guests: this.querySelector('[name="number_of_guests"]').value,
                                special_requirements: this.querySelector('[name="special_requirements"]').value
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                alert('Registration successful!');
                                bootstrap.Modal.getInstance(document.getElementById('eventModal')).hide();
                            }
                        });
                    });
                }
            });
    }

    // Handle window resize
    window.addEventListener('resize', function() {
        const sidebar = document.getElementById('sidebar');
        if (window.innerWidth >= 1024 && sidebar) {
            sidebar.classList.remove('hidden');
            sidebar.classList.remove('active');
        } else if (window.innerWidth < 1024 && sidebar && !sidebar.classList.contains('active')) {
            sidebar.classList.add('hidden');
        }
    });
</script>
@endpush