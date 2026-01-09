@extends('admin.layouts.app')

@section('title', 'Member Details - ' . ($member->user->name ?? $member->first_name . ' ' . $member->last_name))

@section('content')
<div class="container mx-auto px-4 py-8">
     
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
        <div>
            <div class="flex items-center space-x-2">
                <a href="{{ route('admin.members.index') }}" 
                   class="text-[#197b3b] hover:text-black">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <h1 class="text-2xl font-bold text-white">Member Details</h1>
            </div>
            <p class="text-gray-600 mt-1">View detailed information about this member</p>
        </div>
        <div class="flex space-x-2 mt-4 md:mt-0">
            <a href="{{ route('admin.members.edit', $member) }}" 
               class="inline-flex items-center px-4 py-2 bg-[#197b3b] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-black focus:bg-black active:bg-[#0d5d2a] focus:outline-none focus:ring-2 focus:ring-[#197b3b] focus:ring-offset-2 transition ease-in-out duration-150">
                <i class="fas fa-edit mr-2"></i> Edit Member
            </a>
            @if($member->user && $member->user->id !== auth()->id())
                <form action="{{ route('admin.members.destroy', $member) }}" method="POST"
                      onsubmit="return confirm('Are you sure you want to delete this member? This action cannot be undone.')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-800 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        <i class="fas fa-trash mr-2"></i> Delete Member
                    </button>
                </form>
            @endif
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Left Column - Member Profile -->
        <div class="lg:col-span-1">
            <!-- Profile Card -->
            <div class="bg-white shadow-lg rounded-lg overflow-hidden border border-gray-200">
                <div class="bg-gradient-to-r from-[#197b3b] to-black h-20"></div>
                <div class="px-6 py-4 -mt-12">
                    <!-- Avatar -->
                    <div class="flex justify-center">
                        <div class="h-24 w-24 rounded-full bg-[#197b3b] flex items-center justify-center text-white text-2xl font-bold border-4 border-white shadow-lg">
                            @if($member->photo)
                                <img src="{{ asset('storage/' . $member->photo) }}" 
                                     alt="{{ $member->first_name }}" 
                                     class="h-24 w-24 rounded-full object-cover border-4 border-white">
                            @else
                                {{ strtoupper(substr($member->first_name, 0, 1)) }}{{ strtoupper(substr($member->last_name, 0, 1)) }}
                            @endif
                        </div>
                    </div>
                    
                    <!-- Member Info -->
                    <div class="text-center mt-4">
                        <h2 class="text-xl font-bold text-black">
                            {{ $member->first_name }} {{ $member->last_name }}
                        </h2>
                        <p class="text-gray-600">{{ $member->email ?? ($member->user->email ?? 'No email') }}</p>
                        
                        <!-- Role Badge -->
                        <div class="mt-2">
                            @if($member->user)
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium 
                                    {{ $member->user->role === 'admin' ? 'bg-black text-white' : 'bg-[#197b3b] text-white' }}">
                                    <i class="fas fa-user-shield mr-1"></i>
                                    {{ ucfirst($member->user->role) }}
                                </span>
                            @endif
                        </div>

                        <!-- Member Status -->
                        <div class="mt-2">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium 
                                {{ $member->is_active ? 'bg-[#e8f5e9] text-[#197b3b] border border-[#c8e6c9]' : 'bg-gray-100 text-gray-800 border border-gray-300' }}">
                                <i class="fas fa-user mr-1"></i>
                                {{ $member->is_active ? 'Active Member' : 'Inactive Member' }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Quick Stats -->
                <div class="border-t border-gray-200 px-6 py-4">
                    <div class="grid grid-cols-2 gap-4 text-center">
                        <div>
                            <div class="text-2xl font-bold text-black">
                                @if($member->date_of_birth)
                                    {{ \Carbon\Carbon::parse($member->date_of_birth)->age }}
                                @else
                                    N/A
                                @endif
                            </div>
                            <div class="text-sm text-gray-600">Age</div>
                        </div>
                        <div>
                            <div class="text-2xl font-bold text-black">
                                @if($member->joined_at)
                                    {{ $member->joined_at->format('M Y') }}
                                @else
                                    {{ $member->created_at->format('M Y') }}
                                @endif
                            </div>
                            <div class="text-sm text-gray-600">Joined</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Account Information -->
            <div class="bg-white shadow-lg rounded-lg mt-6 border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-black">Member Information</h3>
                </div>
                <div class="p-6">
                    <dl class="space-y-4">
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Member ID</dt>
                            <dd class="text-sm text-black font-medium">{{ $member->id }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Membership Number</dt>
                            <dd class="text-sm text-black font-medium">{{ $member->membership_number ?? 'Not assigned' }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">User Account</dt>
                            <dd class="text-sm">
                                @if($member->user)
                                    <span class="text-[#197b3b] font-medium">
                                        <i class="fas fa-check-circle mr-1"></i>
                                        Linked (ID: {{ $member->user->id }})
                                    </span>
                                @else
                                    <span class="text-yellow-600 font-medium">
                                        <i class="fas fa-exclamation-triangle mr-1"></i>
                                        No User Account
                                    </span>
                                @endif
                            </dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Created</dt>
                            <dd class="text-sm text-black font-medium">
                                {{ $member->created_at->format('M j, Y \a\t g:i A') }}
                            </dd>
                        </div>
                    </dl>
                </div>
            </div>
        </div>

        <!-- Right Column - Member Details -->
        <div class="lg:col-span-2">
            <!-- Personal Information -->
            <div class="bg-white shadow-lg rounded-lg border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-black">Personal Information</h3>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Basic Info -->
                        <div>
                            <h4 class="text-md font-semibold text-black mb-4">Basic Information</h4>
                            <dl class="space-y-3">
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Full Name</dt>
                                    <dd class="text-sm text-black font-medium">
                                        {{ $member->first_name }} {{ $member->last_name }}
                                    </dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Email Address</dt>
                                    <dd class="text-sm text-black font-medium">{{ $member->email ?? 'Not provided' }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Phone Number</dt>
                                    <dd class="text-sm text-black font-medium">{{ $member->phone ?? 'Not provided' }}</dd>
                                </div>
                                @if($member->user)
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">User Role</dt>
                                    <dd class="text-sm">
                                        <span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium 
                                            {{ $member->user->role === 'admin' ? 'bg-black text-white' : 'bg-[#197b3b] text-white' }}">
                                            {{ ucfirst($member->user->role) }}
                                        </span>
                                    </dd>
                                </div>
                                @endif
                            </dl>
                        </div>

                        <!-- Member Details -->
                        <div>
                            <h4 class="text-md font-semibold text-black mb-4">Member Details</h4>
                            <dl class="space-y-3">
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Date of Birth</dt>
                                    <dd class="text-sm text-black font-medium">
                                        @if($member->date_of_birth)
                                            {{ \Carbon\Carbon::parse($member->date_of_birth)->format('F j, Y') }}
                                            <span class="text-gray-500">({{ \Carbon\Carbon::parse($member->date_of_birth)->age }} years old)</span>
                                        @else
                                            Not provided
                                        @endif
                                    </dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Gender</dt>
                                    <dd class="text-sm text-black font-medium">{{ $member->gender ?? 'Not provided' }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Marital Status</dt>
                                    <dd class="text-sm text-black font-medium">{{ $member->marital_status ?? 'Not provided' }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Membership Date</dt>
                                    <dd class="text-sm text-black font-medium">
                                        @if($member->membership_date)
                                            {{ \Carbon\Carbon::parse($member->membership_date)->format('F j, Y') }}
                                        @else
                                            Not provided
                                        @endif
                                    </dd>
                                </div>
                            </dl>
                        </div>
                    </div>

                    <!-- Additional Information -->
                    @if($member->address || $member->home_congregation || $member->emergency_contact_name)
                    <div class="mt-6 pt-6 border-t border-gray-200">
                        <h4 class="text-md font-semibold text-black mb-4">Additional Information</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @if($member->address)
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Address</dt>
                                <dd class="text-sm text-black font-medium mt-1">{{ $member->address }}</dd>
                            </div>
                            @endif
                            
                            @if($member->home_congregation)
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Home Congregation</dt>
                                <dd class="text-sm text-black font-medium mt-1">{{ $member->home_congregation }}</dd>
                            </div>
                            @endif
                            
                            @if($member->emergency_contact_name)
                            <div class="md:col-span-2">
                                <dt class="text-sm font-medium text-gray-500">Emergency Contact</dt>
                                <dd class="text-sm text-black font-medium mt-1">
                                    {{ $member->emergency_contact_name }}
                                    @if($member->emergency_contact_phone)
                                        <br><span class="text-gray-600">{{ $member->emergency_contact_phone }}</span>
                                    @endif
                                </dd>
                            </div>
                            @endif
                        </div>
                    </div>
                    @endif

                    <!-- Religious Information -->
                    @if($member->baptism_date || $member->confirmation_date || $member->parish)
                    <div class="mt-6 pt-6 border-t border-gray-200">
                        <h4 class="text-md font-semibold text-black mb-4">Religious Information</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @if($member->baptism_date)
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Baptism Date</dt>
                                <dd class="text-sm text-black font-medium mt-1">
                                    {{ \Carbon\Carbon::parse($member->baptism_date)->format('F j, Y') }}
                                </dd>
                            </div>
                            @endif
                            
                            @if($member->confirmation_date)
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Confirmation Date</dt>
                                <dd class="text-sm text-black font-medium mt-1">
                                    {{ \Carbon\Carbon::parse($member->confirmation_date)->format('F j, Y') }}
                                </dd>
                            </div>
                            @endif
                            
                            @if($member->parish)
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Parish</dt>
                                <dd class="text-sm text-black font-medium mt-1">{{ $member->parish->name }}</dd>
                            </div>
                            @endif
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white shadow-lg rounded-lg mt-6 border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-black">Quick Actions</h3>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @if($member->email)
                        <a href="mailto:{{ $member->email }}" 
                           class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors hover:border-[#197b3b]">
                            <i class="fas fa-envelope text-[#197b3b] text-xl mr-3"></i>
                            <div>
                                <div class="font-medium text-black">Send Email</div>
                                <div class="text-sm text-gray-600">Contact this member</div>
                            </div>
                        </a>
                        @endif
                        
                        <a href="{{ route('admin.members.edit', $member) }}" 
                           class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors hover:border-[#197b3b]">
                            <i class="fas fa-user-edit text-[#197b3b] text-xl mr-3"></i>
                            <div>
                                <div class="font-medium text-black">Edit Profile</div>
                                <div class="text-sm text-gray-600">Update member information</div>
                            </div>
                        </a>

                        
                        
                        @if($member->user)
                        <a href="#" 
                           class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors hover:border-[#197b3b]">
                            <i class="fas fa-history text-[#197b3b] text-xl mr-3"></i>
                            <div>
                                <div class="font-medium text-black">User Account</div>
                                <div class="text-sm text-gray-600">View user details</div>
                            </div>
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection