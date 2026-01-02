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
        'ministry', // Make sure this is included
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

    // In your MinistryController::subscribe method
public function subscribe(Request $request, Ministry $ministry)
{
    // Debug what's coming in
    \Log::info('Form submission data:', $request->all());
    \Log::info('Ministry ID:', ['id' => $ministry->id]);
    
    // Define different validation rules based on ministry type
    if ($ministry->slug == 'womens-ministry') {
        $rules = [
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'email'      => 'required|email',
            'phone'      => 'nullable|string|max:20',
            'life_stage' => 'required|string|in:Young Adult (18-30),Mother & Family (31-50),Seasoned & Senior (51+)',
            'role'       => 'nullable|string|max:50',
            'interests'  => 'nullable|array',
            'interests.*'=> 'string|max:100',
            'message'    => 'nullable|string|max:1000',
        ];
    } 
    // ADD THIS SECTION FOR CHOIR MINISTRY
    elseif ($ministry->slug == 'worship-and-liturgy-ministry') {
        $rules = [
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'email'      => 'required|email',
            'phone'      => 'nullable|string|max:20',
            'voice_instrument' => 'required|string|in:soprano,alto,tenor,bass,piano,guitar,drums,bass_guitar,other_instrument',
            'choir_group' => 'required|string|in:adult_choir,youth_choir,praise_band,children_choir',
            'role'       => 'nullable|string|max:50',
            'experience' => 'nullable|string|max:1000',
            'interests'  => 'nullable|array',
            'interests.*'=> 'string|max:100',
            'message'    => 'nullable|string|max:1000',
        ];
    }//ovc ministry
    elseif ($ministry->slug == 'orphan-and-vulnerable-children-programs') {
        $rules = [
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'email'      => 'required|email',
            'phone'      => 'nullable|string|max:20',
            'role'       => 'nullable|string|max:50',
            'interests'  => 'nullable|array',
            'interests.*'=> 'string|max:100',
            'message'    => 'nullable|string|max:1000',
        ];
    }
    else {
        // Default validation (for youth ministry, etc.)
        $rules = [
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'email'      => 'required|email',
            'phone'      => 'nullable|string|max:20',
            'age_group'  => 'required|string|in:13-15,16-18,19-25',
            'role'       => 'nullable|string|max:50',
            'interests'  => 'nullable|array',
            'interests.*'=> 'string|max:100',
            'message'    => 'nullable|string|max:1000',
        ];
    }
    
    $validated = $request->validate($rules);
    
    // Check if member already exists with this email
    $member = Member::where('email', $request->email)->first();
    
    if (!$member) {
        // Create new member if doesn't exist
        $memberData = [
            'first_name' => $validated['first_name'],
            'last_name'  => $validated['last_name'],
            'email'      => $validated['email'],
            'phone'      => $validated['phone'] ?? null,
            'joined_at'  => now(),
            'is_active'  => true,
        ];
        
        // For choir ministry, you might want to add gender detection or ask for it
        if ($ministry->slug == 'worship-and-liturgy-ministry
') {
            // You could add logic to detect gender from name or add gender field to form
            $memberData['gender'] = 'Unknown'; // Or add gender field to choir form
        } elseif ($ministry->slug == 'womens-ministry') {
            $memberData['gender'] = 'Female';
        } else {
            $memberData['gender'] = 'Unknown'; // Default for other ministries
        }
        
        $member = Member::create($memberData);
    } else {
        // Update existing member info
        $member->update([
            'first_name' => $validated['first_name'],
            'last_name'  => $validated['last_name'],
            'phone'      => $validated['phone'] ?? $member->phone,
        ]);
    }

    // Check if already a member of this ministry
    $existingMembership = MinistryMember::where('ministry_id', $ministry->id)
        ->where('member_id', $member->id)
        ->first();
    
    if ($existingMembership) {
        if (!$existingMembership->is_active) {
            $existingMembership->update([
                'is_active' => true,
                'role' => $validated['role'] ?? 'Member',
            ]);
            
            return redirect()->route('ministries.show', $ministry)
                ->with('success', 'Welcome back! Your membership has been reactivated.');
        }
        
        return redirect()->route('ministries.show', $ministry)
            ->with('info', 'You are already a member of this ministry.');
    }

    // Create new membership
    $ministryMember = MinistryMember::create([
        'ministry_id' => $ministry->id,
        'member_id'   => $member->id,
        'role'        => $validated['role'] ?? 'Member',
        'joined_at'   => now(),
        'is_active'   => true,
    ]);
    
    // Store additional info as notes
    $notesData = [
        'joined_at' => now()->format('Y-m-d H:i:s'),
    ];
    
    // Ministry-specific data
    if ($ministry->slug == 'womens-ministry') {
        $notesData['life_stage'] = $validated['life_stage'];
    } elseif ($ministry->slug === 'worship-and-liturgy-ministry') {
    $notesData['voice_instrument'] = $validated['voice_instrument'];
    $notesData['choir_group'] = $validated['choir_group'];

    if (!empty($validated['experience'])) {
        $notesData['experience'] = $validated['experience'];
    }
}
else {
        $notesData['age_group'] = $validated['age_group'];
    }
    
    if (!empty($validated['interests'])) {
        $notesData['interests'] = $validated['interests'];
    }
    
    if (!empty($validated['message'])) {
        $notesData['message'] = $validated['message'];
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