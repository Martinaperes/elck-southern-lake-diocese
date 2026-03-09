@extends('admin.layouts.app')

@section('content')
<div class="min-h-screen bg-background-light dark:bg-background-dark p-4">
    
    <!-- Header -->
    <div class="mb-8 flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Settings</h1>
            <p class="text-slate-600 dark:text-slate-400">Configure your system preferences</p>
        </div>
        <div>
            @if(session('success'))
                <div class="bg-emerald-100 border border-emerald-400 text-emerald-700 px-4 py-2 rounded-lg relative mb-4 flex items-center shadow-sm">
                    <span class="material-symbols-outlined mr-2 text-sm">check_circle</span>
                    <span class="text-sm font-medium">{{ session('success') }}</span>
                </div>
            @endif
            @if(session('info'))
                <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-2 rounded-lg relative mb-4 flex items-center shadow-sm">
                    <span class="material-symbols-outlined mr-2 text-sm">info</span>
                    <span class="text-sm font-medium">{{ session('info') }}</span>
                </div>
            @endif
        </div>
    </div>

    <!-- Settings Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        
        <!-- Church Information -->
        <div class="bg-white dark:bg-slate-800 rounded-xl shadow-lg p-6 border border-slate-200 dark:border-slate-700 hover:border-primary/30 transition-all duration-300">
            <h2 class="text-lg font-semibold text-slate-900 dark:text-white mb-4 flex items-center">
                <span class="material-symbols-outlined mr-2 text-primary">church</span>
                Church Information
            </h2>
            <form action="{{ route('admin.settings.church.update') }}" method="POST">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Church Name</label>
                        <input type="text" name="church_name" class="w-full px-4 py-2 border border-slate-300 dark:border-slate-600 rounded-lg dark:bg-slate-700 dark:text-white focus:ring-2 focus:ring-primary focus:border-transparent transition-all" 
                               value="{{ $settings['church_name'] ?? 'E.L.C.K Southern Lake Diocese' }}">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Contact Email</label>
                        <input type="email" name="contact_email" class="w-full px-4 py-2 border border-slate-300 dark:border-slate-600 rounded-lg dark:bg-slate-700 dark:text-white focus:ring-2 focus:ring-primary focus:border-transparent transition-all" 
                               value="{{ $settings['contact_email'] ?? 'contact@southernlake.elck.org' }}">
                    </div>
                    <button type="submit" class="w-full bg-primary hover:bg-primary-dark text-white font-semibold py-2.5 rounded-lg mt-4 transition-all transform active:scale-[0.98] shadow-md shadow-primary/20">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>

        <!-- System Preferences -->
        <div class="bg-white dark:bg-slate-800 rounded-xl shadow-lg p-6 border border-slate-200 dark:border-slate-700 hover:border-primary/30 transition-all duration-300">
            <h2 class="text-lg font-semibold text-slate-900 dark:text-white mb-4 flex items-center">
                <span class="material-symbols-outlined mr-2 text-primary">tune</span>
                System Preferences
            </h2>
            <form action="{{ route('admin.settings.update') }}" method="POST">
                @csrf
                <input type="hidden" name="system_prefs" value="1">
                <div class="space-y-4">
                    <div class="flex items-center justify-between p-3 rounded-lg hover:bg-slate-50 dark:hover:bg-slate-700/50 transition-colors">
                        <div>
                            <p class="font-medium text-slate-900 dark:text-white">Dark Mode</p>
                            <p class="text-xs text-slate-500">Enable dark theme globally</p>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="dark_mode" value="1" class="sr-only peer" {{ ($settings['dark_mode'] ?? '0') == '1' ? 'checked' : '' }}>
                            <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer dark:bg-slate-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-primary"></div>
                        </label>
                    </div>
                    <div class="flex items-center justify-between p-3 rounded-lg hover:bg-slate-50 dark:hover:bg-slate-700/50 transition-colors">
                        <div>
                            <p class="font-medium text-slate-900 dark:text-white">Email Notifications</p>
                            <p class="text-xs text-slate-500">Receive system alerts</p>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="email_notifications" value="1" class="sr-only peer" {{ ($settings['email_notifications'] ?? '0') == '1' ? 'checked' : '' }}>
                            <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer dark:bg-slate-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-primary"></div>
                        </label>
                    </div>
                    <div class="flex items-center justify-between p-3 rounded-lg hover:bg-slate-50 dark:hover:bg-slate-700/50 transition-colors">
                        <div>
                            <p class="font-medium text-slate-900 dark:text-white">Maintenance Mode</p>
                            <p class="text-xs text-slate-500">Take system offline</p>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="maintenance_mode" value="1" class="sr-only peer" {{ ($settings['maintenance_mode'] ?? '0') == '1' ? 'checked' : '' }}>
                            <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer dark:bg-slate-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-primary"></div>
                        </label>
                    </div>
                    <button type="submit" class="w-full bg-slate-800 dark:bg-slate-600 hover:bg-slate-900 text-white font-semibold py-2.5 rounded-lg mt-4 transition-all transform active:scale-[0.98] shadow-md">
                        Update Preferences
                    </button>
                </div>
            </form>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white dark:bg-slate-800 rounded-xl shadow-lg p-6 border border-slate-200 dark:border-slate-700 hover:border-primary/30 transition-all duration-300">
            <h2 class="text-lg font-semibold text-slate-900 dark:text-white mb-4 flex items-center">
                <span class="material-symbols-outlined mr-2 text-primary">bolt</span>
                Quick Actions
            </h2>
            <div class="space-y-3">
                <button class="w-full flex items-center justify-between p-4 rounded-xl border border-slate-200 dark:border-slate-700 hover:bg-slate-50 dark:hover:bg-slate-700 transition-all group">
                    <span class="flex items-center font-medium text-slate-700 dark:text-slate-300">
                        <div class="size-10 rounded-lg bg-orange-100 dark:bg-orange-900/30 flex items-center justify-center mr-4 group-hover:scale-110 transition-transform">
                            <span class="material-symbols-outlined text-orange-600 dark:text-orange-400">backup</span>
                        </div>
                        Create System Backup
                    </span>
                    <span class="material-symbols-outlined text-slate-400">chevron_right</span>
                </button>
                <form action="{{ route('admin.settings.clear-cache') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full flex items-center justify-between p-4 rounded-xl border border-slate-200 dark:border-slate-700 hover:bg-slate-50 dark:hover:bg-slate-700 transition-all group text-left">
                        <span class="flex items-center font-medium text-slate-700 dark:text-slate-300">
                            <div class="size-10 rounded-lg bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center mr-4 group-hover:scale-110 transition-transform">
                                <span class="material-symbols-outlined text-blue-600 dark:text-blue-400">cached</span>
                            </div>
                            Clear System Cache
                        </span>
                        <span class="material-symbols-outlined text-slate-400">chevron_right</span>
                    </button>
                </form>
                <a href="{{ route('admin.settings.logs') }}" class="w-full flex items-center justify-between p-4 rounded-xl border border-slate-200 dark:border-slate-700 hover:bg-slate-50 dark:hover:bg-slate-700 transition-all group">
                    <span class="flex items-center font-medium text-slate-700 dark:text-slate-300">
                        <div class="size-10 rounded-lg bg-emerald-100 dark:bg-emerald-900/30 flex items-center justify-center mr-4 group-hover:scale-110 transition-transform">
                            <span class="material-symbols-outlined text-emerald-600 dark:text-emerald-400">visibility</span>
                        </div>
                        View System Logs
                    </span>
                    <span class="material-symbols-outlined text-slate-400">chevron_right</span>
                </a>
            </div>
        </div>

        <!-- User Account -->
        <div class="bg-white dark:bg-slate-800 rounded-xl shadow-lg p-6 border border-slate-200 dark:border-slate-700 hover:border-primary/30 transition-all duration-300">
            <h2 class="text-lg font-semibold text-slate-900 dark:text-white mb-4 flex items-center">
                <span class="material-symbols-outlined mr-2 text-primary">person</span>
                Your Account
            </h2>
            <div class="space-y-4">
                <div class="flex items-center p-4 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50/50 dark:bg-slate-900/30">
                    <div class="size-14 rounded-full bg-primary/10 flex items-center justify-center ring-2 ring-primary/20">
                        <span class="material-symbols-outlined text-3xl text-primary">person</span>
                    </div>
                    <div class="ml-4">
                        <p class="font-bold text-slate-900 dark:text-white">{{ Auth::user()->name }}</p>
                        <p class="text-sm text-slate-500">{{ Auth::user()->email }}</p>
                        <div class="mt-2 flex gap-3">
                            <a href="{{ route('profile.show') }}" class="text-xs font-semibold text-primary hover:underline">Profile</a>
                            <span class="text-slate-300 dark:text-slate-600">•</span>
                            <a href="{{ route('profile.edit') }}" class="text-xs font-semibold text-primary hover:underline">Security</a>
                        </div>
                    </div>
                </div>
                <div class="pt-4">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full flex items-center justify-center gap-2 text-red-600 hover:text-red-700 font-semibold py-2.5 rounded-lg border border-red-200 hover:border-red-300 hover:bg-red-50 transition-all">
                            <span class="material-symbols-outlined text-sm">logout</span>
                            Logout from System
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection