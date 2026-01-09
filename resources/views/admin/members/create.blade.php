@extends('admin.layouts.app')

@section('title', 'Add New Member')

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
                <h1 class="text-2xl font-bold text-black">Add New Member</h1>
            </div>
            <p class="text-gray-600 mt-1">Create a new member with user account for church access</p>
        </div>
        <div class="mt-4 md:mt-0">
            <a href="{{ route('admin.members.index') }}" 
               class="inline-flex items-center px-4 py-2 bg-gray-200 border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 focus:bg-gray-300 active:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                <i class="fas fa-list mr-2"></i> View All Members
            </a>
        </div>
    </div>

    <!-- Create Form -->
    <div class="bg-white shadow-lg rounded-lg border border-gray-200 overflow-hidden">
        <form action="{{ route('admin.members.store') }}" method="POST">
            @csrf
            
            <div class="p-6">
                <!-- Form Validation Errors -->
                @if ($errors->any())
                    <div class="mb-6 p-4 bg-red-50 border border-red-300 rounded">
                        <h3 class="font-bold text-red-800">Please fix the following errors:</h3>
                        <ul class="mt-2 list-disc list-inside text-red-600">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Success Message (for redirects) -->
                @if (session('success'))
                    <div class="mb-6 p-4 bg-green-50 border border-green-300 rounded">
                        <p class="text-green-800">{{ session('success') }}</p>
                    </div>
                @endif

                <!-- User Account Section -->
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-black mb-4 pb-2 border-b border-gray-200">
                        <i class="fas fa-user-circle mr-2 text-[#197b3b]"></i> User Account
                    </h3>
                    <p class="text-gray-600 mb-4 text-sm">This creates login credentials for the member</p>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Display Name -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                                Display Name <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   name="name" 
                                   id="name"
                                   value="{{ old('name') }}"
                                   required
                                   placeholder="e.g., John Doe"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-[#197b3b] focus:border-[#197b3b] text-black">
                            <p class="mt-1 text-xs text-gray-500">Shown on the website and in emails</p>
                        </div>
                        
                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">
                                Email Address <span class="text-red-500">*</span>
                            </label>
                            <input type="email" 
                                   name="email" 
                                   id="email"
                                   value="{{ old('email') }}"
                                   required
                                   placeholder="member@example.com"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-[#197b3b] focus:border-[#197b3b] text-black">
                            <p class="mt-1 text-xs text-gray-500">Used for login and notifications</p>
                        </div>
                        
                        <!-- Password -->
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">
                                Password <span class="text-red-500">*</span>
                            </label>
                            <input type="password" 
                                   name="password" 
                                   id="password"
                                   required
                                   placeholder="Minimum 8 characters"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-[#197b3b] focus:border-[#197b3b] text-black">
                            <p class="mt-1 text-xs text-gray-500">Create a secure password</p>
                        </div>
                        
                        <!-- Confirm Password -->
                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">
                                Confirm Password <span class="text-red-500">*</span>
                            </label>
                            <input type="password" 
                                   name="password_confirmation" 
                                   id="password_confirmation"
                                   required
                                   placeholder="Repeat the password"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-[#197b3b] focus:border-[#197b3b] text-black">
                        </div>
                        
                        <!-- User Role -->
                        <div>
                            <label for="role" class="block text-sm font-medium text-gray-700 mb-1">
                                User Role <span class="text-red-500">*</span>
                            </label>
                            <select name="role" 
                                    id="role"
                                    required
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-[#197b3b] focus:border-[#197b3b] text-black">
                                <option value="">Select Role</option>
                                <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>Member</option>
                                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Administrator</option>
                                <option value="pastor" {{ old('role') == 'pastor' ? 'selected' : '' }}>Pastor</option>
                                <option value="secretary" {{ old('role') == 'secretary' ? 'selected' : '' }}>Secretary</option>
                                <option value="treasurer" {{ old('role') == 'treasurer' ? 'selected' : '' }}>Treasurer</option>
                                <option value="deacon" {{ old('role') == 'deacon' ? 'selected' : '' }}>Deacon</option>
                            </select>
                            <p class="mt-1 text-xs text-gray-500">
                                <span class="font-medium">Member:</span> Basic access • 
                                <span class="font-medium">Admin:</span> Full system access
                            </p>
                        </div>
                        
                        <!-- Parish (for user) -->
                        <div>
                            <label for="parish_id" class="block text-sm font-medium text-gray-700 mb-1">
                                Default Parish
                            </label>
                            <select name="parish_id" 
                                    id="parish_id"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-[#197b3b] focus:border-[#197b3b] text-black">
                                <option value="">Select Parish (Optional)</option>
                                @foreach($parishes as $parish)
                                    <option value="{{ $parish->id }}" {{ old('parish_id') == $parish->id ? 'selected' : '' }}>
                                        {{ $parish->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Member Profile Section -->
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-black mb-4 pb-2 border-b border-gray-200">
                        <i class="fas fa-id-card mr-2 text-[#197b3b]"></i> Member Profile
                    </h3>
                    <p class="text-gray-600 mb-4 text-sm">Additional information for church records</p>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- First Name -->
                        <div>
                            <label for="first_name" class="block text-sm font-medium text-gray-700 mb-1">
                                First Name <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   name="first_name" 
                                   id="first_name"
                                   value="{{ old('first_name') }}"
                                   required
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-[#197b3b] focus:border-[#197b3b] text-black">
                        </div>
                        
                        <!-- Last Name -->
                        <div>
                            <label for="last_name" class="block text-sm font-medium text-gray-700 mb-1">
                                Last Name <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   name="last_name" 
                                   id="last_name"
                                   value="{{ old('last_name') }}"
                                   required
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-[#197b3b] focus:border-[#197b3b] text-black">
                        </div>
                        
                        <!-- Phone -->
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">
                                Phone Number
                            </label>
                            <input type="text" 
                                   name="phone" 
                                   id="phone"
                                   value="{{ old('phone') }}"
                                   placeholder="+1 (555) 123-4567"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-[#197b3b] focus:border-[#197b3b] text-black">
                        </div>
                        
                        <!-- Date of Birth -->
                        <div>
                            <label for="date_of_birth" class="block text-sm font-medium text-gray-700 mb-1">
                                Date of Birth
                            </label>
                            <input type="date" 
                                   name="date_of_birth" 
                                   id="date_of_birth"
                                   value="{{ old('date_of_birth') }}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-[#197b3b] focus:border-[#197b3b] text-black">
                        </div>
                        
                        <!-- Gender -->
                        <div>
                            <label for="gender" class="block text-sm font-medium text-gray-700 mb-1">
                                Gender
                            </label>
                            <select name="gender" 
                                    id="gender"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-[#197b3b] focus:border-[#197b3b] text-black">
                                <option value="">Select Gender</option>
                                <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                                <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                                <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Other</option>
                            </select>
                        </div>
                        
                        <!-- Marital Status -->
                        <div>
                            <label for="marital_status" class="block text-sm font-medium text-gray-700 mb-1">
                                Marital Status
                            </label>
                            <select name="marital_status" 
                                    id="marital_status"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-[#197b3b] focus:border-[#197b3b] text-black">
                                <option value="">Select Status</option>
                                <option value="single" {{ old('marital_status') == 'single' ? 'selected' : '' }}>Single</option>
                                <option value="married" {{ old('marital_status') == 'married' ? 'selected' : '' }}>Married</option>
                                <option value="divorced" {{ old('marital_status') == 'divorced' ? 'selected' : '' }}>Divorced</option>
                                <option value="widowed" {{ old('marital_status') == 'widowed' ? 'selected' : '' }}>Widowed</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Address Information -->
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-black mb-4 pb-2 border-b border-gray-200">
                        <i class="fas fa-home mr-2 text-[#197b3b]"></i> Address Information
                    </h3>
                    
                    <div class="space-y-6">
                        <!-- Address -->
                        <div>
                            <label for="address" class="block text-sm font-medium text-gray-700 mb-1">
                                Address
                            </label>
                            <textarea name="address" 
                                      id="address"
                                      rows="3"
                                      placeholder="123 Church Street, City, State, ZIP Code"
                                      class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-[#197b3b] focus:border-[#197b3b] text-black">{{ old('address') }}</textarea>
                        </div>
                        
                        <!-- Home Congregation -->
                        <div>
                            <label for="home_congregation" class="block text-sm font-medium text-gray-700 mb-1">
                                Home Congregation (if different from parish)
                            </label>
                            <input type="text" 
                                   name="home_congregation" 
                                   id="home_congregation"
                                   value="{{ old('home_congregation') }}"
                                   placeholder="e.g., St. Mary's Cathedral"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-[#197b3b] focus:border-[#197b3b] text-black">
                        </div>
                    </div>
                </div>

                <!-- Religious Information -->
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-black mb-4 pb-2 border-b border-gray-200">
                        <i class="fas fa-church mr-2 text-[#197b3b]"></i> Religious Information
                    </h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Baptism Date -->
                        <div>
                            <label for="baptism_date" class="block text-sm font-medium text-gray-700 mb-1">
                                Baptism Date
                            </label>
                            <input type="date" 
                                   name="baptism_date" 
                                   id="baptism_date"
                                   value="{{ old('baptism_date') }}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-[#197b3b] focus:border-[#197b3b] text-black">
                        </div>
                        
                        <!-- Confirmation Date -->
                        <div>
                            <label for="confirmation_date" class="block text-sm font-medium text-gray-700 mb-1">
                                Confirmation Date
                            </label>
                            <input type="date" 
                                   name="confirmation_date" 
                                   id="confirmation_date"
                                   value="{{ old('confirmation_date') }}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-[#197b3b] focus:border-[#197b3b] text-black">
                        </div>
                    </div>
                </div>

                <!-- Emergency Contact -->
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-black mb-4 pb-2 border-b border-gray-200">
                        <i class="fas fa-first-aid mr-2 text-[#197b3b]"></i> Emergency Contact
                    </h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Emergency Contact Name -->
                        <div>
                            <label for="emergency_contact_name" class="block text-sm font-medium text-gray-700 mb-1">
                                Emergency Contact Name
                            </label>
                            <input type="text" 
                                   name="emergency_contact_name" 
                                   id="emergency_contact_name"
                                   value="{{ old('emergency_contact_name') }}"
                                   placeholder="Full name of emergency contact"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-[#197b3b] focus:border-[#197b3b] text-black">
                        </div>
                        
                        <!-- Emergency Contact Phone -->
                        <div>
                            <label for="emergency_contact_phone" class="block text-sm font-medium text-gray-700 mb-1">
                                Emergency Contact Phone
                            </label>
                            <input type="text" 
                                   name="emergency_contact_phone" 
                                   id="emergency_contact_phone"
                                   value="{{ old('emergency_contact_phone') }}"
                                   placeholder="Contact phone number"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-[#197b3b] focus:border-[#197b3b] text-black">
                        </div>
                    </div>
                </div>

                <!-- Account Status -->
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-black mb-4 pb-2 border-b border-gray-200">
                        <i class="fas fa-user-check mr-2 text-[#197b3b]"></i> Account Status
                    </h3>
                    
                    <div class="space-y-4">
                        <!-- Immediate Activation -->
                        <div class="flex items-start">
                            <div class="flex items-center h-5">
                                <input type="checkbox" 
                                       name="send_welcome_email" 
                                       id="send_welcome_email"
                                       value="1"
                                       {{ old('send_welcome_email') ? 'checked' : 'checked' }}
                                       class="h-4 w-4 text-[#197b3b] border-gray-300 rounded focus:ring-[#197b3b]">
                            </div>
                            <div class="ml-3 text-sm">
                                <label for="send_welcome_email" class="font-medium text-gray-700">Send welcome email</label>
                                <p class="text-gray-500">Email login credentials to the new member</p>
                            </div>
                        </div>
                        
                        <!-- Auto-activate -->
                        <div class="flex items-start">
                            <div class="flex items-center h-5">
                                <input type="checkbox" 
                                       name="is_active" 
                                       id="is_active"
                                       value="1"
                                       {{ old('is_active', true) ? 'checked' : 'checked' }}
                                       class="h-4 w-4 text-[#197b3b] border-gray-300 rounded focus:ring-[#197b3b]">
                            </div>
                            <div class="ml-3 text-sm">
                                <label for="is_active" class="font-medium text-gray-700">Activate account immediately</label>
                                <p class="text-gray-500">Member can login and access church resources</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Form Actions -->
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-between">
                <div>
                    <a href="{{ route('admin.members.index') }}" 
                       class="inline-flex items-center px-4 py-2 bg-gray-200 border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 focus:bg-gray-300 active:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        <i class="fas fa-times mr-2"></i> Cancel
                    </a>
                </div>
                <div class="flex space-x-2">
                    <button type="reset" 
                            class="inline-flex items-center px-4 py-2 bg-yellow-100 border border-yellow-300 rounded-md font-semibold text-xs text-yellow-800 uppercase tracking-widest hover:bg-yellow-200 focus:bg-yellow-200 active:bg-yellow-300 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        <i class="fas fa-redo mr-2"></i> Reset Form
                    </button>
                    <button type="submit" 
                            class="inline-flex items-center px-4 py-2 bg-[#197b3b] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-black focus:bg-black active:bg-[#0d5d2a] focus:outline-none focus:ring-2 focus:ring-[#197b3b] focus:ring-offset-2 transition ease-in-out duration-150">
                        <i class="fas fa-user-plus mr-2"></i> Create Member
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- JavaScript for Form Enhancements -->
@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Auto-fill display name from first and last name
        const firstName = document.getElementById('first_name');
        const lastName = document.getElementById('last_name');
        const displayName = document.getElementById('name');
        
        function updateDisplayName() {
            if (firstName.value && lastName.value && !displayName.value) {
                displayName.value = firstName.value + ' ' + lastName.value;
            }
        }
        
        firstName.addEventListener('blur', updateDisplayName);
        lastName.addEventListener('blur', updateDisplayName);
        
        // Password strength indicator (optional enhancement)
        const password = document.getElementById('password');
        password.addEventListener('input', function() {
            const strength = document.getElementById('password-strength');
            if (!strength) {
                const div = document.createElement('div');
                div.id = 'password-strength';
                div.className = 'mt-1 text-xs';
                password.parentNode.appendChild(div);
            }
            
            const value = password.value;
            let strengthText = '';
            let strengthColor = 'text-gray-500';
            
            if (value.length === 0) {
                strengthText = '';
            } else if (value.length < 8) {
                strengthText = 'Weak - at least 8 characters needed';
                strengthColor = 'text-red-500';
            } else if (value.length < 12) {
                strengthText = 'Good';
                strengthColor = 'text-yellow-500';
            } else {
                strengthText = 'Strong';
                strengthColor = 'text-green-500';
            }
            
            document.getElementById('password-strength').innerHTML = 
                `<span class="${strengthColor} font-medium">${strengthText}</span>`;
        });
    });
</script>
@endsection
@endsection