<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\MinistryController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\DonationController;
use App\Http\Controllers\Admin\SermonController;
use Illuminate\Support\Facades\Route;

// Public routes (if any)
Route::get('/sermons', [App\Http\Controllers\SermonController::class, 'index'])->name('sermons.index');
Route::get('/sermons/{sermon}', [App\Http\Controllers\SermonController::class, 'show'])->name('sermons.show');

// Admin Routes Group
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Users Management
    Route::resource('users', UserController::class);
    
    // Ministries Management
    Route::resource('ministries', MinistryController::class);

    // Sermons Management
    Route::resource('sermons', SermonController::class);
    Route::post('sermons/{sermon}/toggle-publish', [SermonController::class, 'togglePublish'])
         ->name('sermons.toggle-publish');
    
    // Events Management
    Route::resource('events', EventController::class);
    Route::get('events/{event}/registrations', [EventController::class, 'registrations'])
         ->name('events.registrations');
    Route::post('events/{event}/registrations/{registration}/status', [EventController::class, 'updateRegistrationStatus'])
         ->name('events.registrations.status');
    Route::delete('events/{event}/registrations/{registration}', [EventController::class, 'destroyRegistration'])
         ->name('events.registrations.destroy');
    Route::get('events/{event}/registrations/{registration}/details', [EventController::class, 'getRegistrationDetails'])
         ->name('events.registrations.details');
    
    // Gallery Management
    Route::resource('gallery', GalleryController::class);
    
    // Donations Management
    Route::resource('donations', DonationController::class);
    
    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
});
