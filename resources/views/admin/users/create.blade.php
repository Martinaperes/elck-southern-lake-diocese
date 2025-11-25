@extends('admin.layouts.app')

@section('title', 'Add New User')

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
                <h1 class="text-2xl font-bold text-gray-900">Add New User</h1>
            </div>
            <p class="text-gray-600 mt-1">Create a new user account</p>
        </div>
        <div class="flex space-x-2 mt-4 md:mt-0">
            <a href="{{ route('admin.users.index') }}" 
               class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                <i class="fas fa-users mr-2"></i> View All Users
            </a>
        </div>
    </div>

    <!-- Create Form -->
    <div class="max-w-4xl mx-auto">
        <form action="{{ route('admin.users.store') }}" method="POST">
            @csrf
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Left Column - Basic Information -->
                <div class="lg:col-span-2">
                    <!-- Basic Information Card -->
                    <div class="bg-white shadow-lg rounded-lg">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-900">Basic Information</h3>
                            <p class="text-sm text-gray-600 mt-1">Fill in the basic account details</p>
                        </div>
                        <div class="p-6 space-y-6">
                            <!-- Name -->
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                    Full Name <span class="text-red-500">*</span>
                                </label>
                                <input type="text" 
                                       name="name" 
                                       id="name"
                                       value="{{ old('name') }}"
                                       required
                                       placeholder="Enter full name"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('name') border-red-500 @enderror">
                                @error('name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                    Email Address <span class="text-red-500">*</span>
                                </label>
                                <input type="email" 
                                       name="email" 
                                       id="email"
                                       value="{{ old('email') }}"
                                       required
                                       placeholder="Enter email address"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('email') border-red-500 @enderror">
                                @error('email')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Role -->
                            <div>
                                <label for="role" class="block text-sm font-medium text-gray-700 mb-2">
                                    User Role <span class="text-red-500">*</span>
                                </label>
                                <select name="role" 
                                        id="role"
                                        required
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('role') border-red-500 @enderror">
                                    <option value="">Select Role</option>
                                    <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
                                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Administrator</option>
                                </select>
                                @error('role')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                                <p class="mt-1 text-sm text-gray-500">
                                    <i class="fas fa-info-circle mr-1"></i>
                                    Administrators have full access to the admin panel.
                                </p>
                            </div>

                            <!-- Password -->
                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                                    Password <span class="text-red-500">*</span>
                                </label>
                                <input type="password" 
                                       name="password" 
                                       id="password"
                                       required
                                       placeholder="Enter password"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('password') border-red-500 @enderror">
                                @error('password')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                                <p class="mt-1 text-sm text-gray-500">
                                    <i class="fas fa-shield-alt mr-1"></i>
                                    Password must be at least 8 characters long.
                                </p>
                            </div>

                            <!-- Confirm Password -->
                            <div>
                                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                                    Confirm Password <span class="text-red-500">*</span>
                                </label>
                                <input type="password" 
                                       name="password_confirmation" 
                                       id="password_confirmation"
                                       required
                                       placeholder="Confirm password"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            </div>
                        </div>
                    </div>

                    <!-- Member Information Card (Optional) -->
                    <div class="bg-white shadow-lg rounded-lg mt-6">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900">Member Information</h3>
                                    <p class="text-sm text-gray-600 mt-1">Optional: Add church member details</p>
                                </div>
                                <div class="flex items-center">
                                    <input type="checkbox" 
                                           name="create_member_profile" 
                                           id="create_member_profile"
                                           value="1"
                                           {{ old('create_member_profile') ? 'checked' : '' }}
                                           class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                    <label for="create_member_profile" class="ml-2 text-sm text-gray-700">
                                        Create Member Profile
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div id="member-fields" class="p-6 space-y-6 hidden">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- First Name -->
                                <div>
                                    <label for="first_name" class="block text-sm font-medium text-gray-700 mb-2">
                                        First Name
                                    </label>
                                    <input type="text" 
                                           name="first_name" 
                                           id="first_name"
                                           value="{{ old('first_name') }}"
                                           placeholder="First name"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                </div>

                                <!-- Last Name -->
                                <div>
                                    <label for="last_name" class="block text-sm font-medium text-gray-700 mb-2">
                                        Last Name
                                    </label>
                                    <input type="text" 
                                           name="last_name" 
                                           id="last_name"
                                           value="{{ old('last_name') }}"
                                           placeholder="Last name"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Phone -->
                                <div>
                                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">
                                        Phone Number
                                    </label>
                                    <input type="tel" 
                                           name="phone" 
                                           id="phone"
                                           value="{{ old('phone') }}"
                                           placeholder="Phone number"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                </div>

                                <!-- Gender -->
                                <div>
                                    <label for="gender" class="block text-sm font-medium text-gray-700 mb-2">
                                        Gender
                                    </label>
                                    <select name="gender" 
                                            id="gender"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                        <option value="">Select Gender</option>
                                        <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                                        <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                                        <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Other</option>
                                    </select>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Date of Birth -->
                                <div>
                                    <label for="date_of_birth" class="block text-sm font-medium text-gray-700 mb-2">
                                        Date of Birth
                                    </label>
                                    <input type="date" 
                                           name="date_of_birth" 
                                           id="date_of_birth"
                                           value="{{ old('date_of_birth') }}"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                </div>

                                <!-- Marital Status -->
                                <div>
                                    <label for="marital_status" class="block text-sm font-medium text-gray-700 mb-2">
                                        Marital Status
                                    </label>
                                    <select name="marital_status" 
                                            id="marital_status"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                        <option value="">Select Status</option>
                                        <option value="single" {{ old('marital_status') == 'single' ? 'selected' : '' }}>Single</option>
                                        <option value="married" {{ old('marital_status') == 'married' ? 'selected' : '' }}>Married</option>
                                        <option value="divorced" {{ old('marital_status') == 'divorced' ? 'selected' : '' }}>Divorced</option>
                                        <option value="widowed" {{ old('marital_status') == 'widowed' ? 'selected' : '' }}>Widowed</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Address -->
                            <div>
                                <label for="address" class="block text-sm font-medium text-gray-700 mb-2">
                                    Address
                                </label>
                                <textarea name="address" 
                                          id="address"
                                          rows="3"
                                          placeholder="Full address"
                                          class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ old('address') }}</textarea>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Occupation -->
                                <div>
                                    <label for="occupation" class="block text-sm font-medium text-gray-700 mb-2">
                                        Occupation
                                    </label>
                                    <input type="text" 
                                           name="occupation" 
                                           id="occupation"
                                           value="{{ old('occupation') }}"
                                           placeholder="Occupation"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                </div>

                                <!-- Emergency Contact -->
                                <div>
                                    <label for="emergency_contact" class="block text-sm font-medium text-gray-700 mb-2">
                                        Emergency Contact
                                    </label>
                                    <input type="text" 
                                           name="emergency_contact" 
                                           id="emergency_contact"
                                           value="{{ old('emergency_contact') }}"
                                           placeholder="Emergency contact details"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Membership Date -->
                                <div>
                                    <label for="membership_date" class="block text-sm font-medium text-gray-700 mb-2">
                                        Membership Date
                                    </label>
                                    <input type="date" 
                                           name="membership_date" 
                                           id="membership_date"
                                           value="{{ old('membership_date') }}"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                </div>

                                <!-- Baptism Date -->
                                <div>
                                    <label for="baptism_date" class="block text-sm font-medium text-gray-700 mb-2">
                                        Baptism Date
                                    </label>
                                    <input type="date" 
                                           name="baptism_date" 
                                           id="baptism_date"
                                           value="{{ old('baptism_date') }}"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column - Actions & Info -->
                <div class="lg:col-span-1">
                    <!-- Actions Card -->
                    <div class="bg-white shadow-lg rounded-lg sticky top-6">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-900">Create User</h3>
                        </div>
                        <div class="p-6 space-y-4">
                            <button type="submit" 
                                    class="w-full inline-flex justify-center items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                <i class="fas fa-user-plus mr-2"></i> Create User
                            </button>
                            
                            <a href="{{ route('admin.users.index') }}" 
                               class="w-full inline-flex justify-center items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                <i class="fas fa-times mr-2"></i> Cancel
                            </a>
                        </div>
                    </div>

                    <!-- Quick Tips Card -->
                    <div class="bg-white shadow-lg rounded-lg mt-6">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-900">Quick Tips</h3>
                        </div>
                        <div class="p-6">
                            <div class="space-y-4">
                                <div class="flex items-start space-x-3">
                                    <i class="fas fa-info-circle text-blue-500 mt-1"></i>
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">Required Fields</p>
                                        <p class="text-sm text-gray-600">Fields marked with <span class="text-red-500">*</span> are required.</p>
                                    </div>
                                </div>
                                <div class="flex items-start space-x-3">
                                    <i class="fas fa-user-shield text-purple-500 mt-1"></i>
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">Admin Access</p>
                                        <p class="text-sm text-gray-600">Only assign admin role to trusted users.</p>
                                    </div>
                                </div>
                                <div class="flex items-start space-x-3">
                                    <i class="fas fa-church text-green-500 mt-1"></i>
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">Member Profile</p>
                                        <p class="text-sm text-gray-600">Member profile is optional and can be added later.</p>
                                    </div>
                                </div>
                                <div class="flex items-start space-x-3">
                                    <i class="fas fa-envelope text-yellow-500 mt-1"></i>
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">Email Verification</p>
                                        <p class="text-sm text-gray-600">User will need to verify their email address.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Users Card -->
                    <div class="bg-white shadow-lg rounded-lg mt-6">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-900">Recent Users</h3>
                        </div>
                        <div class="p-6">
                            @php
                                $recentUsers = \App\Models\User::latest()->take(3)->get();
                            @endphp
                            @if($recentUsers->count() > 0)
                                <div class="space-y-3">
                                    @foreach($recentUsers as $recentUser)
                                        <div class="flex items-center space-x-3 p-2 rounded-lg hover:bg-gray-50">
                                            <div class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center text-white text-sm font-bold">
                                                {{ strtoupper(substr($recentUser->name, 0, 1)) }}
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <p class="text-sm font-medium text-gray-900 truncate">{{ $recentUser->name }}</p>
                                                <p class="text-xs text-gray-500">{{ $recentUser->email }}</p>
                                            </div>
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium 
                                                {{ $recentUser->role === 'admin' ? 'bg-purple-100 text-purple-800' : 'bg-green-100 text-green-800' }}">
                                                {{ ucfirst($recentUser->role) }}
                                            </span>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center py-4">
                                    <i class="fas fa-users text-gray-400 text-2xl mb-2"></i>
                                    <p class="text-sm text-gray-500">No users yet</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Toggle member fields
        const memberCheckbox = document.getElementById('create_member_profile');
        const memberFields = document.getElementById('member-fields');

        function toggleMemberFields() {
            if (memberCheckbox.checked) {
                memberFields.classList.remove('hidden');
            } else {
                memberFields.classList.add('hidden');
            }
        }

        memberCheckbox.addEventListener('change', toggleMemberFields);
        
        // Initialize on page load
        toggleMemberFields();

        // Password confirmation validation
        const password = document.getElementById('password');
        const confirmPassword = document.getElementById('password_confirmation');

        function validatePassword() {
            if (password.value !== confirmPassword.value) {
                confirmPassword.setCustomValidity("Passwords don't match");
            } else {
                confirmPassword.setCustomValidity('');
            }
        }

        password.addEventListener('change', validatePassword);
        confirmPassword.addEventListener('keyup', validatePassword);

        // Auto-format phone number
        const phoneInput = document.getElementById('phone');
        if (phoneInput) {
            phoneInput.addEventListener('input', function(e) {
                const x = e.target.value.replace(/\D/g, '').match(/(\d{0,3})(\d{0,3})(\d{0,4})/);
                e.target.value = !x[2] ? x[1] : '(' + x[1] + ') ' + x[2] + (x[3] ? '-' + x[3] : '');
            });
        }

        // Auto-fill member names from user name
        const nameInput = document.getElementById('name');
        const firstNameInput = document.getElementById('first_name');
        const lastNameInput = document.getElementById('last_name');

        nameInput.addEventListener('blur', function() {
            if (memberCheckbox.checked && nameInput.value && !firstNameInput.value) {
                const names = nameInput.value.split(' ');
                if (names.length >= 2) {
                    firstNameInput.value = names[0];
                    lastNameInput.value = names.slice(1).join(' ');
                }
            }
        });
    });
</script>
@endpush