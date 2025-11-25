@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto mt-10 p-6 bg-white rounded shadow">
    <h2 class="text-xl font-bold mb-4">Edit Profile</h2>

    @if(session('success'))
        <div class="bg-green-100 p-2 mb-4 rounded text-green-800">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- User Info -->
<div class="mb-4">
    <label for="name" class="block font-medium mb-1">Name</label>
    <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" class="w-full border px-3 py-2 rounded" required>
</div>

<!-- Member Info -->
<div class="mb-4">
    <label for="first_name" class="block font-medium mb-1">First Name</label>
    <input type="text" name="first_name" id="first_name" value="{{ old('first_name', $member->first_name ?? '') }}" class="w-full border px-3 py-2 rounded">
</div>

<div class="mb-4">
    <label for="last_name" class="block font-medium mb-1">Last Name</label>
    <input type="text" name="last_name" id="last_name" value="{{ old('last_name', $member->last_name ?? '') }}" class="w-full border px-3 py-2 rounded">
</div>

<div class="mb-4">
    <label for="phone" class="block font-medium mb-1">Phone</label>
    <input type="text" name="phone" id="phone" value="{{ old('phone', $member->phone ?? '') }}" class="w-full border px-3 py-2 rounded">
</div>

<div class="mb-4">
    <label for="address" class="block font-medium mb-1">Address</label>
    <input type="text" name="address" id="address" value="{{ old('address', $member->address ?? '') }}" class="w-full border px-3 py-2 rounded">
</div>

<div class="mb-4">
    <label for="date_of_birth" class="block font-medium mb-1">Date of Birth</label>
    <input type="date" name="date_of_birth" id="date_of_birth" value="{{ old('date_of_birth', $member->date_of_birth ?? '') }}" class="w-full border px-3 py-2 rounded">
</div>

<div class="mb-4">
    <label for="gender" class="block font-medium mb-1">Gender</label>
    <select name="gender" id="gender" class="w-full border px-3 py-2 rounded">
        <option value="">Select</option>
        <option value="Male" {{ ($member->gender ?? '') == 'Male' ? 'selected' : '' }}>Male</option>
        <option value="Female" {{ ($member->gender ?? '') == 'Female' ? 'selected' : '' }}>Female</option>
    </select>
    <div class="mb-4">
    <label for="baptism_date" class="block font-medium mb-1">Baptism Date</label>
    <input type="date" name="baptism_date" id="baptism_date" value="{{ old('baptism_date', $member->baptism_date) }}" class="w-full border px-3 py-2 rounded">
</div>

<div class="mb-4">
    <label for="confirmation_date" class="block font-medium mb-1">Confirmation Date</label>
    <input type="date" name="confirmation_date" id="confirmation_date" value="{{ old('confirmation_date', $member->confirmation_date) }}" class="w-full border px-3 py-2 rounded">
</div>

<div class="mb-4">
    <label for="home_congregation" class="block font-medium mb-1">Home Congregation</label>
    <input type="text" name="home_congregation" id="home_congregation" value="{{ old('home_congregation', $member->home_congregation) }}" class="w-full border px-3 py-2 rounded">
</div>

<div class="mb-4">
    <label for="emergency_contact_name" class="block font-medium mb-1">Emergency Contact Name</label>
    <input type="text" name="emergency_contact_name" id="emergency_contact_name" value="{{ old('emergency_contact_name', $member->emergency_contact_name) }}" class="w-full border px-3 py-2 rounded">
</div>

<div class="mb-4">
    <label for="emergency_contact_phone" class="block font-medium mb-1">Emergency Contact Phone</label>
    <input type="text" name="emergency_contact_phone" id="emergency_contact_phone" value="{{ old('emergency_contact_phone', $member->emergency_contact_phone) }}" class="w-full border px-3 py-2 rounded">
</div>

<div class="mb-4">
    <label for="photo" class="block font-medium mb-1">Profile Photo</label>
    <input type="file" name="photo" id="photo" class="w-full">
    @if($member->photo)
        <img src="{{ asset('storage/' . $member->photo) }}" alt="Profile Picture" class="w-20 h-20 rounded-full mt-2">
    @endif
</div>
 <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update Profile</button>
    </form>
</div>
@endsection
