@extends('admin.layouts.app')

@section('title', 'User Details - ' . $user->name)

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
        <div>
            <div class="flex items-center space-x-2">
                <a href="{{ route('admin.users.index') }}" 
                   class="text-blue-600 hover:text-blue-900">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <h1 class="text-2xl font-bold text-gray-900">User Details</h1>
            </div>
            <p class="text-gray-600 mt-1">View detailed information about this user</p>
        </div>
        <div class="flex space-x-2 mt-4 md:mt-0">
            <a href="{{ route('admin.users.edit', $user) }}" 
               class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-800 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                <i class="fas fa-edit mr-2"></i> Edit User
            </a>
            @if($user->id !== auth()->id())
                <form action="{{ route('admin.users.destroy', $user) }}" method="POST"
                      onsubmit="return confirm('Are you sure you want to delete this user? This action cannot be undone.')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-800 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        <i class="fas fa-trash mr-2"></i> Delete User
                    </button>
                </form>
            @endif
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Left Column - User Profile -->
        <div class="lg:col-span-1">
            <!-- Profile Card -->
            <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                <div class="bg-gradient-to-r from-blue-500 to-purple-600 h-20"></div>
                <div class="px-6 py-4 -mt-12">
                    <!-- Avatar -->
                    <div class="flex justify-center">
                        <div class="h-24 w-24 rounded-full bg-blue-600 flex items-center justify-center text-white text-2xl font-bold border-4 border-white shadow-lg">
                            @if($user->member && $user->member->photo)
                                <img src="{{ asset('storage/' . $user->member->photo) }}" 
                                     alt="{{ $user->name }}" 
                                     class="h-24 w-24 rounded-full object-cover border-4 border-white">
                            @else
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            @endif
                        </div>
                    </div>
                    
                    <!-- User Info -->
                    <div class="text-center mt-4">
                        <h2 class="text-xl font-bold text-gray-900">
                            @if($user->member)
                                {{ $user->member->first_name }} {{ $user->member->last_name }}
                            @else
                                {{ $user->name }}
                            @endif
                        </h2>
                        <p class="text-gray-600">{{ $user->email }}</p>
                        
                        <!-- Role Badge -->
                        <div class="mt-2">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium 
                                {{ $user->role === 'admin' ? 'bg-purple-100 text-purple-800' : 'bg-green-100 text-green-800' }}">
                                <i class="fas fa-user-shield mr-1"></i>
                                {{ ucfirst($user->role) }}
                            </span>
                        </div>

                        <!-- Member Status -->
                        <div class="mt-2">
                            @if($user->member)
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                    <i class="fas fa-check-circle mr-1"></i>
                                    Church Member
                                </span>
                            @else
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                                    <i class="fas fa-user mr-1"></i>
                                    Basic User
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Quick Stats -->
                <div class="border-t border-gray-200 px-6 py-4">
                    <div class="grid grid-cols-2 gap-4 text-center">
                        <div>
                           <div class="text-2xl font-bold text-gray-900">
    @if($user->member && $user->member->date_of_birth)
        {{ \Carbon\Carbon::parse($user->member->date_of_birth)->age }}
    @else
        N/A
    @endif
</div>
                            <div class="text-sm text-gray-600">Age</div>
                        </div>
                        <div>
                            <div class="text-2xl font-bold text-gray-900">
                                {{ $user->created_at->format('M Y') }}
                            </div>
                            <div class="text-sm text-gray-600">Joined</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Account Information -->
            <div class="bg-white shadow-lg rounded-lg mt-6">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Account Information</h3>
                </div>
                <div class="p-6">
                    <dl class="space-y-4">
                        <div>
                            <dt class="text-sm font-medium text-gray-500">User ID</dt>
                            <dd class="text-sm text-gray-900">{{ $user->id }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Email Verified</dt>
                            <dd class="text-sm">
                                @if($user->email_verified_at)
                                    <span class="text-green-600">
                                        <i class="fas fa-check-circle mr-1"></i>
                                        {{ $user->email_verified_at->format('M j, Y') }}
                                    </span>
                                @else
                                    <span class="text-red-600">
                                        <i class="fas fa-times-circle mr-1"></i>
                                        Not Verified
                                    </span>
                                @endif
                            </dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Last Login</dt>
                            <dd class="text-sm text-gray-900">
                                @if($user->last_login_at)
                                    {{ $user->last_login_at->diffForHumans() }}
                                @else
                                    <span class="text-gray-500">Never logged in</span>
                                @endif
                            </dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Member Profile</dt>
                            <dd class="text-sm">
                                @if($user->member)
                                    <span class="text-green-600">
                                        <i class="fas fa-check-circle mr-1"></i>
                                        Complete
                                    </span>
                                @else
                                    <span class="text-yellow-600">
                                        <i class="fas fa-exclamation-triangle mr-1"></i>
                                        Not Created
                                    </span>
                                @endif
                            </dd>
                        </div>
                    </dl>
                </div>
            </div>
        </div>

        <!-- Right Column - User Details & Activity -->
        <div class="lg:col-span-2">
            <!-- Personal Information -->
            <div class="bg-white shadow-lg rounded-lg">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">
                        @if($user->member)
                            Member Information
                        @else
                            Personal Information
                        @endif
                    </h3>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Basic Info -->
                        <div>
                            <h4 class="text-md font-semibold text-gray-700 mb-4">Basic Information</h4>
                            <dl class="space-y-3">
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Full Name</dt>
                                    <dd class="text-sm text-gray-900">
                                        @if($user->member)
                                            {{ $user->member->first_name }} {{ $user->member->last_name }}
                                        @else
                                            {{ $user->name }}
                                        @endif
                                    </dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Email Address</dt>
                                    <dd class="text-sm text-gray-900">{{ $user->email }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Account Role</dt>
                                    <dd class="text-sm">
                                        <span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium 
                                            {{ $user->role === 'admin' ? 'bg-purple-100 text-purple-800' : 'bg-green-100 text-green-800' }}">
                                            {{ ucfirst($user->role) }}
                                        </span>
                                    </dd>
                                </div>
                                @if($user->member)
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Phone Number</dt>
                                    <dd class="text-sm text-gray-900">{{ $user->member->phone ?? 'Not provided' }}</dd>
                                </div>
                                @endif
                            </dl>
                        </div>

                        <!-- Member Details -->
                        <div>
                            <h4 class="text-md font-semibold text-gray-700 mb-4">
                                @if($user->member)
                                    Member Details
                                @else
                                    Account Timeline
                                @endif
                            </h4>
                            
                            @if($user->member)
                                <dl class="space-y-3">
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500">Date of Birth</dt>
                                        <dd class="text-sm text-gray-900">
    @if($user->member->date_of_birth)
        {{ \Carbon\Carbon::parse($user->member->date_of_birth)->format('F j, Y') }}
        <span class="text-gray-500">({{ \Carbon\Carbon::parse($user->member->date_of_birth)->age }} years old)</span>
    @else
        Not provided
    @endif
</dd>
                                    </div>
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500">Gender</dt>
                                        <dd class="text-sm text-gray-900">{{ $user->member->gender ?? 'Not provided' }}</dd>
                                    </div>
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500">Marital Status</dt>
                                        <dd class="text-sm text-gray-900">{{ $user->member->marital_status ?? 'Not provided' }}</dd>
                                    </div>
                                    <div>
                                        <dd class="text-sm text-gray-900">
    @if($user->member->membership_date)
        {{ \Carbon\Carbon::parse($user->member->membership_date)->format('F j, Y') }}
    @else
        Not provided
    @endif
</dd>
                                    </div>
                                </dl>
                            @else
                                <!-- Account Timeline for non-members -->
                                <div class="space-y-3">
                                    <div class="flex items-start space-x-3">
                                        <div class="flex-shrink-0 w-2 h-2 bg-green-500 rounded-full mt-2"></div>
                                        <div>
                                            <p class="text-sm font-medium text-gray-900">Account Created</p>
                                            <p class="text-sm text-gray-500">{{ $user->created_at->format('F j, Y \a\t g:i A') }}</p>
                                            <p class="text-xs text-gray-400">{{ $user->created_at->diffForHumans() }}</p>
                                        </div>
                                    </div>
                                    
                                    @if($user->email_verified_at)
                                    <div class="flex items-start space-x-3">
                                        <div class="flex-shrink-0 w-2 h-2 bg-blue-500 rounded-full mt-2"></div>
                                        <div>
                                            <p class="text-sm font-medium text-gray-900">Email Verified</p>
                                            <p class="text-sm text-gray-500">{{ $user->email_verified_at->format('F j, Y \a\t g:i A') }}</p>
                                            <p class="text-xs text-gray-400">{{ $user->email_verified_at->diffForHumans() }}</p>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Additional Member Information -->
                    @if($user->member && ($user->member->address || $user->member->occupation || $user->member->emergency_contact))
                    <div class="mt-6 pt-6 border-t border-gray-200">
                        <h4 class="text-md font-semibold text-gray-700 mb-4">Additional Information</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @if($user->member->address)
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Address</dt>
                                <dd class="text-sm text-gray-900 mt-1">{{ $user->member->address }}</dd>
                            </div>
                            @endif
                            
                            @if($user->member->occupation)
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Occupation</dt>
                                <dd class="text-sm text-gray-900 mt-1">{{ $user->member->occupation }}</dd>
                            </div>
                            @endif
                            
                            @if($user->member->emergency_contact)
                            <div class="md:col-span-2">
                                <dt class="text-sm font-medium text-gray-500">Emergency Contact</dt>
                                <dd class="text-sm text-gray-900 mt-1">{{ $user->member->emergency_contact }}</dd>
                            </div>
                            @endif
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white shadow-lg rounded-lg mt-6">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Quick Actions</h3>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <a href="mailto:{{ $user->email }}" 
                           class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                            <i class="fas fa-envelope text-blue-600 text-xl mr-3"></i>
                            <div>
                                <div class="font-medium text-gray-900">Send Email</div>
                                <div class="text-sm text-gray-600">Contact this user</div>
                            </div>
                        </a>
                        
                        <a href="{{ route('admin.users.edit', $user) }}" 
                           class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                            <i class="fas fa-user-edit text-green-600 text-xl mr-3"></i>
                            <div>
                                <div class="font-medium text-gray-900">Edit Profile</div>
                                <div class="text-sm text-gray-600">Update user information</div>
                            </div>
                        </a>

                        @if($user->member)
                        <a href="#" 
                           class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                            <i class="fas fa-file-pdf text-red-600 text-xl mr-3"></i>
                            <div>
                                <div class="font-medium text-gray-900">Member Report</div>
                                <div class="text-sm text-gray-600">Generate member profile</div>
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