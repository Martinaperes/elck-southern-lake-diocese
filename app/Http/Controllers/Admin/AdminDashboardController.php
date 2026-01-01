<?php\n\nnamespace App\Http\Controllers\Admin;\n\nuse App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\Ministry;
use App\Models\Event;
use App\Models\Donation;
use App\Models\User;

class DashboardController extends Controller
{
    public function __construct()
    {
        // Share sidebar counts with all views loaded by this controller
        view()->share('sidebarCounts', [
            'users' => User::count(),
            'events' => Event::whereMonth('date', now()->month)->count(),
            'ministries' => Ministry::count(),
            'donations' => Donation::whereMonth('created_at', now()->month)->sum('amount'),
        ]);
    }

    public function index()
    {
        $totalMembers = Member::count();
        $totalMinistries = Ministry::count();
        $totalEvents = Event::count();
        $totalDonationsThisMonth = Donation::whereMonth('created_at', now()->month)->sum('amount');

        return view('admin.dashboard', compact(
            'totalMembers', 
            'totalMinistries', 
            'totalEvents', 
            'totalDonationsThisMonth'
        ));
    }
}

