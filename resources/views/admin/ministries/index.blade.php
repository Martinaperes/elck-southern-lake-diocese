@extends('admin.layouts.app')

@section('title', 'Church Ministries')

@section('content')
<div class="container mx-auto px-4 py-6">
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8">
        <div>
            <h1 class="text-2xl font-bold text-secondary dark:text-white mb-2">Church Ministries</h1>
            <p class="text-slate-600 dark:text-slate-400">Manage all church ministries, leaders, and events</p>
        </div>
        <div class="flex space-x-3 mt-4 md:mt-0">
            <a href="{{ route('admin.ministries.create') }}" 
               class="inline-flex items-center px-4 py-2 bg-primary text-white rounded-lg font-medium hover:bg-secondary focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2">
                <span class="material-symbols-outlined mr-2">add</span>
                New Ministry
            </a>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        <div class="bg-white dark:bg-surface-dark rounded-xl p-5 border border-slate-200 dark:border-white/5 shadow-sm">
            <div class="flex items-center justify-between mb-3">
                <div class="flex size-12 items-center justify-center rounded-lg bg-primary/10">
                    <span class="material-symbols-outlined text-2xl text-primary">diversity_3</span>
                </div>
            </div>
            <p class="text-sm text-slate-500 dark:text-slate-400 font-medium mb-1">Total Ministries</p>
            <p class="text-2xl font-bold text-secondary dark:text-white">{{ $stats['total_ministries'] }}</p>
            <div class="h-1 w-full bg-slate-100 dark:bg-white/5 rounded-full mt-3 overflow-hidden">
                <div class="h-full bg-primary rounded-full" style="width: {{ min(($stats['active_ministries'] / max($stats['total_ministries'], 1)) * 100, 100) }}%"></div>
            </div>
        </div>
        
        <div class="bg-white dark:bg-surface-dark rounded-xl p-5 border border-slate-200 dark:border-white/5 shadow-sm">
            <div class="flex items-center justify-between mb-3">
                <div class="flex size-12 items-center justify-center rounded-lg bg-emerald-100 dark:bg-emerald-900/30">
                    <span class="material-symbols-outlined text-2xl text-emerald-600 dark:text-emerald-400">groups</span>
                </div>
            </div>
            <p class="text-sm text-slate-500 dark:text-slate-400 font-medium mb-1">Total Members</p>
            <p class="text-2xl font-bold text-secondary dark:text-white">{{ $stats['total_members'] }}</p>
            <div class="h-1 w-full bg-slate-100 dark:bg-white/5 rounded-full mt-3 overflow-hidden">
                <div class="h-full bg-emerald-500 rounded-full" style="width: {{ min(($stats['active_leaders'] / max($stats['total_members'], 1)) * 100, 100) }}%"></div>
            </div>
        </div>
        
        <div class="bg-white dark:bg-surface-dark rounded-xl p-5 border border-slate-200 dark:border-white/5 shadow-sm">
            <div class="flex items-center justify-between mb-3">
                <div class="flex size-12 items-center justify-center rounded-lg bg-blue-100 dark:bg-blue-900/30">
                    <span class="material-symbols-outlined text-2xl text-blue-600 dark:text-blue-400">person</span>
                </div>
            </div>
            <p class="text-sm text-slate-500 dark:text-slate-400 font-medium mb-1">Active Leaders</p>
            <p class="text-2xl font-bold text-secondary dark:text-white">{{ $stats['active_leaders'] }}</p>
            <div class="h-1 w-full bg-slate-100 dark:bg-white/5 rounded-full mt-3 overflow-hidden">
                <div class="h-full bg-blue-500 rounded-full" style="width: 100%"></div>
            </div>
        </div>
        
        <div class="bg-white dark:bg-surface-dark rounded-xl p-5 border border-slate-200 dark:border-white/5 shadow-sm">
            <div class="flex items-center justify-between mb-3">
                <div class="flex size-12 items-center justify-center rounded-lg bg-purple-100 dark:bg-purple-900/30">
                    <span class="material-symbols-outlined text-2xl text-purple-600 dark:text-purple-400">event_upcoming</span>
                </div>
            </div>
            <p class="text-sm text-slate-500 dark:text-slate-400 font-medium mb-1">Upcoming Events</p>
            <p class="text-2xl font-bold text-secondary dark:text-white">{{ $stats['upcoming_events'] }}</p>
            <div class="h-1 w-full bg-slate-100 dark:bg-white/5 rounded-full mt-3 overflow-hidden">
                <div class="h-full bg-purple-500 rounded-full" style="width: 100%"></div>
            </div>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Ministries List -->
        <div class="lg:col-span-2">
            <div class="bg-white dark:bg-surface-dark rounded-xl border border-slate-200 dark:border-white/5 shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-200 dark:border-white/5">
                    <h2 class="text-lg font-semibold text-secondary dark:text-white">All Ministries</h2>
                    <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Click on a ministry to view details</p>
                </div>
                
                <div class="divide-y divide-slate-200 dark:divide-white/5">
                    @forelse($ministries as $ministry)
                        <a href="{{ route('admin.ministries.show', $ministry) }}" 
                           class="block p-5 hover:bg-slate-50 dark:hover:bg-white/2.5 transition-colors">
                            <div class="flex items-start justify-between">
                                <div class="flex items-start space-x-4">
                                    <!-- Ministry Image -->
                                    <div class="flex-shrink-0">
                                        @if($ministry->image_url)
                                            <img src="{{ asset('images/gallery/' . $ministry->image_url) }}" 
                                                 alt="{{ $ministry->name }}"
                                                 class="w-16 h-16 rounded-lg object-cover border border-slate-200 dark:border-white/5">
                                        @else
                                            <div class="w-16 h-16 rounded-lg bg-primary/10 flex items-center justify-center">
                                                <span class="material-symbols-outlined text-2xl text-primary">diversity_3</span>
                                            </div>
                                        @endif
                                    </div>
                                    
                                    <!-- Ministry Info -->
                                    <div class="flex-1">
                                        <div class="flex items-center justify-between">
                                            <h3 class="font-semibold text-secondary dark:text-white">{{ $ministry->name }}</h3>
                                            <span class="text-xs font-medium px-2 py-1 rounded-full {{ $ministry->is_active ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400' : 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400' }}">
                                                {{ $ministry->is_active ? 'Active' : 'Inactive' }}
                                            </span>
                                        </div>
                                        
                                        <p class="text-sm text-slate-600 dark:text-slate-400 mt-1 line-clamp-2">
                                            {{ $ministry->description ?: 'No description available.' }}
                                        </p>
                                        
                                        <!-- Leaders -->
                                        <div class="flex items-center mt-3">
                                            <div class="flex -space-x-2 mr-3">
                                                @foreach($ministry->members->take(3) as $member)
                                                    <div class="w-8 h-8 rounded-full bg-primary/20 border-2 border-white dark:border-surface-dark flex items-center justify-center text-xs font-semibold text-primary">
                                                        {{ $member->member->initials ?? '??' }}
                                                    </div>
                                                @endforeach
                                                @if($ministry->members_count > 3)
                                                    <div class="w-8 h-8 rounded-full bg-slate-100 dark:bg-white/5 border-2 border-white dark:border-surface-dark flex items-center justify-center text-xs font-semibold text-slate-600 dark:text-slate-400">
                                                        +{{ $ministry->members_count - 3 }}
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="text-sm text-slate-500 dark:text-slate-400">
                                                <span class="font-medium">{{ $ministry->members_count }}</span> members
                                                @if($ministry->leader_name)
                                                    • Leader: {{ $ministry->leader_name }}
                                                @endif
                                            </div>
                                        </div>
                                        
                                        <!-- Contact -->
                                        @if($ministry->contact_email)
                                            <div class="flex items-center mt-2 text-sm text-slate-500 dark:text-slate-400">
                                                <span class="material-symbols-outlined text-[16px] mr-1">mail</span>
                                                {{ $ministry->contact_email }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </a>
                    @empty
                        <div class="p-10 text-center">
                            <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-slate-100 dark:bg-white/5 flex items-center justify-center">
                                <span class="material-symbols-outlined text-2xl text-slate-400">diversity_3</span>
                            </div>
                            <h3 class="text-lg font-medium text-secondary dark:text-white mb-2">No Ministries Yet</h3>
                            <p class="text-slate-500 dark:text-slate-400 mb-4">Create your first ministry to get started</p>
                            <a href="{{ route('admin.ministries.create') }}" 
                               class="inline-flex items-center px-4 py-2 bg-primary text-white rounded-lg font-medium hover:bg-secondary">
                                <span class="material-symbols-outlined mr-2">add</span>
                                Create Ministry
                            </a>
                        </div>
                    @endforelse
                </div>
                
                <!-- Pagination -->
                @if($ministries->hasPages())
                    <div class="px-6 py-4 border-t border-slate-200 dark:border-white/5">
                        {{ $ministries->links() }}
                    </div>
                @endif
            </div>
        </div>
        
        <!-- Upcoming Events & Quick Actions -->
        <div class="space-y-6">
            <!-- Upcoming Events -->
            <div class="bg-white dark:bg-surface-dark rounded-xl border border-slate-200 dark:border-white/5 shadow-sm overflow-hidden">
                <div class="px-5 py-4 border-b border-slate-200 dark:border-white/5">
                    <h2 class="text-lg font-semibold text-secondary dark:text-white">Upcoming Events</h2>
                    <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Events across all ministries</p>
                </div>
                
                <div class="divide-y divide-slate-200 dark:divide-white/5">
                    @forelse($upcomingEvents as $event)
                        <a href="{{ route('admin.events.show', $event) }}" 
                           class="block p-5 hover:bg-slate-50 dark:hover:bg-white/2.5 transition-colors">
                            <div class="flex items-start justify-between">
                                <div>
                                    <h3 class="font-medium text-secondary dark:text-white">{{ $event->title }}</h3>
                                    <div class="flex items-center mt-2 text-sm text-slate-500 dark:text-slate-400">
                                        <span class="material-symbols-outlined text-[16px] mr-1">calendar_month</span>
                                        {{ $event->start_time->format('M j, Y') }}
                                        <span class="mx-2">•</span>
                                        <span class="material-symbols-outlined text-[16px] mr-1">schedule</span>
                                        {{ $event->start_time->format('g:i A') }}
                                    </div>
                                    @if($event->ministry)
                                        <div class="flex items-center mt-1 text-sm text-primary">
                                            <span class="material-symbols-outlined text-[16px] mr-1">diversity_3</span>
                                            {{ $event->ministry->name }}
                                        </div>
                                    @endif
                                </div>
                                <span class="text-xs font-medium px-2 py-1 rounded-full {{ $event->is_public ? 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400' : 'bg-slate-100 text-slate-800 dark:bg-white/5 dark:text-slate-400' }}">
                                    {{ $event->is_public ? 'Public' : 'Private' }}
                                </span>
                            </div>
                        </a>
                    @empty
                        <div class="p-6 text-center">
                            <div class="w-12 h-12 mx-auto mb-3 rounded-full bg-slate-100 dark:bg-white/5 flex items-center justify-center">
                                <span class="material-symbols-outlined text-xl text-slate-400">event_upcoming</span>
                            </div>
                            <p class="text-slate-500 dark:text-slate-400">No upcoming events</p>
                        </div>
                    @endforelse
                </div>
                
                <div class="px-5 py-4 border-t border-slate-200 dark:border-white/5">
                    <a href="{{ route('admin.events.index') }}" 
                       class="text-sm font-medium text-primary hover:text-secondary flex items-center justify-center">
                        View All Events
                        <span class="material-symbols-outlined ml-1 text-[18px]">arrow_forward</span>
                    </a>
                </div>
            </div>
            
            
    </div>
</div>
@endsection