<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Member;
use App\Models\Parish;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class MemberController extends Controller
{
    /**
     * Display the member creation form.
     */
    public function create()
    {
        $parishes = Parish::active()->get();
        return view('admin.members.create', compact('parishes'));
    }

    /**
     * Store a newly created member and user.
     */
    public function store(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            // User fields
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            
            // Member fields
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'date_of_birth' => 'nullable|date',
            'gender' => ['nullable', Rule::in(['male', 'female', 'other'])],
            'marital_status' => ['nullable', Rule::in(['single', 'married', 'divorced', 'widowed'])],
            'baptism_date' => 'nullable|date',
            'confirmation_date' => 'nullable|date',
            'home_congregation' => 'nullable|string|max:200',
            'emergency_contact_name' => 'nullable|string|max:100',
            'emergency_contact_phone' => 'nullable|string|max:20',
            'parish_id' => $validated['parish_id'] ?? null,
        ]);
         $member->membership_number = 'M' . str_pad($member->id, 5, '0', STR_PAD_LEFT);
    $member->save();

        // Create the User first
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'member', // Default role for new members
            'parish_id' => $validated['parish_id'] ?? null,
        ]);

        // Create the Member profile linked to the user
        $member = $user->createMemberProfile([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'phone' => $validated['phone'] ?? null,
            'address' => $validated['address'] ?? null,
            'date_of_birth' => $validated['date_of_birth'] ?? null,
            'gender' => $validated['gender'] ?? null,
            'marital_status' => $validated['marital_status'] ?? null,
            'baptism_date' => $validated['baptism_date'] ?? null,
            'confirmation_date' => $validated['confirmation_date'] ?? null,
            'home_congregation' => $validated['home_congregation'] ?? null,
            'emergency_contact_name' => $validated['emergency_contact_name'] ?? null,
            'emergency_contact_phone' => $validated['emergency_contact_phone'] ?? null,
        ]);

        // Log activity (if you have Activity model)
        if (class_exists('App\Models\Activity')) {
            \App\Models\Activity::log('member_added', "New member {$member->full_name} was added", $member);
        }

        // Send welcome email (optional)
        // $user->sendEmailVerificationNotification();

        return redirect()->route('admin.members.show', $member)
            ->with('success', "Member {$member->full_name} was created successfully!");
    }

    /**
     * Display the specified member.
     */
    public function show(Member $member)
    {
        return view('admin.members.show', compact('member'));
    }

    /**
     * Show the form for editing the member.
     */
    public function edit(Member $member)
    {
        $parishes = Parish::active()->get();
        return view('admin.members.edit', compact('member', 'parishes'));
    }

    /**
     * Update the member and user.
     */
    public function update(Request $request, Member $member)
    {
        // Update logic here (similar to store but with updates)
        // This would update both user and member records
    }
}