<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Member;

class ProfileController extends Controller
{
    // Show the profile page
   public function show()
{
    $user = Auth::user();
    $member = $user->member;

    // If first-time user (no member record), redirect to edit
    if (!$member || !$member->first_name) {
        return redirect()->route('profile.edit');
    }

    return view('profile.show', compact('user', 'member'));
}

public function edit()
{
    $user = Auth::user();
    $member = $user->member;

    // Create member record if it doesn't exist
    if (!$member) {
        $member = $user->member()->create([]);
    }

    return view('profile.edit', compact('user', 'member'));
}

public function update(Request $request)
{
    $user = Auth::user();
    $member = $user->member;

    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'first_name' => 'nullable|string|max:255',
        'last_name' => 'nullable|string|max:255',
        'phone' => 'nullable|string|max:20',
        'address' => 'nullable|string|max:255',
        'date_of_birth' => 'nullable|date',
        'gender' => 'nullable|string',
        'baptism_date' => 'nullable|date',
        'confirmation_date' => 'nullable|date',
        'home_congregation' => 'nullable|string|max:255',
        'emergency_contact_name' => 'nullable|string|max:255',
        'emergency_contact_phone' => 'nullable|string|max:20',
        'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Update User name
    $user->name = $validated['name'];
    $user->save();

    // Update member fields
    $member->fill($validated);

    // Handle photo upload
    if ($request->hasFile('photo')) {
        if ($member->photo) {
            Storage::disk('public')->delete($member->photo);
        }
        $path = $request->file('photo')->store('profile_pictures', 'public');
        $member->photo = $path;
    }

    $member->save();

    return redirect()->route('profile.show')->with('success', 'Profile updated successfully!');
}


}
