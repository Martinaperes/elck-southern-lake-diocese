<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\{
    HomeController, AboutController, ContactController, GalleryController,
    MinistryController, EventController, EventRegistrationController, MpesaCallbackController,
    SermonController, DonationController, NewsletterController, PageController, ProfileController
};
// Add this at the very top of web.php
Route::get('/test-working', function() {
    return response()->json([
        'status' => 'Laravel is working',
        'time' => now(),
        'ministries_route' => route('ministries.index', [], false)
    ]);
});

// Testing route
Route::get('/test', function () {
    return response()->json([
        'message' => 'Laravel is working',
        'middleware' => app('router')->getMiddleware()
    ]);
});

// Profile routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

// Newsletter routes
Route::get('/newsletter', [NewsletterController::class, 'index'])->name('newsletter.index'); // FIXED: Added .index
Route::post('/newsletter/subscribe', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');
Route::get('/newsletter/confirm/{token}', [NewsletterController::class, 'confirm'])->name('newsletter.confirm');
Route::get('/newsletter/unsubscribe/{token}', [NewsletterController::class, 'unsubscribe'])->name('newsletter.unsubscribe');
Route::get('/newsletter/welcome', [App\Http\Controllers\NewsletterController::class, 'welcome'])->name('newsletter.welcome');


// Public Pages
Route::get('/', [PageController::class, 'show'])->defaults('page', 'home')->name('home');
Route::post('/mpesa/callback', function(Request $request) {
    return response()->json(['status' => 'Callback received']);
});

// Contact
Route::get('/contact', [ContactController::class, 'show'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.submit');

// Gallery
Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery');

// Ministries
Route::prefix('ministries')->name('ministries.')->group(function () {
    Route::get('/', [MinistryController::class, 'index'])->name('index');
    Route::get('/{ministry:slug}', [MinistryController::class, 'show'])->name('show');
    
    // Use the controller method instead of closure
    Route::get('/{ministry:slug}/subscribe', [MinistryController::class, 'subscribeForm'])->name('subscribe');
    
    // Make sure this also uses :slug for consistency
    Route::post('/{ministry:slug}/subscribe', [MinistryController::class, 'subscribe'])->name('subscribe.post');
    
    // Keep the partials route
    Route::get('/partial/{partial}', function ($partial) {
        $viewPath = "ministries.partials.{$partial}";
        if (!view()->exists($viewPath)) {
            abort(404, 'Ministry partial not found');
        }
        return view($viewPath);
    })->name('partials');
});

// Events
Route::get('/events', [EventController::class, 'index'])->name('events.index');
Route::get('/events/{event}', [EventController::class, 'show'])->name('events.show');
Route::get('/events/{event}/modal', [EventController::class, 'modal'])->name('events.modal');
Route::post('/events/{event}/register', [EventRegistrationController::class, 'store'])
    ->middleware('auth')
    ->name('events.register');

// Sermons
Route::get('/sermons', [SermonController::class, 'index'])->name('sermons.index');
Route::get('/sermons/{sermon}', [SermonController::class, 'show'])->name('sermons.show');

// Donations
Route::get('/give', [DonationController::class, 'create'])->name('donations.give');
Route::post('/give', [DonationController::class, 'store'])->name('donations.store');

// Testing / Utilities
Route::get('/test-ministries', function () {
    $ministries = \App\Models\Ministry::where('is_active', true)->get();
    return $ministries->isEmpty()
        ? "No ministries in database - run seeder"
        : view('ministries.index', ['ministries' => $ministries]);
});

// Include auth routes
require __DIR__.'/auth.php';

// Include admin routes (REMOVE the duplicate admin routes from this file)
//require __DIR__.'/admin.php';

// Catch-All Page Route (KEEP LAST!)
Route::get('/{page}', [PageController::class, 'show'])
    ->name('page.show')
    ->where('page', '^(?!login|register|forgot-password|reset-password|verify-email|logout|admin|newsletter|contact|gallery|ministries|events|sermons|give|test|test-ministries|profile).*$');