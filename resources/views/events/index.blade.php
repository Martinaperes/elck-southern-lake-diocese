{{-- resources/views/events/index.blade.php --}}
@extends('layouts.app')

@section('content')
<main class="flex-grow">
    <!-- Hero Section with Background Pattern -->
    <div class="relative overflow-hidden bg-gradient-to-br from-emerald-900 via-[#197b3b] to-emerald-700 pt-8 sm:pt-12 lg:pt-16 pb-12 sm:pb-16 lg:pb-20">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%23ffffff" fill-opacity="0.4"%3E%3Cpath d="M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
        </div>
        
        <div class="relative max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-4xl mx-auto">
                <div class="inline-flex items-center justify-center mb-4 sm:mb-6">
                    <div class="w-16 h-16 sm:w-20 sm:h-20 rounded-2xl bg-white/10 backdrop-blur-sm flex items-center justify-center shadow-2xl mb-4">
                        <svg class="w-10 h-10 sm:w-12 sm:h-12 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M19 4h-1V2h-2v2H8V2H6v2H5c-1.11 0-1.99.9-1.99 2L3 20c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 16H5V10h14v10zm0-12H5V6h14v2zm-7 5h5v5h-5v-5z"/>
                        </svg>
                    </div>
                </div>
                
                <h1 class="text-4xl sm:text-5xl lg:text-6xl xl:text-7xl font-bold text-white mb-4 sm:mb-6 tracking-tight">
                    Diocesan <span class="text-emerald-200">Events</span>
                </h1>
                <p class="text-lg sm:text-xl lg:text-2xl text-emerald-100/90 leading-relaxed max-w-3xl mx-auto mb-8 font-light">
                    Join our community in worship, fellowship, and service to strengthen your faith journey.
                </p>
                
                <!-- Quick Stats -->
                <div class="flex flex-wrap justify-center gap-4 sm:gap-6 mb-8">
                    <div class="bg-white/10 backdrop-blur-sm rounded-xl px-5 py-3 sm:px-6 sm:py-4 border border-white/20">
                        <div class="flex items-center gap-3">
                            <div class="p-2 bg-emerald-500/20 rounded-lg">
                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8zm.5-13H11v6l5.25 3.15.75-1.23-4.5-2.67z"/>
                                </svg>
                            </div>
                            <div class="text-left">
                                <div class="text-2xl sm:text-3xl font-bold text-white">{{ $thisWeekEvents }}</div>
                                <div class="text-sm text-emerald-100/80">This Week</div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white/10 backdrop-blur-sm rounded-xl px-5 py-3 sm:px-6 sm:py-4 border border-white/20">
                        <div class="flex items-center gap-3">
                            <div class="p-2 bg-blue-500/20 rounded-lg">
                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M19 4h-1V2h-2v2H8V2H6v2H5c-1.11 0-1.99.9-1.99 2L3 20c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 16H5V10h14v10z"/>
                                </svg>
                            </div>
                            <div class="text-left">
                                <div class="text-2xl sm:text-3xl font-bold text-white">{{ $totalEvents }}</div>
                                <div class="text-sm text-emerald-100/80">This Month</div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white/10 backdrop-blur-sm rounded-xl px-5 py-3 sm:px-6 sm:py-4 border border-white/20">
                        <div class="flex items-center gap-3">
                            <div class="p-2 bg-purple-500/20 rounded-lg">
                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z"/>
                                </svg>
                            </div>
                            <div class="text-left">
                                <div class="text-2xl sm:text-3xl font-bold text-white">{{ $ministries->count() }}</div>
                                <div class="text-sm text-emerald-100/80">Ministries</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-8 -mt-6 sm:-mt-8 lg:-mt-10 relative z-10">
        {{-- Mobile Search --}}
        <div class="lg:hidden mb-8">
            <div class="relative group">
                <div class="absolute inset-0 bg-gradient-to-r from-emerald-600 to-blue-600 rounded-2xl blur opacity-30 group-hover:opacity-50 transition duration-500"></div>
                <div class="relative bg-white dark:bg-gray-800 rounded-2xl shadow-xl p-2">
                    <div class="flex items-center gap-2">
                        <div class="flex-1 relative">
                            <svg class="absolute left-4 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                            <input class="w-full pl-12 pr-4 py-3.5 bg-transparent border-0 text-gray-900 dark:text-gray-100 placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-0" 
                                   placeholder="Search events, ministries, or topics..." 
                                   type="text">
                        </div>
                        <button class="p-3.5 bg-gradient-to-r from-emerald-600 to-emerald-500 text-white rounded-xl shadow-lg hover:shadow-xl hover:scale-105 transition-all duration-200">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M3 17v2h6v-2H3zM3 5v2h10V5H3zm10 16v-2h8v-2h-8v-2h-2v6h2zM7 9v2H3v2h4v2h2V9H7zm14 4v-2H11v2h10zm-6-4h2V7h4V5h-4V3h-2v6z"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        {{-- Desktop Search and Filters --}}
        <div class="hidden lg:block mb-8">
            <div class="flex gap-4">
                <div class="flex-1 relative group">
                    <div class="absolute inset-0 bg-gradient-to-r from-emerald-500 to-emerald-600 rounded-2xl blur opacity-20 group-hover:opacity-30 transition duration-500"></div>
                    <div class="relative bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-3">
                        <div class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-emerald-600 dark:text-emerald-400" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                            <input class="flex-1 bg-transparent border-0 text-gray-900 dark:text-gray-100 placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-0 text-base" 
                                   placeholder="Search events, ministries, locations, or topics..." 
                                   type="text">
                            <div class="flex items-center gap-2">
                                <button class="px-4 py-2 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors text-sm font-medium">
                                    <svg class="w-4 h-4 inline mr-1" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M10 18h4v-2h-4v2zM3 6v2h18V6H3zm3 7h12v-2H6v2z"/>
                                    </svg>
                                    Filter
                                </button>
                                <button class="px-4 py-2 bg-gradient-to-r from-emerald-600 to-emerald-500 text-white rounded-lg shadow hover:shadow-md transition-all duration-200 text-sm font-medium hover:scale-105">
                                    <svg class="w-4 h-4 inline mr-1" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/>
                                    </svg>
                                    Search
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <button class="px-6 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-2xl shadow-lg hover:shadow-xl hover:scale-105 transition-all duration-200 font-medium flex items-center gap-2">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/>
                    </svg>
                    New Event
                </button>
            </div>
        </div>

        {{-- Main Content Grid --}}
        <div class="lg:grid lg:grid-cols-12 gap-6 lg:gap-8">
            {{-- Sidebar Filters --}}
            <aside class="lg:col-span-3 space-y-6">
                {{-- Quick Filters Card --}}
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 overflow-hidden">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100 flex items-center gap-2">
                                <div class="p-2 bg-gradient-to-r from-emerald-500 to-emerald-600 rounded-lg">
                                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M10 18h4v-2h-4v2zM3 6v2h18V6H3zm3 7h12v-2H6v2z"/>
                                    </svg>
                                </div>
                                <span>Quick Filters</span>
                            </h3>
                            <button class="text-sm text-emerald-600 dark:text-emerald-400 hover:text-emerald-700 dark:hover:text-emerald-300 transition-colors font-medium">
                                Clear All
                            </button>
                        </div>
                        
                        {{-- Event Type Filters --}}
                        <div class="mb-6">
                            <h4 class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3 flex items-center gap-2">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M20 6h-4V4c0-1.11-.89-2-2-2h-4c-1.11 0-2 .89-2 2v2H4c-1.11 0-1.99.89-1.99 2L2 19c0 1.11.89 2 2 2h16c1.11 0 2-.89 2-2V8c0-1.11-.89-2-2-2zm-6 0h-4V4h4v2z"/>
                                </svg>
                                Event Type
                            </h4>
                            <div class="flex flex-wrap gap-2">
                                @foreach($eventTypes as $key => $type)
                                    <button class="px-3 py-2 bg-gray-100 dark:bg-gray-700 hover:bg-gradient-to-r hover:from-emerald-500 hover:to-emerald-600 hover:text-white text-gray-700 dark:text-gray-300 rounded-lg text-sm font-medium transition-all duration-200 hover:scale-105 group">
                                        <span class="flex items-center gap-2">
                                            @php
                                                $typeIcons = [
                                                    'service' => '<svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M18 13h-5v5c0 .55-.45 1-1 1s-1-.45-1-1v-5H6c-.55 0-1-.45-1-1s.45-1 1-1h5V6c0-.55.45-1 1-1s1 .45 1 1v5h5c.55 0 1 .45 1 1s-.45 1-1 1z"/></svg>',
                                                    'meeting' => '<svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z"/></svg>',
                                                    'conference' => '<svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M20 6h-1v8c0 .55.45 1 1 1s1-.45 1-1V6c0-1.1-.9-2-2-2H4c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h13l4 4 .01-18z"/></svg>',
                                                    'workshop' => '<svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M19.43 12.98c.04-.32.07-.64.07-.98s-.03-.66-.07-.98l2.11-1.65c.19-.15.24-.42.12-.64l-2-3.46c-.12-.22-.39-.3-.61-.22l-2.49 1c-.52-.4-1.08-.73-1.69-.98l-.38-2.65C14.46 2.18 14.25 2 14 2h-4c-.25 0-.46.18-.49.42l-.38 2.65c-.61.25-1.17.59-1.69.98l-2.49-1c-.23-.09-.49 0-.61.22l-2 3.46c-.13.22-.07.49.12.64l2.11 1.65c-.04.32-.07.65-.07.98s.03.66.07.98l-2.11 1.65c-.19.15-.24.42-.12.64l2 3.46c.12.22.39.3.61.22l2.49-1c.52.4 1.08.73 1.69.98l.38 2.65c.03.24.24.42.49.42h4c.25 0 .46-.18.49-.42l.38-2.65c.61-.25 1.17-.59 1.69-.98l2.49 1c.23.09.49 0 .61-.22l2-3.46c.12-.22.07-.49-.12-.64l-2.11-1.65zM12 15.5c-1.93 0-3.5-1.57-3.5-3.5s1.57-3.5 3.5-3.5 3.5 1.57 3.5 3.5-1.57 3.5-3.5 3.5z"/></svg>',
                                                    'outreach' => '<svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z"/></svg>',
                                                ];
                                                $icon = $typeIcons[$key] ?? '<svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M17 12h-5v5h5v-5zM16 1v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2h-1V1h-2zm3 18H5V8h14v11z"/></svg>';
                                            @endphp
                                            {!! $icon !!}
                                            {{ Str::limit($type, 12) }}
                                        </span>
                                    </button>
                                @endforeach
                            </div>
                        </div>
                        
                        {{-- Ministry Filters --}}
                        <div>
                            <h4 class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3 flex items-center gap-2">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z"/>
                                </svg>
                                Ministries
                            </h4>
                            <div class="space-y-2 max-h-64 overflow-y-auto pr-2">
                                @foreach($ministries as $ministry)
                                    <label class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700/50 cursor-pointer transition-all duration-200 group">
                                        <div class="relative flex-shrink-0">
                                            <input class="ministry-filter size-5 rounded-full border-2 border-gray-300 dark:border-gray-600 checked:border-emerald-500 checked:bg-emerald-500 cursor-pointer transition-all duration-200" 
                                                   type="checkbox" 
                                                   value="{{ $ministry->id }}"
                                                   id="ministry_{{ $ministry->id }}"
                                                   @if(in_array($ministry->id, $ministryFilters)) checked @endif>
                                            <div class="absolute inset-0 rounded-full border-2 border-emerald-500 opacity-0 group-has-[:checked]:opacity-100 transition-opacity duration-200"></div>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <div class="flex items-center justify-between">
                                                <span class="text-sm font-medium text-gray-700 dark:text-gray-300 group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition-colors truncate">
                                                    {{ $ministry->name }}
                                                </span>
                                                <span class="text-xs text-gray-500 dark:text-gray-400 bg-gray-100 dark:bg-gray-700 px-2 py-1 rounded-full">
                                                    {{ $ministry->events_count ?? 0 }}
                                                </span>
                                            </div>
                                            <div class="w-full h-1 bg-gray-200 dark:bg-gray-700 rounded-full mt-1 overflow-hidden">
                                                <div class="h-full bg-gradient-to-r from-emerald-500 to-emerald-600 rounded-full" style="width: {{ min(($ministry->events_count ?? 0) * 10, 100) }}%"></div>
                                            </div>
                                        </div>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    
                    {{-- Apply Filters Button --}}
                    <div class="bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-800 dark:to-gray-900 border-t border-gray-200 dark:border-gray-700 p-4">
                        <button class="w-full py-3 bg-gradient-to-r from-emerald-600 to-emerald-500 text-white rounded-xl font-medium hover:shadow-lg hover:scale-[1.02] transition-all duration-200 flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M10 18h4v-2h-4v2zM3 6v2h18V6H3zm3 7h12v-2H6v2z"/>
                            </svg>
                            Apply Filters
                        </button>
                    </div>
                </div>

                {{-- Featured Events Card --}}
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 overflow-hidden">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100 flex items-center gap-2">
                                <div class="p-2 bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg">
                                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M17 12h-5v5h5v-5zM16 1v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2h-1V1h-2zm3 18H5V8h14v11z"/>
                                    </svg>
                                </div>
                                <span>Featured Events</span>
                            </h3>
                            <span class="px-3 py-1 bg-gradient-to-r from-blue-500 to-blue-600 text-white text-sm font-bold rounded-full">
                                {{ $featuredEvents->count() }}
                            </span>
                        </div>
                        
                        <div class="space-y-5">
                            @foreach($featuredEvents as $event)
                                <div class="group cursor-pointer transform hover:scale-[1.02] transition-all duration-300" 
                                     onclick="showEventModal('{{ route('events.modal', $event) }}')">
                                    <div class="relative overflow-hidden rounded-xl mb-3">
                                        @if($event->poster_url)
                                            <img alt="{{ $event->title }}" 
                                                 class="w-full h-36 object-cover group-hover:scale-110 transition-transform duration-500" 
                                                 src="{{ $event->poster_url }}">
                                        @else
                                            <div class="w-full h-36 bg-gradient-to-br from-emerald-500 via-emerald-600 to-emerald-700 flex items-center justify-center">
                                                <svg class="w-12 h-12 text-white/80" fill="currentColor" viewBox="0 0 24 24">
                                                    <path d="M17 12h-5v5h5v-5zM16 1v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2h-1V1h-2zm3 18H5V8h14v11z"/>
                                                </svg>
                                            </div>
                                        @endif
                                        <div class="absolute top-3 left-3 bg-white/95 dark:bg-gray-900/95 backdrop-blur-sm px-3 py-2 rounded-lg shadow-lg">
                                            <div class="text-xs font-bold text-emerald-600">{{ $event->start_time->format('M') }}</div>
                                            <div class="text-xl font-black text-gray-900 dark:text-white">{{ $event->start_time->format('d') }}</div>
                                        </div>
                                        <div class="absolute bottom-3 right-3">
                                            <span class="px-2 py-1 bg-white/90 dark:bg-gray-900/90 backdrop-blur-sm text-xs font-medium text-gray-700 dark:text-gray-300 rounded-lg">
                                                {{ $event->event_type }}
                                            </span>
                                        </div>
                                    </div>
                                    
                                    <h4 class="text-sm font-bold text-gray-900 dark:text-gray-100 group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition-colors mb-2">
                                        {{ Str::limit($event->title, 40) }}
                                    </h4>
                                    
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center gap-2 text-xs text-gray-600 dark:text-gray-400">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8zm.5-13H11v6l5.25 3.15.75-1.23-4.5-2.67z"/>
                                            </svg>
                                            <span>{{ $event->start_time->format('g:i A') }}</span>
                                        </div>
                                        <div class="flex items-center gap-1 text-xs text-emerald-600 dark:text-emerald-400 font-medium">
                                            View Details
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M12 4l-1.41 1.41L16.17 11H4v2h12.17l-5.58 5.59L12 20l8-8z"/>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                                
                                @if(!$loop->last)
                                    <hr class="border-gray-200 dark:border-gray-700">
                                @endif
                            @endforeach
                        </div>
                        
                        @if($featuredEvents->isEmpty())
                            <div class="text-center py-8">
                                <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-gradient-to-br from-gray-100 to-gray-200 dark:from-gray-700 dark:to-gray-800 flex items-center justify-center">
                                    <svg class="w-8 h-8 text-gray-400" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M19 4h-1V2h-2v2H8V2H6v2H5c-1.11 0-1.99.9-1.99 2L3 20c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 16H5V10h14v10zM9 14h6v2H9z"/>
                                    </svg>
                                </div>
                                <p class="text-gray-500 dark:text-gray-400 text-sm">
                                    No featured events scheduled
                                </p>
                            </div>
                        @endif
                    </div>
                </div>
            </aside>

            {{-- Main Calendar Area --}}
            <div class="lg:col-span-9 space-y-6">
                {{-- Calendar Header --}}
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 p-6">
                    <div class="flex flex-col lg:flex-row items-start lg:items-center justify-between gap-4 mb-6">
                        {{-- Date Navigation --}}
                        <div class="flex items-center gap-3">
                            <button class="p-3 bg-gradient-to-r from-emerald-50 to-emerald-100 dark:from-emerald-900/20 dark:to-emerald-900/10 hover:from-emerald-100 hover:to-emerald-200 dark:hover:from-emerald-900/30 dark:hover:to-emerald-900/20 rounded-xl shadow-sm hover:shadow-md transition-all duration-200 group"
                                    onclick="window.location.href='{{ route('events.index', array_merge(request()->except('month'), ['month' => $currentMonth->copy()->subMonth()->format('Y-m')])) }}'">
                                <svg class="w-5 h-5 text-emerald-600 dark:text-emerald-400 group-hover:scale-110 transition-transform" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M15.41 7.41L14 6l-6 6 6 6 1.41-1.41L10.83 12z"/>
                                </svg>
                            </button>
                            
                            <div class="text-center">
                                <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100">
                                    {{ $currentMonth->format('F Y') }}
                                </h2>
                                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                                    {{ $totalEvents }} events this month
                                </p>
                            </div>
                            
                            <button class="p-3 bg-gradient-to-r from-emerald-50 to-emerald-100 dark:from-emerald-900/20 dark:to-emerald-900/10 hover:from-emerald-100 hover:to-emerald-200 dark:hover:from-emerald-900/30 dark:hover:to-emerald-900/20 rounded-xl shadow-sm hover:shadow-md transition-all duration-200 group"
                                    onclick="window.location.href='{{ route('events.index', array_merge(request()->except('month'), ['month' => $currentMonth->copy()->addMonth()->format('Y-m')])) }}'">
                                <svg class="w-5 h-5 text-emerald-600 dark:text-emerald-400 group-hover:scale-110 transition-transform" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6z"/>
                                </svg>
                            </button>
                            
                            <button class="px-4 py-3 bg-gradient-to-r from-emerald-600 to-emerald-500 text-white rounded-xl shadow-lg hover:shadow-xl hover:scale-105 transition-all duration-200 font-medium flex items-center gap-2">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/>
                                </svg>
                                Today
                            </button>
                        </div>
                        
                        {{-- View Toggle --}}
                        <div class="flex items-center gap-2 bg-gray-100 dark:bg-gray-700 p-1 rounded-xl">
                            <button class="px-5 py-2.5 text-sm font-medium rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 shadow-sm hover:shadow-md transition-all duration-200 flex items-center gap-2">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M19 4h-1V2h-2v2H8V2H6v2H5c-1.11 0-1.99.9-1.99 2L3 20c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 16H5V10h14v10z"/>
                                </svg>
                                Month
                            </button>
                            <button class="px-5 py-2.5 text-sm font-medium rounded-lg text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 transition-colors flex items-center gap-2">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zM4 9h10.5v3.5H4V9zm0 5.5h10.5V18H4v-3.5zM20 18h-5.5V9H20v9z"/>
                                </svg>
                                Week
                            </button>
                            <button class="px-5 py-2.5 text-sm font-medium rounded-lg text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 transition-colors flex items-center gap-2">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M4 10.5c-.83 0-1.5.67-1.5 1.5s.67 1.5 1.5 1.5 1.5-.67 1.5-1.5-.67-1.5-1.5-1.5zm0-6c-.83 0-1.5.67-1.5 1.5S3.17 7.5 4 7.5 5.5 6.83 5.5 6 4.83 4.5 4 4.5zm0 12c-.83 0-1.5.68-1.5 1.5s.68 1.5 1.5 1.5 1.5-.68 1.5-1.5-.67-1.5-1.5-1.5zM7 19h14v-2H7v2zm0-6h14v-2H7v2zm0-8v2h14V5H7z"/>
                                </svg>
                                List
                            </button>
                        </div>
                    </div>

                    {{-- Calendar Grid --}}
                    <div class="bg-white dark:bg-gray-800 rounded-xl overflow-hidden border border-gray-200 dark:border-gray-700">
                        {{-- Day Headers --}}
                        <div class="grid grid-cols-7 bg-gradient-to-r from-emerald-50 to-emerald-100 dark:from-emerald-900/10 dark:to-emerald-900/5">
                            @foreach(['SUN', 'MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT'] as $day)
                                <div class="py-4 text-center text-sm font-bold text-emerald-700 dark:text-emerald-300 uppercase tracking-wider border-r border-emerald-100 dark:border-emerald-900/20 last:border-r-0">
                                    {{ $day }}
                                </div>
                            @endforeach
                        </div>

                        {{-- Calendar Days --}}
                        <div class="grid grid-cols-7">
                            @foreach($calendar as $week)
                                @foreach($week as $day)
                                    <div class="min-h-32 border-r border-b border-gray-100 dark:border-gray-800 last:border-r-0 {{ $day['is_current_month'] ? 'bg-white dark:bg-gray-800' : 'bg-gray-50/50 dark:bg-gray-800/30' }} p-3 hover:bg-emerald-50/50 dark:hover:bg-emerald-900/10 transition-colors duration-200 group relative">
                                        {{-- Day Number --}}
                                        @if($day['date'] == now()->format('Y-m-d'))
                                            <div class="absolute top-3 right-3 w-8 h-8 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-full flex items-center justify-center shadow-lg ring-2 ring-emerald-200 dark:ring-emerald-900">
                                                <span class="text-sm font-bold text-white">{{ $day['day'] }}</span>
                                            </div>
                                        @else
                                            <div class="absolute top-3 right-3 w-8 h-8 flex items-center justify-center group-hover:bg-emerald-100 dark:group-hover:bg-emerald-900/30 rounded-lg transition-colors">
                                                <span class="text-sm font-medium {{ $day['is_current_month'] ? 'text-gray-700 dark:text-gray-300 group-hover:text-emerald-600 dark:group-hover:text-emerald-400' : 'text-gray-400 dark:text-gray-600' }} transition-colors">
                                                    {{ $day['day'] }}
                                                </span>
                                            </div>
                                        @endif

                                        {{-- Events --}}
                                        <div class="mt-10 space-y-1.5">
                                            @if(isset($eventsByDate[$day['date']]))
                                                @foreach($eventsByDate[$day['date']] as $event)
                                                    @php
                                                        $colors = [
                                                            'service' => 'from-amber-500 to-amber-600',
                                                            'meeting' => 'from-blue-500 to-blue-600',
                                                            'conference' => 'from-purple-500 to-purple-600',
                                                            'workshop' => 'from-pink-500 to-pink-600',
                                                            'outreach' => 'from-indigo-500 to-indigo-600',
                                                            'special' => 'from-rose-500 to-rose-600',
                                                            'retreat' => 'from-emerald-500 to-emerald-600',
                                                            'training' => 'from-cyan-500 to-cyan-600',
                                                        ];
                                                        $gradient = $colors[$event->event_type] ?? 'from-emerald-500 to-emerald-600';
                                                    @endphp
                                                    
                                                    <button onclick="showEventModal('{{ route('events.modal', $event) }}')"
                                                            class="w-full text-left p-2 bg-gradient-to-r {{ $gradient }} text-white text-xs rounded-lg shadow-sm hover:shadow-md hover:scale-[1.02] transition-all duration-200 truncate group/event">
                                                        <div class="flex items-center justify-between">
                                                            <div class="flex items-center gap-1.5">
                                                                <span class="text-xs opacity-90">●</span>
                                                                <span class="font-medium truncate">{{ Str::limit($event->title, 12) }}</span>
                                                            </div>
                                                            <svg class="w-3 h-3 opacity-0 group-hover/event:opacity-100 transition-opacity" fill="currentColor" viewBox="0 0 24 24">
                                                                <path d="M9 5l7 7-7 7"/>
                                                            </svg>
                                                        </div>
                                                        <div class="text-xs opacity-90 mt-0.5 truncate">
                                                            {{ $event->start_time->format('g:i A') }}
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
                </div>

                {{-- Event Legend --}}
<div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 p-6">
    <div class="flex items-center justify-between mb-4">
        <h4 class="text-base font-bold text-gray-900 dark:text-gray-100 flex items-center gap-2">
            <svg class="w-5 h-5 text-emerald-600 dark:text-emerald-400" fill="currentColor" viewBox="0 0 24 24">
                <path d="M9.4 16.6L4.8 12l4.6-4.6L8 6l-6 6 6 6 1.4-1.4zm5.2 0l4.6-4.6-4.6-4.6L16 6l6 6-6 6-1.4-1.4z"/>
            </svg>
            Event Type Legend
        </h4>
        <button class="text-sm text-emerald-600 dark:text-emerald-400 hover:text-emerald-700 dark:hover:text-emerald-300 transition-colors font-medium">
            Hide
        </button>
    </div>
    
    {{-- Vertical Column Layout --}}
    <div class="space-y-2">
        @foreach($eventTypes as $key => $type)
            @php
                $legendColors = [
                    'service' => 'from-amber-500 to-amber-600',
                    'meeting' => 'from-blue-500 to-blue-600',
                    'conference' => 'from-purple-500 to-purple-600',
                    'workshop' => 'from-pink-500 to-pink-600',
                    'outreach' => 'from-indigo-500 to-indigo-600',
                    'special' => 'from-rose-500 to-rose-600',
                    'retreat' => 'from-emerald-500 to-emerald-600',
                    'training' => 'from-cyan-500 to-cyan-600',
                ];
                $gradient = $legendColors[$key] ?? 'from-emerald-500 to-emerald-600';
            @endphp
            <div class="flex items-center gap-4 p-3 rounded-xl bg-gray-50 dark:bg-gray-700/50 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors group">
                <div class="flex items-center gap-3 flex-1">
                    <div class="w-4 h-4 rounded-full bg-gradient-to-r {{ $gradient }} flex-shrink-0"></div>
                    <span class="text-sm font-medium text-gray-700 dark:text-gray-300 flex-1">{{ $type }}</span>
                </div>
                <div class="text-xs text-gray-500 dark:text-gray-400 bg-gray-100 dark:bg-gray-600 px-2 py-1 rounded-full flex-shrink-0">
                    {{ $monthEvents->where('event_type', $key)->count() }}
                </div>
            </div>
        @endforeach
    </div>
    
    {{-- Optional: Add quick stats below the legend --}}
    <div class="mt-6 pt-6 border-t border-gray-200 dark:border-gray-700">
        <div class="grid grid-cols-2 gap-3">
            <div class="text-center p-3 bg-emerald-50 dark:bg-emerald-900/20 rounded-lg">
                <div class="text-lg font-bold text-emerald-700 dark:text-emerald-300">{{ $totalEvents }}</div>
                <div class="text-xs text-gray-600 dark:text-gray-400 mt-1">Total Events</div>
            </div>
            <div class="text-center p-3 bg-blue-50 dark:bg-blue-900/20 rounded-lg">
                <div class="text-lg font-bold text-blue-700 dark:text-blue-300">{{ $thisWeekEvents }}</div>
                <div class="text-xs text-gray-600 dark:text-gray-400 mt-1">This Week</div>
            </div>
        </div>
    </div>
</div>

        {{-- All Events This Month Section --}}
        @if($monthEvents->count() > 0)
            <div class="mt-12">
                <div class="flex items-center justify-between mb-8">
                    <div>
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100">All Events This Month</h3>
                        <p class="text-gray-600 dark:text-gray-400 text-sm mt-2 flex items-center gap-2">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M19 4h-1V2h-2v2H8V2H6v2H5c-1.11 0-1.99.9-1.99 2L3 20c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 16H5V10h14v10zM9 14h6v2H9z"/>
                            </svg>
                            Browse all {{ $monthEvents->total() }} events happening in {{ $currentMonth->format('F') }}
                        </p>
                    </div>
                    <div class="flex items-center gap-3">
                        <button class="px-4 py-2.5 text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-emerald-600 dark:hover:text-emerald-400 transition-colors rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 flex items-center gap-2">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M3 18h6v-2H3v2zM3 6v2h18V6H3zm0 7h12v-2H3v2z"/>
                            </svg>
                            Sort
                        </button>
                        <button class="px-4 py-2.5 text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-emerald-600 dark:hover:text-emerald-400 transition-colors rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 flex items-center gap-2">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M3 17v2h6v-2H3zM3 5v2h10V5H3zm10 16v-2h8v-2h-8v-2h-2v6h2zM7 9v2H3v2h4v2h2V9H7zm14 4v-2H11v2h10zm-6-4h2V7h4V5h-4V3h-2v6z"/>
                            </svg>
                            Filter
                        </button>
                    </div>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($monthEvents as $event)
                        <div class="group bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 p-5 hover:shadow-2xl hover:-translate-y-1 transition-all duration-300">
                            <div class="relative mb-5">
                                @if($event->poster_url)
                                    <img alt="{{ $event->title }}" 
                                         class="w-full h-48 object-cover rounded-xl group-hover:scale-105 transition-transform duration-500" 
                                         src="{{ $event->poster_url }}">
                                @else
                                    <div class="w-full h-48 rounded-xl bg-gradient-to-br from-gray-900 to-gray-800 flex items-center justify-center">
                                        <svg class="w-16 h-16 text-white/60" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M17 12h-5v5h5v-5zM16 1v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2h-1V1h-2zm3 18H5V8h14v11z"/>
                                        </svg>
                                    </div>
                                @endif
                                
                                {{-- Date Badge --}}
                                <div class="absolute top-4 left-4 bg-white/95 dark:bg-gray-900/95 backdrop-blur-sm px-3 py-2 rounded-xl shadow-lg">
                                    <div class="text-xs font-bold text-emerald-600 dark:text-emerald-400">{{ $event->start_time->format('M') }}</div>
                                    <div class="text-xl font-black text-gray-900 dark:text-white">{{ $event->start_time->format('d') }}</div>
                                </div>
                                
                                {{-- Event Type Badge --}}
                                <span class="absolute top-4 right-4 px-3 py-1.5 text-xs font-bold text-white rounded-lg bg-gradient-to-r from-emerald-500 to-emerald-600 shadow-md">
                                    {{ $eventTypes[$event->event_type] ?? 'Event' }}
                                </span>
                            </div>
                            
                            <h4 class="text-lg font-bold text-gray-900 dark:text-gray-100 group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition-colors mb-2">
                                {{ $event->title }}
                            </h4>
                            
                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-5 line-clamp-2">
                                {{ Str::limit($event->description, 80) }}
                            </p>
                            
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-4">
                                    <div class="flex items-center gap-1.5 text-sm text-gray-600 dark:text-gray-400">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8zm.5-13H11v6l5.25 3.15.75-1.23-4.5-2.67z"/>
                                        </svg>
                                        <span>{{ $event->start_time->format('g:i A') }}</span>
                                    </div>
                                    <div class="flex items-center gap-1.5 text-sm text-gray-600 dark:text-gray-400">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                                        </svg>
                                        <span>{{ Str::limit($event->location, 15) }}</span>
                                    </div>
                                </div>
                                
                                <button onclick="showEventModal('{{ route('events.modal', $event) }}')"
                                        class="px-4 py-2.5 bg-gradient-to-r from-emerald-600 to-emerald-500 text-white rounded-xl font-medium hover:shadow-lg hover:scale-105 transition-all duration-200 flex items-center gap-2 group/btn">
                                    Details
                                    <svg class="w-4 h-4 group-hover/btn:translate-x-1 transition-transform" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 4l-1.41 1.41L16.17 11H4v2h12.17l-5.58 5.59L12 20l8-8z"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                @if($monthEvents->hasPages())
                    <div class="mt-10 flex justify-center">
                        <div class="flex items-center gap-2 bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-2">
                            @if($monthEvents->onFirstPage())
                                <span class="px-4 py-2 text-gray-400 dark:text-gray-600 cursor-not-allowed rounded-lg">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M15.41 7.41L14 6l-6 6 6 6 1.41-1.41L10.83 12z"/>
                                    </svg>
                                </span>
                            @else
                                <a href="{{ $monthEvents->previousPageUrl() }}" class="px-4 py-2 text-emerald-600 dark:text-emerald-400 hover:bg-emerald-50 dark:hover:bg-emerald-900/20 rounded-lg transition-colors">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M15.41 7.41L14 6l-6 6 6 6 1.41-1.41L10.83 12z"/>
                                    </svg>
                                </a>
                            @endif
                            
                            @foreach($monthEvents->getUrlRange(max(1, $monthEvents->currentPage() - 2), min($monthEvents->lastPage(), $monthEvents->currentPage() + 2)) as $page => $url)
                                @if($page == $monthEvents->currentPage())
                                    <span class="px-4 py-2 bg-gradient-to-r from-emerald-600 to-emerald-500 text-white font-medium rounded-lg">{{ $page }}</span>
                                @else
                                    <a href="{{ $url }}" class="px-4 py-2 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-colors">{{ $page }}</a>
                                @endif
                            @endforeach
                            
                            @if($monthEvents->hasMorePages())
                                <a href="{{ $monthEvents->nextPageUrl() }}" class="px-4 py-2 text-emerald-600 dark:text-emerald-400 hover:bg-emerald-50 dark:hover:bg-emerald-900/20 rounded-lg transition-colors">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6z"/>
                                    </svg>
                                </a>
                            @else
                                <span class="px-4 py-2 text-gray-400 dark:text-gray-600 cursor-not-allowed rounded-lg">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6z"/>
                                    </svg>
                                </span>
                            @endif
                        </div>
                    </div>
                @endif
            </div>
        @else
            {{-- Empty State --}}
            <div class="mt-12 text-center py-16 bg-gradient-to-b from-gray-50 to-white dark:from-gray-900 dark:to-gray-800 rounded-2xl shadow-xl">
                <div class="w-24 h-24 mx-auto mb-6 rounded-full bg-gradient-to-br from-emerald-100 to-emerald-200 dark:from-emerald-900/30 dark:to-emerald-900/10 flex items-center justify-center">
                    <svg class="w-12 h-12 text-emerald-600 dark:text-emerald-400" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M19 4h-1V2h-2v2H8V2H6v2H5c-1.11 0-1.99.9-1.99 2L3 20c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 16H5V10h14v10zM9 14h6v2H9z"/>
                    </svg>
                </div>
                <h4 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-3">No Events Scheduled</h4>
                <p class="text-gray-600 dark:text-gray-400 max-w-md mx-auto mb-8">
                    There are no events scheduled for {{ $currentMonth->format('F Y') }}. Check back soon for updates or suggest an event!
                </p>
                <div class="flex flex-wrap gap-3 justify-center">
                    <button class="px-6 py-3 bg-gradient-to-r from-emerald-600 to-emerald-500 text-white rounded-xl font-medium hover:shadow-lg hover:scale-105 transition-all duration-200 flex items-center gap-2">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/>
                        </svg>
                        Suggest an Event
                    </button>
                    <button onclick="window.location.href='{{ route('events.index', ['month' => now()->format('Y-m')]) }}'" 
                            class="px-6 py-3 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-xl font-medium hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors flex items-center gap-2">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 8V4l8 8-8 8v-4H4V8z"/>
                        </svg>
                        View Current Month
                    </button>
                </div>
            </div>
        @endif
    </div>
</main>

<!-- Event Modal -->
<div class="modal fade" id="eventModal" tabindex="-1" aria-labelledby="eventModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content rounded-2xl border-0 shadow-2xl">
            <div class="modal-body p-0" id="eventModalContent">
                <!-- Content loaded via AJAX -->
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    /* Custom Animations */
    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-10px); }
    }
    
    @keyframes pulse-subtle {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.8; }
    }
    
    .float-animation {
        animation: float 6s ease-in-out infinite;
    }
    
    .pulse-subtle {
        animation: pulse-subtle 3s ease-in-out infinite;
    }
    
    /* Glass Effect */
    .glass-effect {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }
    
    .dark .glass-effect {
        background: rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.1);
    }
    
    /* Custom Scrollbar */
    ::-webkit-scrollbar {
        width: 8px;
        height: 8px;
    }
    
    ::-webkit-scrollbar-track {
        background: #f1f5f9;
        border-radius: 10px;
    }
    
    .dark ::-webkit-scrollbar-track {
        background: #1e293b;
    }
    
    ::-webkit-scrollbar-thumb {
        background: linear-gradient(to bottom, #10b981, #059669);
        border-radius: 10px;
    }
    
    ::-webkit-scrollbar-thumb:hover {
        background: linear-gradient(to bottom, #059669, #047857);
    }
    
    /* Smooth Transitions */
    * {
        transition: background-color 0.3s ease, border-color 0.3s ease, transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    /* Gradient Text */
    .gradient-text {
        background: linear-gradient(135deg, #10b981, #3b82f6);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    
    /* Card Hover Effects */
    .card-hover {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    .card-hover:hover {
        transform: translateY(-4px);
        box-shadow: 0 20px 40px -15px rgba(0, 0, 0, 0.1);
    }
    
    .dark .card-hover:hover {
        box-shadow: 0 20px 40px -15px rgba(0, 0, 0, 0.3);
    }
    
    /* Loading Animation */
    .loading-spinner {
        animation: spin 1s linear infinite;
    }
    
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
    
    /* Line Clamp */
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    .line-clamp-1 {
        display: -webkit-box;
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    /* Focus Styles */
    :focus-visible {
        outline: 2px solid #10b981;
        outline-offset: 2px;
        border-radius: 0.375rem;
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize tooltips
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        const tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl, {
                placement: 'top',
                trigger: 'hover focus',
                customClass: '!opacity-100 !bg-gray-900 dark:!bg-gray-700 !text-white !text-xs !py-2 !px-3 !rounded-lg !shadow-xl !border !border-gray-200 dark:!border-gray-600'
            });
        });

        // Ministry filter with animation
        const ministryFilters = document.querySelectorAll('.ministry-filter');
        let filterTimeout;
        
        function updateFilters() {
            clearTimeout(filterTimeout);
            
            // Add loading animation to apply button
            const applyBtn = document.querySelector('button:contains("Apply Filters")');
            if (applyBtn) {
                const originalText = applyBtn.innerHTML;
                applyBtn.innerHTML = `
                    <svg class="w-5 h-5 animate-spin" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Applying...
                `;
                applyBtn.disabled = true;
            }
            
            filterTimeout = setTimeout(() => {
                const selectedMinistries = Array.from(ministryFilters)
                    .filter(cb => cb.checked)
                    .map(cb => cb.value);
                
                let params = new URLSearchParams(window.location.search);
                
                if (selectedMinistries.length > 0) {
                    params.set('ministry', selectedMinistries.join(','));
                } else {
                    params.delete('ministry');
                }
                
                // Add loading animation to page
                document.body.style.opacity = '0.7';
                document.body.style.pointerEvents = 'none';
                
                setTimeout(() => {
                    window.location.href = '{{ route("events.index") }}?' + params.toString();
                }, 300);
            }, 500);
        }
        
        ministryFilters.forEach(filter => {
            filter.addEventListener('change', updateFilters);
        });

        // Enhanced event modal function
        window.showEventModal = function(url) {
            const modalContent = document.getElementById('eventModalContent');
            
            // Show loading state with animation
            modalContent.innerHTML = `
                <div class="flex flex-col items-center justify-center min-h-[400px] p-8">
                    <div class="relative mb-6">
                        <div class="w-20 h-20 rounded-full bg-gradient-to-r from-emerald-100 to-emerald-200 dark:from-emerald-900/30 dark:to-emerald-900/10 flex items-center justify-center">
                            <svg class="w-10 h-10 text-emerald-600 dark:text-emerald-400 loading-spinner" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8z"/>
                            </svg>
                        </div>
                        <div class="absolute inset-0 rounded-full border-4 border-emerald-200 dark:border-emerald-800 border-t-emerald-600 dark:border-t-emerald-400 animate-spin"></div>
                    </div>
                    <h4 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-2">Loading Event Details</h4>
                    <p class="text-gray-600 dark:text-gray-400 text-sm">Please wait while we fetch the event information...</p>
                </div>
            `;
            
            const modal = new bootstrap.Modal(document.getElementById('eventModal'));
            modal.show();
            
            // Add enter animation to modal
            const modalElement = document.getElementById('eventModal');
            modalElement.classList.add('fade-scale');
            
            // Fetch event details
            fetch(url)
                .then(response => {
                    if (!response.ok) throw new Error('Network response was not ok');
                    return response.text();
                })
                .then(html => {
                    modalContent.innerHTML = html;
                    
                    // Add entrance animation to modal content
                    const elements = modalContent.querySelectorAll('*');
                    elements.forEach((el, index) => {
                        el.style.opacity = '0';
                        el.style.transform = 'translateY(20px)';
                        setTimeout(() => {
                            el.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                            el.style.opacity = '1';
                            el.style.transform = 'translateY(0)';
                        }, index * 50);
                    });
                    
                    // Initialize modal functionality
                    initEventModal();
                })
                .catch(error => {
                    console.error('Error loading event modal:', error);
                    modalContent.innerHTML = `
                        <div class="flex flex-col items-center justify-center min-h-[400px] p-8">
                            <div class="w-16 h-16 mx-auto mb-6 rounded-full bg-red-100 dark:bg-red-900/30 flex items-center justify-center">
                                <svg class="w-8 h-8 text-red-600 dark:text-red-400" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/>
                                </svg>
                            </div>
                            <h4 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-2">Error Loading Event</h4>
                            <p class="text-gray-600 dark:text-gray-400 text-center mb-6 max-w-md">
                                We encountered an error while loading the event details. Please try again in a moment.
                            </p>
                            <button onclick="bootstrap.Modal.getInstance(document.getElementById('eventModal')).hide()" 
                                    class="px-6 py-3 bg-gradient-to-r from-emerald-600 to-emerald-500 text-white rounded-xl font-medium hover:shadow-lg hover:scale-105 transition-all duration-200">
                                Close
                            </button>
                        </div>
                    `;
                });
        };

        function initEventModal() {
            // Add close button if not present
            const modalContent = document.getElementById('eventModalContent');
            if (!modalContent.querySelector('.modal-close-btn')) {
                const closeBtn = document.createElement('button');
                closeBtn.className = 'modal-close-btn absolute top-4 right-4 p-2 bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm rounded-full hover:bg-white dark:hover:bg-gray-700 transition-colors z-10';
                closeBtn.innerHTML = `
                    <svg class="w-5 h-5 text-gray-700 dark:text-gray-300" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/>
                    </svg>
                `;
                closeBtn.onclick = () => bootstrap.Modal.getInstance(document.getElementById('eventModal')).hide();
                modalContent.prepend(closeBtn);
            }

            // Handle registration form
            const registrationForm = document.getElementById('eventRegistrationForm');
            if (registrationForm) {
                registrationForm.addEventListener('submit', handleRegistration);
            }
        }

        function handleRegistration(e) {
            e.preventDefault();
            
            const formData = new FormData(e.target);
            const submitButton = e.target.querySelector('button[type="submit"]');
            const originalText = submitButton.innerHTML;
            
            // Show loading state
            submitButton.innerHTML = `
                <svg class="w-5 h-5 animate-spin mr-2" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Processing Registration...
            `;
            submitButton.disabled = true;
            
            fetch(e.target.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Show success message
                    const modalContent = document.getElementById('eventModalContent');
                    modalContent.innerHTML = `
                        <div class="p-8 text-center">
                            <div class="relative w-20 h-20 mx-auto mb-6">
                                <div class="absolute inset-0 bg-gradient-to-r from-emerald-500 to-emerald-600 rounded-full opacity-20 animate-ping"></div>
                                <div class="relative w-20 h-20 rounded-full bg-gradient-to-r from-emerald-100 to-emerald-200 dark:from-emerald-900/30 dark:to-emerald-900/10 flex items-center justify-center">
                                    <svg class="w-10 h-10 text-emerald-600 dark:text-emerald-400" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>
                                    </svg>
                                </div>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-3">Registration Successful!</h3>
                            <p class="text-gray-600 dark:text-gray-400 mb-6 max-w-md mx-auto">
                                You have successfully registered for this event. We look forward to seeing you there! A confirmation email has been sent to your email address.
                            </p>
                            <button onclick="bootstrap.Modal.getInstance(document.getElementById('eventModal')).hide()" 
                                    class="px-6 py-3 bg-gradient-to-r from-emerald-600 to-emerald-500 text-white rounded-xl font-medium hover:shadow-lg hover:scale-105 transition-all duration-200">
                                Close
                            </button>
                        </div>
                    `;
                } else {
                    // Show error message
                    submitButton.innerHTML = originalText;
                    submitButton.disabled = false;
                    
                    const errorDiv = document.createElement('div');
                    errorDiv.className = 'mt-3 p-3 bg-red-50 dark:bg-red-900/20 text-red-700 dark:text-red-300 rounded-lg text-sm';
                    errorDiv.textContent = data.message || 'Registration failed. Please try again.';
                    
                    e.target.appendChild(errorDiv);
                    
                    // Remove error message after 5 seconds
                    setTimeout(() => errorDiv.remove(), 5000);
                }
            })
            .catch(error => {
                console.error('Registration error:', error);
                submitButton.innerHTML = originalText;
                submitButton.disabled = false;
                
                const errorDiv = document.createElement('div');
                errorDiv.className = 'mt-3 p-3 bg-red-50 dark:bg-red-900/20 text-red-700 dark:text-red-300 rounded-lg text-sm';
                errorDiv.textContent = 'An error occurred. Please check your connection and try again.';
                
                e.target.appendChild(errorDiv);
                
                setTimeout(() => errorDiv.remove(), 5000);
            });
        }

        // Calendar day hover effects
        document.querySelectorAll('.min-h-32').forEach(day => {
            day.addEventListener('mouseenter', function() {
                this.style.transform = 'scale(1.02)';
                this.style.zIndex = '10';
                this.style.boxShadow = '0 10px 30px rgba(0, 0, 0, 0.1)';
            });
            
            day.addEventListener('mouseleave', function() {
                this.style.transform = '';
                this.style.zIndex = '';
                this.style.boxShadow = '';
            });
        });

        // Keyboard navigation for calendar
        document.addEventListener('keydown', function(e) {
            if (e.key === 'ArrowLeft') {
                const prevBtn = document.querySelector('button[onclick*="subMonth"]');
                if (prevBtn) prevBtn.click();
            } else if (e.key === 'ArrowRight') {
                const nextBtn = document.querySelector('button[onclick*="addMonth"]');
                if (nextBtn) nextBtn.click();
            } else if (e.key === 't' || e.key === 'T') {
                const todayBtn = document.querySelector('button:contains("Today")');
                if (todayBtn) todayBtn.click();
            }
        });

        // Add today's date to page title
        document.title = `Events Calendar - {{ $currentMonth->format('F Y') }} | Diocesan Community`;
        
        // Add current date display in console for debugging
        console.log(`Events Calendar loaded for: {{ $currentMonth->format('F Y') }}`);
    });

    // Refresh page when returning from another tab (to update "today" indicator)
    document.addEventListener('visibilitychange', function() {
        if (!document.hidden) {
            // Optional: You could add a subtle refresh indicator here
            console.log('Page is now visible, refreshing events...');
        }
    });
</script>
@endpush