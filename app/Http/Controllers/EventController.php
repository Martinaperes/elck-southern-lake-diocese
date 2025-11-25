<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $query = Event::where('is_public', true);

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('event_type')) {
            $query->where('event_type', $request->event_type);
        }

        if ($request->filled('date')) {
            $query->whereDate('start_time', $request->date);
        }

        $events = $query->latest()->paginate(6);

        return view('events.index', compact('events'));
    }

    public function show(Event $event)
    {
        abort_unless($event->is_public, 403);
        return view('events.show', compact('event'));
    }
}
