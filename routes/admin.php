<?php

// use App\Http\Controllers\Admin\DashboardController; // TEMPORARILY DISABLED
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\MinistryController as AdminMinistryController;
use App\Http\Controllers\Admin\EventController as AdminEventController;
use App\Http\Controllers\Admin\GalleryController as AdminGalleryController;
// use App\Http\Controllers\Admin\DonationController as AdminDonationController; // TEMPORARILY DISABLED
use App\Http\Controllers\Admin\SermonController as AdminSermonController;
use App\Http\Controllers\Admin\NewsletterController as AdminNewsletterController;

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    
    // Dashboard
// Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard'); // TEMPORARILY DISABLED
    
    // Users Management
    Route::resource('users', UserController::class);
    
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
    
    // Donations Management
// Route::resource('donations', AdminDonationController::class); // TEMPORARILY DISABLED
    
    
    
    // Newsletter Management (FIXED: No nested groups)
    Route::prefix('newsletter')->name('newsletter.')->group(function () {
        Route::get('/subscribers', [AdminNewsletterAdminController::class, 'subscribers'])->name('subscribers');
        Route::get('/campaigns', [AdminNewsletterAdminController::class, 'campaigns'])->name('campaigns');
        Route::get('/create', [AdminNewsletterAdminController::class, 'createCampaign'])->name('create');
        Route::post('/', [AdminNewsletterAdminController::class, 'storeCampaign'])->name('store');
        Route::get('/analytics/{campaign}', [AdminNewsletterAdminController::class, 'analytics'])->name('analytics');
        Route::post('/send/{campaign}', [AdminNewsletterAdminController::class, 'sendCampaign'])->name('send');
        
        // Add these additional routes
        Route::post('/{subscriber}/unsubscribe', [AdminNewsletterAdminController::class, 'unsubscribe'])->name('unsubscribe');
        Route::post('/{subscriber}/resubscribe', [AdminNewsletterAdminController::class, 'resubscribe'])->name('resubscribe');
        Route::delete('/subscribers/{subscriber}', [AdminNewsletterAdminController::class, 'destroySubscriber'])->name('subscribers.destroy');
        Route::post('/{campaign}/duplicate', [AdminNewsletterAdminController::class, 'duplicate'])->name('duplicate');
        Route::post('/{campaign}/cancel', [AdminNewsletterAdminController::class, 'cancel'])->name('cancel');
        Route::get('/{campaign}/edit', [AdminNewsletterAdminController::class, 'editCampaign'])->name('edit');
        Route::put('/{campaign}', [AdminNewsletterAdminController::class, 'updateCampaign'])->name('update');
        Route::delete('/{campaign}', [AdminNewsletterAdminController::class, 'destroyCampaign'])->name('destroy');
    });
});

