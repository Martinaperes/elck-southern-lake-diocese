@extends('admin.layouts.app')

@section('title', $ministry->name . ' - Ministry Members')

@section('content')
<div class="p-6">
    <!-- Success/Error Messages -->
    @if(session('success'))
        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg">
            <i class="fas fa-check-circle mr-2"></i>
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg">
            <i class="fas fa-exclamation-circle mr-2"></i>
            {{ session('error') }}
        </div>
    @endif

    @if($errors->any())
        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg">
            <i class="fas fa-exclamation-triangle mr-2"></i>
            <ul class="list-disc ml-4">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

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
                <button type="button"
                        onclick="alert('Click the edit icon next to each member to edit their details')"
                        class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-semibold rounded-lg shadow-lg transition-all duration-200 transform hover:-translate-y-0.5">
                    <i class="fas fa-users-cog mr-2"></i>
                    Manage Members
                </button>
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
                                data-name="{{ strtolower(($ministryMember->member->first_name ?? '') . ' ' . ($ministryMember->member->last_name ?? '')) }}"
                                data-email="{{ strtolower($ministryMember->member->email ?? '') }}"
                                data-phone="{{ strtolower($ministryMember->member->phone ?? '') }}"
                                data-role="{{ strtolower($ministryMember->role ?? '') }}"
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
                                                {{ $ministryMember->member->first_name ?? 'Unknown' }} {{ $ministryMember->member->last_name ?? '' }}
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
                                        $badgeClass = 'bg-green-100 text-green-800';
                                        $roleLower = strtolower($ministryMember->role ?? '');
                                        
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
                                    @if($ministryMember->joined_at instanceof \Carbon\Carbon)
                                        {{ $ministryMember->joined_at->format('M d, Y') }}
                                        <br>
                                        <span class="text-xs text-gray-400">
                                            {{ $ministryMember->joined_at->diffForHumans() }}
                                        </span>
                                    @else
                                        N/A
                                        <br>
                                        <span class="text-xs text-gray-400">
                                            Not specified
                                        </span>
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
                                        <button type="button"
                                                onclick="openEditMemberModal({{ $ministryMember->id }}, '{{ rawurlencode(json_encode([
                                                    'memberId' => $ministryMember->member->id ?? '',
                                                    'memberName' => ($ministryMember->member->first_name ?? 'Unknown') . ' ' . ($ministryMember->member->last_name ?? ''),
                                                    'memberEmail' => $ministryMember->member->email ?? '',
                                                    'memberPhone' => $ministryMember->member->phone ?? '',
                                                    'role' => $ministryMember->role ?? 'Member',
                                                    'joinedAt' => $ministryMember->joined_at ? $ministryMember->joined_at->toISOString() : null,
                                                    'isActive' => $ministryMember->is_active,
                                                    'notes' => $ministryMember->notes ?? '',
                                                    'createdAt' => $ministryMember->created_at ? $ministryMember->created_at->toISOString() : null,
                                                    'updatedAt' => $ministryMember->updated_at ? $ministryMember->updated_at->toISOString() : null,
                                                    'ministryName' => $ministry->name
                                                ])) }}')"
                                                class="text-green-600 hover:text-green-900 transition-colors"
                                                title="Edit Member">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        
                                        <form action="{{ route('admin.ministries.remove-member', [$ministry->id, $ministryMember->id]) }}" 
                                              method="POST" 
                                              class="inline"
                                              onsubmit="return confirm('Are you sure you want to remove {{ addslashes($ministryMember->member->first_name ?? 'this member') }} from this ministry?')">
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
    <div class="relative top-4 mx-auto p-5 border w-full max-w-2xl shadow-lg rounded-2xl bg-white max-h-[90vh] flex flex-col">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-xl font-bold text-gray-900">Add Member to {{ $ministry->name }}</h3>
            <button type="button" onclick="closeAddMemberModal()" class="text-gray-400 hover:text-gray-600">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>
        
        <!-- Scrollable Content Area -->
        <div class="flex-grow overflow-y-auto pr-2 mb-4">
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
                            <input type="hidden" name="member_id" id="selectedMemberId" value="">
                        </div>
                    </div>
                    
                    <!-- Role Selection -->
                    <div>
                        <label for="role" class="block text-sm font-medium text-gray-700 mb-2">
                            Role in Ministry *
                        </label>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-2 mb-3">
                            <button type="button" onclick="setRole('Member')" class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 text-gray-700 transition-colors hover:border-[#197b3b] hover:text-[#197b3b]">Member</button>
                            <button type="button" onclick="setRole('Leader')" class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 text-gray-700 transition-colors hover:border-purple-600 hover:text-purple-600">Leader</button>
                            <button type="button" onclick="setRole('Coordinator')" class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 text-gray-700 transition-colors hover:border-blue-600 hover:text-blue-600">Coordinator</button>
                            <button type="button" onclick="setRole('Volunteer')" class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 text-gray-700 transition-colors hover:border-orange-600 hover:text-orange-600">Volunteer</button>
                        </div>
                        <input type="text" 
                               name="role" 
                               id="role"
                               required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#197b3b] focus:border-[#197b3b] transition-colors text-black"
                               placeholder="Enter role...">
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

                    <!-- Add Another Member Button -->
                    <div class="pt-4 border-t border-gray-200">
                        <button type="button"
                                onclick="addAnotherMember()"
                                class="inline-flex items-center px-4 py-2 border border-[#197b3b] text-[#197b3b] hover:bg-green-50 font-medium rounded-lg transition-colors">
                            <i class="fas fa-user-plus mr-2"></i>
                            Clear Form
                        </button>
                        <p class="text-xs text-gray-500 mt-2">Clear the form to add another member</p>
                    </div>
                </div>
            </form>
        </div>
        
        <!-- Buttons at Bottom -->
        <div class="flex-shrink-0 pt-4 mt-4 border-t border-gray-200">
            <div class="flex justify-end space-x-3">
                <button type="button"
                        onclick="closeAddMemberModal()"
                        class="px-6 py-3 border border-gray-300 text-gray-700 hover:bg-gray-50 font-medium rounded-lg transition-colors">
                    Cancel
                </button>
                <button type="submit"
                        form="addMemberForm"
                        class="px-6 py-3 bg-[#197b3b] hover:bg-green-800 text-white font-semibold rounded-lg shadow-md transition-colors">
                    <i class="fas fa-user-plus mr-2"></i>
                    Add Member
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Member Modal -->
<div id="editMemberModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
    <div class="relative top-4 mx-auto p-5 border w-full max-w-2xl shadow-lg rounded-2xl bg-white max-h-[90vh] flex flex-col">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-xl font-bold text-gray-900">Edit Member Details</h3>
            <button onclick="closeEditMemberModal()" class="text-gray-400 hover:text-gray-600">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>
        
        <!-- Scrollable Content Area -->
        <div class="flex-grow overflow-y-auto pr-2 mb-4">
            <form id="editMemberForm" method="POST">
                @csrf
                @method('PUT')
                
                <div class="space-y-6">
                    <!-- Member Info Display -->
                    <div class="p-4 bg-gradient-to-r from-blue-50 to-blue-100 border border-blue-200 rounded-lg">
                        <div class="flex items-center">
                            <div class="w-12 h-12 rounded-full bg-gradient-to-br from-blue-600 to-blue-700 flex items-center justify-center mr-3">
                                <span class="text-white font-bold text-sm" id="edit_member_initials"></span>
                            </div>
                            <div>
                                <div class="font-bold text-gray-900" id="edit_member_name"></div>
                                <div class="text-sm text-gray-600" id="edit_member_email"></div>
                                <div class="text-xs text-gray-500" id="edit_member_phone"></div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Role Selection -->
                    <div>
                        <label for="edit_role" class="block text-sm font-medium text-gray-700 mb-2">
                            Role in Ministry *
                        </label>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-2 mb-3">
                            <button type="button" onclick="setEditRole('Member')" class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 text-gray-700 transition-colors hover:border-[#197b3b] hover:text-[#197b3b]">Member</button>
                            <button type="button" onclick="setEditRole('Leader')" class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 text-gray-700 transition-colors hover:border-purple-600 hover:text-purple-600">Leader</button>
                            <button type="button" onclick="setEditRole('Coordinator')" class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 text-gray-700 transition-colors hover:border-blue-600 hover:text-blue-600">Coordinator</button>
                            <button type="button" onclick="setEditRole('Volunteer')" class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 text-gray-700 transition-colors hover:border-orange-600 hover:text-orange-600">Volunteer</button>
                        </div>
                        <input type="text" 
                               name="role" 
                               id="edit_role"
                               required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#197b3b] focus:border-[#197b3b] transition-colors text-black"
                               placeholder="Enter role...">
                    </div>
                    
                    <!-- Joined Date -->
                    <div>
                        <label for="edit_joined_at" class="block text-sm font-medium text-gray-700 mb-2">
                            Joined Date
                        </label>
                        <input type="date" 
                               name="joined_at" 
                               id="edit_joined_at"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#197b3b] focus:border-[#197b3b] transition-colors text-black">
                    </div>
                    
                    <!-- Status -->
                    <div class="flex items-center justify-between p-4 bg-gray-50 border border-gray-200 rounded-lg">
                        <div>
                            <label class="text-sm font-medium text-gray-700">
                                Member Status
                            </label>
                            <p class="text-xs text-gray-500">Active members appear in ministry listings</p>
                        </div>
                        <div class="flex items-center space-x-3">
                            <div class="relative inline-block w-12 align-middle select-none">
                                <input type="checkbox" 
                                       name="is_active" 
                                       id="edit_is_active"
                                       value="1"
                                       class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer"
                                       onchange="updateToggleState()">
                                <label for="edit_is_active" class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer"></label>
                            </div>
                            <span class="text-sm font-medium text-gray-700" id="statusLabel">Active</span>
                        </div>
                    </div>
                    
                    <!-- Notes -->
                    <div>
                        <label for="edit_notes" class="block text-sm font-medium text-gray-700 mb-2">
                            Notes <span class="text-gray-400 font-normal">(Optional)</span>
                        </label>
                        <textarea name="notes" 
                                  id="edit_notes" 
                                  rows="3"
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#197b3b] focus:border-[#197b3b] transition-colors text-black"
                                  placeholder="Add any notes about this member's participation..."></textarea>
                    </div>
                    
                    <!-- Member History -->
                    <div class="border-t border-gray-200 pt-4">
                        <h4 class="text-sm font-medium text-gray-700 mb-2">Member History</h4>
                        <div class="text-sm text-gray-600">
                            <div class="flex justify-between mb-1">
                                <span>Added to ministry:</span>
                                <span id="edit_created_at"></span>
                            </div>
                            <div class="flex justify-between">
                                <span>Last updated:</span>
                                <span id="edit_updated_at"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        
        <!-- Buttons at Bottom -->
        <div class="flex-shrink-0 pt-4 mt-4 border-t border-gray-200">
            <div class="flex justify-end space-x-3">
                <button type="button"
                        onclick="closeEditMemberModal()"
                        class="px-6 py-3 border border-gray-300 text-gray-700 hover:bg-gray-50 font-medium rounded-lg transition-colors">
                    Cancel
                </button>
                <button type="submit"
                        form="editMemberForm"
                        class="px-6 py-3 bg-[#197b3b] hover:bg-green-800 text-white font-semibold rounded-lg shadow-md transition-colors">
                    <i class="fas fa-save mr-2"></i>
                    Save Changes
                </button>
            </div>
        </div>
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

// Edit Member Modal Functions
function openEditMemberModal(ministryMemberId, memberData) {
    try {
        // Parse the JSON data
        const data = JSON.parse(decodeURIComponent(memberData));
        
        // Set form action
        document.getElementById('editMemberForm').action = `/admin/ministries/{{ $ministry->id }}/update-role/${ministryMemberId}`;
        
        // Set member info
        document.getElementById('edit_member_name').textContent = data.memberName;
        document.getElementById('edit_member_email').textContent = data.memberEmail || 'No email';
        document.getElementById('edit_member_phone').textContent = data.memberPhone || 'No phone';
        
        // Set member initials
        const firstName = data.memberName.split(' ')[0] || 'M';
        document.getElementById('edit_member_initials').textContent = firstName.charAt(0).toUpperCase();
        
        // Set form values
        document.getElementById('edit_role').value = data.role || 'Member';
        
        if (data.joinedAt) {
            const date = new Date(data.joinedAt);
            const formattedDate = date.toISOString().split('T')[0];
            document.getElementById('edit_joined_at').value = formattedDate;
        } else {
            document.getElementById('edit_joined_at').value = '';
        }
        
        const isActive = data.isActive === true || data.isActive === 'true' || data.isActive === 1;
        document.getElementById('edit_is_active').checked = isActive;
        updateToggleState();
        
        document.getElementById('edit_notes').value = data.notes || '';
        
        // Set history dates
        if (data.createdAt) {
            const createdDate = new Date(data.createdAt);
            document.getElementById('edit_created_at').textContent = createdDate.toLocaleDateString('en-US', { 
                year: 'numeric', 
                month: 'short', 
                day: 'numeric' 
            });
        } else {
            document.getElementById('edit_created_at').textContent = 'N/A';
        }
        
        if (data.updatedAt) {
            const updatedDate = new Date(data.updatedAt);
            document.getElementById('edit_updated_at').textContent = updatedDate.toLocaleDateString('en-US', { 
                year: 'numeric', 
                month: 'short', 
                day: 'numeric' 
            });
        } else {
            document.getElementById('edit_updated_at').textContent = 'N/A';
        }
        
        // Show modal
        document.getElementById('editMemberModal').classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    } catch (error) {
        console.error('Error opening edit modal:', error);
        alert('Error loading member data. Please try again.');
    }
}

function closeEditMemberModal() {
    document.getElementById('editMemberModal').classList.add('hidden');
    document.body.classList.remove('overflow-hidden');
}

function setRole(role) {
    document.getElementById('role').value = role;
}

function setEditRole(role) {
    document.getElementById('edit_role').value = role;
}

function updateToggleState() {
    const toggle = document.getElementById('edit_is_active');
    const label = document.getElementById('statusLabel');
    const toggleLabel = document.querySelector('.toggle-label');
    
    if (toggle.checked) {
        label.textContent = 'Active';
        label.classList.remove('text-gray-500');
        label.classList.add('text-green-600');
        if (toggleLabel) {
            toggleLabel.classList.remove('bg-gray-300');
            toggleLabel.classList.add('bg-[#197b3b]');
        }
    } else {
        label.textContent = 'Inactive';
        label.classList.remove('text-green-600');
        label.classList.add('text-gray-500');
        if (toggleLabel) {
            toggleLabel.classList.remove('bg-[#197b3b]');
            toggleLabel.classList.add('bg-gray-300');
        }
    }
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
    
    // Initialize toggle state
    updateToggleState();
});

function clearSelectedMember() {
    document.getElementById('selectedMemberId').value = '';
    document.getElementById('selectedMember').classList.add('hidden');
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
    
    console.log('Form submitted - Debugging info:');
    console.log('Member ID:', memberId);
    console.log('Role:', role);
    
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
    
    // Show loading indicator
    const submitBtn = document.querySelector('[form="addMemberForm"]');
    if (submitBtn) {
        const originalText = submitBtn.innerHTML;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Adding...';
        submitBtn.disabled = true;
    }
    
    return true;
});

document.getElementById('editMemberForm')?.addEventListener('submit', function(e) {
    const role = document.getElementById('edit_role').value;
    
    if (!role.trim()) {
        e.preventDefault();
        alert('Please enter a role for the member.');
        document.getElementById('edit_role').focus();
        return false;
    }
    
    // Show loading indicator
    const submitBtn = document.querySelector('[form="editMemberForm"]');
    if (submitBtn) {
        const originalText = submitBtn.innerHTML;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Saving...';
        submitBtn.disabled = true;
    }
    
    return true;
});

// Add Another Member function
function addAnotherMember() {
    // Clear the form but keep the modal open
    document.getElementById('selectedMemberId').value = '';
    document.getElementById('selectedMember').classList.add('hidden');
    document.getElementById('memberSearch').value = '';
    document.getElementById('role').value = '';
    document.getElementById('joined_at').value = '{{ date('Y-m-d') }}';
    
    // Focus on the search input
    document.getElementById('memberSearch').focus();
    
    // Show a success message
    const addAnotherBtn = document.querySelector('[onclick="addAnotherMember()"]');
    if (addAnotherBtn) {
        const originalText = addAnotherBtn.innerHTML;
        addAnotherBtn.innerHTML = '<i class="fas fa-check mr-2"></i>Form cleared';
        addAnotherBtn.classList.remove('border-[#197b3b]', 'text-[#197b3b]');
        addAnotherBtn.classList.add('border-green-600', 'text-green-600');
        
        setTimeout(() => {
            addAnotherBtn.innerHTML = originalText;
            addAnotherBtn.classList.remove('border-green-600', 'text-green-600');
            addAnotherBtn.classList.add('border-[#197b3b]', 'text-[#197b3b]');
        }, 2000);
    }
}

// Close modals on Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeAddMemberModal();
        closeEditMemberModal();
    }
});

// Close modals when clicking outside
const modals = document.querySelectorAll('.fixed.inset-0');
modals.forEach(modal => {
    modal.addEventListener('click', function(e) {
        if (e.target === this) {
            if (this.id === 'editMemberModal') {
                closeEditMemberModal();
            } else if (this.id === 'addMemberModal') {
                closeAddMemberModal();
            }
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

/* Toggle Switch Styles for Edit Modal */
.toggle-checkbox:checked {
    transform: translateX(1.5rem);
    border-color: #197b3b;
}

.toggle-checkbox:checked + .toggle-label {
    background-color: #197b3b;
}

.toggle-checkbox {
    left: -1.5rem;
    transition: all 0.3s ease;
}

.toggle-label {
    transition: all 0.3s ease;
}
</style>
@endsection