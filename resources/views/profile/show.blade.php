@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto mt-12 p-6 bg-white dark:bg-[#1a2e1a] rounded-2xl shadow-lg">
    <h2 class="text-3xl font-bold mb-6 text-[#197b3b] dark:text-green-400 text-center">My Profile</h2>

    {{-- Success message --}}
    @if(session('success'))
        <div class="bg-green-100 dark:bg-green-800 p-3 mb-6 rounded text-green-800 dark:text-green-200 font-medium">
            {{ session('success') }}
        </div>
    @endif

    {{-- Profile Image --}}
    <div class="flex justify-center mb-6">
        @if($member->photo)
            <img src="{{ asset('storage/' . $member->photo) }}" alt="Profile Photo" class="w-28 h-28 rounded-full object-cover border-4 border-[#197b3b] shadow-md">
        @else
            {{-- Fallback: initials --}}
            <div class="w-28 h-28 rounded-full bg-[#197b3b] text-white flex items-center justify-center text-3xl font-bold shadow-md">
                {{ strtoupper(substr($user->name,0,1)) }}{{ strtoupper(substr(explode(' ', $user->name)[1] ?? '',0,1)) }}
            </div>
        @endif
    </div>

    {{-- User Info --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div class="bg-gray-50 dark:bg-[#12381c] p-4 rounded-lg shadow-sm">
            <div class="font-semibold text-gray-700 dark:text-gray-200">Name</div>
            <div class="text-gray-900 dark:text-gray-100">{{ $user->name }}</div>
        </div>

        <div class="bg-gray-50 dark:bg-[#12381c] p-4 rounded-lg shadow-sm">
            <div class="font-semibold text-gray-700 dark:text-gray-200">Email</div>
            <div class="text-gray-900 dark:text-gray-100">{{ $user->email }}</div>
        </div>

        <div class="bg-gray-50 dark:bg-[#12381c] p-4 rounded-lg shadow-sm">
            <div class="font-semibold text-gray-700 dark:text-gray-200">Phone</div>
            <div class="text-gray-900 dark:text-gray-100">{{ $member->phone ?? '-' }}</div>
        </div>

        <div class="bg-gray-50 dark:bg-[#12381c] p-4 rounded-lg shadow-sm">
            <div class="font-semibold text-gray-700 dark:text-gray-200">Address</div>
            <div class="text-gray-900 dark:text-gray-100">{{ $member->address ?? '-' }}</div>
        </div>

        <div class="bg-gray-50 dark:bg-[#12381c] p-4 rounded-lg shadow-sm">
            <div class="font-semibold text-gray-700 dark:text-gray-200">Date of Birth</div>
            <div class="text-gray-900 dark:text-gray-100">{{ $member->date_of_birth ?? '-' }}</div>
        </div>

        <div class="bg-gray-50 dark:bg-[#12381c] p-4 rounded-lg shadow-sm">
            <div class="font-semibold text-gray-700 dark:text-gray-200">Gender</div>
            <div class="text-gray-900 dark:text-gray-100">{{ $member->gender ?? '-' }}</div>
        </div>

        <div class="bg-gray-50 dark:bg-[#12381c] p-4 rounded-lg shadow-sm">
            <div class="font-semibold text-gray-700 dark:text-gray-200">Baptism Date</div>
            <div class="text-gray-900 dark:text-gray-100">{{ $member->baptism_date ?? '-' }}</div>
        </div>

        <div class="bg-gray-50 dark:bg-[#12381c] p-4 rounded-lg shadow-sm">
            <div class="font-semibold text-gray-700 dark:text-gray-200">Confirmation Date</div>
            <div class="text-gray-900 dark:text-gray-100">{{ $member->confirmation_date ?? '-' }}</div>
        </div>

        <div class="bg-gray-50 dark:bg-[#12381c] p-4 rounded-lg shadow-sm">
            <div class="font-semibold text-gray-700 dark:text-gray-200">Home Congregation</div>
            <div class="text-gray-900 dark:text-gray-100">{{ $member->home_congregation ?? '-' }}</div>
        </div>

        <div class="bg-gray-50 dark:bg-[#12381c] p-4 rounded-lg shadow-sm">
            <div class="font-semibold text-gray-700 dark:text-gray-200">Emergency Contact</div>
            <div class="text-gray-900 dark:text-gray-100">{{ $member->emergency_contact_name ?? '-' }} - {{ $member->emergency_contact_phone ?? '-' }}</div>
        </div>
    </div>

    {{-- Edit Profile Button --}}
    <div class="mt-8 text-center">
        <a href="{{ route('profile.edit') }}" class="inline-flex items-center justify-center gap-2 bg-[#197b3b] hover:bg-green-700 text-white font-semibold px-6 py-3 rounded-xl shadow-lg transition duration-300">
            <span>Edit Profile</span>
            
        </a>
    </div>
</div>
@endsection
