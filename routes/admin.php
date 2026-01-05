<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\MemberController;
use App\Http\Controllers\Admin\MinistryController as AdminMinistryController;
use App\Http\Controllers\Admin\EventController as AdminEventController;
use App\Http\Controllers\Admin\GalleryController as AdminGalleryController;
use App\Http\Controllers\Admin\SermonController as AdminSermonController;
use App\Http\Controllers\Admin\DonationController as AdminDonationController;
use App\Http\Controllers\Admin\NewsletterController as AdminNewsletterController; // FIXED: Changed usage to match import

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    
    // Dashboard - FIXED: Changed from 'dashboard' to 'admin.dashboard'
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/chart-data', [DashboardController::class, 'getChartData'])->name('dashboard.chart');
    
    // Users Management
    Route::resource('users', UserController::class);
    // Members Management Routes
Route::prefix('members')->name('members.')->group(function () {
    Route::get('/create', [MemberController::class, 'create'])->name('create');
    Route::post('/', [MemberController::class, 'store'])->name('store');
    Route::get('/{member}', [MemberController::class, 'show'])->name('show');
    Route::get('/{member}/edit', [MemberController::class, 'edit'])->name('edit');
    Route::put('/{member}', [MemberController::class, 'update'])->name('update');
    Route::delete('/{member}', [MemberController::class, 'destroy'])->name('destroy');
});
    
    // Ministries Management
    Route::resource('ministries', AdminMinistryController::class);

    // Sermons Management
    Route::resource('sermons', AdminSermonController::class);
    Route::post('sermons/{sermon}/toggle-publish', [AdminSermonController::class, 'togglePublish'])
         ->name('sermons.toggle-publish');
    
    // Events Management
    Route::resource('events', AdminEventController::class);
    Route::get('events/{event}/registrations', [AdminEventController::class, 'registrations'])
         ->name('events.registrations');
    Route::post('events/{event}/registrations/{registration}/status', [AdminEventController::class, 'updateRegistrationStatus'])
         ->name('events.registrations.status');
    Route::delete('events/{event}/registrations/{registration}', [AdminEventController::class, 'destroyRegistration'])
         ->name('events.registrations.destroy');
    Route::get('events/{event}/registrations/{registration}/details', [AdminEventController::class, 'getRegistrationDetails'])
         ->name('events.registrations.details');
    
    // Gallery Management
    Route::resource('gallery', AdminGalleryController::class);
    
    // Newsletter Management - FIXED: All controller references now use AdminNewsletterController
    Route::prefix('newsletter')->name('newsletter.')->group(function () {
        Route::get('/subscribers', [AdminNewsletterController::class, 'subscribers'])->name('subscribers');
        Route::get('/campaigns', [AdminNewsletterController::class, 'campaigns'])->name('campaigns');
        Route::get('/create', [AdminNewsletterController::class, 'createCampaign'])->name('create');
        Route::post('/', [AdminNewsletterController::class, 'storeCampaign'])->name('store');
        Route::get('/analytics/{campaign}', [AdminNewsletterController::class, 'analytics'])->name('analytics');
        Route::post('/send/{campaign}', [AdminNewsletterController::class, 'sendCampaign'])->name('send');
        
        // Additional routes
        Route::prefix('donations')->name('donations.')->group(function () {
    Route::get('/', function () {
        return view('admin.coming-soon'); // Or redirect elsewhere
    })->name('index');
    // Add other donation routes if needed
});
        Route::post('/{subscriber}/unsubscribe', [AdminNewsletterController::class, 'unsubscribe'])->name('unsubscribe');
        Route::post('/{subscriber}/resubscribe', [AdminNewsletterController::class, 'resubscribe'])->name('resubscribe');
        Route::delete('/subscribers/{subscriber}', [AdminNewsletterController::class, 'destroySubscriber'])->name('subscribers.destroy');
        Route::post('/{campaign}/duplicate', [AdminNewsletterController::class, 'duplicate'])->name('duplicate');
        Route::post('/{campaign}/cancel', [AdminNewsletterController::class, 'cancel'])->name('cancel');
        Route::get('/{campaign}/edit', [AdminNewsletterController::class, 'editCampaign'])->name('edit');
        Route::put('/{campaign}', [AdminNewsletterController::class, 'updateCampaign'])->name('update');
        Route::delete('/{campaign}', [AdminNewsletterController::class, 'destroyCampaign'])->name('destroy');
    });
});