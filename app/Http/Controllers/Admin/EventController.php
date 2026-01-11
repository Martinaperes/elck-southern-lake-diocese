<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Ministry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $query = Event::with(['ministry', 'registrations']);

        // Apply filters
        switch ($request->filter) {
            case 'upcoming':
                $query->where('start_time', '>=', now());
                break;
            case 'past':
                $query->where('start_time', '<', now());
                break;
            case 'public':
                $query->where('is_public', true);
                break;
            case 'private':
                $query->where('is_public', false);
                break;
        }

        $events = $query->latest()->paginate(10);

        // Statistics
        $totalEvents = Event::count();
        $upcomingEvents = Event::where('start_time', '>=', now())->count();
        $publicEvents = Event::where('is_public', true)->count();
        $thisMonthEvents = Event::whereYear('start_time', now()->year)
                               ->whereMonth('start_time', now()->month)
                               ->count();

        return view('admin.events.index', compact(
            'events', 
            'totalEvents', 
            'upcomingEvents', 
            'publicEvents', 
            'thisMonthEvents'
        ));
    }
     public function create()
    {
        $ministries = Ministry::all();
        $eventTypes = [
            'service' => 'Church Service',
            'meeting' => 'Meeting',
            'conference' => 'Conference',
            'workshop' => 'Workshop',
            'other' => 'Other'
        ];

        return view('admin.events.create', compact('ministries', 'eventTypes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_time' => 'required|date',
            'end_time' => 'nullable|date|after:start_time',
            'location' => 'required|string|max:255',
            'event_type' => 'required|in:service,meeting,conference,workshop,other',
            'ministry_id' => 'nullable|exists:ministries,id',
            'is_public' => 'boolean',
            'poster' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120', // 5MB max
        ]);

        $eventData = [
            'title' => $request->title,
            'description' => $request->description,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'location' => $request->location,
            'event_type' => $request->event_type,
            'ministry_id' => $request->ministry_id,
            'is_public' => $request->has('is_public')
        ];

        // Handle poster upload
        if ($request->hasFile('poster')) {
            $posterPath = $request->file('poster')->store('events/posters', 'public');
            $eventData['poster'] = $posterPath;
        }

        Event::create($eventData);

        return redirect()->route('admin.events.index')
            ->with('success', 'Event created successfully!');
    }

    public function edit(Event $event)
{
    $ministries = Ministry::all();
    $eventTypes = [
        'service' => 'Church Service',
        'meeting' => 'Meeting',
        'conference' => 'Conference',
        'workshop' => 'Workshop',
        'other' => 'Other'
    ];

    return view('admin.events.edit', compact('event', 'ministries', 'eventTypes'));
}

    public function update(Request $request, Event $event)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_time' => 'required|date',
            'end_time' => 'nullable|date|after:start_time',
            'location' => 'required|string|max:255',
            'event_type' => 'required|in:service,meeting,conference,workshop,other',
            'ministry_id' => 'nullable|exists:ministries,id',
            'is_public' => 'boolean',
            'poster' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ]);

        $event->title = $request->title;
        $event->description = $request->description;
        $event->start_time = $request->start_time;
        $event->end_time = $request->end_time;
        $event->location = $request->location;
        $event->event_type = $request->event_type;
        $event->ministry_id = $request->ministry_id;
        $event->is_public = $request->has('is_public');

        // Handle poster upload
        if ($request->hasFile('poster')) {
            // Delete old poster if exists
            if ($event->poster) {
                Storage::disk('public')->delete($event->poster);
            }
            
            $posterPath = $request->file('poster')->store('events/posters', 'public');
            $event->poster = $posterPath;
        }

        $event->save();

        return redirect()->route('admin.events.index')
            ->with('success', 'Event updated successfully!');
    }
public function ajaxEdit(Event $event)
{
    try {
        return response()->json([
            'success' => true,
            'event' => [
                'id' => $event->id,
                'title' => $event->title,
                'description' => $event->description,
                'start_time' => $event->start_time,
                'start_time_formatted' => $event->start_time->format('Y-m-d\TH:i'),
                'end_time' => $event->end_time,
                'end_time_formatted' => $event->end_time ? $event->end_time->format('Y-m-d\TH:i') : null,
                'location' => $event->location,
                'event_type' => $event->event_type,
                'poster' => $event->poster,
                'is_public' => $event->is_public,
            ]
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Failed to load event details'
        ], 500);
    }
}

    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()->route('admin.events.index')
            ->with('success', 'Event deleted successfully!');
    }

    // Show event registrations
   public function registrations(Event $event)
{
    $registrations = $event->registrations()
        ->with(['member' => function($query) {
            $query->select('id', 'first_name', 'last_name', 'email', 'phone');
        }])
        ->latest()
        ->paginate(20);

    return view('admin.events.registrations', compact('event', 'registrations'));
}

public function updateRegistrationStatus(Request $request, Event $event, EventRegistration $registration)
{
    $request->validate([
        'status' => 'required|in:registered,confirmed,attended,cancelled'
    ]);

    $registration->update(['status' => $request->status]);

    return back()->with('success', 'Registration status updated successfully!');
}

public function destroyRegistration(Event $event, EventRegistration $registration)
{
    $registration->delete();

    return back()->with('success', 'Registration deleted successfully!');
}
public function getRegistrationDetails(Event $event, EventRegistration $registration)
{
    $registration->load('member');
    return view('admin.events.partials.registration-details', compact('registration'));
}
}
