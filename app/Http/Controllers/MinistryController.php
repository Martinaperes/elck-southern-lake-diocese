<?php

namespace App\Http\Controllers;
use App\Models\Member;
use App\Models\Ministry;
use Illuminate\Http\Request;

class MinistryController extends Controller
{
    public function index()
    {
        $ministries = Ministry::where('is_active', true)
                            ->orderBy('name')
                            ->get();

        return view('ministries.index', compact('ministries'));
    }

    // Modified to use slug instead of automatic model binding
    public function show($slug)
    {
        // Find the ministry by slug
        $ministry = Ministry::where('slug', $slug)->firstOrFail();

        // Fetch related ministries
        $relatedMinistries = Ministry::where('is_active', true)
                                   ->where('slug', '!=', $slug)
                                   ->inRandomOrder()
                                   ->limit(3)
                                   ->get();

        return view('ministries.show', compact('ministry', 'relatedMinistries'));
    }

    public function subscribe(Request $request, Ministry $ministry)
{
    $request->validate([
    'first_name' => 'required|string|max:255',
    'last_name' => 'required|string|max:255',
    'email' => 'required|email',
    'phone' => 'nullable|string|max:20',
    'role' => 'nullable|string|max:50',
    'message' => 'nullable|string|max:1000',
]);

$member = Member::firstOrCreate(
    ['email' => $request->email],
    [
        'first_name' => $request->first_name,
        'last_name' => $request->last_name,
        'phone' => $request->phone,
    ]
);


    // Attach member to ministry
    $ministry->members()->syncWithoutDetaching([
        $member->id => [
            'role' => $request->role,
            'joined_at' => now(),
            'is_active' => true,
        ]
    ]);

    return redirect()->back()->with('success', 'Thank you for joining ' . $ministry->name . '! You have been added.');
}
}
