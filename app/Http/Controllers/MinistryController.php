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
    }
    // OVC ministry
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
    elseif ($ministry->slug == 'childrens-ministry') {
        $rules = [
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'email'      => 'required|email',
            'phone'      => 'nullable|string|max:20',
            'age_group'  => 'required|string|in:Nursery (0-3),Pre-school (4-5),Children (6-12),Youth (13-15),Young Adults (19-35),Adults (36-59),Seniors (60+)',
            'role'       => 'nullable|string|max:50',
            'interests'  => 'nullable|array',
            'interests.*'=> 'string|max:100',
            'message'    => 'nullable|string|max:1000',
        ];
    }
    elseif ($ministry->slug == 'evangelism-and-tree-planting-ministry') {
        $rules = [
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'email'      => 'required|email',
            'phone'      => 'nullable|string|max:20',
            'experience_level'  => 'required|string|in:Beginner,Some Experience,Experienced,Leader',
            'role'       => 'nullable|string|max:50',
            'interests'  => 'nullable|array',
            'interests.*'=> 'string|max:100',
            'message'    => 'nullable|string|max:1000',
        ];
    }
    elseif ($ministry->slug == 'hiv-and-aids-ministry') {
        $rules = [
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'email'      => 'required|email',
            'phone'      => 'required|string|max:20',
            'participation_type' => 'required|string|in:Volunteer,Supporter,Advocate,Educator,Donor',
            'role'       => 'nullable|string|max:50',
            'interests'  => 'nullable|array',
            'interests.*'=> 'string|max:100',
            'message'    => 'nullable|string|max:1000',
            'confidentiality' => 'required|accepted',
        ];
    }
    elseif ($ministry->slug == 'elck-malaria-campaign') {
    $rules = [
        'first_name' => 'required|string|max:255',
        'last_name'  => 'required|string|max:255',
        'email'      => 'required|email',
        'phone'      => 'nullable|string|max:20',
        'involvement_type' => 'required|string|in:Volunteer,Health Worker,Educator,Donor,Advocate,Coordinator',
        'role'       => 'nullable|string|max:50',
        'interests'  => 'nullable|array',
        'interests.*'=> 'string|max:100',
        'availability' => 'nullable|string|max:50',
        'message'    => 'nullable|string|max:1000',
    ];
}
elseif ($ministry->slug == 'relief-and-development-ministry') {
    $rules = [
        'first_name' => 'required|string|max:255',
        'last_name'  => 'required|string|max:255',
        'email'      => 'required|email',
        'phone'      => 'required|string|max:20',
        'area_of_focus' => 'required|string|in:Emergency Relief,Food Security,WASH,Livelihoods,Health,All Areas',
        'role'       => 'nullable|string|max:50',
        'interests'  => 'nullable|array',
        'interests.*'=> 'string|max:100',
        'availability' => 'required|string|in:Emergency Only,Regular,Seasonal,On-call',
        'experience' => 'nullable|string|max:50',
        'message'    => 'nullable|string|max:1000',
    ];
} elseif ($ministry->slug == 'clergy-and-lay-leader-training') {
            $rules = [
                'first_name' => 'required|string|max:255',
                'last_name'  => 'required|string|max:255',
                'email'      => 'required|email',
                'phone'      => 'required|string|max:20',
                'program'    => 'required|string|in:Diploma in Theology (DTh),Certificate in Evangelistic Training (CET),Continuing Education,Undecided',
                'education'  => 'required|string|in:High School,Certificate,Diploma,Bachelor\'s Degree,Master\'s Degree,Other',
                'current_role' => 'nullable|string|max:100',
                'years_in_ministry' => 'nullable|string|in:0-2,3-5,6-10,10+',
                'denomination' => 'required|string|max:100',
                'interests'   => 'nullable|array',
                'interests.*' => 'string|max:100',
                'calling_testimony' => 'required|string|min:100|max:2000',
                'financial_assistance' => 'required|string|in:Yes,No,Undecided',
            ];
        }
        elseif ($ministry->slug == 'mens-ministry') {
    $rules = [
        'first_name' => 'required|string|max:255',
        'last_name'  => 'required|string|max:255',
        'email'      => 'required|email',
        'phone'      => 'nullable|string|max:20',
        'age_group'  => 'required|string|in:18-25,26-35,36-50,51-65,66+',
        'marital_status' => 'nullable|string|in:Single,Married,Divorced,Widowed',
        'occupation' => 'nullable|string|max:100',
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
        if ($ministry->slug == 'worship-and-liturgy-ministry') {
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
    
    // Ministry-specific data - THIS IS WHERE THE ISSUE WAS
    if ($ministry->slug == 'womens-ministry') {
        $notesData['life_stage'] = $validated['life_stage'];
    } 
    elseif ($ministry->slug == 'worship-and-liturgy-ministry') {
        $notesData['voice_instrument'] = $validated['voice_instrument'];
        $notesData['choir_group'] = $validated['choir_group'];

        if (!empty($validated['experience'])) {
            $notesData['experience'] = $validated['experience'];
        }
    }
    elseif ($ministry->slug == 'orphan-and-vulnerable-children-programs') {
        // No specific data for OVC ministry
    }
    elseif ($ministry->slug == 'childrens-ministry') {
        $notesData['age_group'] = $validated['age_group'];
    }
    elseif ($ministry->slug == 'evangelism-and-tree-planting-ministry') {
        $notesData['experience_level'] = $validated['experience_level'];
    }
    elseif ($ministry->slug == 'hiv-and-aids-ministry') {
        $notesData['participation_type'] = $validated['participation_type'];
        $notesData['confidentiality_agreed'] = true;
    }
    elseif ($ministry->slug == 'elck-malaria-campaign') {
    $notesData['involvement_type'] = $validated['involvement_type'];
    if (!empty($validated['availability'])) {
        $notesData['availability'] = $validated['availability'];
    }
}elseif ($ministry->slug == 'relief-and-development-ministry') {
    $notesData['area_of_focus'] = $validated['area_of_focus'];
    $notesData['availability'] = $validated['availability'];
    if (!empty($validated['experience'])) {
        $notesData['experience'] = $validated['experience'];
    }
}elseif ($ministry->slug == 'clergy-and-lay-leader-training') {
            $notesData['program'] = $validated['program'];
            $notesData['education'] = $validated['education'];
            $notesData['denomination'] = $validated['denomination'];
            $notesData['calling_testimony'] = $validated['calling_testimony'];
            $notesData['financial_assistance'] = $validated['financial_assistance'];
            
            if (!empty($validated['current_role'])) {
                $notesData['current_role'] = $validated['current_role'];
            }
            if (!empty($validated['years_in_ministry'])) {
                $notesData['years_in_ministry'] = $validated['years_in_ministry'];
            }
        }
        elseif ($ministry->slug == 'mens-ministry') {
    $notesData['age_group'] = $validated['age_group'];
    
    if (!empty($validated['marital_status'])) {
        $notesData['marital_status'] = $validated['marital_status'];
    }
    if (!empty($validated['occupation'])) {
        $notesData['occupation'] = $validated['occupation'];
    }
}
    elseif ($ministry->slug == 'youth-ministry') {
        $notesData['age_group'] = $validated['age_group'];
    }
    else {
        // Default for other ministries
        if (isset($validated['age_group'])) {
            $notesData['age_group'] = $validated['age_group'];
        }
    }
    
    if (!empty($validated['interests'])) {
        $notesData['interests'] = $validated['interests'];
    }
    
    if (!empty($validated['message'])) {
        $notesData['message'] = $validated['message'];
    }
    
    // Encode and save the notes
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