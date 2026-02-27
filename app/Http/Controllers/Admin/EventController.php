<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Ministry;
use App\Models\EventRegistration;
use App\Http\Requests\Admin\EventRequest;
use App\Traits\FileUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class EventController extends Controller
{
    use FileUploadTrait;

    public function index(Request $request)
    {
        $query = Event::with(['ministry']);
        
        // Month/Year navigation
        $currentMonth = (int) $request->get('month', now()->month);
        $currentYear = (int) $request->get('year', now()->year);
        $selectedDate = now()->setYear($currentYear)->setMonth($currentMonth)->startOfMonth();
        
        // Calendar month events
        $monthEvents = Event::whereYear('start_time', $selectedDate->year)
            ->whereMonth('start_time', $selectedDate->month)
            ->orderBy('start_time')
            ->get();

        // Apply filters
        switch ($request->filter) {
            case 'upcoming': $query->upcoming(); break;
            case 'past': $query->where('start_time', '<', now()); break;
            case 'public': $query->public(); break;
            case 'private': $query->where('is_public', false); break;
        }

        $events = $query->latest()->paginate(10);

        // Sidebar / Statistics
        $totalEvents = Event::count();
        $upcomingEventsCount = Event::upcoming()->count();
        $publicEventsCount = Event::public()->count();
        $thisMonthEventsCount = Event::whereYear('start_time', now()->year)
            ->whereMonth('start_time', now()->month)
            ->count();

        $allEvents = Event::orderBy('start_time', 'desc')->limit(50)->get();

        return view('admin.events.index', [
            'events' => $events,
            'totalEvents' => $totalEvents,
            'upcomingEvents' => $upcomingEventsCount,
            'publicEvents' => $publicEventsCount,
            'thisMonthEvents' => $thisMonthEventsCount,
            'monthEvents' => $monthEvents,
            'selectedDate' => $selectedDate,
            'allEvents' => $allEvents,
            'today' => now(),
        ]);
    }

    public function create()
    {
        $ministries = Ministry::all();
        $eventTypes = $this->getEventTypes();
        return view('admin.events.create', compact('ministries', 'eventTypes'));
    }

    public function store(EventRequest $request)
    {
        try {
            $data = $request->validated();
            $data['start_time'] = "{$request->start_date} {$request->start_time}";
            
            if ($request->filled('end_date') && $request->filled('end_time')) {
                 $data['end_time'] = "{$request->end_date} {$request->end_time}";
                 if (strtotime($data['end_time']) <= strtotime($data['start_time'])) {
                    return back()->withInput()->withErrors(['end_time' => 'End time must be after start time']);
                 }
            }

            if ($request->hasFile('poster')) {
                $data['poster'] = $this->uploadImage($request->file('poster'), 'events/posters');
            }

            Event::create($data);
            return redirect()->route('admin.events.index')->with('success', 'Event created successfully!');
        } catch (\Exception $e) {
            Log::error("Event creation failed: {$e->getMessage()}");
            return back()->withInput()->with('error', "Error creating event: {$e->getMessage()}");
        }
    }

    public function edit(Event $event)
    {
        $ministries = Ministry::all();
        $eventTypes = $this->getEventTypes();
        return view('admin.events.edit', compact('event', 'ministries', 'eventTypes'));
    }

    public function update(EventRequest $request, Event $event)
    {
        try {
            $data = $request->validated();
            $data['start_time'] = "{$request->start_date} {$request->start_time}";
            $data['end_time'] = ($request->filled('end_date') && $request->filled('end_time')) 
                ? "{$request->end_date} {$request->end_time}" : null;

            if ($data['end_time'] && strtotime($data['end_time']) <= strtotime($data['start_time'])) {
                return back()->withInput()->withErrors(['end_time' => 'End time must be after start time']);
            }

            if ($request->hasFile('poster')) {
                $data['poster'] = $this->uploadImage($request->file('poster'), 'events/posters', $event->poster);
            }

            $event->update($data);
            return redirect()->route('admin.events.index')->with('success', 'Event updated successfully!');
        } catch (\Exception $e) {
            Log::error("Event update failed: {$e->getMessage()}");
            return back()->withInput()->with('error', "Error updating event: {$e->getMessage()}");
        }
    }

    public function destroy(Event $event)
    {
        $this->deleteFile($event->poster);
        $event->delete();
        return redirect()->route('admin.events.index')->with('success', 'Event deleted successfully!');
    }

    public function registrations(Event $event)
    {
        $registrations = $event->registrations()
            ->with(['member:id,first_name,last_name,email,phone'])
            ->latest()
            ->paginate(20);

        return view('admin.events.registrations', compact('event', 'registrations'));
    }

    public function updateRegistrationStatus(Request $request, Event $event, EventRegistration $registration)
    {
        $request->validate(['status' => 'required|in:registered,confirmed,attended,cancelled']);
        $registration->update(['status' => $request->status]);
        return back()->with('success', 'Registration status updated successfully!');
    }

    public function destroyRegistration(Event $event, EventRegistration $registration)
    {
        $registration->delete();
        return back()->with('success', 'Registration deleted successfully!');
    }

    public function ajaxEdit(Event $event)
    {
        return response()->json([
            'success' => true,
            'event' => [
                'id' => $event->id,
                'title' => $event->title,
                'description' => $event->description,
                'start_time' => $event->start_time->format('Y-m-d\TH:i'),
                'end_time' => $event->end_time ? $event->end_time->format('Y-m-d\TH:i') : null,
                'location' => $event->location,
                'event_type' => $event->event_type,
                'poster' => $event->poster,
                'is_public' => $event->is_public,
            ]
        ]);
    }

    protected function getEventTypes(): array
    {
        return [
            'service' => 'Church Service',
            'meeting' => 'Meeting',
            'conference' => 'Conference',
            'workshop' => 'Workshop',
            'other' => 'Other'
        ];
    }
}

