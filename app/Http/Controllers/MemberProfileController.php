<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;

class MemberProfileController extends Controller
{
    public function show()
    {
        $member = auth()->user()->member;
        return view('members.profile', compact('member'));
    }

    public function update(Request $request)
    {
        $member = auth()->user()->member;

        $validated = $request->validate([
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
            'photo' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('members', 'public');
            $validated['photo'] = $path;
        }

        $member->update($validated);
        return back()->with('success', 'Profile updated successfully.');
    }
}
