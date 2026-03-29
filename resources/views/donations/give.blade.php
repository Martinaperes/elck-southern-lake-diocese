@extends('layouts.app')

@section('content')
<main class="flex-grow bg-gray-50 dark:bg-gray-900 min-h-screen pb-12">
    <!-- Hero Section -->
    <div class="relative overflow-hidden bg-gradient-to-br from-[#0f4a23] via-[#197b3b] to-[#146c33] pt-16 pb-24 sm:pt-20 sm:pb-32">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'0.4\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
        </div>
        
        <div class="relative max-w-[1200px] mx-auto px-4 sm:px-6 lg:px-8 text-center text-white">
            <div class="inline-flex items-center justify-center w-16 h-16 sm:w-20 sm:h-20 rounded-2xl bg-white/10 backdrop-blur-sm shadow-xl mb-6">
                <svg class="w-8 h-8 sm:w-10 sm:h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                </svg>
            </div>
            
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black mb-6 tracking-tight drop-shadow-lg">
                Support Our <span class="text-emerald-200">Mission</span>
            </h1>
            
            <p class="text-lg sm:text-xl text-emerald-50 max-w-2xl mx-auto font-light leading-relaxed mb-8 drop-shadow">
                "Each of you should give what you have decided in your heart to give, not reluctantly or under compulsion, for God loves a cheerful giver." <br>
                <span class="font-semibold text-white mt-2 inline-block">— 2 Corinthians 9:7</span>
            </p>
        </div>
    </div>

    <div class="max-w-[1000px] mx-auto px-4 sm:px-6 lg:px-8 -mt-16 sm:-mt-24 relative z-10">
        <!-- Flash Messages -->
        @if(session('success'))
            <div class="bg-emerald-100 border border-emerald-400 text-emerald-700 px-4 py-3 rounded-xl relative mb-6 shadow-sm flex items-center gap-3 animate-fadeIn" role="alert">
                <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                <span class="block sm:inline font-medium">{{ session('success') }}</span>
            </div>
        @endif

        @if($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-4 rounded-xl relative mb-6 shadow-sm animate-fadeIn" role="alert">
                <div class="flex items-center gap-2 mb-2">
                    <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                    <span class="font-bold">Please fix the following errors:</span>
                </div>
                <ul class="list-disc list-inside text-sm pl-2">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            <!-- Donation Form -->
            <div class="lg:col-span-12">
                <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-2xl border border-gray-100 dark:border-gray-700 overflow-hidden">
                    <div class="grid grid-cols-1 md:grid-cols-5">
                        
                        <!-- Side Info Panel -->
                        <div class="bg-gradient-to-br from-[#146c33] to-[#197b3b] md:col-span-2 p-8 text-white flex flex-col justify-between">
                            <div>
                                <div class="w-16 h-16 bg-white/10 rounded-2xl flex items-center justify-center mb-6 backdrop-blur-sm">
                                    <svg class="w-8 h-8 text-emerald-100" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-2xl font-bold mb-4">Support Our Ministry</h3>
                                <p class="text-emerald-50 mb-6 font-light leading-relaxed">
                                    We offer multiple ways to give. Use M-Pesa for local mobile donations, or Donorbox for international card and PayPal contributions.
                                </p>
                                <div class="space-y-4">
                                    <div class="flex items-start gap-3">
                                        <div class="p-1 bg-emerald-500/30 rounded mt-1">
                                            <svg class="w-4 h-4 text-emerald-100" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                        </div>
                                        <span class="text-sm font-medium">Enter your M-Pesa number.</span>
                                    </div>
                                    <div class="flex items-start gap-3">
                                        <div class="p-1 bg-emerald-500/30 rounded mt-1">
                                            <svg class="w-4 h-4 text-emerald-100" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                        </div>
                                        <span class="text-sm font-medium">Wait for the STK push prompt on your phone.</span>
                                    </div>
                                    <div class="flex items-start gap-3">
                                        <div class="p-1 bg-emerald-500/30 rounded mt-1">
                                            <svg class="w-4 h-4 text-emerald-100" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                        </div>
                                        <span class="text-sm font-medium">Enter your PIN to complete the donation.</span>
                                    </div>
                                </div>

                                <div class="mt-8 p-4 bg-white/10 rounded-2xl border border-white/20 backdrop-blur-sm">
                                    <h4 class="text-xs font-bold uppercase tracking-wider text-emerald-200 mb-3 text-center">Alternative: Manual Paybill</h4>
                                    <div class="space-y-2 text-xs">
                                        <div class="flex justify-between border-b border-emerald-500/20 pb-1">
                                            <span class="text-emerald-100">Business No:</span>
                                            <span class="font-bold font-mono">{{ env('MPESA_SHORTCODE', 'XXXXXX') }}</span>
                                        </div>
                                        <div class="flex justify-between border-b border-emerald-500/20 pb-1">
                                            <span class="text-emerald-100">Account No:</span>
                                            <span class="font-bold font-mono">YOUR NAME</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mt-8 pt-6 border-t border-emerald-500/30">
                                <div class="flex items-center gap-3">
                                    <svg class="w-6 h-6 text-emerald-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                    </svg>
                                    <span class="text-xs font-semibold uppercase tracking-wider text-emerald-100">100% Secure Transaction</span>
                                </div>
                            </div>
                        </div>

                        <!-- Form Area -->
                        <div class="md:col-span-3 p-8 sm:p-10">
                            <!-- Payment Method Tabs -->
                            <div class="flex border-b border-gray-200 dark:border-gray-700 mb-8">
                                <button onclick="switchTab('mpesa')" id="tab-mpesa" class="px-6 py-3 border-b-2 border-[#197b3b] text-[#197b3b] font-bold text-sm transition-all focus:outline-none">
                                    M-Pesa (Local)
                                </button>
                                <button onclick="switchTab('donorbox')" id="tab-donorbox" class="px-6 py-3 border-b-2 border-transparent text-gray-500 hover:text-[#197b3b] font-bold text-sm transition-all focus:outline-none">
                                    Card / International
                                </button>
                            </div>

                            <!-- M-Pesa Tab Pane -->
                            <div id="pane-mpesa" class="tab-pane active">
                                <form action="{{ route('donations.store') }}" method="POST" id="donationForm">
                                    @csrf
                                    <input type="hidden" name="payment_method" value="mpesa">

                                    <!-- Amount Field -->
                                    <div class="mb-6">
                                        <label for="amount" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Donation Amount (KES)</label>
                                        <div class="relative">
                                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                                <span class="text-gray-500 font-medium">KES</span>
                                            </div>
                                            <input type="number" name="amount" id="amount" 
                                                   class="pl-14 w-full bg-gray-50 dark:bg-gray-700/50 border border-gray-200 dark:border-gray-600 text-gray-900 dark:text-gray-100 text-xl font-bold rounded-xl focus:ring-2 focus:ring-[#197b3b] focus:border-[#197b3b] block p-3.5 transition-all" 
                                                   min="1" placeholder="0.00" required>
                                        </div>
                                        <p class="mt-2 text-xs text-gray-500">Minimum donation amount is KES 1.</p>
                                    </div>

                                    <!-- Phone Number Field -->
                                    <div class="mb-6">
                                        <label for="phone" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">M-Pesa Phone Number</label>
                                        <div class="relative">
                                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                                </svg>
                                            </div>
                                            <input type="text" name="phone" id="phone" 
                                                   class="pl-12 w-full bg-gray-50 dark:bg-gray-700/50 border border-gray-200 dark:border-gray-600 text-gray-900 dark:text-gray-100 text-base font-medium rounded-xl focus:ring-2 focus:ring-[#197b3b] focus:border-[#197b3b] block p-3.5 transition-all" 
                                                   placeholder="2547XXXXXXXX" required>
                                        </div>
                                        <p class="mt-2 text-xs text-gray-500">Ensure this number is registered with M-Pesa. Format: 2547...</p>
                                    </div>

                                    <!-- Purpose Field -->
                                    <div class="mb-8">
                                        <label for="purpose" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Donation Purpose</label>
                                        <div class="relative">
                                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                                </svg>
                                            </div>
                                            <select name="purpose" id="purpose" 
                                                    class="pl-12 w-full bg-gray-50 dark:bg-gray-700/50 border border-gray-200 dark:border-gray-600 text-gray-900 dark:text-gray-100 text-base font-medium rounded-xl focus:ring-2 focus:ring-[#197b3b] focus:border-[#197b3b] block p-3.5 transition-all appearance-none" required>
                                                <option value="" disabled selected>Select where to direct your giving</option>
                                                <option value="tithe">Tithe</option>
                                                <option value="offering">Freewill Offering</option>
                                                <option value="building">Building Fund</option>
                                                <option value="project">Special Project</option>
                                                <option value="charity">Charity / Welfare</option>
                                                <option value="missions">Missions</option>
                                            </select>
                                            <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Submit Button -->
                                    <button type="submit" id="submitBtn" class="w-full bg-gradient-to-r from-[#146c33] to-[#197b3b] hover:from-[#0f4a23] hover:to-[#146c33] text-white font-bold text-lg rounded-xl px-4 py-4 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200 flex items-center justify-center gap-2">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                        </svg>
                                        <span>Donate via M-Pesa</span>
                                    </button>
                                    
                                    <p class="text-center text-xs text-gray-400 mt-4">
                                        By proceeding, you will receive an M-Pesa prompt on the provided phone number.
                                    </p>
                                </form>
                            </div>

                            <!-- Donorbox Tab Pane -->
                            <div id="pane-donorbox" class="tab-pane hidden">
                                <script src="https://donorbox.org/widget.js" paypalExpress="false"></script>
                                <div class="w-full flex justify-center">
                                    <iframe src="{{ env('DONORBOX_URL', 'https://donorbox.org/embed/elck-southern-lake') }}" 
                                            name="donorbox" 
                                            allowpaymentrequest="allowpaymentrequest" 
                                            seamless="seamless" 
                                            frameborder="0" 
                                            scrolling="no" 
                                            height="700px" 
                                            width="100%" 
                                            style="max-width: 500px; min-width: 250px; max-height:none!important"></iframe>
                                </div>
                                <p class="text-center text-xs text-gray-400 mt-4">
                                    Secure international giving provided by Donorbox.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Why We Give -->
        <div class="mt-16">
            <h2 class="text-2xl font-bold text-center text-gray-900 dark:text-white mb-8">Where Your Giving Goes</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Card 1 -->
                <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 text-center hover:shadow-md transition-shadow">
                    <div class="w-14 h-14 mx-auto bg-blue-50 dark:bg-blue-900/20 text-blue-600 dark:text-blue-400 rounded-full flex items-center justify-center mb-4">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    </div>
                    <h3 class="font-bold text-gray-900 dark:text-white mb-2">Building Fund</h3>
                    <p class="text-gray-500 text-sm">Supporting the physical growth, maintenance, and expansion of our church facilities to serve more people.</p>
                </div>
                
                <!-- Card 2 -->
                <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 text-center hover:shadow-md transition-shadow">
                    <div class="w-14 h-14 mx-auto bg-emerald-50 dark:bg-emerald-900/20 text-emerald-600 dark:text-emerald-400 rounded-full flex items-center justify-center mb-4">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    </div>
                    <h3 class="font-bold text-gray-900 dark:text-white mb-2">Community Outreach</h3>
                    <p class="text-gray-500 text-sm">Extending grace by serving the needy, hungry, and vulnerable within our local and wider communities.</p>
                </div>
                
                <!-- Card 3 -->
                <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 text-center hover:shadow-md transition-shadow">
                    <div class="w-14 h-14 mx-auto bg-purple-50 dark:bg-purple-900/20 text-purple-600 dark:text-purple-400 rounded-full flex items-center justify-center mb-4">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3"></path></svg>
                    </div>
                    <h3 class="font-bold text-gray-900 dark:text-white mb-2">Worship & Missions</h3>
                    <p class="text-gray-500 text-sm">Empowering our worship ministry, expanding missions, and spreading the gospel further.</p>
                </div>
            </div>
        </div>

        <!-- Donation History -->
        <div class="mt-16 bg-white dark:bg-gray-800 rounded-3xl shadow-lg border border-gray-100 dark:border-gray-700 p-8">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Your Giving Journey</h2>
            
            @auth
                @if(auth()->user()->donations->count())
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-gray-50 dark:bg-gray-700/50">
                                    <th class="p-4 text-sm font-semibold text-gray-600 dark:text-gray-300 rounded-tl-xl rounded-bl-xl">Amount (KES)</th>
                                    <th class="p-4 text-sm font-semibold text-gray-600 dark:text-gray-300">Purpose</th>
                                    <th class="p-4 text-sm font-semibold text-gray-600 dark:text-gray-300">Status</th>
                                    <th class="p-4 text-sm font-semibold text-gray-600 dark:text-gray-300">Transaction ID</th>
                                    <th class="p-4 text-sm font-semibold text-gray-600 dark:text-gray-300 rounded-tr-xl rounded-br-xl">Date</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 dark:divide-gray-700/50">
                                @foreach(auth()->user()->donations()->latest()->take(10)->get() as $donation)
                                    <tr class="hover:bg-gray-50/50 dark:hover:bg-gray-700/30 transition-colors">
                                        <td class="p-4 font-bold text-gray-900 dark:text-white">{{ number_format($donation->amount, 2) }}</td>
                                        <td class="p-4">
                                            <span class="inline-block px-3 py-1 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 text-xs font-semibold rounded-lg">
                                                {{ ucfirst($donation->purpose) }}
                                            </span>
                                        </td>
                                        <td class="p-4">
                                            @if($donation->status == 'completed')
                                                <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400 text-xs font-bold rounded-lg leading-none">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Completed
                                                </span>
                                            @elseif($donation->status == 'pending')
                                                <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-400 text-xs font-bold rounded-lg leading-none">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span> Pending
                                                </span>
                                            @else
                                                <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400 text-xs font-bold rounded-lg leading-none">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span> Failed
                                                </span>
                                            @endif
                                        </td>
                                        <td class="p-4 text-sm font-mono text-gray-500 dark:text-gray-400">{{ $donation->transaction_code ?? 'Pending' }}</td>
                                        <td class="p-4 text-sm text-gray-500 dark:text-gray-400">{{ $donation->created_at->format('M d Y, H:i') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-10 bg-gray-50 dark:bg-gray-700/20 rounded-2xl border border-dashed border-gray-200 dark:border-gray-700">
                        <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-100 dark:bg-gray-700/50 mb-4">
                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"></path></svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100 mb-2">No History Yet</h3>
                        <p class="text-gray-500 text-sm max-w-sm mx-auto">Your giving history will appear here once you make your first contribution.</p>
                    </div>
                @endif
            @else
                <div class="text-center py-12 bg-gray-50 dark:bg-gray-700/20 rounded-2xl border border-gray-100 dark:border-gray-700">
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-blue-50 dark:bg-blue-900/20 mb-4">
                        <svg class="w-8 h-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100 mb-3">Track Your Giving</h3>
                    <p class="text-gray-500 mb-6 text-sm max-w-sm mx-auto">Log in to view your complete donation history, download statements, and manage your profile.</p>
                    <a href="{{ url('/login') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-gray-900 dark:bg-white text-white dark:text-gray-900 text-sm font-bold rounded-xl hover:shadow-lg hover:-translate-y-0.5 transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path></svg>
                        Log In securely
                    </a>
                </div>
            @endauth
        </div>
    </div>
</main>

@push('scripts')
<script>
    function switchTab(method) {
        // Panes
        document.getElementById('pane-mpesa').classList.add('hidden');
        document.getElementById('pane-donorbox').classList.add('hidden');
        document.getElementById('pane-' + method).classList.remove('hidden');

        // Tabs
        document.getElementById('tab-mpesa').classList.remove('border-[#197b3b]', 'text-[#197b3b]');
        document.getElementById('tab-mpesa').classList.add('border-transparent', 'text-gray-500');
        document.getElementById('tab-donorbox').classList.remove('border-[#197b3b]', 'text-[#197b3b]');
        document.getElementById('tab-donorbox').classList.add('border-transparent', 'text-gray-500');

        document.getElementById('tab-' + method).classList.remove('border-transparent', 'text-gray-500');
        document.getElementById('tab-' + method).classList.add('border-[#197b3b]', 'text-[#197b3b]');
    }

    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('donationForm');
        const phoneInput = document.getElementById('phone');
        const submitBtn = document.getElementById('submitBtn');

        if (phoneInput) {
            // Phone formatter
            phoneInput.addEventListener('input', function(e) {
                let val = e.target.value.replace(/\D/g, '');
                if (val.startsWith('0')) {
                    val = '254' + val.substring(1);
                } else if (val.startsWith('7') || val.startsWith('1')) {
                    val = '254' + val;
                }
                e.target.value = val;
            });
        }

        if (form) {
            // Add loading state on submit
            form.addEventListener('submit', function(e) {
                if (form.checkValidity()) {
                    submitBtn.innerHTML = `
                        <svg class="animate-spin -ml-1 mr-2 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Processing... Please wait
                    `;
                    submitBtn.classList.add('opacity-75', 'cursor-not-allowed');
                    // Allow the form to submit organically
                }
            });
        }
    });
</script>
@endpush
@endsection