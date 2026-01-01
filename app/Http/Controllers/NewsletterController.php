<?php

namespace App\Http\Controllers;

use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewsletterSubscription;
use App\Mail\NewsletterConfirmation;

class NewsletterController extends Controller
{
    // Show subscription form/page
    public function index()
    {
        return view('newsletter.index');
    }

    // Handle subscription
    public function subscribe(Request $request)
    {
        // First create the validator
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:255',
            'name' => 'nullable|string|max:255',
            'agree_terms' => 'required|accepted'
        ]);

        // Check for validation errors
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Get validated data
        $validated = $validator->validated();

        // Check if already subscribed
        $existing = NewsletterSubscriber::where('email', $validated['email'])->first();

        if ($existing) {
            if ($existing->is_active) {
                return redirect()->back()
                    ->with('warning', 'You are already subscribed to our newsletter.');
            } else {
                // Reactivate subscription
                $existing->update([
                    'is_active' => true,
                    'unsubscribed_at' => null,
                    'parish' => $request->parish // Add parish if provided
                ]);
                
                // Send welcome email
                Mail::to($existing->email)->send(new NewsletterSubscription($existing));
                
                return redirect()->back()
                    ->with('success', 'Your subscription has been reactivated.');
            }
        }

        // Create new subscriber
        $subscriber = NewsletterSubscriber::create([
            'email' => $validated['email'],
            'name' => $validated['name'],
            'parish' => $request->parish,
            'subscribed_at' => now()
        ]);

        // Send confirmation email
        Mail::to($subscriber->email)->send(new NewsletterConfirmation($subscriber));

        return redirect()->route('newsletter.welcome');

    }
    public function welcome()
{
    // Fetch all newsletter content in order
    $sections = \App\Models\NewsletterContent::orderBy('order')->get();

    return view('newsletter.welcome', compact('sections'));
}



    // Confirm subscription via token
    public function confirm($token)
    {
        $subscriber = NewsletterSubscriber::where('subscription_token', $token)->firstOrFail();

        if (!$subscriber->is_active) {
            $subscriber->update(['is_active' => true]);
            
            // Send welcome email after confirmation
            Mail::to($subscriber->email)->send(new NewsletterSubscription($subscriber));
        }

        return view('newsletter.confirmed', compact('subscriber'));
    }

    // Unsubscribe
    public function unsubscribe($token)
    {
        $subscriber = NewsletterSubscriber::where('subscription_token', $token)->firstOrFail();

        if ($subscriber->is_active) {
            $subscriber->update([
                'is_active' => false,
                'unsubscribed_at' => now()
            ]);
        }

        return view('newsletter.unsubscribed', compact('subscriber'));
    }
}