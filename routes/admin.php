<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MemberController;
use App\Http\Controllers\Admin\MinistryController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\GalleryController as AdminGalleryController;
use App\Http\Controllers\Admin\SermonController as AdminSermonController;
use App\Http\Controllers\Admin\DonationController as AdminDonationController;
use App\Http\Controllers\Admin\NewsletterController as AdminNewsletterController;

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/chart-data', [DashboardController::class, 'getChartData'])->name('dashboard.chart');
    
    // Members Management Routes
    Route::prefix('members')->name('members.')->group(function () {
        Route::get('/', [MemberController::class, 'index'])->name('index');
        Route::get('/create', [MemberController::class, 'create'])->name('create');
        Route::post('/', [MemberController::class, 'store'])->name('store');
        Route::get('/{member}', [MemberController::class, 'show'])->name('show');
        Route::get('/{member}/edit', [MemberController::class, 'edit'])->name('edit');
        Route::put('/{member}', [MemberController::class, 'update'])->name('update');
        Route::delete('/{member}', [MemberController::class, 'destroy'])->name('destroy');
    });
    
    // Ministries Management
    Route::resource('ministries', MinistryController::class);
    Route::post('ministries/{ministry}/add-member', [MinistryController::class, 'addMember'])->name('ministries.add-member');
    Route::delete('ministries/{ministry}/remove-member/{ministryMember}', [MinistryController::class, 'removeMember'])->name('ministries.remove-member');
    Route::post('ministries/{ministry}/register-for-event', [MinistryController::class, 'registerForEvent'])->name('ministries.register-for-event');
    Route::get('ministries/{ministry}/events', [MinistryController::class, 'events'])->name('ministries.events');
    Route::put('ministries/{ministry}/update-role/{ministryMember}', [MinistryController::class, 'updateMemberRole'])->name('ministries.update-role');
    Route::get('ministries/{ministry}/members', [MinistryController::class, 'members'])->name('ministries.members');
    
    // Sermons Management
    Route::prefix('sermons')->name('sermons.')->group(function () {
        Route::get('/', [AdminSermonController::class, 'index'])->name('index');
        Route::get('/create', [AdminSermonController::class, 'create'])->name('create');
        Route::post('/', [AdminSermonController::class, 'store'])->name('store');
        Route::get('/{sermon}', [AdminSermonController::class, 'show'])->name('show');
        Route::get('/{sermon}/edit', [AdminSermonController::class, 'edit'])->name('edit');
        Route::put('/{sermon}', [AdminSermonController::class, 'update'])->name('update');
        Route::delete('/{sermon}', [AdminSermonController::class, 'destroy'])->name('destroy');
        Route::post('/{sermon}/toggle-publish', [AdminSermonController::class, 'togglePublish'])->name('toggle-publish');
        Route::post('/{sermon}/toggle-featured', [AdminSermonController::class, 'toggleFeatured'])->name('toggle-featured');
    });
    
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
    Route::get('events/{event}/ajax-edit', [EventController::class, 'ajaxEdit'])->name('events.ajax-edit');
    
    // Gallery Management
    Route::resource('gallery', AdminGalleryController::class);
    
    // Newsletter Management
    Route::prefix('newsletter')->name('newsletter.')->group(function () {
        Route::get('/subscribers', [AdminNewsletterController::class, 'subscribers'])->name('subscribers');
        Route::get('/campaigns', [AdminNewsletterController::class, 'campaigns'])->name('campaigns');
        Route::get('/create', [AdminNewsletterController::class, 'createCampaign'])->name('create');
        Route::post('/', [AdminNewsletterController::class, 'storeCampaign'])->name('store');
        Route::get('/analytics/{campaign}', [AdminNewsletterController::class, 'analytics'])->name('analytics');
        Route::post('/send/{campaign}', [AdminNewsletterController::class, 'sendCampaign'])->name('send');
        
        // Donations routes
        Route::prefix('donations')->name('donations.')->group(function () {
            Route::get('/', function () {
                return view('admin.coming-soon');
            })->name('index');
        });
        
        // Admin Newsletter Routes
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    // Newsletter Routes
    Route::prefix('newsletter')->name('admin.newsletter.')->group(function () {
        // Campaigns
        Route::get('/campaigns', [NewsletterController::class, 'campaigns'])->name('campaigns');
        Route::get('/create', [NewsletterController::class, 'create'])->name('create');
        Route::post('/store', [NewsletterController::class, 'store'])->name('store');
        Route::get('/{campaign}', [NewsletterController::class, 'show'])->name('show');
        Route::get('/{campaign}/edit', [NewsletterController::class, 'edit'])->name('edit');
        Route::put('/{campaign}/update', [NewsletterController::class, 'update'])->name('update');
        Route::post('/{campaign}/send', [NewsletterController::class, 'send'])->name('send');
        Route::get('/{campaign}/analytics', [NewsletterController::class, 'analytics'])->name('analytics');
        Route::post('/{campaign}/duplicate', [NewsletterController::class, 'duplicate'])->name('duplicate');
        Route::put('/{campaign}/cancel', [NewsletterController::class, 'cancel'])->name('cancel');
        
        // Subscribers
        Route::get('/subscribers', [NewsletterController::class, 'subscribers'])->name('subscribers');
        Route::post('/subscribers/{subscriber}/resubscribe', [NewsletterController::class, 'resubscribe'])->name('resubscribe');
        Route::delete('/subscribers/{subscriber}', [NewsletterController::class, 'destroySubscriber'])->name('destroySubscriber');
    });
});
    });
});