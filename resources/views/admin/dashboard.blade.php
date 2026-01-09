@extends('admin.layouts.app')

@section('title', 'Dashboard - ELCK Diocese Admin')

@section('content')
    <!-- Stats Section -->
    <section class="px-4 py-6">
        <div class="flex flex-col gap-4">
            <!-- Hero Stat -->
            <div class="relative overflow-hidden rounded-xl bg-primary p-6 shadow-lg shadow-primary/20">
                <div class="absolute top-0 right-0 -mr-8 -mt-8 size-32 rounded-full bg-white/10 blur-2xl"></div>
                <div class="relative z-10">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-primary-100 text-sm font-medium mb-1 opacity-90">Total Congregants</p>
                            <h3 class="text-4xl font-bold text-white tracking-tight">{{ number_format($totalCongregants) }}</h3>
                        </div>
                        <div class="flex items-center gap-1 rounded-full bg-white/20 px-2 py-1 text-xs font-bold text-white backdrop-blur-sm">
                            <span class="material-symbols-outlined text-[14px]">trending_up</span>
                            <span>{{ number_format($growthPercentage, 1) }}%</span>
                        </div>
                    </div>
                    <p class="mt-4 text-xs text-white/70">Updated {{ now()->format('F j, Y \a\t g:i A') }}</p>
                </div>
            </div>
            
            <!-- Secondary Stats Grid -->
            <div class="grid grid-cols-2 gap-4">
                <div class="flex flex-col gap-1 rounded-xl bg-white dark:bg-surface-dark p-5 border border-slate-200 dark:border-white/5 shadow-sm">
                    <div class="mb-2 flex size-10 items-center justify-center rounded-lg bg-blue-100 dark:bg-blue-500/20 text-blue-600 dark:text-blue-400">
                        <span class="material-symbols-outlined">church</span>
                    </div>
                    <p class="text-sm text-slate-500 dark:text-slate-400 font-medium">Active Parishes</p>
                    <p class="text-2xl font-bold text-slate-900 dark:text-white">{{ $activeParishes }}</p>
                </div>
                
                <div class="flex flex-col gap-1 rounded-xl bg-white dark:bg-surface-dark p-5 border border-slate-200 dark:border-white/5 shadow-sm">
                    <div class="mb-2 flex size-10 items-center justify-center rounded-lg bg-orange-100 dark:bg-orange-500/20 text-orange-600 dark:text-orange-400">
                        <span class="material-symbols-outlined">event</span>
                    </div>
                    <div class="flex justify-between items-end">
                        <div>
                            <p class="text-sm text-slate-500 dark:text-slate-400 font-medium">Events</p>
                            <p class="text-2xl font-bold text-slate-900 dark:text-white">{{ $upcomingEvents }}</p>
                        </div>
                        @if($newEventsThisMonth > 0)
    <span class="text-xs font-medium text-primary mb-1">+{{ $newEventsThisMonth }} new</span>
@endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Quick Actions -->
<section class="mb-8">
    <!-- Header -->
    <div class="flex items-center justify-between mb-5 px-1">
        <div>
            <h3 class="text-xl font-bold text-secondary leading-tight">Quick Actions</h3>
            <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Frequently used admin tools</p>
        </div>
        <button class="text-sm font-medium text-primary hover:text-secondary transition-colors flex items-center gap-1 px-3 py-1.5 rounded-lg hover:bg-slate-100 dark:hover:bg-white/5">
            <span class="material-symbols-outlined text-[18px]">tune</span>
            Customize
        </button>
    </div>

    <!-- Actions Grid -->
    <div class="grid grid-cols-4 gap-3">
        <!-- Add Member -->
        <a href="{{ route('admin.members.create') }}" 
           class="group relative flex flex-col items-center p-4 rounded-2xl bg-white dark:bg-surface-dark border border-slate-200 dark:border-white/10 hover:border-primary/30 dark:hover:border-primary/30 transition-all duration-200 hover:shadow-md active:scale-[0.98]">
            <div class="flex size-12 items-center justify-center rounded-xl bg-primary/10 mb-3 group-hover:bg-primary/15 transition-colors">
                <span class="material-symbols-outlined text-[26px] text-primary">person_add</span>
            </div>
            <span class="text-xs font-semibold text-secondary dark:text-white text-center leading-tight">Add Member</span>
            <span class="absolute -top-1 -right-1 size-5 bg-primary text-white text-[10px] font-bold rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                +
            </span>
        </a>
        
        <!-- View Tithes -->
        <a href="#" 
           class="group flex flex-col items-center p-4 rounded-2xl bg-white dark:bg-surface-dark border border-slate-200 dark:border-white/10 hover:border-primary/30 dark:hover:border-primary/30 transition-all duration-200 hover:shadow-md active:scale-[0.98]">
            <div class="flex size-12 items-center justify-center rounded-xl bg-emerald-100 dark:bg-emerald-900/30 mb-3 group-hover:bg-emerald-200 dark:group-hover:bg-emerald-900/50 transition-colors">
                <span class="material-symbols-outlined text-[26px] text-emerald-600 dark:text-emerald-400">payments</span>
            </div>
            <span class="text-xs font-semibold text-secondary dark:text-white text-center leading-tight">View Tithes</span>
        </a>
        
        <!-- Calendar -->
        <a href="{{ route('admin.events.index') }}" 
           class="group flex flex-col items-center p-4 rounded-2xl bg-white dark:bg-surface-dark border border-slate-200 dark:border-white/10 hover:border-primary/30 dark:hover:border-primary/30 transition-all duration-200 hover:shadow-md active:scale-[0.98]">
            <div class="flex size-12 items-center justify-center rounded-xl bg-blue-100 dark:bg-blue-900/30 mb-3 group-hover:bg-blue-200 dark:group-hover:bg-blue-900/50 transition-colors">
                <span class="material-symbols-outlined text-[26px] text-blue-600 dark:text-blue-400">calendar_month</span>
            </div>
            <span class="text-xs font-semibold text-secondary dark:text-white text-center leading-tight">Calendar</span>
        </a>
        
        <!-- Send Communications -->
        <a href="{{ route('admin.newsletter.create') }}" 
           class="group flex flex-col items-center p-4 rounded-2xl bg-white dark:bg-surface-dark border border-slate-200 dark:border-white/10 hover:border-primary/30 dark:hover:border-primary/30 transition-all duration-200 hover:shadow-md active:scale-[0.98]">
            <div class="flex size-12 items-center justify-center rounded-xl bg-purple-100 dark:bg-purple-900/30 mb-3 group-hover:bg-purple-200 dark:group-hover:bg-purple-900/50 transition-colors">
                <span class="material-symbols-outlined text-[26px] text-purple-600 dark:text-purple-400">send</span>
            </div>
            <span class="text-xs font-semibold text-secondary dark:text-white text-center leading-tight">Send Comms</span>
        </a>
    </div>

    <!-- Second Row - More Actions -->
    <div class="grid grid-cols-4 gap-3 mt-3">
        <!-- Add Sermon -->
        <a href="{{ route('admin.sermons.create') }}" 
           class="group flex flex-col items-center p-4 rounded-2xl bg-white dark:bg-surface-dark border border-slate-200 dark:border-white/10 hover:border-primary/30 dark:hover:border-primary/30 transition-all duration-200 hover:shadow-md active:scale-[0.98]">
            <div class="flex size-12 items-center justify-center rounded-xl bg-amber-100 dark:bg-amber-900/30 mb-3 group-hover:bg-amber-200 dark:group-hover:bg-amber-900/50 transition-colors">
                <span class="material-symbols-outlined text-[26px] text-amber-600 dark:text-amber-400">library_books</span>
            </div>
            <span class="text-xs font-semibold text-secondary dark:text-white text-center leading-tight">Add Sermon</span>
        </a>
        
        <!-- Add Ministry -->
        <a href="{{ route('admin.ministries.create') }}" 
           class="group flex flex-col items-center p-4 rounded-2xl bg-white dark:bg-surface-dark border border-slate-200 dark:border-white/10 hover:border-primary/30 dark:hover:border-primary/30 transition-all duration-200 hover:shadow-md active:scale-[0.98]">
            <div class="flex size-12 items-center justify-center rounded-xl bg-indigo-100 dark:bg-indigo-900/30 mb-3 group-hover:bg-indigo-200 dark:group-hover:bg-indigo-900/50 transition-colors">
                <span class="material-symbols-outlined text-[26px] text-indigo-600 dark:text-indigo-400">diversity_3</span>
            </div>
            <span class="text-xs font-semibold text-secondary dark:text-white text-center leading-tight">Add Ministry</span>
        </a>
        
        <!-- Upload Gallery -->
        <a href="{{ route('admin.gallery.create') }}" 
           class="group flex flex-col items-center p-4 rounded-2xl bg-white dark:bg-surface-dark border border-slate-200 dark:border-white/10 hover:border-primary/30 dark:hover:border-primary/30 transition-all duration-200 hover:shadow-md active:scale-[0.98]">
            <div class="flex size-12 items-center justify-center rounded-xl bg-pink-100 dark:bg-pink-900/30 mb-3 group-hover:bg-pink-200 dark:group-hover:bg-pink-900/50 transition-colors">
                <span class="material-symbols-outlined text-[26px] text-pink-600 dark:text-pink-400">photo_library</span>
            </div>
            <span class="text-xs font-semibold text-secondary dark:text-white text-center leading-tight">Upload Gallery</span>
        </a>
        
        <!-- Generate Report -->
        <a href="#" 
           class="group flex flex-col items-center p-4 rounded-2xl bg-white dark:bg-surface-dark border border-slate-200 dark:border-white/10 hover:border-primary/30 dark:hover:border-primary/30 transition-all duration-200 hover:shadow-md active:scale-[0.98]">
            <div class="flex size-12 items-center justify-center rounded-xl bg-cyan-100 dark:bg-cyan-900/30 mb-3 group-hover:bg-cyan-200 dark:group-hover:bg-cyan-900/50 transition-colors">
                <span class="material-symbols-outlined text-[26px] text-cyan-600 dark:text-cyan-400">insights</span>
            </div>
            <span class="text-xs font-semibold text-secondary dark:text-white text-center leading-tight">Generate Report</span>
        </a>
    </div>
</section>

<!-- Quick Stats -->
<section class="mb-8">
    <div class="flex items-center justify-between mb-5 px-1">
        <div>
            <h3 class="text-xl font-bold text-secondary leading-tight">Quick Stats</h3>
            <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Current church metrics</p>
        </div>
        <button class="text-sm font-medium text-primary hover:text-secondary transition-colors flex items-center gap-1 px-3 py-1.5 rounded-lg hover:bg-slate-100 dark:hover:bg-white/5">
            <span class="material-symbols-outlined text-[18px]">refresh</span>
            Refresh
        </button>
    </div>

    <div class="grid grid-cols-4 gap-3">
        <!-- Monthly Tithes -->
        <div class="group rounded-2xl bg-white dark:bg-surface-dark p-5 border border-slate-200 dark:border-white/5 hover:border-primary/30 dark:hover:border-primary/30 transition-all duration-200 hover:shadow-md">
            <div class="flex items-start justify-between mb-3">
                <div class="flex size-10 items-center justify-center rounded-lg bg-emerald-100 dark:bg-emerald-900/30">
                    <span class="material-symbols-outlined text-[20px] text-emerald-600 dark:text-emerald-400">payments</span>
                </div>
                <span class="text-xs font-medium text-emerald-600 dark:text-emerald-400 bg-emerald-50 dark:bg-emerald-900/20 px-2 py-1 rounded-full">
                    +12.5%
                </span>
            </div>
            <p class="text-sm text-slate-500 dark:text-slate-400 font-medium mb-1">Monthly Tithes</p>
            <p class="text-xl font-bold text-secondary dark:text-white">Ksh {{ number_format($stats['total_tithes'] ?? 0, 0) }}</p>
            <div class="h-1 w-full bg-slate-100 dark:bg-white/5 rounded-full mt-3 overflow-hidden">
                <div class="h-full bg-emerald-500 rounded-full" style="width: 75%"></div>
            </div>
        </div>
        
        <!-- Total Members -->
        <div class="group rounded-2xl bg-white dark:bg-surface-dark p-5 border border-slate-200 dark:border-white/5 hover:border-primary/30 dark:hover:border-primary/30 transition-all duration-200 hover:shadow-md">
            <div class="flex items-start justify-between mb-3">
                <div class="flex size-10 items-center justify-center rounded-lg bg-primary/10">
                    <span class="material-symbols-outlined text-[20px] text-primary">groups</span>
                </div>
                <span class="text-xs font-medium text-primary bg-primary/10 px-2 py-1 rounded-full">
                    {{ $stats['new_this_month'] ?? 0 }} new
                </span>
            </div>
            <p class="text-sm text-slate-500 dark:text-slate-400 font-medium mb-1">Total Members</p>
            <p class="text-xl font-bold text-secondary dark:text-white">{{ number_format($stats['total_members'] ?? 0) }}</p>
            <div class="h-1 w-full bg-slate-100 dark:bg-white/5 rounded-full mt-3 overflow-hidden">
                <div class="h-full bg-primary rounded-full" style="width: {{ min(($stats['active_members'] ?? 0) / max(($stats['total_members'] ?? 1), 1) * 100, 100) }}%"></div>
            </div>
        </div>
        
        <!-- Active Ministries -->
        <div class="group rounded-2xl bg-white dark:bg-surface-dark p-5 border border-slate-200 dark:border-white/5 hover:border-primary/30 dark:hover:border-primary/30 transition-all duration-200 hover:shadow-md">
            <div class="flex items-start justify-between mb-3">
                <div class="flex size-10 items-center justify-center rounded-lg bg-indigo-100 dark:bg-indigo-900/30">
                    <span class="material-symbols-outlined text-[20px] text-indigo-600 dark:text-indigo-400">diversity_3</span>
                </div>
                <span class="text-xs font-medium text-indigo-600 dark:text-indigo-400 bg-indigo-50 dark:bg-indigo-900/20 px-2 py-1 rounded-full">
                    {{ $stats['active_ministries'] ?? 8 }} active
                </span>
            </div>
            <p class="text-sm text-slate-500 dark:text-slate-400 font-medium mb-1">Active Ministries</p>
            <p class="text-xl font-bold text-secondary dark:text-white">{{ $stats['total_ministries'] ?? 12 }}</p>
            <div class="h-1 w-full bg-slate-100 dark:bg-white/5 rounded-full mt-3 overflow-hidden">
                <div class="h-full bg-indigo-500 rounded-full" style="width: {{ min((($stats['active_ministries'] ?? 0) / max(($stats['total_ministries'] ?? 1), 1) * 100), 100) }}%"></div>
            </div>
        </div>
        
        <!-- Upcoming Events -->
        <div class="group rounded-2xl bg-white dark:bg-surface-dark p-5 border border-slate-200 dark:border-white/5 hover:border-primary/30 dark:hover:border-primary/30 transition-all duration-200 hover:shadow-md">
            <div class="flex items-start justify-between mb-3">
                <div class="flex size-10 items-center justify-center rounded-lg bg-blue-100 dark:bg-blue-900/30">
                    <span class="material-symbols-outlined text-[20px] text-blue-600 dark:text-blue-400">event_upcoming</span>
                </div>
                <span class="text-xs font-medium text-blue-600 dark:text-blue-400 bg-blue-50 dark:bg-blue-900/20 px-2 py-1 rounded-full">
                    {{ $stats['upcoming_events'] ?? 3 }} upcoming
                </span>
            </div>
            <p class="text-sm text-slate-500 dark:text-slate-400 font-medium mb-1">Upcoming Events</p>
            <p class="text-xl font-bold text-secondary dark:text-white">{{ $stats['total_events'] ?? 15 }}</p>
            <div class="h-1 w-full bg-slate-100 dark:bg-white/5 rounded-full mt-3 overflow-hidden">
                <div class="h-full bg-blue-500 rounded-full" style="width: {{ min((($stats['upcoming_events'] ?? 0) / max(($stats['total_events'] ?? 1), 1) * 100), 100) }}%"></div>
            </div>
        </div>
    </div>
</section>
    
    <!-- Recent Activity -->
    <section class="mt-8">
        <div class="flex items-center justify-between px-4 pb-2">
            <h3 class="text-lg font-bold leading-tight tracking-[-0.015em]">Recent Activity</h3>
            <a href="#" class="text-sm font-medium text-primary">View All</a>
        </div>
        <div class="flex flex-col">
            @forelse($recentActivities as $index => $activity)
<div class="relative flex items-start gap-4 p-4 active:bg-white/5 transition-colors">
    @if($index < count($recentActivities) - 1)
        <div class="absolute left-[31px] top-10 bottom-0 w-px bg-slate-200 dark:bg-white/10"></div>
    @endif
    <div class="relative z-10 flex size-8 shrink-0 items-center justify-center rounded-full {{ $getActivityColor($activity->type) }} ring-4 ring-background-light dark:ring-background-dark">
        <span class="material-symbols-outlined text-[16px]">{{ $getActivityIcon($activity->type) }}</span>
    </div>
    <div class="flex flex-1 flex-col gap-1 pb-2">
        <p class="text-sm font-medium text-slate-900 dark:text-white leading-snug">
            {{ $activity->description }}
            @if($activity->subject)
                <span class="text-primary font-bold">{{ $activity->subject->name ?? '' }}</span>
            @endif
        </p>
        <p class="text-xs text-slate-500 dark:text-slate-500">
            {{ $activity->performed_at->diffForHumans() }}
            @if($activity->user)
                • By {{ $activity->user->name }}
            @endif
        </p>
    </div>
</div>
@empty
<div class="p-8 text-center text-slate-500 dark:text-slate-400">
    <span class="material-symbols-outlined text-4xl mb-2">info</span>
    <p>No recent activity</p>
</div>
@endforelse
        </div>
    </section>
    <section class="mt-8 px-4">
    <div class="rounded-xl bg-white dark:bg-surface-dark p-6 border border-slate-200 dark:border-white/5 shadow-sm">
        <h3 class="text-lg font-bold mb-4">Growth Overview</h3>
        <div class="h-64" id="growthChart">
            <div class="flex items-center justify-center h-full text-slate-400">
                <p>Loading chart data...</p>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        fetch('{{ route("admin.dashboard.chart") }}')
            .then(response => response.json())
            .then(data => {
                renderGrowthChart(data);
            });
    });
    
    function renderGrowthChart(data) {
        {{-- Chart.js rendering code --}}
    }
</script>
@endpush