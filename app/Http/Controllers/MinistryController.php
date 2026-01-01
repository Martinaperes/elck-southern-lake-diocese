<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Member;
use App\Models\Ministry;
use App\Models\MinistryMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MinistryController extends Controller
{
    public function index()
    {
        $ministries = Ministry::where('is_active', true)
                            ->orderBy('name')
                            ->get();

        return view('ministries.index', compact('ministries'));
    }

    // Show ministry using slug
    public function show(Ministry $ministry)
{


    $relatedMinistries = Ministry::where('is_active', true)
        ->where('id', '!=', $ministry->id)
        ->inRandomOrder()
        ->limit(3)
        ->get();

    
    $upcomingEvents = Event::where('date', '>=', now())
        ->orderBy('date')
        ->limit(10) // Limit to 10 events to avoid too many
        ->get();
    
    // Check if current user is already a member
    $isMember = false;
    $userEmail = null;
    
    if (auth()->check() && auth()->user()->email) {
        $userEmail = auth()->user()->email;
        $member = Member::where('email', $userEmail)->first();
        
        if ($member) {
            $isMember = MinistryMember::where('ministry_id', $ministry->id)
                ->where('member_id', $member->id)
                ->where('is_active', true)
                ->exists();
        }
    }
    
    // Now log after $isMember is calculated
    \Log::info('Showing ministry', [
        'ministry' => $ministry->slug,
        'auth_user' => auth()->check() ? auth()->user()->email : 'not logged in',
        'isMember_calculated' => $isMember
    ]);

    return view('ministries.show', compact(
        'ministry',
        'relatedMinistries',
        'upcomingEvents', 
        'isMember',
        'userEmail'
    ));
}
    public function subscribeForm(Ministry $ministry)
    {
        return view('ministries.subscribe', compact('ministry'));
    }

    // Member subscription - UPDATED
    public function subscribe(Request $request, Ministry $ministry)
{
    $request->validate([
        'first_name' => 'required|string|max:255',
        'last_name'  => 'required|string|max:255',
        'email'      => 'required|email',
        'phone'      => 'nullable|string|max:20',
        'age_group'  => 'required|string|in:13-15,16-18,19-25',
        'role'       => 'nullable|string|max:50',
        'interests'  => 'nullable|array',
        'interests.*'=> 'string|max:100',
        'message'    => 'nullable|string|max:1000',
    ]);

    // Check if member already exists with this email
    $member = Member::where('email', $request->email)->first();
    
    if (!$member) {
        // Create new member if doesn't exist
        $member = Member::create([
            'first_name' => $request->first_name,
            'last_name'  => $request->last_name,
            'email'      => $request->email,
            'phone'      => $request->phone,
            'joined_at'  => now(),
            'is_active'  => true,
            // Store age group as additional info
            'gender'     => 'Other', // You might want to add a gender field to form
        ]);
    } else {
        // Update existing member info if provided
        $member->first_name = $request->first_name;
        $member->last_name = $request->last_name;
        if ($request->phone) {
            $member->phone = $request->phone;
        }
        $member->save();
    }

    // Check if already a member of this ministry
    $existingMembership = MinistryMember::where('ministry_id', $ministry->id)
        ->where('member_id', $member->id)
        ->first();
    
    if ($existingMembership) {
        // If exists but inactive, reactivate
        if (!$existingMembership->is_active) {
            $existingMembership->update([
                'is_active' => true,
                'role' => $request->role ?? $existingMembership->role,
            ]);
            
            // Store interests in additional info if needed
            if ($request->has('interests')) {
                // You can store this in a separate table or as JSON
                // For now, we'll store as additional note
                $existingMembership->notes = json_encode([
                    'age_group' => $request->age_group,
                    'interests' => $request->interests,
                    'message' => $request->message,
                ]);
                $existingMembership->save();
            }
            
            return redirect()->route('ministries.show', $ministry)
                ->with('success', 'Welcome back! Your membership has been reactivated.');
        }
        
        // If already an active member
        return redirect()->route('ministries.show', $ministry)
            ->with('info', 'You are already a member of this ministry.');
    }

    // Add new membership
    $ministryMember = MinistryMember::create([
        'ministry_id' => $ministry->id,
        'member_id'   => $member->id,
        'role'        => $request->role ?? 'Member',
        'joined_at'   => now(),
        'is_active'   => true,
    ]);
    
    // Store additional info as notes
    $notesData = [
        'age_group' => $request->age_group,
        'joined_at' => now()->format('Y-m-d H:i:s'),
    ];
    
    if ($request->has('interests')) {
        $notesData['interests'] = $request->interests;
    }
    
    if ($request->message) {
        $notesData['message'] = $request->message;
    }
    
    $ministryMember->notes = json_encode($notesData);
    $ministryMember->save();

    return redirect()->route('ministries.show', $ministry)
        ->with('success', 'Congratulations! You have successfully joined ' . $ministry->name . '. Welcome to our community!');
}
    // ✅ ADMIN: Update ministry details (leader image included)
    public function update(Request $request, Ministry $ministry)
    {
        $request->validate([
            'leader_name'  => 'required|string|max:255',
            'leader_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // Handle image upload
        if ($request->hasFile('leader_image')) {
            // Delete old image if it exists
            if ($ministry->leader_image) {
                Storage::disk('public')->delete($ministry->leader_image);
            }

            // Store new image
            $path = $request->file('leader_image')
                            ->store('ministries', 'public');

            $ministry->leader_image = $path;
        }

        $ministry->leader_name = $request->leader_name;
        $ministry->save();

        return redirect()->back()
            ->with('success', 'Ministry updated successfully.');
    }
}