@extends('admin.layouts.app')

@section('title', 'Reports Overview')

@section('content')
<div class="px-4 py-6 max-w-7xl mx-auto">
    <!-- Header -->
    <div class="mb-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold tracking-tight text-slate-900 dark:text-white">Reports Overview</h1>
            <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Generate and view analytics for various church activities</p>
        </div>
    </div>

    <!-- Reports Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        
        <!-- Donations Report Card -->
        <div class="group relative flex flex-col rounded-2xl bg-white dark:bg-surface-dark border border-slate-200 dark:border-white/10 hover:border-emerald-500/50 dark:hover:border-emerald-500/50 transition-all duration-300 shadow-sm hover:shadow-md overflow-hidden">
            <div class="p-6">
                <div class="size-12 rounded-xl bg-emerald-100 dark:bg-emerald-900/30 text-emerald-600 dark:text-emerald-400 flex items-center justify-center mb-4">
                    <span class="material-symbols-outlined text-[28px]">payments</span>
                </div>
                <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-2">Financial Reports</h3>
                <p class="text-sm text-slate-500 dark:text-slate-400 mb-6">View comprehensive logs of all donations, tithes, offerings, and M-Pesa transactions.</p>
                <a href="{{ route('admin.reports.donations') }}" class="inline-flex items-center gap-2 text-sm font-semibold text-emerald-600 hover:text-emerald-700 dark:hover:text-emerald-300 transition-colors">
                    View Report <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                </a>
            </div>
            <div class="absolute bottom-0 left-0 h-1 w-full bg-emerald-500 scale-x-0 group-hover:scale-x-100 transition-transform origin-left duration-300"></div>
        </div>

        <!-- Events Report Card -->
        <div class="group relative flex flex-col rounded-2xl bg-white dark:bg-surface-dark border border-slate-200 dark:border-white/10 hover:border-blue-500/50 dark:hover:border-blue-500/50 transition-all duration-300 shadow-sm hover:shadow-md overflow-hidden">
            <div class="p-6">
                <div class="size-12 rounded-xl bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 flex items-center justify-center mb-4">
                    <span class="material-symbols-outlined text-[28px]">event</span>
                </div>
                <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-2">Event Analytics</h3>
                <p class="text-sm text-slate-500 dark:text-slate-400 mb-6">Track attendance, event registrations, and overall engagement across church activities.</p>
                <a href="{{ route('admin.reports.events') }}" class="inline-flex items-center gap-2 text-sm font-semibold text-blue-600 hover:text-blue-700 dark:hover:text-blue-300 transition-colors">
                    View Report <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                </a>
            </div>
            <div class="absolute bottom-0 left-0 h-1 w-full bg-blue-500 scale-x-0 group-hover:scale-x-100 transition-transform origin-left duration-300"></div>
        </div>

        <!-- Member Report Card (Placeholder) -->
        <div class="group relative flex flex-col rounded-2xl bg-white dark:bg-surface-dark border border-slate-200 dark:border-white/10 hover:border-primary/50 dark:hover:border-primary/50 transition-all duration-300 shadow-sm hover:shadow-md overflow-hidden">
            <div class="absolute inset-0 bg-slate-50/50 dark:bg-white/5 z-10 flex items-center justify-center backdrop-blur-[1px] opacity-0 group-hover:opacity-100 transition-opacity">
                <span class="bg-slate-900 text-white text-xs font-bold px-3 py-1.5 rounded-full shadow-lg">Coming Soon</span>
            </div>
            <div class="p-6 opacity-70">
                <div class="size-12 rounded-xl bg-primary/10 text-primary flex items-center justify-center mb-4">
                    <span class="material-symbols-outlined text-[28px]">groups</span>
                </div>
                <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-2">Congregation Metrics</h3>
                <p class="text-sm text-slate-500 dark:text-slate-400 mb-6">Demographic breakdowns, membership growth trends, and ministry involvement maps.</p>
                <div class="inline-flex items-center gap-2 text-sm font-semibold text-primary/70 transition-colors">
                    View Report <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
