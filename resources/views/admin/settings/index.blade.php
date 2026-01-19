@extends('admin.layouts.app')

@section('content')
<div class="min-h-screen bg-background-light dark:bg-background-dark p-4">
    
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Settings</h1>
        <p class="text-slate-600 dark:text-slate-400">Configure your system preferences</p>
    </div>

    <!-- Settings Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        
        <!-- Church Information -->
        <div class="bg-white dark:bg-slate-800 rounded-xl shadow-lg p-6">
            <h2 class="text-lg font-semibold text-slate-900 dark:text-white mb-4 flex items-center">
                <span class="material-symbols-outlined mr-2">church</span>
                Church Information
            </h2>
            <form>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm text-slate-600 dark:text-slate-400 mb-1">Church Name</label>
                        <input type="text" class="w-full px-4 py-2 border rounded-lg" 
                               value="E.L.C.K Southern Lake Diocese">
                    </div>
                    <div>
                        <label class="block text-sm text-slate-600 dark:text-slate-400 mb-1">Contact Email</label>
                        <input type="email" class="w-full px-4 py-2 border rounded-lg" 
                               value="contact@southernlake.elck.org">
                    </div>
                    <button class="w-full bg-primary text-white py-2 rounded-lg mt-4">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>

        <!-- System Preferences -->
        <div class="bg-white dark:bg-slate-800 rounded-xl shadow-lg p-6">
            <h2 class="text-lg font-semibold text-slate-900 dark:text-white mb-4 flex items-center">
                <span class="material-symbols-outlined mr-2">tune</span>
                System Preferences
            </h2>
            <div class="space-y-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="font-medium">Dark Mode</p>
                        <p class="text-sm text-slate-500">Enable dark theme</p>
                    </div>
                    <input type="checkbox" class="toggle" checked>
                </div>
                <div class="flex items-center justify-between">
                    <div>
                        <p class="font-medium">Email Notifications</p>
                        <p class="text-sm text-slate-500">Receive system alerts</p>
                    </div>
                    <input type="checkbox" class="toggle" checked>
                </div>
                <div class="flex items-center justify-between">
                    <div>
                        <p class="font-medium">Maintenance Mode</p>
                        <p class="text-sm text-slate-500">Take system offline</p>
                    </div>
                    <input type="checkbox" class="toggle">
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white dark:bg-slate-800 rounded-xl shadow-lg p-6">
            <h2 class="text-lg font-semibold text-slate-900 dark:text-white mb-4 flex items-center">
                <span class="material-symbols-outlined mr-2">bolt</span>
                Quick Actions
            </h2>
            <div class="space-y-3">
                <button class="w-full flex items-center justify-between p-3 rounded-lg border hover:bg-slate-50">
                    <span class="flex items-center">
                        <span class="material-symbols-outlined mr-3">backup</span>
                        Create System Backup
                    </span>
                    <span class="material-symbols-outlined">chevron_right</span>
                </button>
                <button class="w-full flex items-center justify-between p-3 rounded-lg border hover:bg-slate-50">
                    <span class="flex items-center">
                        <span class="material-symbols-outlined mr-3">cached</span>
                        Clear Cache
                    </span>
                    <span class="material-symbols-outlined">chevron_right</span>
                </button>
                <button class="w-full flex items-center justify-between p-3 rounded-lg border hover:bg-slate-50">
                    <span class="flex items-center">
                        <span class="material-symbols-outlined mr-3">visibility</span>
                        View System Logs
                    </span>
                    <span class="material-symbols-outlined">chevron_right</span>
                </button>
            </div>
        </div>

        <!-- User Account -->
        <div class="bg-white dark:bg-slate-800 rounded-xl shadow-lg p-6">
            <h2 class="text-lg font-semibold text-slate-900 dark:text-white mb-4 flex items-center">
                <span class="material-symbols-outlined mr-2">person</span>
                Your Account
            </h2>
            <div class="space-y-4">
                <div class="flex items-center space-x-4">
                    <div class="w-16 h-16 rounded-full bg-primary/10 flex items-center justify-center">
                        <span class="material-symbols-outlined text-2xl text-primary">person</span>
                    </div>
                    <div>
                        <p class="font-bold">Admin User</p>
                        <p class="text-sm text-slate-500">admin@elck.org</p>
                        <a href="#" class="text-sm text-primary hover:underline">Change Password</a>
                    </div>
                </div>
                <div class="pt-4 border-t">
                    <a href="#" class="block text-center text-red-600 hover:text-red-700">
                        <span class="material-symbols-outlined align-middle">logout</span>
                        Logout
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection