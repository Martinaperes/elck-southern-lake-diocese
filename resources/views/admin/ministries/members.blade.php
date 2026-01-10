@extends('admin.layouts.app')

@section('title', $ministry->name . ' - Ministry Members')

@section('content')
<div class="p-6">
    <!-- Header Section -->
    <div class="mb-8">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
            <div class="flex items-center space-x-4">
                <a href="{{ route('admin.ministries.show', $ministry) }}" 
                   class="inline-flex items-center px-4 py-2 text-gray-600 hover:text-gray-900 bg-white border border-gray-300 rounded-lg shadow-sm hover:bg-gray-50 transition-colors">
                    <i class="fas fa-arrow-left mr-2"></i> Back to Ministry
                </a>
                <div>
                    <h1 class="text-3xl font-bold text-white">{{ $ministry->name }} - Members</h1>
                    <p class="text-gray-600 mt-1">Manage ministry participants and their roles</p>
                </div>
            </div>
            
            <!-- Action Buttons -->
            <div class="flex space-x-3 mt-4 md:mt-0">
                <button type="button"
                        onclick="openAddMemberModal()"
                        class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-[#197b3b] to-green-800 hover:from-green-800 hover:to-green-900 text-white font-semibold rounded-lg shadow-lg transition-all duration-200 transform hover:-translate-y-0.5">
                    <i class="fas fa-user-plus mr-2"></i>
                    Add Member
                </button>
                <a href="{{ route('admin.ministries.edit', $ministry) }}"
                   class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-semibold rounded-lg shadow-lg transition-all duration-200 transform hover:-translate-y-0.5">
                    <i class="fas fa-edit mr-2"></i>
                    Edit Ministry
                </a>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-xl shadow-md border border-gray-100 p-6">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mr-4">
                    <i class="fas fa-users text-blue-600 text-xl"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Total Members</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $totalMembers }}</p>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-xl shadow-md border border-gray-100 p-6">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mr-4">
                    <i class="fas fa-user-check text-green-600 text-xl"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Active Members</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $activeMembers }}</p>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-xl shadow-md border border-gray-100 p-6">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mr-4">
                    <i class="fas fa-user-tie text-purple-600 text-xl"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Leaders</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $leadersCount }}</p>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-xl shadow-md border border-gray-100 p-6">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center mr-4">
                    <i class="fas fa-history text-orange-600 text-xl"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-600">New This Month</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $newThisMonth }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Search and Filter Bar -->
    <div class="bg-white rounded-2xl shadow-xl border border-gray-100 p-6 mb-6">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between space-y-4 md:space-y-0">
            <!-- Search Box -->
            <div class="flex-1">
                <div class="relative max-w-md">
                    <input type="text" 
                           id="searchInput"
                           placeholder="Search members by name, email, or phone..." 
                           class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#197b3b] focus:border-[#197b3b] transition-colors text-black"
                           onkeyup="filterMembers()">
                    <i class="fas fa-search absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                </div>
            </div>
            
            <!-- Filter Buttons -->
            <div class="flex space-x-3">
                <select id="roleFilter" 
                        class="border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-[#197b3b] focus:border-[#197b3b] text-black"
                        onchange="filterMembers()">
                    <option value="">All Roles</option>
                    <option value="leader">Leaders</option>
                    <option value="member">Members</option>
                    <option value="coordinator">Coordinators</option>
                    <option value="volunteer">Volunteers</option>
                </select>
                
                <select id="statusFilter" 
                        class="border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-[#197b3b] focus:border-[#197b3b] text-black"
                        onchange="filterMembers()">
                    <option value="">All Status</option>
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
                
                <button onclick="resetFilters()"
                        class="px-4 py-3 border border-gray-300 text-gray-700 hover:bg-gray-50 font-medium rounded-lg transition-colors">
                    <i class="fas fa-redo-alt mr-2"></i> Reset
                </button>
            </div>
        </div>
    </div>

    <!-- Members Table -->
    <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
        <div class="bg-gradient-to-r from-[#197b3b] to-green-700 px-6 py-4">
            <h2 class="text-xl font-semibold text-white">Ministry Members ({{ $ministryMembers->total() }})</h2>
        </div>
        
        <div class="p-6">
            @if($ministryMembers->isEmpty())
                <div class="text-center py-12">
                    <i class="fas fa-users text-gray-300 text-5xl mb-4"></i>
                    <h3 class="text-xl font-semibold text-gray-700 mb-2">No Members Found</h3>
                    <p class="text-gray-500 mb-6">This ministry doesn't have any members yet.</p>
                    <button type="button"
                            onclick="openAddMemberModal()"
                            class="inline-flex items-center px-6 py-3 bg-[#197b3b] hover:bg-green-800 text-white font-semibold rounded-lg shadow-md transition-colors">
                        <i class="fas fa-user-plus mr-2"></i>
                        Add First Member
                    </button>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Member
                                </th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Contact
                                </th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Role
                                </th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Joined
                                </th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status
                                </th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200" id="membersTableBody">
                            @foreach($ministryMembers as $ministryMember)
                            <tr class="member-row hover:bg-gray-50 transition-colors"
                                data-name="{{ strtolower($ministryMember->member->first_name . ' ' . $ministryMember->member->last_name) }}"
                                data-email="{{ strtolower($ministryMember->member->email ?? '') }}"
                                data-phone="{{ strtolower($ministryMember->member->phone ?? '') }}"
                                data-role="{{ strtolower($ministryMember->role) }}"
                                data-status="{{ $ministryMember->is_active ? 'active' : 'inactive' }}">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-[#197b3b] to-green-700 flex items-center justify-center mr-3">
                                            <span class="text-white font-bold text-sm">
                                                {{ strtoupper(substr($ministryMember->member->first_name ?? 'M', 0, 1)) }}
                                            </span>
                                        </div>
                                        <div>
                                            <div class="font-semibold text-gray-900">
                                                {{ $ministryMember->member->first_name }} {{ $ministryMember->member->last_name }}
                                            </div>
                                            <div class="text-sm text-gray-500">
                                                ID: {{ $ministryMember->member->membership_number ?? 'N/A' }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $ministryMember->member->email ?? 'N/A' }}</div>
                                    <div class="text-sm text-gray-500">{{ $ministryMember->member->phone ?? 'N/A' }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @php
                                        // Fix nested ternary operator by using if-else
                                        $badgeClass = 'bg-green-100 text-green-800'; // default
                                        $roleLower = strtolower($ministryMember->role);
                                        
                                        if (strpos($roleLower, 'leader') !== false) {
                                            $badgeClass = 'bg-purple-100 text-purple-800';
                                        } elseif (strpos($roleLower, 'coordinator') !== false) {
                                            $badgeClass = 'bg-blue-100 text-blue-800';
                                        } elseif (strpos($roleLower, 'volunteer') !== false) {
                                            $badgeClass = 'bg-orange-100 text-orange-800';
                                        }
                                    @endphp
                                    <span class="role-badge inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $badgeClass }}">
                                        {{ $ministryMember->role ?? 'Member' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $ministryMember->joined_at ? $ministryMember->joined_at->format('M d, Y') : 'N/A' }}
                                    @if($ministryMember->joined_at)
                                        <br><span class="text-xs text-gray-400">{{ $ministryMember->joined_at->diffForHumans() }}</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($ministryMember->is_active)
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                            <i class="fas fa-circle mr-1" style="font-size: 6px;"></i>
                                            Active
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                                            <i class="fas fa-circle mr-1" style="font-size: 6px;"></i>
                                            Inactive
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex space-x-2">
                                        <!-- Edit Role Button -->
                                        <button type="button"
                                                onclick="openEditRoleModal({{ $ministryMember->id }}, '{{ $ministryMember->role }}', {{ $ministryMember->is_active ? 'true' : 'false' }})"
                                                class="text-green-600 hover:text-green-900 transition-colors"
                                                title="Edit Role">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        
                                        <!-- Remove Member Button -->
                                        <form action="{{ route('admin.ministries.remove-member', [$ministry->id, $ministryMember->id]) }}" 
                                              method="POST" 
                                              class="inline"
                                              onsubmit="return confirm('Are you sure you want to remove {{ $ministryMember->member->first_name }} from this ministry?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="text-red-600 hover:text-red-900 transition-colors"
                                                    title="Remove from Ministry">
                                                <i class="fas fa-user-minus"></i>
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
                    {{ $ministryMembers->links() }}
                </div>
                
                <!-- Results Count -->
                <div class="mt-4 text-sm text-gray-500">
                    Showing {{ $ministryMembers->firstItem() }} to {{ $ministryMembers->lastItem() }} of {{ $ministryMembers->total() }} members
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Add Member Modal -->
<div id="addMemberModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-5 border w-full max-w-2xl shadow-lg rounded-2xl bg-white">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-xl font-bold text-gray-900">Add Member to {{ $ministry->name }}</h3>
            <button onclick="closeAddMemberModal()" class="text-gray-400 hover:text-gray-600">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>
        
        <form action="{{ route('admin.ministries.add-member', $ministry) }}" method="POST" id="addMemberForm">
            @csrf
            <div class="space-y-6">
                <!-- Member Search and Select -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Add Member 
                    </label>
                    <div class="relative">
                        <input type="text" 
                               id="memberSearch"
                               placeholder="Search members by name or email..."
                               class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#197b3b] focus:border-[#197b3b] transition-colors text-black"
                               onkeyup="searchAvailableMembers()">
                        <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    </div>
                    
                    <!-- Available Members List -->
                    <div id="availableMembers" class="mt-3 max-h-60 overflow-y-auto border border-gray-200 rounded-lg hidden">
                        @foreach($availableMembers as $member)
                            <div class="member-option p-3 border-b border-gray-100 hover:bg-gray-50 cursor-pointer transition-colors"
                                 data-id="{{ $member->id }}"
                                 data-name="{{ $member->first_name }} {{ $member->last_name }}"
                                 data-email="{{ $member->email }}">
                                <div class="font-medium text-gray-900">{{ $member->first_name }} {{ $member->last_name }}</div>
                                <div class="text-sm text-gray-500">{{ $member->email ?? 'No email' }} | {{ $member->phone ?? 'No phone' }}</div>
                                <div class="text-xs text-gray-400 mt-1">Click to select</div>
                            </div>
                        @endforeach
                    </div>
                    
                    <!-- Selected Member Display -->
                    <div id="selectedMember" class="mt-3 p-4 bg-green-50 border border-green-200 rounded-lg hidden">
                        <div class="flex justify-between items-center">
                            <div>
                                <div class="font-medium text-green-800" id="selectedMemberName"></div>
                                <div class="text-sm text-green-600" id="selectedMemberEmail"></div>
                            </div>
                            <button type="button" 
                                    onclick="clearSelectedMember()"
                                    class="text-green-600 hover:text-green-800">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        <input type="hidden" name="member_id" id="selectedMemberId">
                    </div>
                </div>
                
                <!-- Role Selection -->
                <div>
                    <label for="role" class="block text-sm font-medium text-gray-700 mb-2">
                        Role in Ministry *
                    </label>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-2 mb-3">
                        <button type="button" onclick="setRole('Member')" class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 text-gray-700 transition-colors">Member</button>
                        <button type="button" onclick="setRole('Leader')" class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 text-gray-700 transition-colors">Leader</button>
                        <button type="button" onclick="setRole('Coordinator')" class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 text-gray-700 transition-colors">Coordinator</button>
                        <button type="button" onclick="setRole('Volunteer')" class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 text-gray-700 transition-colors">Volunteer</button>
                    </div>
                    <input type="text" 
                           name="role" 
                           id="role"
                           required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#197b3b] focus:border-[#197b3b] transition-colors text-black"
                           placeholder="Or enter custom role...">
                </div>
                
                <!-- Joined Date -->
                <div>
                    <label for="joined_at" class="block text-sm font-medium text-gray-700 mb-2">
                        Joined Date
                    </label>
                    <input type="date" 
                           name="joined_at" 
                           id="joined_at"
                           value="{{ date('Y-m-d') }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#197b3b] focus:border-[#197b3b] transition-colors text-black">
                </div>
            </div>
            
            <div class="mt-8 flex justify-end space-x-3">
                <button type="button"
                        onclick="closeAddMemberModal()"
                        class="px-6 py-3 border border-gray-300 text-gray-700 hover:bg-gray-50 font-medium rounded-lg transition-colors">
                    Cancel
                </button>
                <button type="submit"
                        class="px-6 py-3 bg-[#197b3b] hover:bg-green-800 text-white font-semibold rounded-lg shadow-md transition-colors">
                    <i class="fas fa-user-plus mr-2"></i>
                    Add Member
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Edit Role Modal -->
<div id="editRoleModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-5 border w-full max-w-md shadow-lg rounded-2xl bg-white">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-xl font-bold text-gray-900">Edit Member Role</h3>
            <button onclick="closeEditRoleModal()" class="text-gray-400 hover:text-gray-600">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>
        
        <form id="editRoleForm" method="POST">
            @csrf
            @method('PUT')
            <div class="space-y-6">
                <div>
                    <label for="edit_role" class="block text-sm font-medium text-gray-700 mb-2">
                        Role in Ministry *
                    </label>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-2 mb-3">
                        <button type="button" onclick="setEditRole('Member')" class="px-3 py-1 border border-gray-300 rounded hover:bg-gray-50 text-gray-700 transition-colors text-sm">Member</button>
                        <button type="button" onclick="setEditRole('Leader')" class="px-3 py-1 border border-gray-300 rounded hover:bg-gray-50 text-gray-700 transition-colors text-sm">Leader</button>
                        <button type="button" onclick="setEditRole('Coordinator')" class="px-3 py-1 border border-gray-300 rounded hover:bg-gray-50 text-gray-700 transition-colors text-sm">Coordinator</button>
                        <button type="button" onclick="setEditRole('Volunteer')" class="px-3 py-1 border border-gray-300 rounded hover:bg-gray-50 text-gray-700 transition-colors text-sm">Volunteer</button>
                    </div>
                    <input type="text" 
                           name="role" 
                           id="edit_role"
                           required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#197b3b] focus:border-[#197b3b] transition-colors text-black"
                           placeholder="Enter role...">
                </div>
                
                <div class="flex items-center">
                    <input type="checkbox" 
                           name="is_active" 
                           id="edit_is_active"
                           value="1"
                           class="w-4 h-4 text-[#197b3b] border-gray-300 rounded focus:ring-[#197b3b]">
                    <label for="edit_is_active" class="ml-2 text-sm font-medium text-gray-700">
                        Active Member
                    </label>
                </div>
            </div>
            
            <div class="mt-8 flex justify-end space-x-3">
                <button type="button"
                        onclick="closeEditRoleModal()"
                        class="px-6 py-3 border border-gray-300 text-gray-700 hover:bg-gray-50 font-medium rounded-lg transition-colors">
                    Cancel
                </button>
                <button type="submit"
                        class="px-6 py-3 bg-[#197b3b] hover:bg-green-800 text-white font-semibold rounded-lg transition-colors">
                    <i class="fas fa-save mr-2"></i>
                    Update Role
                </button>
            </div>
        </form>
    </div>
</div>

<script>
// Modal Functions
function openAddMemberModal() {
    document.getElementById('addMemberModal').classList.remove('hidden');
    document.body.classList.add('overflow-hidden');
}

function closeAddMemberModal() {
    document.getElementById('addMemberModal').classList.add('hidden');
    document.body.classList.remove('overflow-hidden');
    clearSelectedMember();
}

function openEditRoleModal(memberId, currentRole, isActive) {
    document.getElementById('editRoleForm').action = `/admin/ministries/{{ $ministry->id }}/update-role/${memberId}`;
    document.getElementById('edit_role').value = currentRole;
    document.getElementById('edit_is_active').checked = isActive;
    document.getElementById('editRoleModal').classList.remove('hidden');
    document.body.classList.add('overflow-hidden');
}

function closeEditRoleModal() {
    document.getElementById('editRoleModal').classList.add('hidden');
    document.body.classList.remove('overflow-hidden');
}

// Member Selection Functions
function searchAvailableMembers() {
    const searchTerm = document.getElementById('memberSearch').value.toLowerCase();
    const memberOptions = document.querySelectorAll('.member-option');
    const availableMembersDiv = document.getElementById('availableMembers');
    
    let hasVisibleOptions = false;
    
    memberOptions.forEach(option => {
        const name = option.getAttribute('data-name').toLowerCase();
        const email = option.getAttribute('data-email').toLowerCase();
        
        if (name.includes(searchTerm) || email.includes(searchTerm)) {
            option.style.display = 'block';
            hasVisibleOptions = true;
        } else {
            option.style.display = 'none';
        }
    });
    
    if (searchTerm && hasVisibleOptions) {
        availableMembersDiv.classList.remove('hidden');
    } else {
        availableMembersDiv.classList.add('hidden');
    }
}

// Attach click event to member options
document.addEventListener('DOMContentLoaded', function() {
    const memberOptions = document.querySelectorAll('.member-option');
    memberOptions.forEach(option => {
        option.addEventListener('click', function() {
            const memberId = this.getAttribute('data-id');
            const memberName = this.getAttribute('data-name');
            const memberEmail = this.getAttribute('data-email');
            
            document.getElementById('selectedMemberId').value = memberId;
            document.getElementById('selectedMemberName').textContent = memberName;
            document.getElementById('selectedMemberEmail').textContent = memberEmail;
            document.getElementById('selectedMember').classList.remove('hidden');
            document.getElementById('availableMembers').classList.add('hidden');
            document.getElementById('memberSearch').value = '';
        });
    });
});

function clearSelectedMember() {
    document.getElementById('selectedMemberId').value = '';
    document.getElementById('selectedMember').classList.add('hidden');
}

function setRole(role) {
    document.getElementById('role').value = role;
}

function setEditRole(role) {
    document.getElementById('edit_role').value = role;
}

// Table Filtering Functions
function filterMembers() {
    const searchTerm = document.getElementById('searchInput').value.toLowerCase();
    const roleFilter = document.getElementById('roleFilter').value.toLowerCase();
    const statusFilter = document.getElementById('statusFilter').value;
    const rows = document.querySelectorAll('.member-row');
    
    let visibleCount = 0;
    
    rows.forEach(row => {
        const name = row.getAttribute('data-name');
        const email = row.getAttribute('data-email');
        const phone = row.getAttribute('data-phone');
        const role = row.getAttribute('data-role');
        const status = row.getAttribute('data-status');
        
        const matchesSearch = !searchTerm || 
                             name.includes(searchTerm) || 
                             email.includes(searchTerm) || 
                             phone.includes(searchTerm);
        
        const matchesRole = !roleFilter || role.includes(roleFilter);
        const matchesStatus = !statusFilter || status === statusFilter;
        
        if (matchesSearch && matchesRole && matchesStatus) {
            row.style.display = '';
            visibleCount++;
        } else {
            row.style.display = 'none';
        }
    });
    
    // Update results count if needed
    const resultsCount = document.getElementById('resultsCount');
    if (resultsCount) {
        resultsCount.textContent = `Showing ${visibleCount} members`;
    }
}

function resetFilters() {
    document.getElementById('searchInput').value = '';
    document.getElementById('roleFilter').value = '';
    document.getElementById('statusFilter').value = '';
    filterMembers();
}

// Form Validation
document.getElementById('addMemberForm')?.addEventListener('submit', function(e) {
    const memberId = document.getElementById('selectedMemberId').value;
    const role = document.getElementById('role').value;
    
    if (!memberId) {
        e.preventDefault();
        alert('Please select a member to add.');
        return false;
    }
    
    if (!role.trim()) {
        e.preventDefault();
        alert('Please enter a role for the member.');
        document.getElementById('role').focus();
        return false;
    }
    
    return true;
});

// Close modals on Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeAddMemberModal();
        closeEditRoleModal();
    }
});

// Close modals when clicking outside
const modals = document.querySelectorAll('.fixed.inset-0');
modals.forEach(modal => {
    modal.addEventListener('click', function(e) {
        if (e.target === this) {
            this.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }
    });
});
</script>

<style>
.fixed.inset-0 {
    backdrop-filter: blur(4px);
}

.member-option:hover {
    background-color: #f3f4f6;
}

.role-badge {
    transition: all 0.2s ease;
}

.role-badge:hover {
    transform: translateY(-1px);
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}
</style>
@endsection