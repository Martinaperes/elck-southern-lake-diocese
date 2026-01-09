@extends('admin.layouts.app')

@section('title', 'Members Management')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-white-900">Members Management</h1>
            <p class="text-gray-600 mt-1">Manage all members and congregants in the diocese</p>
        </div>
        <a href="{{ route('admin.members.create') }}" 
           class="mt-4 md:mt-0 inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-800 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
            <i class="fas fa-plus mr-2"></i> Add New Member
        </a>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <i class="fas fa-users text-green-600 text-3xl"></i>
                </div>
                <div class="ml-5">
                    <p class="text-sm font-medium text-gray-500">Total Members</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ number_format($stats['total_members'] ?? 0) }}</p>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <i class="fas fa-user-check text-blue-600 text-3xl"></i>
                </div>
                <div class="ml-5">
                    <p class="text-sm font-medium text-gray-500">Active Members</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ number_format($stats['active_members'] ?? 0) }}</p>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <i class="fas fa-calendar-plus text-orange-600 text-3xl"></i>
                </div>
                <div class="ml-5">
                    <p class="text-sm font-medium text-gray-500">New This Month</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ number_format($stats['new_this_month'] ?? 0) }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Members Table -->
    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
        <!-- Table Header -->
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                <h2 class="text-lg font-semibold text-gray-800">All Members</h2>
                
                <!-- Search Form -->
                <form method="GET" action="{{ route('admin.members.index') }}" class="mt-4 md:mt-0">
                    <div class="flex space-x-2">
                        <input 
                            type="text" 
                            name="search" 
                            placeholder="Search members..." 
                            value="{{ request('search') }}"
                            class="w-full md:w-64 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500"
                        >
                        <button type="submit" class="px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Member
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Contact
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Membership
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Status
                        </th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($members as $member)
                        <tr class="hover:bg-gray-50">
                            <!-- Member Info -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        @if($member->photo)
                                            <img class="h-10 w-10 rounded-full object-cover" src="{{ asset('storage/' . $member->photo) }}" alt="{{ $member->first_name }}">
                                        @else
                                            <div class="h-10 w-10 rounded-full bg-green-600 flex items-center justify-center text-white font-semibold">
                                                {{ strtoupper(substr($member->first_name, 0, 1)) }}{{ strtoupper(substr($member->last_name, 0, 1)) }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $member->first_name }} {{ $member->last_name }}
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            @if($member->user)
                                                User: {{ $member->user->name }}
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </td>

                            <!-- Contact -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $member->phone ?? 'No phone' }}</div>
                                <div class="text-sm text-gray-500">{{ $member->email ?? 'No email' }}</div>
                            </td>

                            <!-- Membership -->
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                @if($member->membership_number)
                                    <span class="font-mono">{{ $member->membership_number }}</span>
                                @else
                                    <span class="text-gray-400">No ID</span>
                                @endif
                                <div class="text-xs text-gray-500">
                                    Joined: {{ $member->joined_at ? $member->joined_at->format('M j, Y') : 'Not set' }}
                                </div>
                            </td>

                            <!-- Status -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($member->is_active)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        <i class="fas fa-circle text-green-500 mr-1" style="font-size: 6px;"></i>
                                        Active
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                        <i class="fas fa-circle text-red-500 mr-1" style="font-size: 6px;"></i>
                                        Inactive
                                    </span>
                                @endif
                            </td>

                            <!-- Actions -->
                            <!-- Actions -->
<td class="px-6 py-4 whitespace-nowrap">
    <div class="flex justify-end space-x-3">
        <!-- View Button with Icon -->
        <a href="{{ route('admin.members.show', $member) }}" 
           class="inline-flex items-center justify-center w-8 h-8 text-blue-600 hover:text-blue-900 hover:bg-blue-50 rounded-full transition-colors"
           title="View Member">
            <i class="fas fa-eye fa-sm"></i>
        </a>
        
        <!-- Edit Button with Icon -->
        <a href="{{ route('admin.members.edit', $member) }}" 
           class="inline-flex items-center justify-center w-8 h-8 text-green-600 hover:text-green-900 hover:bg-green-50 rounded-full transition-colors"
           title="Edit Member">
            <i class="fas fa-edit fa-sm"></i>
        </a>
        
        <!-- Delete Button with Icon -->
        <form action="{{ route('admin.members.destroy', $member) }}" 
              method="POST" 
              class="inline"
              onsubmit="return confirm('Are you sure?')">
            @csrf
            @method('DELETE')
            <button type="submit" 
                    class="inline-flex items-center justify-center w-8 h-8 text-red-600 hover:text-red-900 hover:bg-red-50 rounded-full transition-colors"
                    title="Delete Member">
                <i class="fas fa-trash fa-sm"></i>
            </button>
        </form>
    </div>
</td>
                        </tr>
                    @empty
                        <tr>
                            <div class="p-4 mb-4 bg-gray-100 rounded">
   
</div>
                            <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">
                                <div class="flex flex-col items-center justify-center py-8">
                                    <i class="fas fa-users text-gray-400 text-4xl mb-4"></i>
                                    <p class="text-lg font-medium text-gray-900">No members found</p>
                                    <p class="text-gray-600 mt-1">Get started by creating your first member.</p>
                                    <a href="{{ route('admin.members.create') }}" 
                                       class="mt-4 inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">
                                        <i class="fas fa-plus mr-2"></i> Add New Member
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($members->hasPages())
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $members->links() }}
            </div>
        @endif
    </div>
</div>
@endsection