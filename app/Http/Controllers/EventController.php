<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Ministry;
use Illuminate\Http\Request;
use Carbon\Carbon;

class EventController extends Controller
{
    public function index(Request $request)
    {
        // Get current month from query or use current month
        $currentMonth = $request->has('month') 
            ? Carbon::createFromFormat('Y-m', $request->month)
            : Carbon::now();
        
        // Get ministry filters
        $ministryFilters = $request->has('ministry') 
            ? explode(',', $request->ministry)
            : [];
        
        // Base query - only public events
        $query = Event::with('ministry')
            ->where('is_public', true)
            ->whereDate('start_time', '>=', now()->subDay())
            ->orderBy('start_time');
        
        // Apply ministry filters
        if (!empty($ministryFilters)) {
            $query->whereHas('ministry', function ($q) use ($ministryFilters) {
                $q->whereIn('id', $ministryFilters);
            });
        }
        
        // Apply event type filter if specified
        if ($request->has('event_type')) {
            $query->where('event_type', $request->event_type);
        }
        
        // Apply date filter if specified
        if ($request->has('date')) {
            $query->whereDate('start_time', $request->date);
        }
        
        // Get all events for the current month
        $monthEvents = $query->whereMonth('start_time', $currentMonth->month)
            ->whereYear('start_time', $currentMonth->year)
            ->paginate(12);
        
        // Get featured events (events in the next 7 days, limit to 2)
        $featuredEvents = Event::with('ministry')
    ->where('is_public', true)
    ->whereDate('start_time', '>=', now())
    ->whereDate('start_time', '<=', now()->addDays(30)) // Show next 30 days
    ->orderBy('start_time')
    ->limit(3) // Show 3 featured events
    ->get();
        
        // Get events grouped by date for calendar
        $eventsByDate = Event::with('ministry')
            ->where('is_public', true)
            ->whereMonth('start_time', $currentMonth->month)
            ->whereYear('start_time', $currentMonth->year)
            ->get()
            ->groupBy(function($event) {
                return $event->start_time->format('Y-m-d');
            });
        
        // Build calendar grid
        $calendar = $this->buildCalendar($currentMonth);
        
        // Get all active ministries for filter
        $ministries = Ministry::where('is_active', true)
            ->orderBy('name')
            ->get();
        
        // Statistics
        $totalEvents = Event::where('is_public', true)
            ->whereMonth('start_time', $currentMonth->month)
            ->whereYear('start_time', $currentMonth->year)
            ->count();
        
        $thisWeekEvents = Event::where('is_public', true)
            ->whereBetween('start_time', [now(), now()->addDays(7)])
            ->count();
        
        // Event types for filter
        $eventTypes = [
            'service' => 'Sunday Service',
            'meeting' => 'Ministry Meeting',
            'conference' => 'Conference',
            'training' => 'Training',
            'outreach' => 'Community Outreach',
            'special' => 'Special Event',
            'retreat' => 'Retreat',
            'workshop' => 'Workshop'
        ];
        
        return view('events.index', compact(
            'currentMonth',
            'monthEvents',
            'featuredEvents',
            'eventsByDate',
            'calendar',
            'totalEvents',
            'thisWeekEvents',
            'ministries',
            'eventTypes',
            'ministryFilters'
        ));
    }
    
    private function buildCalendar($date)
    {
        $firstDay = $date->copy()->firstOfMonth();
        $lastDay = $date->copy()->lastOfMonth();
        
        // Start from Sunday of the week containing the 1st
        $startDate = $firstDay->copy()->startOfWeek(Carbon::SUNDAY);
        $endDate = $lastDay->copy()->endOfWeek(Carbon::SATURDAY);
        
        $calendar = [];
        $currentDate = $startDate->copy();
        
        while ($currentDate <= $endDate) {
            $week = [];
            
            for ($i = 0; $i < 7; $i++) {
                $week[] = [
                    'date' => $currentDate->format('Y-m-d'),
                    'day' => $currentDate->format('j'),
                    'is_current_month' => $currentDate->month == $date->month
                ];
                $currentDate->addDay();
            }
            
            $calendar[] = $week;
        }
        
        return $calendar;
    }
    
    public function modal(Event $event)
    {
        if (!$event->is_public) {
            abort(404);
        }
        
        return view('events.modal', compact('event'));
    }
    
    public function show(Event $event)
    {
        if (!$event->is_public) {
            abort(404);
        }
        
        return view('events.show', compact('event'));
    }
}