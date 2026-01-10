@extends('admin.layouts.app')

@section('title', ($ministry->name ?? 'Ministry') . ' - Ministry Details')

@section('content')
<div class="p-6">

    <!-- Header Section -->
    <div class="mb-8">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
            <div class="flex items-center space-x-4">
                <a href="{{ route('admin.ministries.index') }}" 
                   class="inline-flex items-center px-4 py-2 text-gray-600 hover:text-gray-900 bg-white border border-gray-300 rounded-lg shadow-sm hover:bg-gray-50 transition-colors">
                    <i class="fas fa-arrow-left mr-2"></i> Back to Ministries
                </a>
                <div>
                    <h1 class="text-3xl font-bold text-white">{{ $ministry->name ?? 'Ministry Details' }}</h1>
                    <p class="text-gray-600 mt-1">Ministry Details & Information</p>
                </div>
            </div>
            
            <!-- Action Buttons -->
            <div class="flex space-x-3 mt-4 md:mt-0">
                <a href="{{ route('admin.ministries.edit', $ministry) }}"
                   class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-[#197b3b] to-green-800 hover:from-green-800 hover:to-green-900 text-white font-semibold rounded-lg shadow-lg transition-all duration-200 transform hover:-translate-y-0.5">
                    <i class="fas fa-edit mr-2"></i>
                    Edit Ministry
                </a>
                <form action="{{ route('admin.ministries.destroy', $ministry) }}" 
                      method="POST"
                      onsubmit="return confirm('Are you sure you want to delete this ministry? This action cannot be undone.')">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white font-semibold rounded-lg shadow-lg transition-all duration-200 transform hover:-translate-y-0.5">
                        <i class="fas fa-trash mr-2"></i>
                        Delete Ministry
                    </button>
                </form>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg">
            <div class="flex items-center">
                <i class="fas fa-check-circle mr-2"></i>
                {{ session('success') }}
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg">
            <div class="flex items-center">
                <i class="fas fa-exclamation-circle mr-2"></i>
                {{ session('error') }}
            </div>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <!-- Left Column - Ministry Profile -->
        <div class="lg:col-span-2">
            <!-- Ministry Information Card -->
            <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
                <div class="bg-gradient-to-r from-black to-gray-800 px-6 py-4">
                    <h2 class="text-xl font-semibold text-white">Ministry Information</h2>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Basic Info -->
                        <div class="space-y-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-2">Ministry Name</label>
                                <p class="text-lg font-semibold text-gray-900">{{ $ministry->name ?? 'N/A' }}</p>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-2">Leader</label>
                                @if($ministry->leader_name)
                                    <div class="flex items-center space-x-3">
                                        <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                                            <i class="fas fa-user text-[#197b3b]"></i>
                                        </div>
                                        <span class="text-lg font-semibold text-gray-900">{{ $ministry->leader_name }}</span>
                                    </div>
                                @else
                                    <p class="text-gray-400 italic">No leader assigned</p>
                                @endif
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-2">Contact Email</label>
                                @if($ministry->contact_email)
                                    <div class="flex items-center space-x-3">
                                        <i class="fas fa-envelope text-gray-400"></i>
                                        <a href="mailto:{{ $ministry->contact_email }}" class="text-[#197b3b] hover:text-green-800 font-semibold">
                                            {{ $ministry->contact_email }}
                                        </a>
                                    </div>
                                @else
                                    <p class="text-gray-400 italic">No contact email</p>
                                @endif
                            </div>
                        </div>
                        
                        <!-- Status & Schedule -->
                        <div class="space-y-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-2">Status</label>
                                @if($ministry->is_active)
                                    <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold bg-green-100 text-green-800 border border-green-200">
                                        <i class="fas fa-check-circle mr-2"></i>
                                        Active Ministry
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold bg-red-100 text-red-800 border border-red-200">
                                        <i class="fas fa-pause-circle mr-2"></i>
                                        Inactive Ministry
                                    </span>
                                @endif
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-2">Meeting Schedule</label>
                                @if($ministry->meeting_schedule)
                                    <div class="flex items-center space-x-3">
                                        <i class="fas fa-calendar-alt text-gray-400"></i>
                                        <p class="text-lg font-semibold text-gray-900">{{ $ministry->meeting_schedule }}</p>
                                    </div>
                                @else
                                    <p class="text-gray-400 italic">No meeting schedule set</p>
                                @endif
                            </div>
                            
                          
                        </div>
                    </div>
                    
                    <!-- Description -->
                    <div class="mt-8 pt-6 border-t border-gray-200">
                        <label class="block text-sm font-medium text-gray-500 mb-4">Description</label>
                        <div class="prose max-w-none">
                            @if($ministry->description)
                                <p class="text-gray-700 leading-relaxed whitespace-pre-line">{{ $ministry->description }}</p>
                            @else
                                <p class="text-gray-400 italic">No description provided</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Quick Actions Card -->
            <div class="bg-white rounded-2xl shadow-xl border border-gray-100 mt-6">
                <div class="bg-gradient-to-r from-[#197b3b] to-green-700 px-6 py-4">
                    <h2 class="text-xl font-semibold text-white">Quick Actions</h2>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <a href="mailto:{{ $ministry->contact_email ?? '#' }}" 
                           class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-green-50 transition-colors {{ !$ministry->contact_email ? 'opacity-50 cursor-not-allowed' : '' }}">
                            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mr-4">
                                <i class="fas fa-envelope text-[#197b3b] text-xl"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900">Send Email</h3>
                                <p class="text-sm text-gray-600">Contact ministry leader</p>
                            </div>
                        </a>
                        
                        <a href="{{ route('admin.ministries.edit', $ministry) }}" 
                           class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-green-50 transition-colors">
                            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mr-4">
                                <i class="fas fa-edit text-[#197b3b] text-xl"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900">Edit Details</h3>
                                <p class="text-sm text-gray-600">Update ministry information</p>
                            </div>
                        </a>
                        
                        <a href="#" 
                           class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-blue-50 transition-colors">
                            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mr-4">
                                <i class="fas fa-users text-blue-600 text-xl"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900">View Members</h3>
                                <p class="text-sm text-gray-600">See ministry participants</p>
                            </div>
                        </a>
                        
                        <a href="#" 
                           class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                            <div class="w-12 h-12 bg-gray-100 rounded-lg flex items-center justify-center mr-4">
                                <i class="fas fa-bell text-gray-600 text-xl"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900">Notify Members</h3>
                                <p class="text-sm text-gray-600">Send announcements</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Recent Activity Section -->
            <div class="bg-white rounded-2xl shadow-xl border border-gray-100 mt-6">
                <div class="bg-gradient-to-r from-black to-gray-800 px-6 py-4">
                    <h2 class="text-xl font-semibold text-white">Recent Activity</h2>
                </div>
                <div class="p-6">
                    <div class="text-center py-8">
                        <i class="fas fa-history text-gray-300 text-4xl mb-3"></i>
                        <p class="text-gray-500">No recent activity recorded</p>
                        <p class="text-sm text-gray-400 mt-1">Activity will appear here when members join events</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Right Column - Ministry Profile & Stats -->
        <div class="space-y-6">
            <!-- Ministry Image Card -->
            <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
                <div class="bg-gradient-to-r from-black to-gray-800 px-6 py-4">
                    <h2 class="text-xl font-semibold text-white">Ministry Profile</h2>
                </div>
                <div class="p-6">
                    <div class="flex flex-col items-center text-center">
                        @if($ministry->image_url)
                           <img src="{{ $ministry->banner_url }}" 
                                 alt="{{ $ministry->name }}"
                                 class="w-32 h-32 rounded-2xl object-cover border-4 border-white shadow-lg mb-4">
                        @else
                            @php
                                $colors = [
                                    'bg-gradient-to-br from-black to-gray-800',
                                    'bg-gradient-to-br from-[#197b3b] to-green-700',
                                    'bg-gradient-to-br from-gray-800 to-black',
                                    'bg-gradient-to-br from-green-700 to-[#197b3b]'
                                ];
                                $colorIndex = $ministry->id ? crc32($ministry->name) % count($colors) : 0;
                                $bgGradient = $colors[$colorIndex];
                            @endphp
                            <div class="w-32 h-32 rounded-2xl {{ $bgGradient }} flex items-center justify-center text-white font-bold text-4xl shadow-lg mb-4">
                                {{ $ministry->name ? strtoupper(substr($ministry->name, 0, 1)) : 'M' }}
                            </div>
                        @endif
                        
                        <h3 class="text-lg font-bold text-gray-900">{{ $ministry->name ?? 'Ministry' }}</h3>
                        <p class="text-gray-600 mt-1">ELCK Church Ministry</p>
                        
                        @if($ministry->is_active)
                            <div class="mt-3 inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-green-100 text-green-800">
                                <i class="fas fa-circle mr-1" style="font-size: 6px;"></i>
                                Active
                            </div>
                        @else
                            <div class="mt-3 inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-red-100 text-red-800">
                                <i class="fas fa-circle mr-1" style="font-size: 6px;"></i>
                                Inactive
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            
            <!-- Ministry Stats Card -->
            <div class="bg-white rounded-2xl shadow-xl border border-gray-100">
                <div class="bg-gradient-to-r from-[#197b3b] to-green-700 px-6 py-4">
                    <h2 class="text-xl font-semibold text-white">Ministry Stats</h2>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        @php
                            $membersCount = $ministry->members()->where('is_active', true)->count();
                            $activeEvents = $ministry->events()->where('start_time', '>=', now())->count();
                            $upcomingMeetings = 0; // You can implement meeting logic
                            $lastActivity = $ministry->updated_at?->diffForHumans() ?? 'Never';
                        @endphp
                        
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Members Count</span>
                            <span class="font-semibold text-gray-900">{{ $membersCount }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Active Events</span>
                            <span class="font-semibold text-gray-900">{{ $activeEvents }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Upcoming Meetings</span>
                            <span class="font-semibold text-gray-900">{{ $upcomingMeetings }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Last Activity</span>
                            <span class="text-sm text-gray-500">{{ $lastActivity }}</span>
                        </div>
                    </div>
                    
                    <div class="mt-6 pt-4 border-t border-gray-200">
                        <h4 class="font-semibold text-gray-900 mb-3">Quick Links</h4>
                        <div class="space-y-2">
                            <a href="{{ route('admin.ministries.members', $ministry) }}" class="flex items-center text-[#197b3b] hover:text-green-800 text-sm transition-colors">
                                <i class="fas fa-list mr-2"></i> View All Members
                            </a>
                            <a href="#" class="flex items-center text-[#197b3b] hover:text-green-800 text-sm transition-colors">
                                <i class="fas fa-calendar-plus mr-2"></i> Schedule Event
                            </a>
                            <a href="#" class="flex items-center text-[#197b3b] hover:text-green-800 text-sm transition-colors">
                                <i class="fas fa-bell mr-2"></i> Notify Members
                            </a>
                            <a href="{{ route('admin.ministries.events', $ministry) }}" class="flex items-center text-[#197b3b] hover:text-green-800 text-sm transition-colors">
                                <i class="fas fa-calendar-check mr-2"></i> Ministry Events
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- System Information -->
            <div class="bg-white rounded-2xl shadow-xl border border-gray-100">
                <div class="bg-gradient-to-r from-black to-gray-800 px-6 py-4">
                    <h2 class="text-xl font-semibold text-white">System Information</h2>
                </div>
                <div class="p-6">
                    <div class="space-y-3 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Ministry ID</span>
                            <span class="font-mono text-gray-900">#{{ $ministry->id ?? 'N/A' }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Slug</span>
                            <span class="font-mono text-gray-900">{{ $ministry->slug ?? 'N/A' }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Created</span>
                            <span class="text-gray-900">{{ $ministry->created_at?->format('M j, Y') ?? 'N/A' }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Last Updated</span>
                            <span class="text-gray-900">{{ $ministry->updated_at?->format('M j, Y') ?? 'N/A' }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Database ID</span>
                            <span class="font-mono text-gray-900">{{ $ministry->id ?? 'N/A' }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Manage Members Section -->
            <div class="bg-white rounded-2xl shadow-xl border border-gray-100">
                <div class="bg-gradient-to-r from-[#197b3b] to-green-700 px-6 py-4">
                    <h2 class="text-xl font-semibold text-white">Manage Members</h2>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        <div class="text-center">
                            <div class="text-3xl font-bold text-gray-900">{{ $membersCount }}</div>
                            <p class="text-gray-600 text-sm">Total Members</p>
                        </div>
                        
                        <div class="space-y-3">
                            <a href="#" class="block w-full text-center px-4 py-3 bg-[#197b3b] hover:bg-green-800 text-white font-medium rounded-lg transition-colors">
                                <i class="fas fa-user-plus mr-2"></i> Add New Member
                            </a>
                            
                            <a href="#" class="block w-full text-center px-4 py-3 border border-[#197b3b] text-[#197b3b] hover:bg-green-50 font-medium rounded-lg transition-colors">
                                <i class="fas fa-users mr-2"></i> View All Members
                            </a>
                            
                            <a href="#" class="block w-full text-center px-4 py-3 border border-gray-300 text-gray-700 hover:bg-gray-50 font-medium rounded-lg transition-colors">
                                <i class="fas fa-user-check mr-2"></i> Verify Attendance
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<style>
    .prose {
        max-width: none;
    }
    .prose p {
        margin-bottom: 0;
    }
</style>

<script>
    // Add some basic interactivity
    document.addEventListener('DOMContentLoaded', function() {
        // Add confirmation for delete action
        const deleteForm = document.querySelector('form[action*="destroy"]');
        if (deleteForm) {
            deleteForm.addEventListener('submit', function(e) {
                if (!confirm('Are you sure you want to delete this ministry? This action cannot be undone.')) {
                    e.preventDefault();
                }
            });
        }

        // Add loading states for buttons
        const actionButtons = document.querySelectorAll('a, button');
        actionButtons.forEach(button => {
            button.addEventListener('click', function() {
                if (this.classList.contains('cursor-not-allowed')) {
                    return;
                }
                // Add loading indicator for better UX
                const originalText = this.innerHTML;
                this.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Loading...';
                this.classList.add('opacity-50', 'cursor-not-allowed');
                
                // Reset after 2 seconds (for demo purposes)
                setTimeout(() => {
                    this.innerHTML = originalText;
                    this.classList.remove('opacity-50', 'cursor-not-allowed');
                }, 2000);
            });
        });
    });
</script>
@endsection