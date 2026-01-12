@extends('admin.layouts.app')

@section('content')
<div class="relative flex h-auto min-h-screen w-full flex-col overflow-x-hidden bg-background-light dark:bg-background-dark">
    <!-- TopAppBar -->
    <header class="sticky top-0 z-20 backdrop-blur-md bg-background-light/80 dark:bg-background-dark/80 border-b border-primary/10">
        <div class="flex items-center p-4 pb-2 justify-between">
            <div class="text-primary flex size-12 shrink-0 items-center justify-start">
                <a href="{{ route('admin.dashboard') }}" class="text-primary">
                    <span class="material-symbols-outlined cursor-pointer">arrow_back_ios</span>
                </a>
            </div>
            <h2 class="text-slate-900 dark:text-white text-lg font-bold leading-tight tracking-[-0.015em] flex-1 text-center font-display">
                Newsletter Management
            </h2>
            <div class="flex w-12 items-center justify-end">
                <button class="flex items-center justify-center rounded-lg h-12 w-12 bg-transparent text-primary">
                    <span class="material-symbols-outlined">more_vert</span>
                </button>
            </div>
        </div>
    </header>

    <main class="flex-1 pb-24">
        @if(session('success'))
        <div class="mx-4 mt-4 p-4 bg-emerald-50 dark:bg-emerald-900/20 border border-emerald-200 dark:border-emerald-800 rounded-xl">
            <div class="flex items-center">
                <span class="material-symbols-outlined text-emerald-600 dark:text-emerald-400 mr-3">check_circle</span>
                <p class="text-emerald-800 dark:text-emerald-300">{{ session('success') }}</p>
            </div>
        </div>
        @endif

        @if(session('error'))
        <div class="mx-4 mt-4 p-4 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-xl">
            <div class="flex items-center">
                <span class="material-symbols-outlined text-red-600 dark:text-red-400 mr-3">error</span>
                <p class="text-red-800 dark:text-red-300">{{ session('error') }}</p>
            </div>
        </div>
        @endif

        <!-- SearchBar -->
        <div class="px-4 py-4">
            <form method="GET" action="{{ route('admin.newsletter.campaigns') }}">
                <label class="flex flex-col min-w-40 h-12 w-full">
                    <div class="flex w-full flex-1 items-stretch rounded-xl h-full shadow-sm">
                        <div class="text-primary/60 flex border-none bg-white dark:bg-[#1d2d23] items-center justify-center pl-4 rounded-l-xl">
                            <span class="material-symbols-outlined text-[20px]">search</span>
                        </div>
                        <input type="text" name="search" 
                               class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-xl text-slate-900 dark:text-white focus:outline-0 focus:ring-0 border-none bg-white dark:bg-[#1d2d23] focus:border-none h-full placeholder:text-slate-400 dark:placeholder:text-[#a0b6a8] px-4 rounded-l-none border-l-0 pl-2 text-base font-normal leading-normal" 
                               placeholder="Search newsletters..." 
                               value="{{ request('search') }}"/>
                    </div>
                </label>
            </form>
        </div>

        <!-- Stats Cards -->
        <div class="px-4 mb-4">
            <div class="grid grid-cols-3 gap-3">
                <div class="bg-white dark:bg-[#1d2520] rounded-xl p-3 border border-slate-100 dark:border-primary/5">
                    <div class="text-center">
                        <div class="text-2xl font-bold text-primary">{{ $activeSubscribers ?? \App\Models\NewsletterSubscriber::where('is_active', true)->count() }}</div>
                        <div class="text-xs text-slate-500 dark:text-[#a0b6a8] mt-1">Active Subscribers</div>
                    </div>
                </div>
                <div class="bg-white dark:bg-[#1d2520] rounded-xl p-3 border border-slate-100 dark:border-primary/5">
                    <div class="text-center">
                        <div class="text-2xl font-bold text-amber-600">{{ $sentCampaigns ?? \App\Models\NewsletterCampaign::where('status', 'sent')->count() }}</div>
                        <div class="text-xs text-slate-500 dark:text-[#a0b6a8] mt-1">Sent Campaigns</div>
                    </div>
                </div>
                <div class="bg-white dark:bg-[#1d2520] rounded-xl p-3 border border-slate-100 dark:border-primary/5">
                    <div class="text-center">
                        @php
                            $drafts = \App\Models\NewsletterCampaign::where('status', 'draft')->count();
                        @endphp
                        <div class="text-2xl font-bold text-slate-600 dark:text-slate-300">{{ $drafts }}</div>
                        <div class="text-xs text-slate-500 dark:text-[#a0b6a8] mt-1">Drafts</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Drafts Section -->
        @php
            $draftCampaigns = $campaigns->where('status', 'draft')->take(2);
        @endphp
        
        @if($draftCampaigns->count() > 0)
        <div class="flex items-center justify-between px-4 pt-4">
            <h3 class="text-slate-900 dark:text-white text-lg font-bold leading-tight tracking-[-0.015em] font-display">Drafts</h3>
            <span class="text-xs font-semibold text-primary px-2 py-1 bg-primary/10 rounded">
                {{ $draftCampaigns->count() }} active
            </span>
        </div>
        
        <div class="p-4 space-y-4">
            @foreach($draftCampaigns as $campaign)
            <!-- Card: Draft -->
            <div class="group flex items-stretch justify-between gap-4 rounded-xl bg-white dark:bg-[#1d2520] p-4 shadow-sm border border-slate-100 dark:border-primary/5 hover:border-primary/20 transition-all">
                <div class="flex flex-col gap-1 flex-[2_2_0px]">
                    <div class="flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-slate-400"></span>
                        <p class="text-slate-500 dark:text-[#a0b6a8] text-xs font-medium uppercase tracking-wider">
                            Draft
                        </p>
                    </div>
                    <p class="text-slate-900 dark:text-white text-base font-bold leading-tight font-display">
                        {{ Str::limit($campaign->subject, 40) }}
                    </p>
                    <p class="text-slate-500 dark:text-[#a0b6a8] text-sm font-normal leading-normal">
                        Last edited: {{ $campaign->updated_at->format('M d, Y') }}
                    </p>
                </div>
                <div class="w-32 bg-center bg-no-repeat aspect-video bg-cover rounded-lg shrink-0 overflow-hidden bg-gradient-to-br from-slate-100 to-slate-200 dark:from-slate-800 dark:to-slate-900 flex items-center justify-center">
                    @if($campaign->featured_image)
                    <img src="{{ asset('storage/' . $campaign->featured_image) }}" 
                         alt="{{ $campaign->subject }}" 
                         class="w-full h-full object-cover">
                    @else
                    <span class="material-symbols-outlined text-slate-400 dark:text-slate-600 text-3xl">
                        draft
                    </span>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        @endif

        <!-- Scheduled Section -->
        @php
            $scheduledCampaigns = $campaigns->where('status', 'scheduled');
        @endphp
        
        @if($scheduledCampaigns->count() > 0)
        <div class="flex items-center justify-between px-4 pt-6">
            <h3 class="text-slate-900 dark:text-white text-lg font-bold leading-tight tracking-[-0.015em] font-display">Scheduled</h3>
            <a href="{{ route('admin.newsletter.campaigns') }}?status=scheduled" class="text-primary text-sm font-semibold">See all</a>
        </div>
        
        <div class="p-4 space-y-4">
            @foreach($scheduledCampaigns as $campaign)
            <div class="group flex items-stretch justify-between gap-4 rounded-xl bg-white dark:bg-[#1d2520] p-4 shadow-sm border border-slate-100 dark:border-primary/5 hover:border-primary/20 transition-all">
                <div class="flex flex-col gap-1 flex-[2_2_0px]">
                    <div class="flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                        <p class="text-amber-600 dark:text-amber-500 text-xs font-medium uppercase tracking-wider">
                            Scheduled
                        </p>
                    </div>
                    <p class="text-slate-900 dark:text-white text-base font-bold leading-tight font-display">
                        {{ Str::limit($campaign->subject, 40) }}
                    </p>
                    <p class="text-slate-500 dark:text-[#a0b6a8] text-sm font-normal leading-normal">
                        Scheduled for {{ $campaign->scheduled_at->format('M d, Y') }}
                    </p>
                </div>
                <div class="w-32 bg-center bg-no-repeat aspect-video bg-cover rounded-lg shrink-0 overflow-hidden bg-gradient-to-br from-amber-50 to-amber-100 dark:from-amber-900/20 dark:to-amber-900/10 flex items-center justify-center">
                    @if($campaign->featured_image)
                    <img src="{{ asset('storage/' . $campaign->featured_image) }}" 
                         alt="{{ $campaign->subject }}" 
                         class="w-full h-full object-cover">
                    @else
                    <span class="material-symbols-outlined text-amber-400 text-3xl">
                        schedule
                    </span>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        @endif

        <!-- Sent History Section -->
        @php
            $sentCampaigns = $campaigns->where('status', 'sent')->take(3);
        @endphp
        
        @if($sentCampaigns->count() > 0)
        <div class="flex items-center justify-between px-4 pt-6">
            <h3 class="text-slate-900 dark:text-white text-lg font-bold leading-tight tracking-[-0.015em] font-display">Sent History</h3>
            <a href="{{ route('admin.newsletter.campaigns') }}?status=sent" class="text-primary text-sm font-semibold">See all</a>
        </div>
        
        <div class="p-4 space-y-4">
            @foreach($sentCampaigns as $campaign)
            <a href="{{ route('admin.newsletter.show', $campaign) }}" class="block">
                <div class="group flex items-center justify-between gap-4 rounded-xl bg-white dark:bg-[#1d2520] p-4 shadow-sm border border-slate-100 dark:border-primary/5 hover:border-primary/20 transition-all">
                    <div class="flex flex-col gap-1 flex-1">
                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary text-[14px]">check_circle</span>
                            <p class="text-primary text-xs font-medium uppercase tracking-wider">Sent</p>
                        </div>
                        <p class="text-slate-900 dark:text-white text-base font-bold leading-tight font-display">
                            {{ Str::limit($campaign->subject, 40) }}
                        </p>
                        <p class="text-slate-500 dark:text-[#a0b6a8] text-sm font-normal">
                            Sent on {{ $campaign->sent_at->format('M d, Y') }} • 
                            {{ $campaign->sent_count }} recipients
                        </p>
                    </div>
                    <div class="text-slate-400">
                        <span class="material-symbols-outlined">chevron_right</span>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
        @endif

        <!-- Empty State -->
        @if($campaigns->count() === 0)
        <div class="flex flex-col items-center justify-center py-16 px-4">
            <div class="w-20 h-20 rounded-full bg-primary/10 flex items-center justify-center mb-6">
                <span class="material-symbols-outlined text-primary text-3xl">
                    campaign
                </span>
            </div>
            <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-2">No campaigns yet</h3>
            <p class="text-slate-500 dark:text-[#a0b6a8] text-center mb-6">
                Start creating newsletters to communicate with your congregation
            </p>
            <a href="{{ route('admin.newsletter.create') }}" 
               class="bg-primary hover:bg-primary/90 text-white font-bold py-3 px-6 rounded-xl shadow-lg shadow-primary/20 flex items-center justify-center gap-2 transition-transform active:scale-[0.98]">
                <span class="material-symbols-outlined">add</span>
                Create First Campaign
            </a>
        </div>
        @endif
    </main>

    <!-- Floating Action Button -->
    <div class="fixed bottom-8 right-8 z-30 flex justify-center items-center">
        <a href="{{ route('admin.newsletter.create') }}" 
           class="flex h-14 w-14 items-center justify-center rounded-full bg-primary text-white shadow-lg hover:scale-105 transition-transform active:scale-95 focus:outline-none focus:ring-4 focus:ring-primary/40">
            <span class="material-symbols-outlined text-3xl">add</span>
        </a>
    </div>

    <!-- Navigation Bar (iOS Style Placeholder) -->
    <nav class="fixed bottom-0 left-0 right-0 h-16 bg-white/95 dark:bg-[#122017]/95 backdrop-blur-md border-t border-primary/10 flex items-center justify-around px-6">
        <a href="{{ route('admin.dashboard') }}" class="flex flex-col items-center gap-1 text-slate-400 hover:text-primary transition-colors">
            <span class="material-symbols-outlined text-[24px]">dashboard</span>
            <span class="text-[10px] font-medium">Home</span>
        </a>
        <a href="{{ route('admin.newsletter.campaigns') }}" class="flex flex-col items-center gap-1 text-primary">
            <span class="material-symbols-outlined text-[24px] fill-current" style="font-variation-settings: 'FILL' 1">mail</span>
            <span class="text-[10px] font-bold">Newsletters</span>
        </a>
        <a href="{{ route('admin.newsletter.subscribers') }}" class="flex flex-col items-center gap-1 text-slate-400 hover:text-primary transition-colors">
            <span class="material-symbols-outlined text-[24px]">group</span>
            <span class="text-[10px] font-medium">Subscribers</span>
        </a>
        <a href="#" class="flex flex-col items-center gap-1 text-slate-400 hover:text-primary transition-colors">
            <span class="material-symbols-outlined text-[24px]">settings</span>
            <span class="text-[10px] font-medium">Settings</span>
        </a>
    </nav>
</div>

@push('styles')
<style>
    .material-symbols-outlined {
        font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
    }
    
    .form-input:focus {
        border-color: #197b3b !important;
        box-shadow: 0 0 0 1px #197b3b !important;
    }
    
    body {
        font-family: 'Public Sans', sans-serif;
        -webkit-tap-highlight-color: transparent;
    }
</style>
@endpush
@endsection