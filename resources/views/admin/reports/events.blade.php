@extends('admin.layouts.app')

@section('title', 'Event Reports')

@section('content')
<div class="px-4 py-6 max-w-7xl mx-auto">
    <!-- Header -->
    <div class="mb-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold tracking-tight text-slate-900 dark:text-white">Event Registrations</h1>
            <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Attendance and analytics</p>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('admin.reports.index') }}" class="inline-flex items-center gap-2 rounded-lg bg-slate-100 dark:bg-white/5 py-2 px-4 text-sm font-semibold text-slate-700 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-white/10 transition-colors">
                <span class="material-symbols-outlined text-[18px]">arrow_back</span> Back
            </a>
            <button class="inline-flex items-center gap-2 rounded-lg bg-blue-600 py-2 px-4 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-blue-600 transition-colors">
                <span class="material-symbols-outlined text-[18px]">download</span> Export Report
            </button>
        </div>
    </div>

    <!-- Events Table Card -->
    <div class="rounded-xl border border-slate-200 dark:border-white/5 bg-white dark:bg-surface-dark shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-slate-600 dark:text-slate-300 border-collapse">
                <thead class="bg-slate-50 dark:bg-white/5 text-xs uppercase font-semibold text-slate-500 dark:text-slate-400 border-b border-slate-200 dark:border-white/5">
                    <tr>
                        <th class="px-6 py-4">Event Name</th>
                        <th class="px-6 py-4">Location</th>
                        <th class="px-6 py-4 text-center">Registrations</th>
                        <th class="px-6 py-4">Start Date</th>
                        <th class="px-6 py-4">End Date</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-white/5 font-medium">
                    @forelse($events as $event)
                        <tr class="hover:bg-slate-50/50 dark:hover:bg-white/[0.02] transition-colors">
                            <td class="px-6 py-4">
                                <span class="font-bold text-slate-900 dark:text-white">{{ $event->title }}</span>
                            </td>
                            <td class="px-6 py-4">
                                {{ $event->location ?? 'N/A' }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 px-3 py-1 rounded-full font-bold">
                                    {{ $event->registrations_count ?? 0 }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-xs text-slate-500">
                                {{ \Carbon\Carbon::parse($event->start_date)->format('M j, Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-xs text-slate-500">
                                {{ \Carbon\Carbon::parse($event->end_date)->format('M j, Y') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-slate-500">
                                <span class="material-symbols-outlined text-4xl mb-2 opacity-50 block">event_busy</span>
                                No event records found
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
