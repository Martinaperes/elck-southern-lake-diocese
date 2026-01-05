@extends('admin.layouts.app')

@section('title', 'Add New Member - ELCK Diocese Admin')

@section('content')
<div class="px-4 py-6">
    <div class="max-w-2xl mx-auto">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Add New Member</h1>
            <p class="text-slate-600 dark:text-slate-400 mt-2">Create a new member account with login credentials</p>
        </div>

        <!-- Form -->
        <form method="POST" action="{{ route('admin.members.store') }}" class="space-y-6">
            @csrf

            <!-- User Account Section -->
            <div class="rounded-xl bg-white dark:bg-surface-dark p-6 border border-slate-200 dark:border-white/5 shadow-sm">
                <h2 class="text-lg font-semibold text-slate-900 dark:text-white mb-4">Account Information</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Full Name *</label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" 
                               class="w-full px-4 py-2 rounded-lg border border-slate-300 dark:border-white/10 bg-white dark:bg-white/5 text-slate-900 dark:text-white focus:ring-2 focus:ring-primary focus:border-transparent" required>
                        @error('name') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Email Address *</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" 
                               class="w-full px-4 py-2 rounded-lg border border-slate-300 dark:border-white/10 bg-white dark:bg-white/5 text-slate-900 dark:text-white focus:ring-2 focus:ring-primary focus:border-transparent" required>
                        @error('email') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Password *</label>
                        <input type="password" id="password" name="password" 
                               class="w-full px-4 py-2 rounded-lg border border-slate-300 dark:border-white/10 bg-white dark:bg-white/5 text-slate-900 dark:text-white focus:ring-2 focus:ring-primary focus:border-transparent" required>
                        @error('password') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Confirm Password *</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" 
                               class="w-full px-4 py-2 rounded-lg border border-slate-300 dark:border-white/10 bg-white dark:bg-white/5 text-slate-900 dark:text-white focus:ring-2 focus:ring-primary focus:border-transparent" required>
                    </div>
                </div>
            </div>

            <!-- Member Details Section -->
            <div class="rounded-xl bg-white dark:bg-surface-dark p-6 border border-slate-200 dark:border-white/5 shadow-sm">
                <h2 class="text-lg font-semibold text-slate-900 dark:text-white mb-4">Member Details</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- First Name -->
                    <div>
                        <label for="first_name" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">First Name *</label>
                        <input type="text" id="first_name" name="first_name" value="{{ old('first_name') }}" 
                               class="w-full px-4 py-2 rounded-lg border border-slate-300 dark:border-white/10 bg-white dark:bg-white/5 text-slate-900 dark:text-white focus:ring-2 focus:ring-primary focus:border-transparent" required>
                        @error('first_name') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <!-- Last Name -->
                    <div>
                        <label for="last_name" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Last Name *</label>
                        <input type="text" id="last_name" name="last_name" value="{{ old('last_name') }}" 
                               class="w-full px-4 py-2 rounded-lg border border-slate-300 dark:border-white/10 bg-white dark:bg-white/5 text-slate-900 dark:text-white focus:ring-2 focus:ring-primary focus:border-transparent" required>
                        @error('last_name') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <!-- Phone -->
                    <div>
                        <label for="phone" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Phone Number</label>
                        <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" 
                               class="w-full px-4 py-2 rounded-lg border border-slate-300 dark:border-white/10 bg-white dark:bg-white/5 text-slate-900 dark:text-white focus:ring-2 focus:ring-primary focus:border-transparent">
                        @error('phone') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <!-- Date of Birth -->
                    <div>
                        <label for="date_of_birth" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Date of Birth</label>
                        <input type="date" id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth') }}" 
                               class="w-full px-4 py-2 rounded-lg border border-slate-300 dark:border-white/10 bg-white dark:bg-white/5 text-slate-900 dark:text-white focus:ring-2 focus:ring-primary focus:border-transparent">
                    </div>

                    <!-- Gender -->
                    <div>
                        <label for="gender" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Gender</label>
                        <select id="gender" name="gender" class="w-full px-4 py-2 rounded-lg border border-slate-300 dark:border-white/10 bg-white dark:bg-white/5 text-slate-900 dark:text-white focus:ring-2 focus:ring-primary focus:border-transparent">
                            <option value="">Select Gender</option>
                            <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                            <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                            <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Other</option>
                        </select>
                    </div>

                    <!-- Marital Status -->
                    <div>
                        <label for="marital_status" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Marital Status</label>
                        <select id="marital_status" name="marital_status" class="w-full px-4 py-2 rounded-lg border border-slate-300 dark:border-white/10 bg-white dark:bg-white/5 text-slate-900 dark:text-white focus:ring-2 focus:ring-primary focus:border-transparent">
                            <option value="">Select Status</option>
                            <option value="single" {{ old('marital_status') == 'single' ? 'selected' : '' }}>Single</option>
                            <option value="married" {{ old('marital_status') == 'married' ? 'selected' : '' }}>Married</option>
                            <option value="divorced" {{ old('marital_status') == 'divorced' ? 'selected' : '' }}>Divorced</option>
                            <option value="widowed" {{ old('marital_status') == 'widowed' ? 'selected' : '' }}>Widowed</option>
                        </select>
                    </div>

                    <!-- Parish (Congregation) -->
                   <!-- Replace the current parish field with this enhanced version -->
<div class="col-span-2">
    <label for="parish_id" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
        Home Parish (Official)
    </label>
    <select id="parish_id" name="parish_id" 
            class="w-full px-4 py-2 rounded-lg border border-slate-300 dark:border-white/10 bg-white dark:bg-white/5 text-slate-900 dark:text-white focus:ring-2 focus:ring-primary focus:border-transparent">
        <option value="">Select from registered parishes</option>
        @foreach($parishes as $parish)
            <option value="{{ $parish->id }}" {{ old('parish_id') == $parish->id ? 'selected' : '' }}>
                {{ $parish->name }} - {{ $parish->location }}
            </option>
        @endforeach
    </select>
    <p class="mt-1 text-xs text-slate-500">Choose from official parish registry</p>
</div>


<div class="col-span-2">
    <label for="home_congregation" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
        Or specify congregation name
    </label>
    <input type="text" id="home_congregation" name="home_congregation" 
           value="{{ old('home_congregation') }}" 
           class="w-full px-4 py-2 rounded-lg border border-slate-300 dark:border-white/10 bg-white dark:bg-white/5 text-slate-900 dark:text-white focus:ring-2 focus:ring-primary focus:border-transparent"
           placeholder="e.g., Othoro Parish">
    <p class="mt-1 text-xs text-slate-500">If not in the list above, enter congregation name</p>
</div>

                    <!-- Membership Number -->
                    <div>
                        <label for="membership_number" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Membership Number</label>
                        <input type="text" id="membership_number" name="membership_number" value="{{ old('membership_number') }}" 
                               class="w-full px-4 py-2 rounded-lg border border-slate-300 dark:border-white/10 bg-white dark:bg-white/5 text-slate-900 dark:text-white focus:ring-2 focus:ring-primary focus:border-transparent" placeholder="e.g., MEM-001">
                    </div>
                </div>

                <!-- Address -->
                <div class="mt-4">
                    <label for="address" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Address</label>
                    <textarea id="address" name="address" rows="2" 
                              class="w-full px-4 py-2 rounded-lg border border-slate-300 dark:border-white/10 bg-white dark:bg-white/5 text-slate-900 dark:text-white focus:ring-2 focus:ring-primary focus:border-transparent">{{ old('address') }}</textarea>
                </div>

                <!-- Emergency Contact -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                    <div>
                        <label for="emergency_contact_name" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Emergency Contact Name</label>
                        <input type="text" id="emergency_contact_name" name="emergency_contact_name" value="{{ old('emergency_contact_name') }}" 
                               class="w-full px-4 py-2 rounded-lg border border-slate-300 dark:border-white/10 bg-white dark:bg-white/5 text-slate-900 dark:text-white focus:ring-2 focus:ring-primary focus:border-transparent">
                    </div>
                    <div>
                        <label for="emergency_contact_phone" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Emergency Contact Phone</label>
                        <input type="tel" id="emergency_contact_phone" name="emergency_contact_phone" value="{{ old('emergency_contact_phone') }}" 
                               class="w-full px-4 py-2 rounded-lg border border-slate-300 dark:border-white/10 bg-white dark:bg-white/5 text-slate-900 dark:text-white focus:ring-2 focus:ring-primary focus:border-transparent">
                    </div>
                </div>

                <!-- Important Dates -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                    <div>
                        <label for="baptism_date" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Baptism Date</label>
                        <input type="date" id="baptism_date" name="baptism_date" value="{{ old('baptism_date') }}" 
                               class="w-full px-4 py-2 rounded-lg border border-slate-300 dark:border-white/10 bg-white dark:bg-white/5 text-slate-900 dark:text-white focus:ring-2 focus:ring-primary focus:border-transparent">
                    </div>
                    <div>
                        <label for="confirmation_date" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Confirmation Date</label>
                        <input type="date" id="confirmation_date" name="confirmation_date" value="{{ old('confirmation_date') }}" 
                               class="w-full px-4 py-2 rounded-lg border border-slate-300 dark:border-white/10 bg-white dark:bg-white/5 text-slate-900 dark:text-white focus:ring-2 focus:ring-primary focus:border-transparent">
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="flex items-center justify-between pt-4">
                <a href="{{ route('admin.dashboard') }}" class="px-5 py-2.5 rounded-lg border border-slate-300 dark:border-white/10 text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-white/5 transition-colors">
                    Cancel
                </a>
                <button type="submit" class="px-5 py-2.5 rounded-lg bg-primary text-white hover:bg-primary/90 transition-colors font-medium">
                    Create Member Account
                </button>
            </div>
        </form>
    </div>
</div>
@endsection