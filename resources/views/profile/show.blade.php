@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto mt-10 p-6 bg-white rounded shadow">
    <h2 class="text-2xl font-bold mb-6">My Profile</h2>

    {{-- Success message --}}
    @if(session('success'))
        <div class="bg-green-100 p-2 mb-4 rounded text-green-800">
            {{ session('success') }}
        </div>
    @endif

    {{-- Profile Image --}}
    <div class="flex justify-center mb-6">
        @if($member->photo)
            <img src="{{ asset('storage/' . $member->photo) }}" alt="Profile Photo" class="w-24 h-24 rounded-full object-cover">
        @else
            {{-- Fallback: initials --}}
            <div class="w-24 h-24 rounded-full bg-blue-600 text-white flex items-center justify-center text-xl font-bold">
                {{ strtoupper(substr($user->name,0,1)) }}{{ strtoupper(substr(explode(' ', $user->name)[1] ?? '',0,1)) }}
            </div>
        @endif
    </div>

    {{-- User Info --}}
    <div class="space-y-3">
        <div><strong>Name:</strong> {{ $user->name }}</div>
        <div><strong>First Name:</strong> {{ $member->first_name ?? '-' }}</div>
        <div><strong>Last Name:</strong> {{ $member->last_name ?? '-' }}</div>
        <div><strong>Email:</strong> {{ $user->email }}</div>
        <div><strong>Phone:</strong> {{ $member->phone ?? '-' }}</div>
        <div><strong>Address:</strong> {{ $member->address ?? '-' }}</div>
        <div><strong>Date of Birth:</strong> {{ $member->date_of_birth ?? '-' }}</div>
        <div><strong>Gender:</strong> {{ $member->gender ?? '-' }}</div>
        <div><strong>Baptism Date:</strong> {{ $member->baptism_date ?? '-' }}</div>
        <div><strong>Confirmation Date:</strong> {{ $member->confirmation_date ?? '-' }}</div>
        <div><strong>Home Congregation:</strong> {{ $member->home_congregation ?? '-' }}</div>
        <div><strong>Emergency Contact Name:</strong> {{ $member->emergency_contact_name ?? '-' }}</div>
        <div><strong>Emergency Contact Phone:</strong> {{ $member->emergency_contact_phone ?? '-' }}</div>
    </div>

    {{-- Edit Profile Button --}}
    <div class="mt-6 text-center">
        <a href="{{ route('profile.edit') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Edit Profile
        </a>
    </div>
</div>
@endsection
