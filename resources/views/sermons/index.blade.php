{{-- resources/views/sermons/index.blade.php --}}
@extends('layouts.app')

@section('content')
<main class="flex-1 bg-[#197b3b]">
    {{-- Hero Section --}}
    <div class="relative px-4 sm:px-6 md:px-10 lg:px-40 py-12 sm:py-16 bg-gradient-to-b from-[#197b3b] via-[#146c33] to-[#11592a] overflow-hidden">
        {{-- Background Pattern --}}
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-10 right-4 sm:right-10 w-48 h-48 sm:w-64 sm:h-64 bg-white/20 rounded-full blur-3xl"></div>
            <div class="absolute bottom-10 left-4 sm:left-10 w-64 h-64 sm:w-96 sm:h-96 bg-emerald-400/20 rounded-full blur-3xl"></div>
        </div>
        
        <div class="relative max-w-[1200px] mx-auto">
            <div class="max-w-3xl">
                <div class="inline-flex items-center gap-2 mb-4 px-3 py-2 bg-white/20 backdrop-blur-sm text-white rounded-full text-xs sm:text-sm font-medium">
                    <svg class="w-3 h-3 sm:w-4 sm:h-4" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M3 9v6h4l5 5V4L7 9H3zm13.5 3c0-1.77-1.02-3.29-2.5-4.03v8.05c1.48-.73 2.5-2.25 2.5-4.02zM14 3.23v2.06c2.89.86 5 3.54 5 6.71s-2.11 5.85-5 6.71v2.06c4.01-.91 7-4.49 7-8.77s-2.99-7.86-7-8.77z"/>
                    </svg>
                    <span class="hidden xs:inline">Spiritual Nourishment</span>
                    <span class="xs:hidden">Sermons</span>
                </div>
                
                <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-black leading-tight tracking-tight text-white mb-4 sm:mb-6">
                    Sermons & 
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-white to-emerald-200 block sm:inline">Resources</span>
                </h1>
                
                <p class="text-lg sm:text-xl md:text-2xl text-emerald-100 font-normal leading-relaxed max-w-2xl mb-6 sm:mb-8">
                    Nourish your soul with inspiring messages, download resources, and access materials for spiritual growth.
                </p>
                
                <div class="flex flex-col xs:flex-row gap-3 sm:gap-4">
                    <button onclick="document.getElementById('recent-sermons').scrollIntoView({ behavior: 'smooth' })" 
                            class="w-full xs:w-auto px-4 sm:px-6 py-3 bg-white text-[#197b3b] rounded-xl font-bold flex items-center justify-center gap-2 shadow-lg hover:shadow-xl hover:-translate-y-0.5 transition-all duration-300 hover:bg-emerald-50 text-sm sm:text-base">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M8 5v14l11-7z"/>
                        </svg>
                        Explore Sermons
                    </button>
                    
                    <a href="#documents" 
                       class="w-full xs:w-auto px-4 sm:px-6 py-3 bg-transparent border-2 border-white/30 text-white rounded-xl font-bold flex items-center justify-center gap-2 hover:bg-white/10 hover:border-white/50 transition-all duration-300 text-sm sm:text-base">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M14 2H6c-1.1 0-1.99.9-1.99 2L4 20c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6zm2 16H8v-2h8v2zm0-4H8v-2h8v2zm-3-5V3.5L18.5 9H13z"/>
                        </svg>
                        View Resources
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Featured Sermon --}}
    @php
        $latestSermon = $sermons->first();
    @endphp
    
    @if($latestSermon)
    <div class="px-4 sm:px-6 md:px-10 lg:px-40 py-8 bg-gradient-to-b from-[#146c33] to-[#197b3b]">
        <div class="max-w-[1200px] mx-auto">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
                <div>
                    <h2 class="text-xl sm:text-2xl md:text-3xl font-bold text-white flex items-center gap-3 mb-2">
                        <span class="w-8 sm:w-12 h-1 bg-gradient-to-r from-white to-emerald-300 rounded-full"></span>
                        Featured Message
                    </h2>
                    <p class="text-emerald-200 text-sm sm:text-base">Latest inspiration from our pulpit</p>
                </div>
                <div class="text-xs sm:text-sm text-emerald-200 bg-white/10 backdrop-blur-sm px-3 py-1.5 rounded-full border border-white/20 w-fit">
                    {{ $latestSermon->sermon_date->format('F d, Y') }}
                </div>
            </div>
            
            <div class="relative group">
                {{-- Background Glow --}}
                <div class="absolute -inset-2 sm:-inset-4 bg-gradient-to-r from-white/20 to-emerald-400/20 rounded-3xl blur-xl opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                
                <div class="relative bg-white rounded-xl sm:rounded-2xl shadow-lg overflow-hidden">
                    <div class="grid grid-cols-1 lg:grid-cols-5 gap-0">
                        {{-- Thumbnail Section --}}
                        <div class="lg:col-span-3 relative">
                            <div class="aspect-video lg:aspect-auto lg:h-full relative overflow-hidden bg-gradient-to-br from-gray-900 to-black">
                                @if($latestSermon->video_url)
                                    <div class="absolute inset-0 bg-cover bg-center transition-transform duration-700 group-hover:scale-110" 
                                         style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuDMAqpKfudheCflFCxYzkConLYvIaBG3i-Lw2wrFaII4yKtn1oRdS_bipk9-VAIYxULCfRPf8LmE311sL2qKmx7qT307yQM8J3OpE9Mf8TQYeluXIl_yowFVW5RKTqk1DZdWBZbJ97xVZ5s2LNjVTzI-pu4yQ8BVsrbLB0GW9yrFoL_8FFlAEHtTZUNq7wTgIK9GeaxGutMJL4IxxzGsMCI8oG1ZA4E-zoublBeYku2hhjZoydSSA5nHtxffUI64IJrSVygy60XqXc");'>
                                    </div>
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent"></div>
                                @else
                                    <div class="absolute inset-0 bg-gradient-to-br from-emerald-600 via-[#197b3b] to-[#146c33] flex items-center justify-center">
                                        <svg class="w-16 h-16 sm:w-20 sm:h-20 lg:w-24 lg:h-24 text-white/40" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M18 10.48V6c0-1.1-.9-2-2-2H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2v-4.48l4 3.98v-11l-4 3.98zM10 8c1.1 0 2 .9 2 2s-.9 2-2 2-2-.9-2-2 .9-2 2-2zm4 8H6v-.9c0-2 4-3.1 4-3.1s4 1.1 4 3.1v.9z"/>
                                        </svg>
                                    </div>
                                @endif
                                
                                {{-- Play Button Overlay --}}
                                <button onclick="showSermonModal('{{ $latestSermon->video_url }}', '{{ $latestSermon->title }}')"
                                        class="absolute inset-0 w-full h-full flex items-center justify-center group/play">
                                    <div class="relative">
                                        <div class="w-16 h-16 sm:w-20 sm:h-20 lg:w-24 lg:h-24 rounded-full bg-white/20 backdrop-blur-sm flex items-center justify-center transform group-hover/play:scale-110 transition-transform duration-300">
                                            <div class="w-12 h-12 sm:w-16 sm:h-16 lg:w-20 lg:h-20 rounded-full bg-white flex items-center justify-center shadow-2xl">
                                                @if($latestSermon->video_url)
                                                    <svg class="w-6 h-6 sm:w-8 sm:h-8 lg:w-10 lg:h-10 text-[#197b3b] ml-1" fill="currentColor" viewBox="0 0 24 24">
                                                        <path d="M8 5v14l11-7z"/>
                                                    </svg>
                                                @else
                                                    <svg class="w-6 h-6 sm:w-8 sm:h-8 lg:w-10 lg:h-10 text-[#197b3b]" fill="currentColor" viewBox="0 0 24 24">
                                                        <path d="M3 9v6h4l5 5V4L7 9H3zm13.5 3c0-1.77-1.02-3.29-2.5-4.03v8.05c1.48-.73 2.5-2.25 2.5-4.02zM14 3.23v2.06c2.89.86 5 3.54 5 6.71s-2.11 5.85-5 6.71v2.06c4.01-.91 7-4.49 7-8.77s-2.99-7.86-7-8.77z"/>
                                                    </svg>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </button>
                                
                                {{-- Badges --}}
                                <div class="absolute top-3 left-3 sm:top-4 sm:left-4 flex flex-col gap-2">
                                    <span class="bg-gradient-to-r from-[#197b3b] to-emerald-600 text-white text-xs font-bold px-2 sm:px-3 py-1 sm:py-1.5 rounded-full uppercase tracking-wider shadow-lg whitespace-nowrap">
                                        Featured
                                    </span>
                                    @if($latestSermon->video_url)
                                        <span class="bg-black/60 backdrop-blur-sm text-white text-xs font-bold px-2 sm:px-3 py-1 sm:py-1.5 rounded-full flex items-center gap-1 whitespace-nowrap">
                                            <svg class="w-2 h-2 sm:w-3 sm:h-3" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M17 10.5V7c0-.55-.45-1-1-1H4c-.55 0-1 .45-1 1v10c0 .55.45 1 1 1h12c.55 0 1-.45 1-1v-3.5l4 4v-11l-4 4z"/>
                                            </svg>
                                            <span class="hidden xs:inline">Video Available</span>
                                            <span class="xs:hidden">Video</span>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        {{-- Content Section --}}
                        <div class="lg:col-span-2 p-4 sm:p-6 lg:p-8 xl:p-10">
                            <div class="h-full flex flex-col justify-between">
                                <div>
                                    <div class="flex items-center gap-2 mb-3 sm:mb-4">
                                        <span class="w-6 h-6 sm:w-8 sm:h-8 rounded-full bg-[#197b3b]/10 flex items-center justify-center">
                                            <svg class="w-3 h-3 sm:w-4 sm:h-4 text-[#197b3b]" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M19 3h-1V1h-2v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V8h14v11zM7 10h5v5H7z"/>
                                            </svg>
                                        </span>
                                        <span class="text-xs sm:text-sm text-gray-600">
                                            {{ $latestSermon->sermon_date->format('F d, Y') }}
                                        </span>
                                    </div>
                                    
                                    <h3 class="text-lg sm:text-xl lg:text-2xl xl:text-3xl font-bold text-gray-900 mb-3 sm:mb-4 leading-tight">
                                        {{ Str::limit($latestSermon->title, 60) }}
                                    </h3>
                                    
                                    <p class="text-gray-600 text-sm sm:text-base mb-4 sm:mb-6 leading-relaxed line-clamp-2 sm:line-clamp-3">
                                        {{ $latestSermon->description ?: 'Join us for this inspiring message of faith and hope.' }}
                                    </p>
                                    
                                    <div class="space-y-2 sm:space-y-3">
                                        <div class="flex items-center gap-2 sm:gap-3">
                                            <svg class="w-4 h-4 sm:w-5 sm:h-5 text-[#197b3b]" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                            </svg>
                                            <span class="text-gray-800 font-medium text-sm sm:text-base">{{ $latestSermon->preacher }}</span>
                                        </div>
                                        
                                        @if($latestSermon->formatted_scriptures)
                                        <div class="flex items-center gap-2 sm:gap-3">
                                            <svg class="w-4 h-4 sm:w-5 sm:h-5 text-[#197b3b]" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M21 5c-1.11-.35-2.33-.5-3.5-.5-1.95 0-4.05.4-5.5 1.5-1.45-1.1-3.55-1.5-5.5-1.5S2.45 4.9 1 6v14.65c0 .25.25.5.5.5.1 0 .15-.05.25-.05C3.1 20.45 5.05 20 6.5 20c1.95 0 4.05.4 5.5 1.5 1.35-.85 3.8-1.5 5.5-1.5 1.65 0 3.35.3 4.75 1.05.1.05.15.05.25.05.25 0 .5-.25.5-.5V6c-.6-.45-1.25-.75-2-1zM3 18.5V7c1.1-.35 2.3-.5 3.5-.5 1.34 0 3.13.41 4.5.99v11.5C9.63 18.41 7.84 18 6.5 18c-1.2 0-2.4.15-3.5.5zm18 0c-1.1-.35-2.3-.5-3.5-.5-1.34 0-3.13.41-4.5.99V7.49c1.37-.59 3.16-.99 4.5-.99 1.2 0 2.4.15 3.5.5v11.5z"/>
                                            </svg>
                                            <span class="text-gray-800 text-sm sm:text-base">{{ $latestSermon->formatted_scriptures }}</span>
                                        </div>
                                        @endif
                                        
                                        @if($latestSermon->duration_formatted)
                                        <div class="flex items-center gap-2 sm:gap-3">
                                            <svg class="w-4 h-4 sm:w-5 sm:h-5 text-[#197b3b]" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8zm.5-13H11v6l5.25 3.15.75-1.23-4.5-2.67z"/>
                                            </svg>
                                            <span class="text-gray-800 text-sm sm:text-base">{{ $latestSermon->duration_formatted }}</span>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                
                                {{-- Action Buttons --}}
                                <div class="mt-6 sm:mt-8 pt-4 sm:pt-6 border-t border-gray-200">
                                    <div class="flex flex-col xs:flex-row gap-3">
                                        @if($latestSermon->video_url)
                                            <button onclick="showSermonModal('{{ $latestSermon->video_url }}', '{{ $latestSermon->title }}')"
                                                    class="flex-1 flex items-center justify-center gap-2 px-4 py-2.5 sm:px-5 sm:py-3 bg-gradient-to-r from-[#197b3b] to-emerald-600 text-white rounded-xl font-bold hover:shadow-xl hover:-translate-y-0.5 transition-all duration-300 group/btn text-sm sm:text-base">
                                                <svg class="w-4 h-4 sm:w-5 sm:h-5 group-hover/btn:scale-110 transition-transform" fill="currentColor" viewBox="0 0 24 24">
                                                    <path d="M8 5v14l11-7z"/>
                                                </svg>
                                                Watch
                                            </button>
                                        @endif
                                        
                                        @if($latestSermon->audio_url)
                                            <button onclick="playAudio('{{ $latestSermon->audio_url }}', '{{ $latestSermon->title }}', '{{ $latestSermon->preacher }}')"
                                                    class="flex-1 flex items-center justify-center gap-2 px-4 py-2.5 sm:px-5 sm:py-3 bg-white border-2 border-[#197b3b]/20 text-[#197b3b] rounded-xl font-bold hover:border-[#197b3b] hover:shadow-md transition-all duration-300 group/btn text-sm sm:text-base">
                                                <svg class="w-4 h-4 sm:w-5 sm:h-5 group-hover/btn:scale-110 transition-transform" fill="currentColor" viewBox="0 0 24 24">
                                                    <path d="M3 9v6h4l5 5V4L7 9H3zm13.5 3c0-1.77-1.02-3.29-2.5-4.03v8.05c1.48-.73 2.5-2.25 2.5-4.02zM14 3.23v2.06c2.89.86 5 3.54 5 6.71s-2.11 5.85-5 6.71v2.06c4.01-.91 7-4.49 7-8.77s-2.99-7.86-7-8.77z"/>
                                                </svg>
                                                Listen
                                            </button>
                                        @endif
                                        
                                        @if($latestSermon->document_url)
                                            <a href="{{ $latestSermon->document_url }}" target="_blank" 
                                               class="flex-1 flex items-center justify-center gap-2 px-4 py-2.5 sm:px-5 sm:py-3 bg-white border-2 border-[#197b3b]/20 text-[#197b3b] rounded-xl font-bold hover:border-[#197b3b] hover:shadow-md transition-all duration-300 group/btn text-sm sm:text-base">
                                                <svg class="w-4 h-4 sm:w-5 sm:h-5 group-hover/btn:scale-110 transition-transform" fill="currentColor" viewBox="0 0 24 24">
                                                    <path d="M19 9h-4V3H9v6H5l7 7 7-7zM5 18v2h14v-2H5z"/>
                                                </svg>
                                                Download
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- Sticky Filter Bar --}}
    <div class="sticky top-0 z-30 bg-white/95 backdrop-blur-xl border-b border-gray-200 transition-all duration-300 shadow-sm" id="sticky-header">
        <div class="px-4 sm:px-6 md:px-10 lg:px-40 py-3 sm:py-4">
            <div class="max-w-[1200px] mx-auto">
                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 sm:gap-4">
                    <div class="w-full sm:w-auto">
                        <h3 class="text-base sm:text-lg font-bold text-gray-900" id="recent-sermons">Browse Sermons</h3>
                        <p class="text-xs sm:text-sm text-gray-600 hidden xs:block">Filter and search through our collection</p>
                    </div>
                    
                    <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 w-full sm:w-auto">
                        {{-- Search --}}
                        <div class="relative w-full sm:w-48 md:w-64">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="w-3 h-3 sm:w-4 sm:h-4 text-gray-400" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/>
                                </svg>
                            </div>
                            <input id="sermonSearch" 
                                   class="w-full pl-9 sm:pl-10 pr-3 sm:pr-4 py-2 sm:py-2.5 bg-white border border-gray-300 rounded-xl text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-[#197b3b] focus:border-transparent transition-all text-sm sm:text-base"
                                   placeholder="Search sermons..."
                                   type="search">
                        </div>
                        
                        {{-- Filter Buttons --}}
                        <div class="flex gap-1 sm:gap-2 overflow-x-auto pb-1 sm:pb-2 scrollbar-hide" id="sermonFilters">
                            <button class="filter-btn active px-3 py-1.5 sm:px-4 sm:py-2 bg-gradient-to-r from-[#197b3b] to-emerald-600 text-white rounded-lg font-medium whitespace-nowrap hover:shadow-md transition-all text-xs sm:text-sm" data-filter="all">
                                All
                            </button>
                            <button class="filter-btn px-3 py-1.5 sm:px-4 sm:py-2 bg-gray-100 text-gray-700 rounded-lg font-medium whitespace-nowrap hover:bg-gray-200 transition-all text-xs sm:text-sm" data-filter="video">
                                Video
                            </button>
                            <button class="filter-btn px-3 py-1.5 sm:px-4 sm:py-2 bg-gray-100 text-gray-700 rounded-lg font-medium whitespace-nowrap hover:bg-gray-200 transition-all text-xs sm:text-sm" data-filter="audio">
                                Audio
                            </button>
                            <button class="filter-btn px-3 py-1.5 sm:px-4 sm:py-2 bg-gray-100 text-gray-700 rounded-lg font-medium whitespace-nowrap hover:bg-gray-200 transition-all text-xs sm:text-sm" data-filter="document">
                                Docs
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Recent Sermons Grid --}}
    <div class="px-4 sm:px-6 md:px-10 lg:px-40 py-8 sm:py-12 bg-[#197b3b]">
        <div class="max-w-[1200px] mx-auto">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6" id="sermonGrid">
                @foreach($sermons as $index => $sermon)
                    @if($index > 0) {{-- Skip first since it's featured --}}
                    <div class="sermon-card group relative bg-white rounded-xl sm:rounded-2xl border border-white/20 overflow-hidden hover:shadow-xl transition-all duration-300 hover:-translate-y-1 sm:hover:-translate-y-2 hover:border-white/40"
                         data-type="{{ $sermon->video_url ? 'video' : ($sermon->audio_url ? 'audio' : ($sermon->document_url ? 'document' : 'other')) }}">
                        
                        {{-- Corner Badge --}}
                        @if($sermon->sermon_date->isToday())
                            <div class="absolute top-2 right-2 sm:top-3 sm:right-3 z-10">
                                <span class="bg-gradient-to-r from-red-500 to-pink-600 text-white text-xs font-bold px-2 py-0.5 sm:px-3 sm:py-1 rounded-full shadow-lg">
                                    LIVE
                                </span>
                            </div>
                        @elseif($sermon->sermon_date->isCurrentWeek())
                            <div class="absolute top-2 right-2 sm:top-3 sm:right-3 z-10">
                                <span class="bg-gradient-to-r from-emerald-500 to-green-600 text-white text-xs font-bold px-2 py-0.5 sm:px-3 sm:py-1 rounded-full shadow-lg">
                                    NEW
                                </span>
                            </div>
                        @endif
                        
                        {{-- Thumbnail --}}
                        <div class="relative aspect-video overflow-hidden">
                            <div class="absolute inset-0 bg-gradient-to-br from-gray-900 to-black">
                                @if($sermon->video_url)
                                    <div class="w-full h-full bg-cover bg-center transition-transform duration-500 group-hover:scale-110" 
                                         style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuDZX1qfDh5RH4_pe13wEAQ_L7M7uj9YqntiZ9hLJSaymOb8s4xgy8L3qhwPQ0yQ7NkRyypl28ue2kpFh9Sy2yhP2mzkDlUwhlC4PMsvOpYwCDYua5jRUCq3VhVkiSwoXsWJ9XQZ4Qt6AW2E35jM3pmUC3YGvlMiHWWus04VwPf-GaTM1IWVi7YrtGvgt-i9Mi8qGWYN6wNxhaTgenhqWohjbaOxW49WJk0Umx8k0o0HT-evN-lNL-21xws8xBc3Tjzl8uWVQSqf0gw");'></div>
                                @else
                                    <div class="w-full h-full bg-gradient-to-br from-emerald-500 to-[#197b3b] flex items-center justify-center">
                                        @if($sermon->audio_url)
                                            <svg class="w-12 h-12 sm:w-16 sm:h-16 text-white/40" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M3 9v6h4l5 5V4L7 9H3zm13.5 3c0-1.77-1.02-3.29-2.5-4.03v8.05c1.48-.73 2.5-2.25 2.5-4.02zM14 3.23v2.06c2.89.86 5 3.54 5 6.71s-2.11 5.85-5 6.71v2.06c4.01-.91 7-4.49 7-8.77s-2.99-7.86-7-8.77z"/>
                                            </svg>
                                        @else
                                            <svg class="w-12 h-12 sm:w-16 sm:h-16 text-white/40" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M14 2H6c-1.1 0-1.99.9-1.99 2L4 20c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6zm2 16H8v-2h8v2zm0-4H8v-2h8v2zm-3-5V3.5L18.5 9H13z"/>
                                            </svg>
                                        @endif
                                    </div>
                                @endif
                            </div>
                            
                            {{-- Overlay Gradient --}}
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                            
                            {{-- Play Button --}}
                            <button onclick="{{ $sermon->video_url ? "showSermonModal('{$sermon->video_url}', '{$sermon->title}')" : "playAudio('{$sermon->audio_url}', '{$sermon->title}', '{$sermon->preacher}')" }}"
                                    class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                <div class="w-12 h-12 sm:w-16 sm:h-16 rounded-full bg-white/20 backdrop-blur-sm flex items-center justify-center transform group-hover:scale-110 transition-transform">
                                    <div class="w-8 h-8 sm:w-12 sm:h-12 rounded-full bg-white flex items-center justify-center">
                                        @if($sermon->video_url)
                                            <svg class="w-5 h-5 sm:w-8 sm:h-8 text-[#197b3b]" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M8 5v14l11-7z"/>
                                            </svg>
                                        @else
                                            <svg class="w-5 h-5 sm:w-8 sm:h-8 text-[#197b3b]" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M3 9v6h4l5 5V4L7 9H3zm13.5 3c0-1.77-1.02-3.29-2.5-4.03v8.05c1.48-.73 2.5-2.25 2.5-4.02zM14 3.23v2.06c2.89.86 5 3.54 5 6.71s-2.11 5.85-5 6.71v2.06c4.01-.91 7-4.49 7-8.77s-2.99-7.86-7-8.77z"/>
                                            </svg>
                                        @endif
                                    </div>
                                </div>
                            </button>
                            
                            {{-- Duration Badge --}}
                            @if($sermon->duration_formatted)
                                <div class="absolute bottom-2 right-2 sm:bottom-3 sm:right-3 bg-black/60 backdrop-blur-sm text-white text-xs font-bold px-1.5 py-0.5 sm:px-2 sm:py-1 rounded-lg flex items-center gap-1">
                                    <svg class="w-2 h-2 sm:w-3 sm:h-3" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8zm.5-13H11v6l5.25 3.15.75-1.23-4.5-2.67z"/>
                                    </svg>
                                    {{ $sermon->duration_formatted }}
                                </div>
                            @endif
                        </div>
                        
                        {{-- Content --}}
                        <div class="p-4 sm:p-6">
                            {{-- Scripture Reference --}}
                            @if($sermon->formatted_scriptures)
                                <div class="inline-flex items-center gap-1 mb-2 px-1.5 py-0.5 sm:px-2 sm:py-1 bg-[#197b3b]/10 rounded-lg">
                                    <svg class="w-2 h-2 sm:w-3 sm:h-3 text-[#197b3b]" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M21 5c-1.11-.35-2.33-.5-3.5-.5-1.95 0-4.05.4-5.5 1.5-1.45-1.1-3.55-1.5-5.5-1.5S2.45 4.9 1 6v14.65c0 .25.25.5.5.5.1 0 .15-.05.25-.05C3.1 20.45 5.05 20 6.5 20c1.95 0 4.05.4 5.5 1.5 1.35-.85 3.8-1.5 5.5-1.5 1.65 0 3.35.3 4.75 1.05.1.05.15.05.25.05.25 0 .5-.25.5-.5V6c-.6-.45-1.25-.75-2-1zM3 18.5V7c1.1-.35 2.3-.5 3.5-.5 1.34 0 3.13.41 4.5.99v11.5C9.63 18.41 7.84 18 6.5 18c-1.2 0-2.4.15-3.5.5zm18 0c-1.1-.35-2.3-.5-3.5-.5-1.34 0-3.13.41-4.5.99V7.49c1.37-.59 3.16-.99 4.5-.99 1.2 0 2.4.15 3.5.5v11.5z"/>
                                    </svg>
                                    <span class="text-[#197b3b] text-xs font-bold truncate">
                                        {{ Str::limit($sermon->formatted_scriptures, 20) }}
                                    </span>
                                </div>
                            @endif
                            
                            {{-- Title --}}
                            <h4 class="text-base sm:text-lg font-bold text-gray-900 mb-2 sm:mb-3 group-hover:text-[#197b3b] transition-colors line-clamp-2">
                                {{ Str::limit($sermon->title, 50) }}
                            </h4>
                            
                            {{-- Description --}}
                            <p class="text-gray-600 text-xs sm:text-sm mb-3 sm:mb-4 line-clamp-2">
                                {{ $sermon->description ? Str::limit($sermon->description, 70) : 'Listen to this inspiring message of faith.' }}
                            </p>
                            
                            {{-- Metadata --}}
                            <div class="flex items-center justify-between pt-3 sm:pt-4 border-t border-gray-200">
                                <div class="flex flex-col sm:flex-row sm:items-center gap-1 sm:gap-3">
                                    <div class="flex items-center gap-1 sm:gap-2">
                                        <svg class="w-2 h-2 sm:w-3 sm:h-3 text-gray-500" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                        </svg>
                                        <span class="text-xs sm:text-sm text-gray-600 truncate max-w-[80px] sm:max-w-none">{{ $sermon->preacher }}</span>
                                    </div>
                                    <div class="hidden sm:block w-1 h-1 bg-gray-300 rounded-full"></div>
                                    <span class="text-xs sm:text-sm text-gray-600">
                                        {{ $sermon->sermon_date->format('M d, Y') }}
                                    </span>
                                </div>
                                
                                {{-- Action Buttons --}}
                                <div class="flex gap-1">
                                    @if($sermon->video_url)
                                        <button onclick="showSermonModal('{{ $sermon->video_url }}', '{{ $sermon->title }}')"
                                                class="p-1 sm:p-2 text-gray-500 hover:text-[#197b3b] hover:bg-[#197b3b]/10 rounded-lg transition-all hover:scale-110"
                                                title="Watch video">
                                            <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M8 5v14l11-7z"/>
                                            </svg>
                                        </button>
                                    @endif
                                    
                                    @if($sermon->audio_url)
                                        <button onclick="playAudio('{{ $sermon->audio_url }}', '{{ $sermon->title }}', '{{ $sermon->preacher }}')"
                                                class="p-1 sm:p-2 text-gray-500 hover:text-[#197b3b] hover:bg-[#197b3b]/10 rounded-lg transition-all hover:scale-110"
                                                title="Listen audio">
                                            <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M3 9v6h4l5 5V4L7 9H3zm13.5 3c0-1.77-1.02-3.29-2.5-4.03v8.05c1.48-.73 2.5-2.25 2.5-4.02zM14 3.23v2.06c2.89.86 5 3.54 5 6.71s-2.11 5.85-5 6.71v2.06c4.01-.91 7-4.49 7-8.77s-2.99-7.86-7-8.77z"/>
                                            </svg>
                                        </button>
                                    @endif
                                    
                                    @if($sermon->document_url)
                                        <a href="{{ $sermon->document_url }}" target="_blank"
                                           class="p-1 sm:p-2 text-gray-500 hover:text-[#197b3b] hover:bg-[#197b3b]/10 rounded-lg transition-all hover:scale-110"
                                           title="Download PDF">
                                            <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M19 9h-4V3H9v6H5l7 7 7-7zM5 18v2h14v-2H5z"/>
                                            </svg>
                                        </a>
                                    @endif
                                    
                                    <a href="{{ route('sermons.show', $sermon) }}"
                                       class="p-1 sm:p-2 text-gray-500 hover:text-[#197b3b] hover:bg-[#197b3b]/10 rounded-lg transition-all hover:scale-110"
                                       title="View details">
                                        <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M19 19H5V5h7V3H5c-1.11 0-2 .9-2 2v14c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2v-7h-2v7zM14 3v2h3.59l-9.83 9.83 1.41 1.41L19 6.41V10h2V3h-7z"/>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                @endforeach
            </div>
            
            {{-- Pagination --}}
            @if($sermons->hasPages())
                <div class="mt-8 sm:mt-12">
                    <div class="bg-white rounded-xl border border-white/20 p-2 overflow-x-auto">
                        {{ $sermons->onEachSide(0)->links('pagination::tailwind') }}
                    </div>
                </div>
            @endif
        </div>
    </div>

    {{-- Documents & Newsletter Section --}}
    <div class="px-4 sm:px-6 md:px-10 lg:px-40 py-8 sm:py-12 bg-[#146c33]" id="documents">
        <div class="max-w-[1200px] mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 sm:gap-8">
                {{-- Documents Section --}}
                <div class="lg:col-span-2">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
                        <div>
                            <h2 class="text-xl sm:text-2xl md:text-3xl font-bold text-white flex items-center gap-3 mb-2">
                                <span class="w-8 sm:w-12 h-1 bg-gradient-to-r from-white to-emerald-300 rounded-full"></span>
                                Resources & Documents
                            </h2>
                            <p class="text-emerald-200 text-sm sm:text-base">Download study guides and newsletters</p>
                        </div>
                        <a href="#" class="text-white hover:text-emerald-100 font-bold flex items-center gap-2 group text-sm sm:text-base">
                            View All
                            <svg class="w-4 h-4 sm:w-5 sm:h-5 group-hover:translate-x-1 transition-transform" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M5 13h11.17l-4.88 4.88c-.39.39-.39 1.03 0 1.42.39.39 1.02.39 1.41 0l6.59-6.59c.39-.39.39-1.02 0-1.41l-6.58-6.6c-.39-.39-1.02-.39-1.41 0-.39.39-.39 1.02 0 1.41L16.17 11H5c-.55 0-1 .45-1 1s.45 1 1 1z"/>
                            </svg>
                        </a>
                    </div>
                    
                    <div class="bg-white rounded-xl sm:rounded-2xl border border-white/20 overflow-hidden shadow-xl">
                        <div class="divide-y divide-gray-200">
                            @php
                                $documents = $sermons->whereNotNull('document_url')->take(4);
                            @endphp
                            
                            @foreach($documents as $sermon)
                                <div class="p-4 sm:p-6 hover:bg-gray-50 transition-colors group">
                                    <div class="flex items-center gap-3 sm:gap-4">
                                        <div class="relative">
                                            <div class="w-10 h-10 sm:w-14 sm:h-14 rounded-lg sm:rounded-xl bg-gradient-to-br from-red-100 to-red-200 flex items-center justify-center group-hover:scale-110 transition-transform">
                                                <svg class="w-5 h-5 sm:w-8 sm:h-8 text-red-600" fill="currentColor" viewBox="0 0 24 24">
                                                    <path d="M20 2H8c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm0 14H8V4h12v12zM4 6H2v14c0 1.1.9 2 2 2h14v-2H4V6z"/>
                                                </svg>
                                            </div>
                                            <div class="absolute -top-1 -right-1 sm:-top-2 sm:-right-2 w-4 h-4 sm:w-6 sm:h-6 bg-[#197b3b] text-white rounded-full flex items-center justify-center text-xs font-bold">
                                                PDF
                                            </div>
                                        </div>
                                        
                                        <div class="flex-1 min-w-0">
                                            <h4 class="font-bold text-gray-900 truncate group-hover:text-[#197b3b] transition-colors text-sm sm:text-base">
                                                {{ Str::limit($sermon->title, 40) }}
                                            </h4>
                                            <div class="flex flex-col xs:flex-row xs:items-center gap-1 xs:gap-3 mt-1 sm:mt-2">
                                                <span class="text-xs sm:text-sm text-gray-600 flex items-center gap-1">
                                                    <svg class="w-2 h-2 sm:w-3 sm:h-3" fill="currentColor" viewBox="0 0 24 24">
                                                        <path d="M19 3h-1V1h-2v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V8h14v11zM7 10h5v5H7z"/>
                                                    </svg>
                                                    {{ $sermon->sermon_date->format('M d, Y') }}
                                                </span>
                                                <span class="hidden xs:block w-1 h-1 bg-gray-300 rounded-full"></span>
                                                <span class="text-xs sm:text-sm text-gray-600 flex items-center gap-1">
                                                    <svg class="w-2 h-2 sm:w-3 sm:h-3" fill="currentColor" viewBox="0 0 24 24">
                                                        <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                                    </svg>
                                                    {{ $sermon->preacher }}
                                                </span>
                                            </div>
                                        </div>
                                        
                                        <a href="{{ $sermon->document_url }}" target="_blank" 
                                           class="p-2 sm:p-3 rounded-lg sm:rounded-xl bg-gray-100 text-[#197b3b] hover:bg-[#197b3b] hover:text-white transition-all duration-300 hover:scale-110">
                                            <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M19 9h-4V3H9v6H5l7 7 7-7zM5 18v2h14v-2H5z"/>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                            
                            @if($documents->isEmpty())
                                <div class="p-8 sm:p-12 text-center">
                                    <div class="w-16 h-16 sm:w-20 sm:h-20 mx-auto mb-4 sm:mb-6 rounded-2xl bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                                        <svg class="w-8 h-8 sm:w-10 sm:h-10 text-gray-400" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M14 2H6c-1.1 0-1.99.9-1.99 2L4 20c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6zm2 16H8v-2h8v2zm0-4H8v-2h8v2zm-3-5V3.5L18.5 9H13z"/>
                                        </svg>
                                    </div>
                                    <h4 class="text-base sm:text-lg font-bold text-gray-900 mb-2">No documents yet</h4>
                                    <p class="text-gray-600 text-sm sm:text-base">Check back soon for resources</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                
                {{-- Sidebar --}}
                <div class="space-y-6 sm:space-y-8">
                    {{-- Newsletter Card --}}
                    <div class="relative overflow-hidden rounded-xl sm:rounded-2xl bg-gradient-to-br from-[#197b3b] via-emerald-600 to-[#146c33] p-6 sm:p-8 text-white shadow-xl">
                        <div class="absolute top-0 right-0 w-24 h-24 sm:w-32 sm:h-32 bg-white/10 rounded-full -translate-y-8 sm:-translate-y-16 translate-x-8 sm:translate-x-16"></div>
                        <div class="absolute bottom-0 left-0 w-32 h-32 sm:w-40 sm:h-40 bg-white/5 rounded-full translate-y-16 sm:translate-y-20 -translate-x-8 sm:-translate-x-20"></div>
                        
                        <div class="relative z-10">
                            <div class="w-12 h-12 sm:w-16 sm:h-16 rounded-xl sm:rounded-2xl bg-white/20 backdrop-blur-sm flex items-center justify-center mb-4 sm:mb-6">
                                <svg class="w-6 h-6 sm:w-8 sm:h-8" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/>
                                </svg>
                            </div>
                            
                            <h3 class="text-xl sm:text-2xl font-bold mb-2 sm:mb-3">Stay Inspired</h3>
                            <p class="text-emerald-100 text-sm sm:text-base mb-4 sm:mb-6">
                                Get weekly sermons, devotionals, and church updates delivered to your inbox.
                            </p>
                            
                            <form class="space-y-3 sm:space-y-4">
                                <input type="email" 
                                       placeholder="Your email address"
                                       class="w-full px-3 sm:px-4 py-2.5 sm:py-3 rounded-xl bg-white/20 backdrop-blur-sm border border-white/30 text-white placeholder-emerald-200 focus:outline-none focus:ring-2 focus:ring-white/50 text-sm sm:text-base">

                                <button type="submit"
                                        class="w-full px-4 sm:px-6 py-2.5 sm:py-3 bg-white text-[#197b3b] font-bold rounded-xl hover:bg-emerald-50 transition-colors shadow-lg hover:shadow-xl text-sm sm:text-base">
                                    Subscribe Now
                                </button>
                            </form>
                            
                            <p class="text-xs sm:text-sm text-emerald-200/70 mt-3 sm:mt-4">No spam, ever. Unsubscribe anytime.</p>
                        </div>
                    </div>
                    
                    {{-- Podcast Card --}}
                    <div class="bg-white rounded-xl sm:rounded-2xl border border-white/20 p-4 sm:p-6 shadow-xl">
                        <h3 class="text-lg sm:text-xl font-bold text-gray-900 mb-3 sm:mb-4 flex items-center gap-2">
                            <svg class="w-5 h-5 sm:w-6 sm:h-6 text-[#197b3b]" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M18 11c0-.959-.68-1.761-1.581-1.954C16.779 8.445 17 7.75 17 7c0-2.206-1.794-4-4-4-1.517 0-2.821.857-3.5 2.104C8.821 3.857 7.517 3 6 3 3.794 3 2 4.794 2 7c0 .902.312 1.727.827 2.396A1.994 1.994 0 0 0 2 11v2c0 1.103.897 2 2 2h.142c.446 1.722 1.997 3 3.858 3 2.206 0 4-1.794 4-4V5h1c1.103 0 2 .897 2 2v6.142c1.722.446 3 1.997 3 3.858 0 2.206-1.794 4-4 4s-4-1.794-4-4c0-1.861 1.278-3.412 3-3.858V13c0 1.103-.897 2-2 2h-1v-1c0-1.654-1.346-3-3-3s-3 1.346-3 3v1H4v-2h8v1c0 1.654 1.346 3 3 3s3-1.346 3-3c0-1.103-.897-2-2-2h-1V7h1c1.103 0 2-.897 2-2s-.897-2-2-2z"/>
                            </svg>
                            Listen Anywhere
                        </h3>
                        
                        <p class="text-gray-600 text-sm sm:text-base mb-4 sm:mb-6">
                            Subscribe to our podcast on your favorite platforms
                        </p>
                        
                        <div class="space-y-2 sm:space-y-3">
                            <a href="#" target="_blank" 
                               class="flex items-center gap-3 p-3 sm:p-4 rounded-xl border border-gray-200 hover:border-[#197b3b]/30 hover:shadow-md transition-all group">
                                <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl bg-gradient-to-br from-purple-100 to-pink-100 flex items-center justify-center">
                                    <svg class="w-5 h-5 sm:w-6 sm:h-6 text-purple-600" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M18 11c0-.959-.68-1.761-1.581-1.954C16.779 8.445 17 7.75 17 7c0-2.206-1.794-4-4-4-1.517 0-2.821.857-3.5 2.104C8.821 3.857 7.517 3 6 3 3.794 3 2 4.794 2 7c0 .902.312 1.727.827 2.396A1.994 1.994 0 0 0 2 11v2c0 1.103.897 2 2 2h.142c.446 1.722 1.997 3 3.858 3 2.206 0 4-1.794 4-4V5h1c1.103 0 2 .897 2 2v6.142c1.722.446 3 1.997 3 3.858 0 2.206-1.794 4-4 4s-4-1.794-4-4c0-1.861 1.278-3.412 3-3.858V13c0 1.103-.897 2-2 2h-1v-1c0-1.654-1.346-3-3-3s-3 1.346-3 3v1H4v-2h8v1c0 1.654 1.346 3 3 3s3-1.346 3-3c0-1.103-.897-2-2-2h-1V7h1c1.103 0 2-.897 2-2s-.897-2-2-2z"/>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <div class="font-bold text-gray-900 group-hover:text-[#197b3b] transition-colors text-sm sm:text-base">
                                        Apple Podcasts
                                    </div>
                                    <div class="text-xs sm:text-sm text-gray-600">Subscribe now</div>
                                </div>
                                <svg class="w-4 h-4 sm:w-5 sm:h-5 text-gray-400 group-hover:text-[#197b3b] transition-colors" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M19 19H5V5h7V3H5c-1.11 0-2 .9-2 2v14c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2v-7h-2v7zM14 3v2h3.59l-9.83 9.83 1.41 1.41L19 6.41V10h2V3h-7z"/>
                                </svg>
                            </a>
                            
                            <a href="#" target="_blank" 
                               class="flex items-center gap-3 p-3 sm:p-4 rounded-xl border border-gray-200 hover:border-[#197b3b]/30 hover:shadow-md transition-all group">
                                <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl bg-gradient-to-br from-green-100 to-emerald-100 flex items-center justify-center">
                                    <svg class="w-5 h-5 sm:w-6 sm:h-6 text-green-600" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 0C5.4 0 0 5.4 0 12s5.4 12 12 12 12-5.4 12-12S18.66 0 12 0zm5.521 17.34c-.24.359-.66.48-1.021.24-2.82-1.74-6.36-2.101-10.561-1.141-.418.122-.779-.179-.899-.539-.12-.421.18-.78.54-.9 4.56-1.021 8.52-.6 11.64 1.32.42.18.479.659.301 1.02zm1.44-3.3c-.301.42-.841.6-1.262.3-3.239-1.98-8.159-2.58-11.939-1.38-.479.12-1.02-.12-1.14-.6-.12-.48.12-1.021.6-1.141C9.6 9.9 15 10.561 18.72 12.84c.361.181.54.78.241 1.2zm.12-3.36C15.24 8.4 8.82 8.16 5.16 9.301c-.6.179-1.2-.181-1.38-.721-.18-.601.18-1.2.72-1.381 4.26-1.26 11.28-1.02 15.721 1.621.539.3.719 1.02.419 1.56-.299.421-1.02.601-1.559.3z"/>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <div class="font-bold text-gray-900 group-hover:text-[#197b3b] transition-colors text-sm sm:text-base">
                                        Spotify
                                    </div>
                                    <div class="text-xs sm:text-sm text-gray-600">Follow our show</div>
                                </div>
                                <svg class="w-4 h-4 sm:w-5 sm:h-5 text-gray-400 group-hover:text-[#197b3b] transition-colors" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M19 19H5V5h7V3H5c-1.11 0-2 .9-2 2v14c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2v-7h-2v7zM14 3v2h3.59l-9.83 9.83 1.41 1.41L19 6.41V10h2V3h-7z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

{{-- Video Modal --}}
<div class="modal fade" id="videoModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content bg-transparent border-0">
            <div class="modal-body p-2 sm:p-4 relative">
                <button type="button" class="absolute -top-8 sm:-top-12 right-0 w-8 h-8 sm:w-10 sm:h-10 bg-white/20 hover:bg-white/30 text-white rounded-full flex items-center justify-center backdrop-blur-sm" 
                        data-bs-dismiss="modal" aria-label="Close">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/>
                    </svg>
                </button>
                
                <div class="aspect-video w-full rounded-lg sm:rounded-2xl overflow-hidden shadow-2xl">
                    <iframe id="sermonVideo" class="w-full h-full" frameborder="0" 
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                            allowfullscreen>
                    </iframe>
                </div>
                
                <div class="mt-2 sm:mt-4 p-2 sm:p-4 bg-white/10 backdrop-blur-sm rounded-lg sm:rounded-xl">
                    <h3 id="videoTitle" class="text-base sm:text-xl font-bold text-white line-clamp-2"></h3>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Audio Player --}}
<div id="audioPlayer" class="hidden fixed bottom-0 left-0 w-full bg-white border-t border-gray-200 shadow-2xl transform translate-y-full transition-transform duration-500 z-50">
    <div class="px-3 sm:px-4 md:px-10 lg:px-40 py-2 sm:py-3">
        <div class="max-w-[1200px] mx-auto flex items-center justify-between gap-2 sm:gap-4 md:gap-6">
            {{-- Track Info --}}
            <div class="flex items-center gap-2 sm:gap-4 min-w-0">
                <div class="w-10 h-10 sm:w-12 sm:h-12 md:w-14 md:h-14 rounded-lg sm:rounded-xl bg-gradient-to-br from-[#197b3b] to-emerald-600 flex items-center justify-center shrink-0 shadow-lg">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6 md:w-8 md:h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M3 9v6h4l5 5V4L7 9H3zm13.5 3c0-1.77-1.02-3.29-2.5-4.03v8.05c1.48-.73 2.5-2.25 2.5-4.02zM14 3.23v2.06c2.89.86 5 3.54 5 6.71s-2.11 5.85-5 6.71v2.06c4.01-.91 7-4.49 7-8.77s-2.99-7.86-7-8.77z"/>
                    </svg>
                </div>
                
                <div class="min-w-0">
                    <h4 id="audioTitle" class="font-bold text-gray-900 truncate text-xs sm:text-sm md:text-base">Now Playing</h4>
                    <p id="audioPreacher" class="text-gray-600 truncate text-xs sm:text-sm"></p>
                </div>
            </div>
            
            {{-- Controls --}}
            <div class="flex items-center gap-1 sm:gap-2 md:gap-4">
                <button onclick="skipAudio(-15)" 
                        class="p-1 sm:p-2 text-gray-500 hover:text-[#197b3b] transition-colors hover:scale-110">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M11.99 5V1l-5 5 5 5V7c3.31 0 6 2.69 6 6s-2.69 6-6 6-6-2.69-6-6h-2c0 4.42 3.58 8 8 8s8-3.58 8-8-3.58-8-8-8z"/>
                    </svg>
                </button>
                
                <button id="playPauseBtn" 
                        onclick="toggleAudio()"
                        class="w-8 h-8 sm:w-10 sm:h-10 md:w-12 md:h-12 rounded-full bg-[#197b3b] text-white flex items-center justify-center hover:bg-[#146c33] shadow-lg hover:shadow-xl transition-all">
                    <svg id="playPauseIcon" class="w-4 h-4 sm:w-5 sm:h-5 md:w-6 md:h-6" fill="currentColor" viewBox="0 0 24 24">
                        <path id="playIcon" d="M8 5v14l11-7z" style="display: none;"/>
                        <path id="pauseIcon" d="M6 19h4V5H6v14zm8-14v14h4V5h-4z"/>
                    </svg>
                </button>
                
                <button onclick="skipAudio(15)" 
                        class="p-1 sm:p-2 text-gray-500 hover:text-[#197b3b] transition-colors hover:scale-110">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M5 4v2h3.59l-9.83 9.83 1.41 1.41L10 7.41V11h2V4H5z"/>
                    </svg>
                </button>
            </div>
            
            {{-- Volume --}}
            <div class="hidden sm:flex items-center gap-2 w-20 md:w-32 lg:w-40">
                <svg class="w-3 h-3 sm:w-4 sm:h-4 md:w-5 md:h-5 text-gray-400" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M3 9v6h4l5 5V4L7 9H3zm13.5 3c0-1.77-1.02-3.29-2.5-4.03v8.05c1.48-.73 2.5-2.25 2.5-4.02zM14 3.23v2.06c2.89.86 5 3.54 5 6.71s-2.11 5.85-5 6.71v2.06c4.01-.91 7-4.49 7-8.77s-2.99-7.86-7-8.77z"/>
                </svg>
                <input type="range" min="0" max="1" step="0.1" value="0.7" 
                       id="volumeSlider"
                       oninput="setVolume(this.value)"
                       class="flex-1 h-1 sm:h-1.5 bg-gray-200 rounded-full appearance-none [&::-webkit-slider-thumb]:appearance-none [&::-webkit-slider-thumb]:h-3 [&::-webkit-slider-thumb]:w-3 sm:[&::-webkit-slider-thumb]:h-4 sm:[&::-webkit-slider-thumb]:w-4 [&::-webkit-slider-thumb]:rounded-full [&::-webkit-slider-thumb]:bg-[#197b3b] hover:[&::-webkit-slider-thumb]:scale-110 sm:hover:[&::-webkit-slider-thumb]:scale-125 transition-transform">
            </div>
            
            {{-- Close --}}
            <button onclick="closeAudioPlayer()"
                    class="p-1 sm:p-2 text-gray-500 hover:text-red-500 transition-colors hover:scale-110">
                <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/>
                </svg>
            </button>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .font-sans {
        font-family: "Noto Sans", sans-serif;
    }
    
    .scrollbar-hide::-webkit-scrollbar {
        display: none;
    }
    
    .scrollbar-hide {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
    
    .line-clamp-2 {
        overflow: hidden;
        display: -webkit-box;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 2;
    }
    
    .line-clamp-3 {
        overflow: hidden;
        display: -webkit-box;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 3;
    }
    
    .filter-btn.active {
        background: linear-gradient(135deg, #197b3b 0%, #146c33 100%) !important;
        color: white !important;
        box-shadow: 0 4px 12px rgba(25, 123, 59, 0.3);
    }
    
    /* Responsive breakpoints */
    @media (max-width: 360px) {
        /* Extra small phones */
        .text-xs {
            font-size: 0.7rem !important;
        }
        .p-4 {
            padding: 0.75rem !important;
        }
    }
    
    @media (min-width: 361px) and (max-width: 480px) {
        /* Small phones */
        .text-sm {
            font-size: 0.813rem !important;
        }
    }
    
    @media (min-width: 481px) {
        /* Tablets and above */
        .xs\:inline {
            display: inline !important;
        }
        .xs\:hidden {
            display: none !important;
        }
    }
    
    /* Custom range slider for mobile */
    input[type="range"] {
        -webkit-appearance: none;
        appearance: none;
        background: transparent;
        cursor: pointer;
        width: 100%;
    }
    
    input[type="range"]::-webkit-slider-thumb {
        -webkit-appearance: none;
        appearance: none;
        border-radius: 50%;
        background: #197b3b;
        cursor: pointer;
        transition: all 0.2s;
    }
    
    input[type="range"]::-moz-range-thumb {
        border-radius: 50%;
        background: #197b3b;
        cursor: pointer;
        border: none;
        transition: all 0.2s;
    }
    
    /* Better touch targets for mobile */
    @media (max-width: 640px) {
        button, a, input, .clickable {
            min-height: 44px;
            min-width: 44px;
        }
        
        .sermon-card {
            min-height: 320px;
        }
    }
    
    /* Glass effect */
    .backdrop-blur-sm {
        backdrop-filter: blur(8px);
    }
    
    .backdrop-blur-xl {
        backdrop-filter: blur(24px);
    }
    
    /* Prevent horizontal scroll */
    html, body {
        overflow-x: hidden;
        max-width: 100%;
    }
    
    /* Smooth transitions */
    .transition-all {
        transition-property: all;
        transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
    }
</style>
@endpush

@push('scripts')
<script>
    // Enhanced JavaScript with mobile optimizations
    let audioPlayer = null;
    let currentAudioUrl = '';
    let currentAudioTitle = '';
    let currentAudioPreacher = '';
    let isPlaying = false;

    function playAudio(url, title, preacher = '') {
        currentAudioUrl = url;
        currentAudioTitle = title;
        currentAudioPreacher = preacher;
        
        if (!audioPlayer) {
            audioPlayer = new Audio();
            audioPlayer.addEventListener('ended', () => {
                isPlaying = false;
                updatePlayPauseIcon();
            });
        }
        
        audioPlayer.src = url;
        audioPlayer.load();
        
        document.getElementById('audioTitle').textContent = title;
        document.getElementById('audioPreacher').textContent = preacher;
        
        const playerElement = document.getElementById('audioPlayer');
        playerElement.classList.remove('hidden');
        setTimeout(() => {
            playerElement.classList.remove('translate-y-full');
        }, 10);
        
        audioPlayer.play();
        isPlaying = true;
        updatePlayPauseIcon();
    }

    function toggleAudio() {
        if (!audioPlayer) return;
        
        if (isPlaying) {
            audioPlayer.pause();
        } else {
            audioPlayer.play();
        }
        isPlaying = !isPlaying;
        updatePlayPauseIcon();
    }

    function updatePlayPauseIcon() {
        const playIcon = document.getElementById('playIcon');
        const pauseIcon = document.getElementById('pauseIcon');
        
        if (isPlaying) {
            playIcon.style.display = 'none';
            pauseIcon.style.display = 'block';
        } else {
            playIcon.style.display = 'block';
            pauseIcon.style.display = 'none';
        }
    }

    function skipAudio(seconds) {
        if (!audioPlayer) return;
        audioPlayer.currentTime += seconds;
    }

    function setVolume(value) {
        if (audioPlayer) {
            audioPlayer.volume = value;
        }
    }

    function closeAudioPlayer() {
        if (audioPlayer && isPlaying) {
            audioPlayer.pause();
            isPlaying = false;
            updatePlayPauseIcon();
        }
        
        const playerElement = document.getElementById('audioPlayer');
        playerElement.classList.add('translate-y-full');
        setTimeout(() => {
            playerElement.classList.add('hidden');
        }, 500);
    }

    function showSermonModal(videoUrl, title) {
        const modal = new bootstrap.Modal(document.getElementById('videoModal'));
        const videoFrame = document.getElementById('sermonVideo');
        const titleElement = document.getElementById('videoTitle');
        
        let embedUrl = videoUrl;
        if (videoUrl.includes('youtube.com') || videoUrl.includes('youtu.be')) {
            let videoId = videoUrl.split('v=')[1];
            if (!videoId && videoUrl.includes('youtu.be')) {
                videoId = videoUrl.split('youtu.be/')[1];
            }
            if (videoId) {
                videoId = videoId.split('&')[0];
                embedUrl = `https://www.youtube.com/embed/${videoId}?autoplay=1&rel=0&modestbranding=1`;
            }
        }
        
        videoFrame.src = embedUrl;
        titleElement.textContent = title;
        modal.show();
    }

    // Enhanced filter and search for mobile
    document.addEventListener('DOMContentLoaded', function() {
        const filterButtons = document.querySelectorAll('.filter-btn');
        const sermonCards = document.querySelectorAll('.sermon-card');
        const searchInput = document.getElementById('sermonSearch');
        
        // Handle filter buttons with better mobile UX
        filterButtons.forEach(button => {
            button.addEventListener('click', function() {
                filterButtons.forEach(btn => btn.classList.remove('active'));
                this.classList.add('active');
                
                const filterType = this.dataset.filter;
                
                sermonCards.forEach(card => {
                    const cardType = card.dataset.type;
                    
                    if (filterType === 'all' || cardType === filterType) {
                        card.style.opacity = '1';
                        card.style.pointerEvents = 'all';
                        card.style.display = 'flex';
                    } else {
                        card.style.opacity = '0.3';
                        card.style.pointerEvents = 'none';
                        setTimeout(() => {
                            card.style.display = 'none';
                        }, 300);
                    }
                });
            });
        });
        
        // Search functionality with debounce for mobile performance
        let searchTimeout;
        if (searchInput) {
            searchInput.addEventListener('input', function() {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(() => {
                    const searchTerm = this.value.toLowerCase();
                    
                    sermonCards.forEach(card => {
                        const title = card.querySelector('h4').textContent.toLowerCase();
                        const description = card.querySelector('p').textContent.toLowerCase();
                        const preacherElement = card.querySelector('.text-gray-600');
                        const preacher = preacherElement ? preacherElement.textContent.toLowerCase() : '';
                        
                        if (title.includes(searchTerm) || description.includes(searchTerm) || preacher.includes(searchTerm)) {
                            card.style.display = 'flex';
                            card.style.opacity = '1';
                            card.style.pointerEvents = 'all';
                        } else {
                            card.style.opacity = '0.3';
                            card.style.pointerEvents = 'none';
                            setTimeout(() => {
                                card.style.display = 'none';
                            }, 300);
                        }
                    });
                }, 300); // 300ms debounce
            });
        }
        
        // Sticky header with mobile optimization
        const stickyHeader = document.getElementById('sticky-header');
        if (stickyHeader) {
            let lastScrollTop = 0;
            window.addEventListener('scroll', function() {
                let scrollTop = window.pageYOffset || document.documentElement.scrollTop;
                
                if (scrollTop > lastScrollTop && scrollTop > 100) {
                    // Scrolling down
                    stickyHeader.classList.add('shadow-lg', 'bg-white/95');
                } else {
                    // Scrolling up
                    stickyHeader.classList.remove('shadow-lg', 'bg-white/95');
                }
                lastScrollTop = scrollTop;
            });
        }
        
        // Smooth scroll for anchor links with mobile offset
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const targetId = this.getAttribute('href');
                if (targetId === '#') return;
                
                const targetElement = document.querySelector(targetId);
                if (targetElement) {
                    const offset = window.innerWidth < 640 ? 60 : 80;
                    window.scrollTo({
                        top: targetElement.offsetTop - offset,
                        behavior: 'smooth'
                    });
                }
            });
        });
        
        // Initialize audio player icons
        updatePlayPauseIcon();
        
        // Handle video modal for mobile
        const videoModal = document.getElementById('videoModal');
        if (videoModal) {
            videoModal.addEventListener('hidden.bs.modal', function () {
                const videoFrame = document.getElementById('sermonVideo');
                videoFrame.src = '';
            });
        }
        
        // Prevent zoom on double-tap for better mobile UX
        let lastTouchEnd = 0;
        document.addEventListener('touchend', function (event) {
            const now = (new Date()).getTime();
            if (now - lastTouchEnd <= 300) {
                event.preventDefault();
            }
            lastTouchEnd = now;
        }, false);
    });
</script>
@endpush