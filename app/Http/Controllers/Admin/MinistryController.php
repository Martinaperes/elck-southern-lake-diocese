<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ministry;
use App\Models\MinistryMember;
use App\Models\Member;
use App\Models\Event;
use App\Models\EventRegistration;
use App\Http\Requests\Admin\MinistryRequest;
use App\Traits\FileUploadTrait;
use App\Services\MinistryService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MinistryController extends Controller
{
    use FileUploadTrait;

    protected $ministryService;

    public function __construct(MinistryService $ministryService)
    {
        $this->ministryService = $ministryService;
    }

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
            
        $allMinistries = Ministry::orderBy('name')->get();
        
        $upcomingEvents = Event::with('ministry')
            ->where('start_time', '>=', now())
            ->orderBy('start_time')
            ->limit(5)
            ->get();
        
        $stats = [
            'total_ministries' => Ministry::count(),
            'active_ministries' => Ministry::where('is_active', true)->count(),
            'total_members' => MinistryMember::where('is_active', true)->count(),
            'active_leaders' => MinistryMember::where('role', 'like', '%leader%')->where('is_active', true)->count(),
            'upcoming_events' => $upcomingEvents->count(),
        ];
        
        return view('admin.ministries.index', compact('ministries', 'allMinistries', 'stats', 'upcomingEvents'));
    }
    
    public function create()
    {
        $members = Member::active()->get();
        $galleryImages = $this->getGalleryImages();
        return view('admin.ministries.create', compact('members', 'galleryImages'));
    }
    
    public function store(MinistryRequest $request)
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($request->name);
        $data['is_active'] = $request->has('is_active');
        
        if ($request->hasFile('leader_image')) {
            $data['leader_image'] = $this->uploadImage($request->file('leader_image'), 'ministries/leaders');
        }
        
        if ($request->hasFile('image_file')) {
            $data['image_url'] = $this->uploadImage($request->file('image_file'), 'ministries/banners');
        } elseif ($request->filled('image_url')) {
            $data['image_url'] = $request->image_url;
        }
        
        $ministry = Ministry::create($data);
        
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

    public function members(Ministry $ministry)
    {
        $ministryMembers = $ministry->members()
            ->with('member')
            ->orderBy('role')
            ->orderBy('joined_at', 'desc')
            ->paginate(20);
        
        $availableMembers = Member::active()
            ->whereDoesntHave('ministries', fn($q) => $q->where('ministry_id', $ministry->id))
            ->orderBy('first_name')
            ->get();
        
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
    
    public function update(MinistryRequest $request, Ministry $ministry)
    {
        $data = $request->validated();
        $data['is_active'] = $request->has('is_active');
        
        if ($request->hasFile('leader_image')) {
            $data['leader_image'] = $this->uploadImage($request->file('leader_image'), 'ministries/leaders', $ministry->leader_image);
        }
        
        if ($request->hasFile('image_file')) {
            // Only delete if it's a stored file path
            $oldPoster = (Str::contains($ministry->image_url, 'ministries/banners/')) ? $ministry->image_url : null;
            $data['image_url'] = $this->uploadImage($request->file('image_file'), 'ministries/banners', $oldPoster);
        } elseif ($request->filled('image_url')) {
             if ($ministry->image_url && Str::contains($ministry->image_url, 'ministries/banners/') && $request->image_url !== $ministry->image_url) {
                $this->deleteFile($ministry->image_url);
            }
            $data['image_url'] = $request->image_url;
        } elseif (!$request->filled('image_url')) {
            if ($ministry->image_url && Str::contains($ministry->image_url, 'ministries/banners/')) {
                $this->deleteFile($ministry->image_url);
            }
            $data['image_url'] = null;
        }
        
        $ministry->update($data);
        
        return redirect()->route('admin.ministries.show', $ministry)
            ->with('success', 'Ministry updated successfully!');
    }
    
    public function destroy(Ministry $ministry)
    {
        $this->deleteFile($ministry->leader_image);
        
        if ($ministry->image_url && Str::contains($ministry->image_url, 'ministries/banners/')) {
            $this->deleteFile($ministry->image_url);
        }
        
        $ministry->delete();
        
        return redirect()->route('admin.ministries.index')
            ->with('success', 'Ministry deleted successfully!');
    }
    
    public function addMember(Request $request, Ministry $ministry)
    {
        $request->validate([
            'member_id' => 'required|exists:members,id',
            'role' => 'required|string|max:255',
            'joined_at' => 'nullable|date',
        ]);
        
        $member = Member::findOrFail($request->member_id);
        $this->ministryService->addMemberToMinistry($member, $ministry, $request->only('role', 'joined_at'));
        
        return back()->with('success', 'Member added to ministry successfully!');
    }

    public function removeMember(Ministry $ministry, MinistryMember $ministryMember)
    {
        $ministryMember->delete();
        return back()->with('success', 'Member removed from ministry successfully!');
    }
    
    public function registerForEvent(Request $request, Ministry $ministry)
    {
        $request->validate([
            'event_id' => 'required|exists:events,id',
            'number_of_guests' => 'nullable|integer|min:0',
            'special_requirements' => 'nullable|string',
        ]);
        
        $members = $ministry->members()->where('is_active', true)->pluck('member_id');
        
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
    
    private function getGalleryImages()
    {
        $galleryPath = public_path('images/gallery');
        $images = [];
        
        if (is_dir($galleryPath)) {
            $files = scandir($galleryPath);
            foreach ($files as $file) {
                if ($file !== '.' && $file !== '..') {
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