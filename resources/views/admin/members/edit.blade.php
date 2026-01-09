@extends('admin.layouts.app')

@section('title', 'Edit Member - ' . ($member->user->name ?? $member->first_name . ' ' . $member->last_name))

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
        <div>
            <div class="flex items-center space-x-2">
                <a href="{{ route('admin.members.show', $member) }}" 
                   class="text-[#197b3b] hover:text-black">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <h1 class="text-2xl font-bold text-white">Edit Member</h1>
            </div>
            <p class="text-gray-600 mt-1">Update information for {{ $member->first_name }} {{ $member->last_name }}</p>
        </div>
        <div class="mt-4 md:mt-0">
            <a href="{{ route('admin.members.show', $member) }}" 
               class="inline-flex items-center px-4 py-2 bg-gray-200 border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 focus:bg-gray-300 active:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                <i class="fas fa-eye mr-2"></i> View Member
            </a>
        </div>
    </div>

    <!-- Edit Form -->
    <div class="bg-white shadow-lg rounded-lg border border-gray-200 overflow-hidden">
        <form action="{{ route('admin.members.update', $member) }}" method="POST">
            @csrf
            @method('PUT')
            
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

                <!-- Success Message -->
                @if (session('success'))
                    <div class="mb-6 p-4 bg-green-50 border border-green-300 rounded">
                        <p class="text-green-800">{{ session('success') }}</p>
                    </div>
                @endif

                <!-- Personal Information Section -->
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-black mb-4 pb-2 border-b border-gray-200">
                        <i class="fas fa-user-circle mr-2 text-[#197b3b]"></i>Personal Information
                    </h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- First Name -->
                        <div>
                            <label for="first_name" class="block text-sm font-medium text-gray-700 mb-1">
                                First Name <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   name="first_name" 
                                   id="first_name"
                                   value="{{ old('first_name', $member->first_name) }}"
                                   required
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-[#197b3b] focus:border-[#197b3b]  text-black">
                        </div>
                        
                        <!-- Last Name -->
                        <div>
                            <label for="last_name" class="block text-sm font-medium text-gray-700 mb-1">
                                Last Name <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   name="last_name" 
                                   id="last_name"
                                   value="{{ old('last_name', $member->last_name) }}"
                                   required
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-[#197b3b] focus:border-[#197b3b]  text-black">
                        </div>
                        
                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">
                                Email Address <span class="text-red-500">*</span>
                            </label>
                            <input type="email" 
                                   name="email" 
                                   id="email"
                                   value="{{ old('email', $member->email) }}"
                                   required
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-[#197b3b] focus:border-[#197b3b] text-black">
                            @if($member->user)
                                <p class="mt-1 text-xs text-gray-500">Linked to user account: {{ $member->user->email }}</p>
                            @endif
                        </div>
                        
                        <!-- Phone -->
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">
                                Phone Number
                            </label>
                            <input type="text" 
                                   name="phone" 
                                   id="phone"
                                   value="{{ old('phone', $member->phone) }}"
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
                                   value="{{ old('date_of_birth', $member->date_of_birth ? \Carbon\Carbon::parse($member->date_of_birth)->format('Y-m-d') : '') }}"
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
                                <option value="male" {{ old('gender', $member->gender) == 'male' ? 'selected' : '' }}>Male</option>
                                <option value="female" {{ old('gender', $member->gender) == 'female' ? 'selected' : '' }}>Female</option>
                                <option value="other" {{ old('gender', $member->gender) == 'other' ? 'selected' : '' }}>Other</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Address & Contact Section -->
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-black mb-4 pb-2 border-b border-gray-200">
                        <i class="fas fa-home mr-2 text-[#197b3b]"></i>Address & Contact Information
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
                                      class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-[#197b3b] focus:border-[#197b3b] text-black">{{ old('address', $member->address) }}</textarea>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Marital Status -->
                            <div>
                                <label for="marital_status" class="block text-sm font-medium text-gray-700 mb-1">
                                    Marital Status
                                </label>
                                <select name="marital_status" 
                                        id="marital_status"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-[#197b3b] focus:border-[#197b3b] text-black">
                                    <option value="">Select Status</option>
                                    <option value="single" {{ old('marital_status', $member->marital_status) == 'single' ? 'selected' : '' }}>Single</option>
                                    <option value="married" {{ old('marital_status', $member->marital_status) == 'married' ? 'selected' : '' }}>Married</option>
                                    <option value="divorced" {{ old('marital_status', $member->marital_status) == 'divorced' ? 'selected' : '' }}>Divorced</option>
                                    <option value="widowed" {{ old('marital_status', $member->marital_status) == 'widowed' ? 'selected' : '' }}>Widowed</option>
                                </select>
                            </div>
                            
                            <!-- Parish -->
                            <div>
                                <label for="parish_id" class="block text-sm font-medium text-gray-700 mb-1">
                                    Parish
                                </label>
                                <select name="parish_id" 
                                        id="parish_id"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-[#197b3b] focus:border-[#197b3b] text-black">
                                    <option value="">Select Parish</option>
                                    @foreach($parishes as $parish)
                                        <option value="{{ $parish->id }}" {{ old('parish_id', $member->parish_id) == $parish->id ? 'selected' : '' }}>
                                            {{ $parish->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Religious Information Section -->
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-black mb-4 pb-2 border-b border-gray-200">
                        <i class="fas fa-church mr-2 text-[#197b3b]"></i>Religious Information
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
                                   value="{{ old('baptism_date', $member->baptism_date ? \Carbon\Carbon::parse($member->baptism_date)->format('Y-m-d') : '') }}"
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
                                   value="{{ old('confirmation_date', $member->confirmation_date ? \Carbon\Carbon::parse($member->confirmation_date)->format('Y-m-d') : '') }}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-[#197b3b] focus:border-[#197b3b] text-black">
                        </div>
                        
                        <!-- Home Congregation -->
                        <div class="md:col-span-2">
                            <label for="home_congregation" class="block text-sm font-medium text-gray-700 mb-1">
                                Home Congregation
                            </label>
                            <input type="text" 
                                   name="home_congregation" 
                                   id="home_congregation"
                                   value="{{ old('home_congregation', $member->home_congregation) }}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-[#197b3b] focus:border-[#197b3b] text-black">
                        </div>
                    </div>
                </div>

                <!-- Emergency Contact Section -->
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-black mb-4 pb-2 border-b border-gray-200">
                        <i class="fas fa-first-aid mr-2 text-[#197b3b]"></i>Emergency Contact
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
                                   value="{{ old('emergency_contact_name', $member->emergency_contact_name) }}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-[#197b3b] focus:border-[#197b3b]">
                        </div>
                        
                        <!-- Emergency Contact Phone -->
                        <div>
                            <label for="emergency_contact_phone" class="block text-sm font-medium text-gray-700 mb-1">
                                Emergency Contact Phone
                            </label>
                            <input type="text" 
                                   name="emergency_contact_phone" 
                                   id="emergency_contact_phone"
                                   value="{{ old('emergency_contact_phone', $member->emergency_contact_phone) }}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-[#197b3b] focus:border-[#197b3b]">
                        </div>
                    </div>
                </div>

                <!-- Member Status Section -->
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-black mb-4 pb-2 border-b border-gray-200">
                        <i class="fas fa-user-check mr-2 text-[#197b3b]"></i>Member Status
                    </h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Active Status -->
                        <div class="flex items-center">
                            <input type="hidden" name="is_active" value="0">
                            <input type="checkbox" 
                                   name="is_active" 
                                   id="is_active"
                                   value="1"
                                   {{ old('is_active', $member->is_active) ? 'checked' : '' }}
                                   class="h-5 w-5 text-[#197b3b] border-gray-300 rounded focus:ring-[#197b3b]">
                            <label for="is_active" class="ml-2 block text-sm text-gray-700">
                                Active Member
                            </label>
                        </div>
                    </div>
                    
                    <p class="mt-2 text-sm text-gray-500">
                        Inactive members won't appear in some reports and may have limited access.
                    </p>
                </div>
            </div>
            
            <!-- Form Actions -->
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-between">
                <div>
                    <a href="{{ route('admin.members.show', $member) }}" 
                       class="inline-flex items-center px-4 py-2 bg-gray-200 border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 focus:bg-gray-300 active:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        <i class="fas fa-times mr-2"></i> Cancel
                    </a>
                </div>
                <div class="flex space-x-2">
                    <button type="button"
                            onclick="window.location.href='{{ route('admin.members.show', $member) }}'"
                            class="inline-flex items-center px-4 py-2 bg-gray-200 border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 focus:bg-gray-300 active:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        <i class="fas fa-eye mr-2"></i> Preview
                    </button>
                    <button type="submit" 
                            class="inline-flex items-center px-4 py-2 bg-[#197b3b] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-black focus:bg-black active:bg-[#0d5d2a] focus:outline-none focus:ring-2 focus:ring-[#197b3b] focus:ring-offset-2 transition ease-in-out duration-150">
                        <i class="fas fa-save mr-2"></i> Save Changes
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- JavaScript for Form Enhancements -->
@section('scripts')
<script>
    // Initialize any date pickers if needed
    document.addEventListener('DOMContentLoaded', function() {
        // You can add date picker initialization here if using a library
        // Example for Flatpickr or similar:
        // flatpickr('#date_of_birth', { dateFormat: 'Y-m-d' });
        // flatpickr('#baptism_date', { dateFormat: 'Y-m-d' });
        // flatpickr('#confirmation_date', { dateFormat: 'Y-m-d' });
    });
</script>
@endsection
@endsection