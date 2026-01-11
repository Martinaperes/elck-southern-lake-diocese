<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ministry;
use App\Models\MinistryMember;
use App\Models\Member;
use App\Models\Event;
use App\Models\EventRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MinistryController extends Controller
{
    public function index()
    {
        $ministries = Ministry::withCount(['members' => function($query) {
                $query->where('is_active', true);
            }])
            ->with(['members' => function($query) {
                $query->where('role', 'like', '%leader%')->take(3);
            }])
            ->latest()
            ->paginate(10);
            $allMinistries = Ministry::orderBy('name')->get(); //for dropdown
        
        // Get upcoming events for all ministries
        $upcomingEvents = Event::with('ministry')
            ->where('start_time', '>=', now())
            ->orderBy('start_time')
            ->limit(5)
            ->get();
        
        // Statistics
        $stats = [
            'total_ministries' => Ministry::count(),
            'active_ministries' => Ministry::where('is_active', true)->count(),
            'total_members' => MinistryMember::where('is_active', true)->count(),
            'active_leaders' => MinistryMember::where('role', 'like', '%leader%')->where('is_active', true)->count(),
            'upcoming_events' => $upcomingEvents->count(),
        ];
        
        return view(
    'admin.ministries.index',
    compact('ministries', 'allMinistries', 'stats', 'upcomingEvents')
);
    }
    
    public function create()
    {
        $members = Member::active()->get();
        $galleryImages = $this->getGalleryImages();
        return view('admin.ministries.create', compact('members', 'galleryImages'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:ministries',
            'description' => 'nullable|string',
            'leader_name' => 'nullable|string|max:255',
            'contact_email' => 'nullable|email',
            'meeting_schedule' => 'nullable|string',
            'is_active' => 'boolean',
            'leader_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'image_url' => 'nullable|string', // Changed from 'url' to 'string'
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120', // New field for file upload
        ]);
        
        $ministryData = $request->except(['leader_image', 'image_file']);
        $ministryData['slug'] = \Str::slug($request->name);
        $ministryData['is_active'] = $request->has('is_active');
        
        // Handle leader image upload
        if ($request->hasFile('leader_image')) {
            $path = $request->file('leader_image')->store('ministries/leaders', 'public');
            $ministryData['leader_image'] = $path;
        }
        
        // Handle banner image UPLOAD (new image_file field)
        if ($request->hasFile('image_file')) {
            $bannerPath = $request->file('image_file')->store('ministries/banners', 'public');
            $ministryData['image_url'] = $bannerPath; // Store the uploaded file path
        } 
        // If no file uploaded but text entered, keep the text (could be filename or URL)
        elseif ($request->filled('image_url')) {
            $ministryData['image_url'] = $request->image_url;
        }
        
        $ministry = Ministry::create($ministryData);
        
        return redirect()->route('admin.ministries.show', $ministry)
            ->with('success', 'Ministry created successfully!');
    }
    
    public function show(Ministry $ministry)
    {
        $ministry->load(['members.member', 'events' => function($query) {
            $query->where('start_time', '>=', now())->orderBy('start_time');
        }]);
        
        $members = Member::active()->get();
        $allEvents = Event::where('ministry_id', $ministry->id)
            ->orWhere('is_public', true)
            ->where('start_time', '>=', now())
            ->orderBy('start_time')
            ->get();
        
        return view('admin.ministries.show', compact('ministry', 'members', 'allEvents'));
    }
    
    public function edit(Ministry $ministry)
    {
        $members = Member::active()->get();
        $galleryImages = $this->getGalleryImages();
        return view('admin.ministries.edit', compact('ministry', 'members', 'galleryImages'));
    }
    // View ministry members
// View ministry members
public function members(Ministry $ministry)
{
    // Get ministry members with pagination
    $ministryMembers = $ministry->members()
        ->with('member')
        ->orderBy('role')
        ->orderBy('joined_at', 'desc')
        ->paginate(20);
    
    // Get all available members (not in this ministry)
    $availableMembers = Member::active()
        ->whereDoesntHave('ministries', function($query) use ($ministry) {
            $query->where('ministry_id', $ministry->id);
        })
        ->orderBy('first_name')
        ->get();
    
    // Statistics
    $stats = [
        'totalMembers' => $ministry->members()->count(),
        'activeMembers' => $ministry->members()->where('is_active', true)->count(),
        'leadersCount' => $ministry->members()->where('role', 'like', '%leader%')->count(),
        'newThisMonth' => $ministry->members()
            ->where('joined_at', '>=', now()->subMonth())
            ->count(),
    ];
    
    return view('admin.ministries.members', compact('ministry', 'ministryMembers', 'availableMembers') + $stats);
}
    
    public function update(Request $request, Ministry $ministry)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:ministries,name,' . $ministry->id,
            'description' => 'nullable|string',
            'leader_name' => 'nullable|string|max:255',
            'contact_email' => 'nullable|email',
            'meeting_schedule' => 'nullable|string',
            'is_active' => 'boolean',
            'leader_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'image_url' => 'nullable|string', // Changed from 'url' to 'string'
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ]);
        
        $ministryData = $request->except(['leader_image', 'image_file']);
        $ministryData['is_active'] = $request->has('is_active');
        
        // Handle leader image upload
        if ($request->hasFile('leader_image')) {
            // Delete old image if exists
            if ($ministry->leader_image) {
                Storage::disk('public')->delete($ministry->leader_image);
            }
            
            $path = $request->file('leader_image')->store('ministries/leaders', 'public');
            $ministryData['leader_image'] = $path;
        }
        
        // Handle banner image UPLOAD
        if ($request->hasFile('image_file')) {
            // Delete old uploaded banner if it was a stored file
            if ($ministry->image_url && strpos($ministry->image_url, 'ministries/banners/') !== false) {
                Storage::disk('public')->delete($ministry->image_url);
            }
            
            $bannerPath = $request->file('image_file')->store('ministries/banners', 'public');
            $ministryData['image_url'] = $bannerPath;
        } 
        // If user entered text in image_url field (and didn't upload file)
        elseif ($request->filled('image_url') && !$request->hasFile('image_file')) {
            // Check if they're trying to remove an uploaded file by entering text
            if ($ministry->image_url && strpos($ministry->image_url, 'ministries/banners/') !== false && $request->image_url !== $ministry->image_url) {
                // They had an uploaded file but now entered different text - delete the old file
                Storage::disk('public')->delete($ministry->image_url);
            }
            $ministryData['image_url'] = $request->image_url;
        }
        // If image_url is empty (removing banner)
        elseif (!$request->filled('image_url') && !$request->hasFile('image_file')) {
            // Delete uploaded file if exists
            if ($ministry->image_url && strpos($ministry->image_url, 'ministries/banners/') !== false) {
                Storage::disk('public')->delete($ministry->image_url);
            }
            $ministryData['image_url'] = null;
        }
        
        $ministry->update($ministryData);
        
        return redirect()->route('admin.ministries.show', $ministry)
            ->with('success', 'Ministry updated successfully!');
    }
    
    public function destroy(Ministry $ministry)
    {
        // Delete leader image if exists
        if ($ministry->leader_image) {
            Storage::disk('public')->delete($ministry->leader_image);
        }
        
        // Delete banner image if it's an uploaded file
        if ($ministry->image_url && strpos($ministry->image_url, 'ministries/banners/') !== false) {
            Storage::disk('public')->delete($ministry->image_url);
        }
        
        $ministry->delete();
        
        return redirect()->route('admin.ministries.index')
            ->with('success', 'Ministry deleted successfully!');
    }
    
    // Add member to ministry
   // Update your addMember method in MinistryController
public function addMember(Request $request, Ministry $ministry)
{
    // Debug the incoming request
    \Log::info('Add Member Request:', $request->all());
    
    $request->validate([
        'member_id' => 'required|exists:members,id',
        'role' => 'required|string|max:255',
        'joined_at' => 'nullable|date',
    ]);
    
    \Log::info('Creating ministry member for ministry: ' . $ministry->id . ', member: ' . $request->member_id);
    
    $ministryMember = MinistryMember::updateOrCreate(
        [
            'ministry_id' => $ministry->id,
            'member_id' => $request->member_id,
        ],
        [
            'role' => $request->role,
            'joined_at' => $request->joined_at ?: now(),
            'is_active' => true,
        ]
    );
    
    \Log::info('Ministry member created:', ['id' => $ministryMember->id]);
    
    return back()->with('success', 'Member added to ministry successfully!');
}
    // Remove member from ministry
    public function removeMember(Ministry $ministry, MinistryMember $ministryMember)
    {
        $ministryMember->delete();
        
        return back()->with('success', 'Member removed from ministry successfully!');
    }
    
    // Register ministry for an event
    public function registerForEvent(Request $request, Ministry $ministry)
    {
        $request->validate([
            'event_id' => 'required|exists:events,id',
            'number_of_guests' => 'nullable|integer|min:0',
            'special_requirements' => 'nullable|string',
        ]);
        
        // Get all active ministry members
        $members = $ministry->members()->where('is_active', true)->pluck('member_id');
        
        // Register each member for the event
        foreach ($members as $memberId) {
            EventRegistration::updateOrCreate(
                [
                    'event_id' => $request->event_id,
                    'member_id' => $memberId,
                ],
                [
                    'number_of_guests' => $request->number_of_guests ?? 0,
                    'special_requirements' => $request->special_requirements,
                    'status' => 'registered',
                ]
            );
        }
        
        return back()->with('success', 'Ministry registered for event successfully!');
    }
    
    // View ministry events
    public function events(Ministry $ministry)
    {
        $events = $ministry->events()
            ->withCount('registrations')
            ->latest()
            ->paginate(10);
        
        $upcomingEvents = Event::where('ministry_id', $ministry->id)
            ->where('start_time', '>=', now())
            ->orderBy('start_time')
            ->get();
        
        return view('admin.ministries.events', compact('ministry', 'events', 'upcomingEvents'));
    }
    
    // Update member role in ministry
    public function updateMemberRole(Request $request, Ministry $ministry, MinistryMember $ministryMember)
    {
        $request->validate([
            'role' => 'required|string|max:255',
            'is_active' => 'boolean',
        ]);
        
        $ministryMember->update([
            'role' => $request->role,
            'is_active' => $request->has('is_active'),
        ]);
        
        return back()->with('success', 'Member role updated successfully!');
    }
    
    // Helper method to get gallery images
    private function getGalleryImages()
    {
        $galleryPath = public_path('images/gallery');
        $images = [];
        
        if (is_dir($galleryPath)) {
            $files = scandir($galleryPath);
            foreach ($files as $file) {
                if ($file !== '.' && $file !== '..') {
                    // Check if it's an image file
                    $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                    if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp'])) {
                        $images[] = $file;
                    }
                }
            }
        }
        
        return $images;
    }
}