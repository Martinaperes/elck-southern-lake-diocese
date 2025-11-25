<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    HomeController, AboutController, ContactController, GalleryController,
    MinistryController, EventController, EventRegistrationController,MpesaCallbackController,
    SermonController, DonationController, NewsletterController, PageController,ProfileController
};
use App\Http\Controllers\Admin\EventController as AdminEventController;
use App\Http\Controllers\Admin\SermonController as AdminSermonController;

//testing
// Test route - add this at the top
Route::get('/test', function () {
    return response()->json([
        'message' => 'Laravel is working',
        'middleware' => app('router')->getMiddleware()
    ]);
});
//profile controller
Route::middleware('auth')->group(function () {
    // Show Profile
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');

    // Edit Profile
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');

    // Update Profile
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});


//Newsletter route
Route::get('/newsletter', [NewsletterController::class, 'index'])
    ->name('newsletter.index');

Route::post('/newsletter', [NewsletterController::class, 'store'])
    ->name('newsletter.store');
Route::redirect('/newsletter/index', '/newsletter');


// Public Pages
Route::get('/', [PageController::class, 'show'])->defaults('page', 'home')->name('home');
Route::post('/mpesa/callback', [MpesaCallbackController::class, 'handle']);
// Contact
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');

// Gallery
Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery');


// Ministries
Route::get('/ministries', [MinistryController::class, 'index'])->name('ministries.index');
Route::get('/ministries/{slug}', [MinistryController::class, 'show'])->name('ministries.show');
Route::get('/ministries/{ministry:slug}/subscribe', function(App\Models\Ministry $ministry){
    return view('ministries.subscribe', compact('ministry'));
})->name('ministries.subscribe');
Route::post('/ministries/{ministry}/subscribe', [MinistryController::class, 'subscribe'])->name('ministries.subscribe.post');
// Events (User Side)
Route::get('/events', [EventController::class, 'index'])->name('events.index');
Route::get('/events/{event}', [EventController::class, 'show'])->name('events.show');
Route::post('/events/{event}/register', [EventRegistrationController::class, 'store'])
    ->middleware('auth')
    ->name('events.register');
// Sermons


// User sermon side
Route::get('/sermons', [SermonController::class, 'index'])->name('sermons.index');
Route::get('/sermons/{sermon}', [SermonController::class, 'show'])->name('sermons.show');

// Donations / Giving
Route::get('/give', [DonationController::class, 'create'])->name('donations.give');
Route::post('/give', [DonationController::class, 'store'])->name('donations.store');

// Testing / Utilities

Route::get('/test-ministries', function () {
    $ministries = \App\Models\Ministry::where('is_active', true)->get();
    return $ministries->isEmpty()
        ? "No ministries in database - run seeder"
        : view('ministries.index', ['ministries' => $ministries]);
});
// Include auth routes (login, register, etc.)
require __DIR__.'/auth.php';

//admin routes
require __DIR__.'/admin.php';
// Catch-All Page Route (KEEP LAST!)
// Excludes all auth routes so they are handled correctly
Route::get('/{page}', [PageController::class, 'show'])
    ->name('page.show')
    ->where('page', '^(?!login|register|forgot-password|reset-password|verify-email|logout).*$');