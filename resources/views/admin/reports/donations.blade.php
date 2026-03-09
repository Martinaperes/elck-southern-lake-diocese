@extends('admin.layouts.app')

@section('title', 'Financial Reports')

@section('content')
<div class="px-4 py-6 max-w-7xl mx-auto">
    <!-- Header -->
    <div class="mb-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold tracking-tight text-slate-900 dark:text-white">Donations & Tithes</h1>
            <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Transaction logs</p>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('admin.reports.index') }}" class="inline-flex items-center gap-2 rounded-lg bg-slate-100 dark:bg-white/5 py-2 px-4 text-sm font-semibold text-slate-700 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-white/10 transition-colors">
                <span class="material-symbols-outlined text-[18px]">arrow_back</span> Back
            </a>
            <button class="inline-flex items-center gap-2 rounded-lg bg-emerald-600 py-2 px-4 text-sm font-semibold text-white shadow-sm hover:bg-emerald-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-emerald-600 transition-colors">
                <span class="material-symbols-outlined text-[18px]">download</span> Export CSV
            </button>
        </div>
    </div>

    <!-- Donations Table Card -->
    <div class="rounded-xl border border-slate-200 dark:border-white/5 bg-white dark:bg-surface-dark shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-slate-600 dark:text-slate-300 border-collapse">
                <thead class="bg-slate-50 dark:bg-white/5 text-xs uppercase font-semibold text-slate-500 dark:text-slate-400 border-b border-slate-200 dark:border-white/5">
                    <tr>
                        <th class="px-6 py-4">Transaction Code</th>
                        <th class="px-6 py-4">Donor/Member</th>
                        <th class="px-6 py-4">Amount</th>
                        <th class="px-6 py-4">Purpose</th>
                        <th class="px-6 py-4">Method</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4">Date</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-white/5 font-medium">
                    @forelse($donations as $donation)
                        <tr class="hover:bg-slate-50/50 dark:hover:bg-white/[0.02] transition-colors">
                            <td class="px-6 py-4 font-mono text-xs">{{ $donation->transaction_code ?? 'N/A' }}</td>
                            <td class="px-6 py-4">
                                <span class="font-bold text-slate-900 dark:text-white">{{ $donation->member->name ?? 'Anonymous' }}</span>
                            </td>
                            <td class="px-6 py-4 text-emerald-600 dark:text-emerald-400 font-bold whitespace-nowrap">
                                KES {{ number_format($donation->amount, 2) }}
                            </td>
                            <td class="px-6 py-4 capitalize">{{ $donation->purpose }}</td>
                            <td class="px-6 py-4 uppercase text-xs">{{ $donation->payment_method }}</td>
                            <td class="px-6 py-4">
                                @if($donation->status === 'completed')
                                    <span class="inline-flex items-center gap-1 rounded-full bg-emerald-50 dark:bg-emerald-400/10 px-2 py-1 text-xs font-semibold text-emerald-600 dark:text-emerald-400 ring-1 ring-inset ring-emerald-600/20">
                                        Completed
                                    </span>
                                @elseif($donation->status === 'pending')
                                    <span class="inline-flex items-center gap-1 rounded-full bg-amber-50 dark:bg-amber-400/10 px-2 py-1 text-xs font-semibold text-amber-600 dark:text-amber-400 ring-1 ring-inset ring-amber-600/20">
                                        Pending
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 rounded-full bg-slate-50 dark:bg-slate-400/10 px-2 py-1 text-xs font-semibold text-slate-600 dark:text-slate-400 ring-1 ring-inset ring-slate-600/20">
                                        {{ ucfirst($donation->status) }}
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-xs">
                                {{ $donation->created_at->format('M j, Y h:i A') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center text-slate-500">
                                <span class="material-symbols-outlined text-4xl mb-2 opacity-50 block">receipt_long</span>
                                No financial records found
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="mt-4">
        {{ $donations->links() }}
    </div>
</div>
@endsection
