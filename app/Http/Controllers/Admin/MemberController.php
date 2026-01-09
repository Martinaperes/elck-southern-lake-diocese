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
    public function index()
    {
        $members = Member::with(['user', 'parish'])
            ->latest()
            ->paginate(15);
            
        $stats = [
            'total_members' => Member::count(),
            'active_members' => Member::where('is_active', true)->count(),
            'new_this_month' => Member::whereMonth('created_at', now()->month)->count(),
        ];
        
        return view('admin.members.index', compact('members', 'stats'));
    }

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
            'role' => 'required|in:user,admin,pastor,secretary,treasurer,deacon',
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
            'parish_id' => 'nullable|exists:parishes,id',
        ]);

        // Create the User first
        $user = User::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'password' => Hash::make($validated['password']),
        'role' => $validated['role'], // Use the selected role
        'parish_id' => $validated['parish_id'] ?? null,
    ]);

        // Create the Member profile linked to the user
        $member = Member::create([
            'user_id' => $user->id,
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'email' => $validated['email'],
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
            'parish_id' => $validated['parish_id'] ?? null,
            'is_active' => true,
            'joined_at' => now(),
        ]);

        // Generate membership number AFTER saving (when we have an ID)
        $member->membership_number = 'M' . str_pad($member->id, 5, '0', STR_PAD_LEFT);
        $member->save();

        // Log activity
        if (class_exists('App\Models\Activity')) {
            \App\Models\Activity::log('member_added', "New member {$member->first_name} {$member->last_name} was added", $member);
        }

        return redirect()->route('admin.members.show', $member->id)
            ->with('success', "Member {$member->first_name} {$member->last_name} was created successfully!");
    }

    /**
     * Display the specified member.
     */
  public function show(Member $member)
{
    $member->load(['user', 'parish']);
    return view('admin.members.show', compact('member'));
}


    /**
     * Show the form for editing the member.
     */
    public function edit(Member $member)
{
    // Laravel has already found the member for you!
    // Just load the relationships you need:
    $member->load(['user', 'parish']);
    
    $parishes = Parish::active()->get();
    return view('admin.members.edit', compact('member', 'parishes'));
}

    /**
     * Update the member and user.
     */
    public function update(Request $request, Member $member)
    {
       
        
        // Validate the request
        $validated = $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'required|email|unique:members,email,' . $member->id,
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
            'parish_id' => 'nullable|exists:parishes,id',
            'is_active' => 'boolean',
        ]);
        
        // Update member
        $member->update($validated);
        
        // Update user if exists
        if ($member->user) {
            $member->user->update([
                'name' => $validated['first_name'] . ' ' . $validated['last_name'],
                'email' => $validated['email'],
            ]);
        }
        
        return redirect()->route('admin.members.show', $member->id)
            ->with('success', 'Member updated successfully!');
    }

    /**
     * Remove the specified member.
     */
   public function destroy(Member $member)
    {
        
        
        // Delete associated user if exists
        if ($member->user) {
            $member->user->delete();
        }
        
        $member->delete();
        
        return redirect()->route('admin.members.index')
            ->with('success', 'Member deleted successfully!');
    }
}