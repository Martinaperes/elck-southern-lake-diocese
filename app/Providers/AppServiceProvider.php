<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route; // ADD THIS IMPORT
use App\Models\Member;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Explicit route model binding for 'member' parameter
        Route::model('member', Member::class);
        
        // Optional: Custom binding with eager loading
         Route::bind('member', function ($value) {
         return Member::with(['user', 'parish'])
                ->where('id', $value)
                ->firstOrFail();
        });
    }
}