<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Sermon;
use App\Models\Ministry;

class HomeController extends Controller
{
    public function index()
    {
        
        $events = Event::latest()->take(3)->get();
        $sermons = Sermon::latest()->take(3)->get();
        $ministries = Ministry::take(5)->get();
        if (auth()->check() && auth()->user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }
    
    // Otherwise show normal homepage
        return view('home.index', compact('events', 'sermons', 'ministries'));
    }
    
}
