<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Newsletter;

class NewsletterController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:newsletters,email',
        ]);

        Newsletter::create(['email' => $request->email]);

        return redirect()->back()->with('success', 'Thank you for subscribing!');
    }

    public function index()
    {
        $subscribers = Newsletter::latest()->get();
        return view('admin.newsletter', compact('subscribers'));
    }
}
