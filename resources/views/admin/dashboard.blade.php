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
    <section>
        <div class="flex items-center justify-between px-4 pb-3">
            <h3 class="text-lg font-bold leading-tight tracking-[-0.015em]">Quick Actions</h3>
            <button class="text-sm font-medium text-primary">Edit</button>
        </div>
        <div class="grid grid-cols-4 gap-3 px-4">
            <!-- Action 1 -->
            <a href="{{ route('admin.members.create') }}" class="flex flex-col items-center gap-2 group">
    <div class="flex size-14 items-center justify-center rounded-2xl bg-white dark:bg-surface-dark border border-slate-200 dark:border-white/10 text-primary transition-all group-active:scale-95 group-active:bg-primary/10 shadow-sm">
        <span class="material-symbols-outlined text-[28px]">person_add</span>
    </div>
    <span class="text-xs font-medium text-slate-600 dark:text-slate-300 text-center leading-tight">Add Member</span>
</a>
            
            <!-- Action 2 -->
            <a href="#" class="flex flex-col items-center gap-2 group">
                <div class="flex size-14 items-center justify-center rounded-2xl bg-white dark:bg-surface-dark border border-slate-200 dark:border-white/10 text-primary transition-all group-active:scale-95 group-active:bg-primary/10 shadow-sm">
                    <span class="material-symbols-outlined text-[28px]">payments</span>
                </div>
                <span class="text-xs font-medium text-slate-600 dark:text-slate-300 text-center leading-tight">View Tithes</span>
            </a>
            
            <!-- Action 3 -->
            <a href="{{ route('admin.events.index') }}" class="flex flex-col items-center gap-2 group">
                <div class="flex size-14 items-center justify-center rounded-2xl bg-white dark:bg-surface-dark border border-slate-200 dark:border-white/10 text-primary transition-all group-active:scale-95 group-active:bg-primary/10 shadow-sm">
                    <span class="material-symbols-outlined text-[28px]">calendar_month</span>
                </div>
                <span class="text-xs font-medium text-slate-600 dark:text-slate-300 text-center leading-tight">Calendar</span>
            </a>
            <div class="grid grid-cols-4 gap-4">
    <div class="flex flex-col gap-1 rounded-xl bg-white dark:bg-surface-dark p-4 border border-slate-200 dark:border-white/5 shadow-sm">
        <p class="text-xs text-slate-500 dark:text-slate-400 font-medium">Monthly Tithes</p>
        <p class="text-lg font-bold text-slate-900 dark:text-white">Ksh {{ number_format($stats['total_tithes'] ?? 0) }}</p>
    </div>
    {{-- ... 3 more stat boxes ... --}}
</div>
            <!-- Action 4 -->
            <button class="flex flex-col items-center gap-2 group">
                <div class="flex size-14 items-center justify-center rounded-2xl bg-white dark:bg-surface-dark border border-slate-200 dark:border-white/10 text-primary transition-all group-active:scale-95 group-active:bg-primary/10 shadow-sm">
                    <span class="material-symbols-outlined text-[28px]">send</span>
                </div>
                <span class="text-xs font-medium text-slate-600 dark:text-slate-300 text-center leading-tight">Send Comms</span>
            </button>
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