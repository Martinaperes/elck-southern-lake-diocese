@extends('admin.layouts.app')

@section('title', 'Ministries Management')

@section('content')
<div class="p-6">

    <!-- Header Section -->
    <div class="mb-8">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Ministries Management</h1>
                <p class="text-gray-600 mt-2">Manage all church ministries and outreach programs</p>
            </div>
            
            <!-- Action Buttons -->
            <div class="flex space-x-3 mt-4 md:mt-0">
                <a href="{{ route('admin.ministries.create') }}"
                   class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-semibold rounded-lg shadow-lg transition-all duration-200 transform hover:-translate-y-0.5">
                    <i class="fas fa-plus-circle mr-2"></i>
                    Create Ministry
                </a>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mt-6">
            <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl p-6 text-white shadow-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-blue-100 text-sm font-medium">Total Ministries</p>
                        <p class="text-3xl font-bold mt-1">{{ $ministries->total() }}</p>
                    </div>
                    <div class="bg-blue-400 bg-opacity-30 p-3 rounded-full">
                        <i class="fas fa-church text-xl"></i>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-2xl p-6 text-white shadow-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-green-100 text-sm font-medium">Active</p>
                        <p class="text-3xl font-bold mt-1">{{ App\Models\Ministry::where('is_active', true)->count() }}</p>
                    </div>
                    <div class="bg-green-400 bg-opacity-30 p-3 rounded-full">
                        <i class="fas fa-check-circle text-xl"></i>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl p-6 text-white shadow-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-purple-100 text-sm font-medium">With Leaders</p>
                        <p class="text-3xl font-bold mt-1">{{ App\Models\Ministry::whereNotNull('leader_name')->where('leader_name', '!=', '')->count() }}</p>
                    </div>
                    <div class="bg-purple-400 bg-opacity-30 p-3 rounded-full">
                        <i class="fas fa-users text-xl"></i>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-orange-500 to-orange-600 rounded-2xl p-6 text-white shadow-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-orange-100 text-sm font-medium">With Images</p>
                        <p class="text-3xl font-bold mt-1">{{ App\Models\Ministry::whereNotNull('image_url')->where('image_url', '!=', '')->count() }}</p>
                    </div>
                    <div class="bg-orange-400 bg-opacity-30 p-3 rounded-full">
                        <i class="fas fa-image text-xl"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Ministries Table Card -->
    <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
        <!-- Table Header -->
        <div class="px-6 py-4 border-b border-gray-100 bg-gradient-to-r from-gray-50 to-gray-75">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                <h3 class="text-lg font-semibold text-gray-800">All Ministries</h3>
                
                <!-- Search and Filters -->
                <div class="flex items-center space-x-4 mt-4 md:mt-0">
                    <form method="GET" action="{{ route('admin.ministries.index') }}" class="relative">
    @if(request('status'))
        <input type="hidden" name="status" value="{{ request('status') }}">
    @endif
    <input type="text" 
           name="search" 
           placeholder="Search ministries..." 
           value="{{ request('search') }}"
           class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 w-64">
    <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
    @if(request('search'))
        <a href="{{ route('admin.ministries.index') }}" 
           class="absolute right-3 top-3 text-gray-400 hover:text-gray-600"
           title="Clear search">
            <i class="fas fa-times"></i>
        </a>
    @endif
</form>
                    <div class="relative" x-data="{ open: false }">
    <button type="button" 
            @click="open = !open"
            class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
        <i class="fas fa-filter mr-2"></i>Filter
    </button>
    
    <!-- Dropdown menu -->
    <div x-show="open" 
         @click.away="open = false"
         class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200 z-10">
        <div class="p-2">
            <a href="{{ route('admin.ministries.index', ['status' => 'active'] + request()->except('status')) }}"
               class="block px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded {{ request('status') == 'active' ? 'bg-blue-50 text-blue-700' : '' }}">
                Active Only
            </a>
            <a href="{{ route('admin.ministries.index', ['status' => 'inactive'] + request()->except('status')) }}"
               class="block px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded {{ request('status') == 'inactive' ? 'bg-blue-50 text-blue-700' : '' }}">
                Inactive Only
            </a>
            <a href="{{ route('admin.ministries.index', request()->except('status')) }}"
               class="block px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded {{ !request('status') ? 'bg-blue-50 text-blue-700' : '' }}">
                All Status
            </a>
        </div>
    </div>
</div>
                </div>
            </div>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Ministry
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Leader
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Contact
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Status
                        </th>
                        <th class="px-6 py-4 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                </thead>

                <tbody class="bg-white divide-y divide-gray-100">
                    @foreach($ministries as $ministry)
                    <tr class="hover:bg-blue-50 transition-colors duration-150 group">
                        <!-- Ministry Info with Image -->
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-12 w-12 relative">
                                    @if(!empty($ministry->image_url))
                                        <img src="{{ asset('images/gallery/' . $ministry->image_url) }}"
                                             alt="{{ $ministry->name }}"
                                             class="h-12 w-12 rounded-xl object-cover border-2 border-white shadow-lg ring-2 ring-blue-100">
                                        <div class="absolute -bottom-1 -right-1 bg-green-500 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs shadow-sm">
                                            <i class="fas fa-image text-xs"></i>
                                        </div>
                                    @else
                                        @php
                                            $colors = [
                                                'bg-gradient-to-br from-blue-500 to-blue-600',
                                                'bg-gradient-to-br from-green-500 to-green-600', 
                                                'bg-gradient-to-br from-purple-500 to-purple-600',
                                                'bg-gradient-to-br from-red-500 to-red-600',
                                                'bg-gradient-to-br from-yellow-500 to-yellow-600',
                                                'bg-gradient-to-br from-indigo-500 to-indigo-600'
                                            ];
                                            $colorIndex = crc32($ministry->name) % count($colors);
                                            $bgGradient = $colors[$colorIndex];
                                        @endphp
                                        <div class="h-12 w-12 rounded-xl {{ $bgGradient }} flex items-center justify-center text-white font-bold text-lg shadow-lg">
                                            {{ strtoupper(substr($ministry->name, 0, 1)) }}
                                        </div>
                                    @endif
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-semibold text-gray-900 group-hover:text-blue-700 transition-colors">
                                        {{ $ministry->name }}
                                    </div>
                                    <div class="text-sm text-gray-500 line-clamp-1 max-w-xs">
                                        {{ Str::limit($ministry->description, 50) }}
                                    </div>
                                </div>
                            </div>
                        </td>

                        <!-- Leader -->
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">
                                @if($ministry->leader_name && trim($ministry->leader_name) !== '')
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center mr-2">
                                            <i class="fas fa-user text-blue-600 text-sm"></i>
                                        </div>
                                        <span class="font-medium">{{ $ministry->leader_name }}</span>
                                    </div>
                                @else
                                    <span class="text-gray-400 italic">No leader</span>
                                @endif
                            </div>
                        </td>

                        <!-- Contact -->
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-600">
                                @if($ministry->contact_email && trim($ministry->contact_email) !== '')
                                    <div class="flex items-center">
                                        <i class="fas fa-envelope text-gray-400 mr-2"></i>
                                        <span class="truncate max-w-xs">{{ $ministry->contact_email }}</span>
                                    </div>
                                @else
                                    <span class="text-gray-400 italic">No email</span>
                                @endif
                            </div>
                        </td>

                        <!-- Status -->
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($ministry->is_active)
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800 border border-green-200">
                                    <i class="fas fa-circle mr-1" style="font-size: 6px;"></i>
                                    Active
                                </span>
                            @else
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-800 border border-red-200">
                                    <i class="fas fa-circle mr-1" style="font-size: 6px;"></i>
                                    Inactive
                                </span>
                            @endif
                        </td>

                        <!-- Actions -->
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <div class="flex justify-end space-x-2 opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                                <!-- View -->
                                <a href="{{ route('admin.ministries.show', $ministry) }}"
                                   class="text-blue-600 hover:text-blue-900 p-2 rounded-lg hover:bg-blue-100 transition-colors"
                                   title="View Ministry">
                                    <i class="fas fa-eye"></i>
                                </a>

                                <!-- Edit -->
                                <a href="{{ route('admin.ministries.edit', $ministry) }}"
                                   class="text-green-600 hover:text-green-900 p-2 rounded-lg hover:bg-green-100 transition-colors"
                                   title="Edit Ministry">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <!-- Delete -->
                                <form action="{{ route('admin.ministries.destroy', $ministry) }}"
                                      method="POST"
                                      class="inline"
                                      onsubmit="return confirm('Are you sure you want to delete this ministry? This action cannot be undone.')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="text-red-600 hover:text-red-900 p-2 rounded-lg hover:bg-red-100 transition-colors"
                                            title="Delete Ministry">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Table Footer -->
        <div class="px-6 py-4 border-t border-gray-100 bg-gray-50">
            <div class="flex items-center justify-between">
                <p class="text-sm text-gray-600">
                    Showing {{ $ministries->firstItem() }} to {{ $ministries->lastItem() }} of {{ $ministries->total() }} results
                </p>
                
                <!-- Pagination -->
                @if($ministries->hasPages())
                    <div class="flex space-x-2">
                        {{ $ministries->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Empty State -->
    @if($ministries->isEmpty())
    <div class="text-center py-12">
        <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-2xl p-12 border-2 border-dashed border-gray-200">
            <i class="fas fa-hands-helping text-gray-300 text-6xl mb-4"></i>
            <h3 class="text-xl font-semibold text-gray-600 mb-2">No Ministries Yet</h3>
            <p class="text-gray-500 mb-6">Get started by creating your first ministry</p>
            <a href="{{ route('admin.ministries.create') }}"
               class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-semibold rounded-lg shadow-lg transition-all duration-200">
                <i class="fas fa-plus-circle mr-2"></i>
                Create First Ministry
            </a>
        </div>
    </div>
    @endif

</div>

<style>
    .line-clamp-1 {
        display: -webkit-box;
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    .bg-gradient-to-br {
        background-image: linear-gradient(to bottom right, var(--tw-gradient-stops));
    }
</style>
@endsection