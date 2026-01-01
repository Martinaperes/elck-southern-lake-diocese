<?php\n\nnamespace App\Http\Controllers\Admin;\n\nuse App\Http\Controllers\Controller;
use App\Models\Donation;
use App\Models\Event;

class ReportController extends Controller
{
    public function donations()
    {
        $donations = Donation::latest()->paginate(20);
        return view('admin.reports.donations', compact('donations'));
    }

    public function events()
    {
        $events = Event::withCount('registrations')->get();
        return view('admin.reports.events', compact('events'));
    }
}

