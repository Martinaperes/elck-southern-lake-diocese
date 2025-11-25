<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\User;
use App\Models\Event;
use App\Models\Ministry;
use App\Models\Donation;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        // Share sidebar counts with admin layout
        View::composer('admin.layouts.app', function ($view) {
            $view->with('sidebarCounts', [
                'users' => User::count(),
                'events' => Event::whereMonth('date', now()->month)->count(),
                'ministries' => Ministry::count(),
                'donations' => Donation::whereMonth('created_at', now()->month)->sum('amount'),
            ]);
        });
    }
}
