@extends('admin.layouts.app')

@section('title', 'Users Management')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Users Management</h1>
            <p class="text-gray-600 mt-1">Manage all users and administrators in the system</p>
        </div>
        <a href="{{ route('admin.users.create') }}" 
           class="mt-4 md:mt-0 inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
            <i class="fas fa-plus mr-2"></i> Add New User
        </a>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
        <x-dashboard-card 
            title="Total Users" 
            :count="$users->total()" 
        />
        <x-dashboard-card 
            title="Admin Users" 
            :count="App\Models\User::where('role', 'admin')->count()" 
        />
        <x-dashboard-card 
            title="Regular Users" 
            :count="App\Models\User::where('role', 'user')->count()" 
        />
        <x-dashboard-card 
            title="New This Month" 
            :count="App\Models\User::whereMonth('created_at', now()->month)->count()" 
        />
    </div>

    <!-- Users Table -->
    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
        <!-- Table Header -->
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                <h2 class="text-lg font-semibold text-gray-800">All Users</h2>
                
                <!-- Search Form -->
                <form method="GET" action="{{ route('admin.users.index') }}" class="mt-4 md:mt-0">
                    <div class="flex space-x-2">
                        <input 
                            type="text" 
                            name="search" 
                            placeholder="Search users..." 
                            value="{{ request('search') }}"
                            class="w-full md:w-64 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
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
                            User
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Role
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Email
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Joined
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
                    @forelse($users as $user)
                        <tr class="hover:bg-gray-50">
                            <!-- User Info -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <div class="h-10 w-10 rounded-full bg-blue-600 flex items-center justify-center text-white font-semibold">
                                            {{ strtoupper(substr($user->name, 0, 1)) }}
                                        </div>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $user->name }}
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            ID: {{ $user->id }}
                                        </div>
                                    </div>
                                </div>
                            </td>

                            <!-- Role -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                    {{ $user->role === 'admin' ? 'bg-purple-100 text-purple-800' : 'bg-green-100 text-green-800' }}">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </td>

                            <!-- Email -->
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $user->email }}
                            </td>

                            <!-- Joined Date -->
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $user->created_at->format('M j, Y') }}
                                <div class="text-xs text-gray-400">
                                    {{ $user->created_at->diffForHumans() }}
                                </div>
                            </td>

                            <!-- Status -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    <i class="fas fa-circle text-green-500 mr-1" style="font-size: 6px;"></i>
                                    Active
                                </span>
                            </td>

                            <!-- Actions -->
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex justify-end space-x-2">
                                    <!-- View -->
                                    <a href="{{ route('admin.users.show', $user) }}" 
                                       class="text-blue-600 hover:text-blue-900"
                                       title="View User">
                                        <i class="fas fa-eye"></i>
                                    </a>

                                    <!-- Edit -->
                                    <a href="{{ route('admin.users.edit', $user) }}" 
                                       class="text-green-600 hover:text-green-900"
                                       title="Edit User">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <!-- Delete -->
                                    @if($user->id !== auth()->id())
                                        <form action="{{ route('admin.users.destroy', $user) }}" 
                                              method="POST" 
                                              class="inline"
                                              onsubmit="return confirm('Are you sure you want to delete this user?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="text-red-600 hover:text-red-900"
                                                    title="Delete User">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-gray-400 cursor-not-allowed" title="Cannot delete your own account">
                                            <i class="fas fa-trash"></i>
                                        </span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500">
                                <div class="flex flex-col items-center justify-center py-8">
                                    <i class="fas fa-users text-gray-400 text-4xl mb-4"></i>
                                    <p class="text-lg font-medium text-gray-900">No users found</p>
                                    <p class="text-gray-600 mt-1">Get started by creating your first user.</p>
                                    <a href="{{ route('admin.users.create') }}" 
                                       class="mt-4 inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                                        <i class="fas fa-plus mr-2"></i> Add New User
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($users->hasPages())
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $users->links() }}
            </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Auto-dismiss flash messages after 5 seconds
    document.addEventListener('DOMContentLoaded', function() {
        const flashMessages = document.querySelectorAll('.bg-green-100, .bg-red-100');
        flashMessages.forEach(function(message) {
            setTimeout(function() {
                message.style.transition = 'opacity 0.5s ease';
                message.style.opacity = '0';
                setTimeout(function() {
                    message.remove();
                }, 500);
            }, 5000);
        });
    });

    // Search functionality enhancement
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.querySelector('input[name="search"]');
        if (searchInput) {
            // Clear search button
            const clearSearch = document.createElement('button');
            clearSearch.type = 'button';
            clearSearch.innerHTML = '&times;';
            clearSearch.className = 'absolute right-2 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600';
            clearSearch.style.display = 'none';
            
            const searchContainer = searchInput.parentElement;
            searchContainer.style.position = 'relative';
            searchContainer.appendChild(clearSearch);

            searchInput.addEventListener('input', function() {
                clearSearch.style.display = this.value ? 'block' : 'none';
            });

            clearSearch.addEventListener('click', function() {
                searchInput.value = '';
                clearSearch.style.display = 'none';
                searchInput.focus();
            });
        }
    });
</script>
@endpush