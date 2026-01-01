<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function show()
    {
        return view('contact');
    }

    public function store(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'inquiry_type' => 'required|string|in:General Inquiry,Prayer Request,Pastoral Care,Donations & Tithes,Events,Membership,Volunteering,Technical Support',
            'message' => 'required|string|min:10|max:2000',
            'newsletter' => 'nullable|boolean'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        // Create notification in database
        $notification = Notification::create([
            'title' => 'New Contact Message: ' . $request->inquiry_type,
            'message' => $request->message,
            'type' => 'contact',
            'email' => $request->email,
            'phone' => $request->phone,
            'inquiry_type' => $request->inquiry_type,
            'data' => [
                'name' => $request->name,
                'newsletter_opt_in' => $request->has('newsletter'),
                'submitted_at' => now()->toDateTimeString(),
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent()
            ]
        ]);

        // You could also send an email notification to admins here
        // Mail::to('admin@elcksld.org')->send(new ContactFormNotification($notification));

        return response()->json([
            'success' => true,
            'message' => 'Thank you for your message! We will get back to you soon.',
            'notification_id' => $notification->id
        ]);
    }
}