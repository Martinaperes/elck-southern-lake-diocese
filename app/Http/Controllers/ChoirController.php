<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\Ministry;
use App\Models\MinistryMember;

class ChoirController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'first_name'       => 'required|string|max:255',
            'last_name'        => 'required|string|max:255',
            'email'            => 'required|email|max:255',
            'phone'            => 'nullable|string|max:20',
            'voice_instrument' => 'nullable|string|max:50',
            'choir_group'      => 'nullable|string|max:50',
            'experience'       => 'nullable|string',
            'interests'        => 'nullable|array',
        ]);

        // 1️⃣ Check if member already exists
        $member = Member::firstOrCreate(
            ['email' => $request->email],
            [
                'first_name' => $request->first_name,
                'last_name'  => $request->last_name,
                'phone'      => $request->phone,
                'joined_at'  => now(),
                'is_active'  => true, // set false if admin approval is needed
            ]
        );

        // 2️⃣ Get the Music Ministry
        $musicMinistry = Ministry::where('name', 'Music Ministry')->firstOrFail();

        // 3️⃣ Check if already in MinistryMember
        $alreadyMember = MinistryMember::where('member_id', $member->id)
                                       ->where('ministry_id', $musicMinistry->id)
                                       ->exists();

        if (!$alreadyMember) {
            MinistryMember::create([
                'member_id'  => $member->id,
                'ministry_id'=> $musicMinistry->id,
                'role'       => $request->voice_instrument ?? 'Member',
                'joined_at'  => now(),
                'is_active'  => true, // or false if pending admin approval
            ]);
        }

        return redirect()->back()->with('success', 'Thank you! Your registration to the Music Ministry was successful.');
    }
}
