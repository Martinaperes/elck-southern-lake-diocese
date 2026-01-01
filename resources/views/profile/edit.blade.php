@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto mt-12 p-6 bg-white dark:bg-[#1a2e1a] rounded-2xl shadow-lg">
    <h2 class="text-3xl font-bold mb-6 text-[#197b3b] text-center">Edit Profile</h2>

    {{-- Success message --}}
    @if(session('success'))
        <div class="bg-green-100 dark:bg-green-800 p-3 mb-6 rounded text-green-800 dark:text-green-200 font-medium">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        @method('PUT')

        {{-- User Info --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="name" class="block font-medium mb-1 text-gray-700 dark:text-gray-200">Name</label>
                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" class="w-full border border-gray-300 dark:border-gray-600 px-3 py-2 rounded-lg focus:ring-2 focus:ring-[#197b3b]" required>
            </div>

            <div>
                <label for="first_name" class="block font-medium mb-1 text-gray-700 dark:text-gray-200">First Name</label>
                <input type="text" name="first_name" id="first_name" value="{{ old('first_name', $member->first_name ?? '') }}" class="w-full border border-gray-300 dark:border-gray-600 px-3 py-2 rounded-lg focus:ring-2 focus:ring-[#197b3b]">
            </div>

            <div>
                <label for="last_name" class="block font-medium mb-1 text-gray-700 dark:text-gray-200">Last Name</label>
                <input type="text" name="last_name" id="last_name" value="{{ old('last_name', $member->last_name ?? '') }}" class="w-full border border-gray-300 dark:border-gray-600 px-3 py-2 rounded-lg focus:ring-2 focus:ring-[#197b3b]">
            </div>

            <div>
                <label for="phone" class="block font-medium mb-1 text-gray-700 dark:text-gray-200">Phone</label>
                <input type="text" name="phone" id="phone" value="{{ old('phone', $member->phone ?? '') }}" class="w-full border border-gray-300 dark:border-gray-600 px-3 py-2 rounded-lg focus:ring-2 focus:ring-[#197b3b]">
            </div>

            <div>
                <label for="address" class="block font-medium mb-1 text-gray-700 dark:text-gray-200">Address</label>
                <input type="text" name="address" id="address" value="{{ old('address', $member->address ?? '') }}" class="w-full border border-gray-300 dark:border-gray-600 px-3 py-2 rounded-lg focus:ring-2 focus:ring-[#197b3b]">
            </div>

            <div>
                <label for="date_of_birth" class="block font-medium mb-1 text-gray-700 dark:text-gray-200">Date of Birth</label>
                <input type="date" name="date_of_birth" id="date_of_birth" value="{{ old('date_of_birth', $member->date_of_birth ?? '') }}" class="w-full border border-gray-300 dark:border-gray-600 px-3 py-2 rounded-lg focus:ring-2 focus:ring-[#197b3b]">
            </div>

            <div>
                <label for="gender" class="block font-medium mb-1 text-gray-700 dark:text-gray-200">Gender</label>
                <select name="gender" id="gender" class="w-full border border-gray-300 dark:border-gray-600 px-3 py-2 rounded-lg focus:ring-2 focus:ring-[#197b3b]">
                    <option value="">Select</option>
                    <option value="Male" {{ ($member->gender ?? '') == 'Male' ? 'selected' : '' }}>Male</option>
                    <option value="Female" {{ ($member->gender ?? '') == 'Female' ? 'selected' : '' }}>Female</option>
                </select>
            </div>

            <div>
                <label for="baptism_date" class="block font-medium mb-1 text-gray-700 dark:text-gray-200">Baptism Date</label>
                <input type="date" name="baptism_date" id="baptism_date" value="{{ old('baptism_date', $member->baptism_date) }}" class="w-full border border-gray-300 dark:border-gray-600 px-3 py-2 rounded-lg focus:ring-2 focus:ring-[#197b3b]">
            </div>

            <div>
                <label for="confirmation_date" class="block font-medium mb-1 text-gray-700 dark:text-gray-200">Confirmation Date</label>
                <input type="date" name="confirmation_date" id="confirmation_date" value="{{ old('confirmation_date', $member->confirmation_date) }}" class="w-full border border-gray-300 dark:border-gray-600 px-3 py-2 rounded-lg focus:ring-2 focus:ring-[#197b3b]">
            </div>

            <div>
                <label for="home_congregation" class="block font-medium mb-1 text-gray-700 dark:text-gray-200">Home Congregation</label>
                <input type="text" name="home_congregation" id="home_congregation" value="{{ old('home_congregation', $member->home_congregation) }}" class="w-full border border-gray-300 dark:border-gray-600 px-3 py-2 rounded-lg focus:ring-2 focus:ring-[#197b3b]">
            </div>

            <div>
                <label for="emergency_contact_name" class="block font-medium mb-1 text-gray-700 dark:text-gray-200">Emergency Contact Name</label>
                <input type="text" name="emergency_contact_name" id="emergency_contact_name" value="{{ old('emergency_contact_name', $member->emergency_contact_name) }}" class="w-full border border-gray-300 dark:border-gray-600 px-3 py-2 rounded-lg focus:ring-2 focus:ring-[#197b3b]">
            </div>

            <div>
                <label for="emergency_contact_phone" class="block font-medium mb-1 text-gray-700 dark:text-gray-200">Emergency Contact Phone</label>
                <input type="text" name="emergency_contact_phone" id="emergency_contact_phone" value="{{ old('emergency_contact_phone', $member->emergency_contact_phone) }}" class="w-full border border-gray-300 dark:border-gray-600 px-3 py-2 rounded-lg focus:ring-2 focus:ring-[#197b3b]">
            </div>

            <div class="col-span-1 md:col-span-2">
                <label for="photo" class="block font-medium mb-1 text-gray-700 dark:text-gray-200">Profile Photo</label>
                <input type="file" name="photo" id="photo" class="w-full border border-gray-300 dark:border-gray-600 px-3 py-2 rounded-lg">
                @if($member->photo)
                    <img src="{{ asset('storage/' . $member->photo) }}" alt="Profile Picture" class="w-24 h-24 rounded-full mt-2 border-2 border-[#197b3b]">
                @endif
            </div>
        </div>

        <div class="text-center mt-6">
            <button type="submit" class="inline-flex items-center justify-center gap-2 bg-[#197b3b] hover:bg-green-700 text-white font-semibold px-6 py-3 rounded-xl shadow-lg transition duration-300">
                <span>Update Profile</span>
            </button>
        </div>
    </form>
</div>
@endsection
