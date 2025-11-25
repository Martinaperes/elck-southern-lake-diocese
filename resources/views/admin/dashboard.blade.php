@extends('admin.layouts.app')

@section('content')
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

    <div class="bg-white rounded-lg shadow p-6 flex flex-col items-center">
        <i class="fas fa-users text-3xl text-blue-500 mb-2"></i>
        <h2 class="text-xl font-bold">{{ $totalMembers }}</h2>
        <p class="text-gray-600">Members</p>
    </div>

    <div class="bg-white rounded-lg shadow p-6 flex flex-col items-center">
        <i class="fas fa-hands-praying text-3xl text-green-500 mb-2"></i>
        <h2 class="text-xl font-bold">{{ $totalMinistries }}</h2>
        <p class="text-gray-600">Ministries</p>
    </div>

    <div class="bg-white rounded-lg shadow p-6 flex flex-col items-center">
        <i class="fas fa-calendar-alt text-3xl text-yellow-500 mb-2"></i>
        <h2 class="text-xl font-bold">{{ $totalEvents }}</h2>
        <p class="text-gray-600">Events</p>
    </div>

    <div class="bg-white rounded-lg shadow p-6 flex flex-col items-center">
        <i class="fas fa-heart text-3xl text-red-500 mb-2"></i>
        <h2 class="text-xl font-bold">${{ number_format($totalDonationsThisMonth, 2) }}</h2>
        <p class="text-gray-600">Donations This Month</p>
    </div>

</div>
@endsection
