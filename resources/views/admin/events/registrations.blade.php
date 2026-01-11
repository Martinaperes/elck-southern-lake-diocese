@extends('admin.layouts.app')

@section('title', $event->title . ' - Registrations')

@section('content')
<div class="p-6">
    <!-- Success/Error Messages -->
    @if(session('success'))
        <div class="mb-4 bg-[#197b3b] bg-opacity-10 border border-[#197b3b] text-[#197b3b] px-4 py-3 rounded-lg">
            <i class="fas fa-check-circle mr-2"></i>
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="mb-4 bg-red-900 bg-opacity-10 border border-red-900 text-red-900 px-4 py-3 rounded-lg">
            <i class="fas fa-exclamation-circle mr-2"></i>
            {{ session('error') }}
        </div>
    @endif

    <!-- Header Section -->
    <div class="mb-8">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
            <div class="flex items-center space-x-4">
                <a href="{{ route('admin.ministries.events', $event->ministry) }}" 
                   class="inline-flex items-center px-4 py-2 text-black hover:text-[#197b3b] bg-white border border-black hover:border-[#197b3b] rounded-lg shadow-sm hover:bg-gray-50 transition-colors">
                    <i class="fas fa-arrow-left mr-2"></i> Back to Events
                </a>
                <div>
                    <h1 class="text-3xl font-bold text-white">{{ $event->title }} - Registrations</h1>
                    <p class="text-gray-300 mt-1">Manage event registrations and attendance</p>
                </div>
            </div>
            
            <!-- Event Info Card -->
            <div class="mt-4 md:mt-0">
                <div class="bg-white rounded-lg border border-gray-200 p-4 shadow-sm">
                    <div class="flex items-center space-x-3">
                        @if($event->poster)
                            <img src="{{ Storage::url($event->poster) }}" 
                                 alt="{{ $event->title }}"
                                 class="w-12 h-12 object-cover rounded-lg border border-gray-200">
                        @else
                            <div class="w-12 h-12 bg-gray-100 rounded-lg flex items-center justify-center border border-gray-200">
                                <i class="fas fa-calendar-alt text-gray-400"></i>
                            </div>
                        @endif
                        <div>
                            <h3 class="font-semibold text-black text-sm">{{ $event->title }}</h3>
                            <p class="text-xs text-gray-600">{{ $event->start_time->format('M d, Y h:i A') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-xl shadow-md border border-gray-200 p-6">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-[#197b3b] bg-opacity-10 rounded-lg flex items-center justify-center mr-4">
                    <i class="fas fa-users text-[#197b3b] text-xl"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Total Registrations</p>
                    <p class="text-2xl font-bold text-black">{{ $registrations->total() }}</p>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-xl shadow-md border border-gray-200 p-6">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-[#197b3b] bg-opacity-10 rounded-lg flex items-center justify-center mr-4">
                    <i class="fas fa-check-circle text-[#197b3b] text-xl"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Confirmed</p>
                    <p class="text-2xl font-bold text-black">
                        {{ $registrations->where('status', 'confirmed')->count() }}
                    </p>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-xl shadow-md border border-gray-200 p-6">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-[#197b3b] bg-opacity-10 rounded-lg flex items-center justify-center mr-4">
                    <i class="fas fa-user-check text-[#197b3b] text-xl"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Attended</p>
                    <p class="text-2xl font-bold text-black">
                        {{ $registrations->where('status', 'attended')->count() }}
                    </p>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-xl shadow-md border border-gray-200 p-6">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-[#197b3b] bg-opacity-10 rounded-lg flex items-center justify-center mr-4">
                    <i class="fas fa-user-plus text-[#197b3b] text-xl"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Total Guests</p>
                    <p class="text-2xl font-bold text-black">
                        {{ $registrations->sum('number_of_guests') }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Registration Status Summary -->
    <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden mb-8">
        <div class="bg-[#197b3b] px-6 py-4">
            <h2 class="text-xl font-semibold text-white">Registration Status Summary</h2>
        </div>
        
        <div class="p-6">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                @php
                    $statuses = [
                        'registered' => ['name' => 'Registered', 'color' => 'bg-blue-100 text-blue-800 border-blue-200'],
                        'confirmed' => ['name' => 'Confirmed', 'color' => 'bg-green-100 text-green-800 border-green-200'],
                        'attended' => ['name' => 'Attended', 'color' => 'bg-purple-100 text-purple-800 border-purple-200'],
                        'cancelled' => ['name' => 'Cancelled', 'color' => 'bg-red-100 text-red-800 border-red-200'],
                    ];
                @endphp
                
                @foreach($statuses as $statusKey => $statusInfo)
                <div class="border rounded-lg p-4 text-center {{ $statusInfo['color'] }}">
                    <div class="text-2xl font-bold">{{ $registrations->where('status', $statusKey)->count() }}</div>
                    <div class="text-sm font-medium">{{ $statusInfo['name'] }}</div>
                    @if($registrations->total() > 0)
                    <div class="text-xs mt-1">
                        {{ round(($registrations->where('status', $statusKey)->count() / $registrations->total()) * 100, 1) }}%
                    </div>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Registrations Table -->
    <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden">
        <div class="bg-black px-6 py-4">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                <h2 class="text-xl font-semibold text-white">All Registrations</h2>
                <div class="mt-2 md:mt-0">
                    <span class="text-gray-300 text-sm">
                        {{ $registrations->total() }} total registrations
                    </span>
                </div>
            </div>
        </div>
        
        <div class="p-6">
            @if($registrations->isEmpty())
                <div class="text-center py-12">
                    <i class="fas fa-user-slash text-gray-300 text-5xl mb-4"></i>
                    <h3 class="text-xl font-semibold text-gray-700 mb-2">No Registrations Yet</h3>
                    <p class="text-gray-500 mb-6">No one has registered for this event yet.</p>
                    <a href="{{ route('admin.ministries.events', $event->ministry) }}"
                       class="inline-flex items-center px-6 py-3 bg-[#197b3b] hover:bg-[#15632f] text-white font-semibold rounded-lg shadow-md transition-colors">
                        <i class="fas fa-calendar mr-2"></i>
                        Back to Events
                    </a>
                </div>
            @else
                <!-- Filter and Search -->
                <div class="mb-6">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between space-y-4 md:space-y-0">
                        <!-- Search -->
                        <div class="flex-1">
                            <div class="relative max-w-md">
                                <input type="text" 
                                       id="searchInput"
                                       placeholder="Search by name or email..." 
                                       class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#197b3b] focus:border-[#197b3b] transition-colors text-black"
                                       onkeyup="filterRegistrations()">
                                <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                            </div>
                        </div>
                        
                        <!-- Status Filter -->
                        <div class="flex space-x-2">
                            <select id="statusFilter" 
                                    class="border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-[#197b3b] focus:border-[#197b3b] text-black text-sm"
                                    onchange="filterRegistrations()">
                                <option value="">All Status</option>
                                <option value="registered">Registered</option>
                                <option value="confirmed">Confirmed</option>
                                <option value="attended">Attended</option>
                                <option value="cancelled">Cancelled</option>
                            </select>
                            
                            <button onclick="resetFilters()"
                                    class="px-3 py-2 border border-gray-300 text-gray-700 hover:bg-gray-50 font-medium rounded-lg transition-colors text-sm">
                                <i class="fas fa-redo-alt mr-1"></i> Reset
                            </button>
                        </div>
                    </div>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                                    Member
                                </th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                                    Contact
                                </th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                                    Guests
                                </th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                                    Registered On
                                </th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                                    Status
                                </th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200" id="registrationsTableBody">
                            @foreach($registrations as $registration)
                            <tr class="registration-row hover:bg-gray-50 transition-colors"
                                data-name="{{ strtolower(($registration->member->first_name ?? '') . ' ' . ($registration->member->last_name ?? '')) }}"
                                data-email="{{ strtolower($registration->member->email ?? '') }}"
                                data-status="{{ $registration->status }}">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-[#197b3b] to-green-700 flex items-center justify-center mr-3">
                                            <span class="text-white font-bold text-sm">
                                                {{ strtoupper(substr($registration->member->first_name ?? 'M', 0, 1)) }}
                                            </span>
                                        </div>
                                        <div>
                                            <div class="font-semibold text-black">
                                                {{ $registration->member->first_name ?? 'Unknown' }} {{ $registration->member->last_name ?? '' }}
                                            </div>
                                            <div class="text-sm text-gray-600">
                                                ID: {{ $registration->member->membership_number ?? 'N/A' }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-black">{{ $registration->member->email ?? 'N/A' }}</div>
                                    <div class="text-sm text-gray-600">{{ $registration->member->phone ?? 'N/A' }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-lg font-semibold text-black">{{ $registration->number_of_guests }}</div>
                                    <div class="text-xs text-gray-600">additional guests</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-black">{{ $registration->created_at->format('M d, Y') }}</div>
                                    <div class="text-xs text-gray-600">{{ $registration->created_at->format('h:i A') }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @php
                                        $statusColors = [
                                            'registered' => 'bg-blue-100 text-blue-800 border-blue-200',
                                            'confirmed' => 'bg-green-100 text-green-800 border-green-200',
                                            'attended' => 'bg-purple-100 text-purple-800 border-purple-200',
                                            'cancelled' => 'bg-red-100 text-red-800 border-red-200',
                                        ];
                                        $statusColor = $statusColors[$registration->status] ?? 'bg-gray-100 text-gray-800 border-gray-200';
                                    @endphp
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium border {{ $statusColor }}">
                                        {{ ucfirst($registration->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex space-x-2">
                                        <!-- Update Status Dropdown -->
                                        <div class="relative" x-data="{ open: false }">
                                            <button @click="open = !open"
                                                    class="text-[#197b3b] hover:text-[#15632f] transition-colors"
                                                    title="Update Status">
                                                <i class="fas fa-sync-alt"></i>
                                            </button>
                                            
                                            <div x-show="open" 
                                                 @click.away="open = false"
                                                 class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-xl border border-gray-200 z-10"
                                                 style="display: none;">
                                                <div class="py-1">
                                                    <form action="{{ route('admin.events.registrations.status', [$event, $registration]) }}" method="POST">
                                                        @csrf
                                                        <button type="submit" name="status" value="registered"
                                                                class="block w-full text-left px-4 py-2 text-sm text-blue-700 hover:bg-blue-50 transition-colors">
                                                            <i class="fas fa-user-clock mr-2"></i>Mark as Registered
                                                        </button>
                                                        <button type="submit" name="status" value="confirmed"
                                                                class="block w-full text-left px-4 py-2 text-sm text-green-700 hover:bg-green-50 transition-colors">
                                                            <i class="fas fa-check-circle mr-2"></i>Mark as Confirmed
                                                        </button>
                                                        <button type="submit" name="status" value="attended"
                                                                class="block w-full text-left px-4 py-2 text-sm text-purple-700 hover:bg-purple-50 transition-colors">
                                                            <i class="fas fa-user-check mr-2"></i>Mark as Attended
                                                        </button>
                                                        <button type="submit" name="status" value="cancelled"
                                                                class="block w-full text-left px-4 py-2 text-sm text-red-700 hover:bg-red-50 transition-colors">
                                                            <i class="fas fa-times-circle mr-2"></i>Mark as Cancelled
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- View Details Button -->
                                        <button type="button"
                                                onclick="viewRegistrationDetails({{ $registration->id }})"
                                                class="text-black hover:text-gray-800 transition-colors"
                                                title="View Details">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        
                                        <!-- Delete Registration -->
                                        <form action="{{ route('admin.events.registrations.destroy', [$event, $registration]) }}" 
                                              method="POST" 
                                              class="inline"
                                              onsubmit="return confirm('Are you sure you want to remove this registration?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="text-red-900 hover:text-red-700 transition-colors"
                                                    title="Remove Registration">
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
                
                <!-- Pagination -->
                <div class="mt-6">
                    {{ $registrations->links() }}
                </div>
                
                <!-- Results Count -->
                <div class="mt-4 text-sm text-gray-600">
                    Showing {{ $registrations->firstItem() }} to {{ $registrations->lastItem() }} of {{ $registrations->total() }} registrations
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Registration Details Modal -->
<div id="registrationDetailsModal" class="hidden fixed inset-0 bg-black bg-opacity-50 overflow-y-auto h-full w-full z-50">
    <div class="relative top-4 mx-auto p-5 border w-full max-w-lg shadow-lg rounded-2xl bg-white max-h-[90vh] flex flex-col">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-xl font-bold text-black">Registration Details</h3>
            <button type="button" onclick="closeRegistrationDetailsModal()" class="text-gray-500 hover:text-black">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>
        
        <!-- Content loaded via AJAX -->
        <div id="registrationDetailsContent" class="flex-grow overflow-y-auto pr-2 mb-4">
            <!-- Details will be loaded here -->
        </div>
        
        <!-- Close Button -->
        <div class="flex-shrink-0 pt-4 mt-4 border-t border-gray-200">
            <div class="flex justify-end">
                <button type="button"
                        onclick="closeRegistrationDetailsModal()"
                        class="px-6 py-3 border border-gray-300 text-gray-700 hover:bg-gray-50 font-medium rounded-lg transition-colors">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>

<script>
// Registration Details Modal Functions
function viewRegistrationDetails(registrationId) {
    // Show loading state
    document.getElementById('registrationDetailsContent').innerHTML = `
        <div class="flex items-center justify-center h-32">
            <i class="fas fa-spinner fa-spin text-gray-400 text-xl"></i>
            <span class="ml-2 text-gray-600">Loading details...</span>
        </div>
    `;
    
    // Load registration details via AJAX
    fetch(`/admin/events/{{ $event->id }}/registrations/${registrationId}/details`)
        .then(response => response.text())
        .then(html => {
            document.getElementById('registrationDetailsContent').innerHTML = html;
            document.getElementById('registrationDetailsModal').classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        })
        .catch(error => {
            console.error('Error loading registration details:', error);
            document.getElementById('registrationDetailsContent').innerHTML = `
                <div class="text-center py-8">
                    <i class="fas fa-exclamation-triangle text-red-500 text-3xl mb-3"></i>
                    <p class="text-red-600">Error loading details</p>
                </div>
            `;
            document.getElementById('registrationDetailsModal').classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        });
}

function closeRegistrationDetailsModal() {
    document.getElementById('registrationDetailsModal').classList.add('hidden');
    document.body.classList.remove('overflow-hidden');
}

// Filter Functions
function filterRegistrations() {
    const searchTerm = document.getElementById('searchInput').value.toLowerCase();
    const statusFilter = document.getElementById('statusFilter').value;
    const rows = document.querySelectorAll('.registration-row');
    
    let visibleCount = 0;
    
    rows.forEach(row => {
        const name = row.getAttribute('data-name');
        const email = row.getAttribute('data-email');
        const status = row.getAttribute('data-status');
        
        const matchesSearch = !searchTerm || 
                             name.includes(searchTerm) || 
                             email.includes(searchTerm);
        
        const matchesStatus = !statusFilter || status === statusFilter;
        
        if (matchesSearch && matchesStatus) {
            row.style.display = '';
            visibleCount++;
        } else {
            row.style.display = 'none';
        }
    });
    
    // Update results count
    const resultsCount = document.getElementById('resultsCount');
    if (resultsCount) {
        resultsCount.textContent = `Showing ${visibleCount} registrations`;
    }
}

function resetFilters() {
    document.getElementById('searchInput').value = '';
    document.getElementById('statusFilter').value = '';
    filterRegistrations();
}

// Initialize Alpine.js for dropdowns
document.addEventListener('alpine:init', () => {
    Alpine.data('dropdown', () => ({
        open: false,
        toggle() {
            this.open = !this.open;
        },
        close() {
            this.open = false;
        }
    }));
});

// Close modals on Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeRegistrationDetailsModal();
    }
});

// Close modal when clicking outside
const registrationModal = document.getElementById('registrationDetailsModal');
if (registrationModal) {
    registrationModal.addEventListener('click', function(e) {
        if (e.target === this) {
            closeRegistrationDetailsModal();
        }
    });
}

// Initialize filters on page load
document.addEventListener('DOMContentLoaded', function() {
    // Initialize any filters if needed
});
</script>

<style>
.fixed.inset-0 {
    backdrop-filter: blur(4px);
}

[x-cloak] {
    display: none;
}
</style>
@endsection