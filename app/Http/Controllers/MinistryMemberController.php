<?php

namespace App\Http\Controllers;

use App\Models\Ministry;
use App\Models\Member;
use Illuminate\Http\Request;

class MinistryMemberController extends Controller
{
    public function index(Ministry $ministry)
    {
        $members = $ministry->members;
        return view('ministries.members.index', compact('ministry', 'members'));
    }

    public function addMember(Request $request, Ministry $ministry)
    {
        $validated = $request->validate([
            'member_id' => 'required|exists:members,id',
        ]);

        $ministry->members()->attach($validated['member_id']);
        return back()->with('success', 'Member added to ministry.');
    }

    public function removeMember(Ministry $ministry, Member $member)
    {
        $ministry->members()->detach($member->id);
        return back()->with('success', 'Member removed from ministry.');
    }
}
