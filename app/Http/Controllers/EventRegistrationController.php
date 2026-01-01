<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventRegistration;
use Illuminate\Http\Request;

class EventRegistrationController extends Controller
{
    public function store(Request $request, Event $event)
{
    $request->validate([
        'number_of_guests' => 'required|integer|min:0|max:10',
        'special_requirements' => 'nullable|string|max:500',
    ]);

    EventRegistration::create([
        'event_id' => $event->id,
        'member_id' => auth()->id(),
        'number_of_guests' => $request->number_of_guests,
        'special_requirements' => $request->special_requirements,
        'status' => 'registered'
    ]);

    if ($request->ajax()) {
        return response()->json(['success' => true, 'message' => 'You have registered for this event.']);
    }

    return back()->with('success', 'You have registered for this event.');
}
}