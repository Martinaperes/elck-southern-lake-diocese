<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Parish;
use App\Models\Event;
use App\Models\Activity;
use App\Models\Donation;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Total congregants (users with role 'member' or 'user')
        $totalCongregants = User::whereIn('role', ['member', 'user'])->count();
        
        // Growth percentage (this month vs last month)
        $currentMonthCount = User::whereIn('role', ['member', 'user'])
            ->whereMonth('created_at', now()->month)
            ->count();
            
        $lastMonthCount = User::whereIn('role', ['member', 'user'])
            ->whereMonth('created_at', now()->subMonth()->month)
            ->count();
            
        $growthPercentage = $lastMonthCount > 0 
            ? (($currentMonthCount - $lastMonthCount) / $lastMonthCount) * 100 
            : 0;
        
        // Active parishes
        $activeParishes = Parish::where('is_active', true)->count();
        
        // Upcoming events
        $upcomingEvents = Event::where('date', '>=', now())
            ->orderBy('date')
            ->take(5)
            ->count();
        
        // New events this month
        $newEventsThisMonth = Event::whereMonth('created_at', now()->month)->count();
        
        // Recent activities (last 10)
        $recentActivities = Activity::with(['user', 'subject'])
            ->orderBy('performed_at', 'desc')
            ->take(10)
            ->get();
        
        // Quick stats for cards
        $stats = [
            'total_tithes' => Donation::whereMonth('created_at', now()->month)->sum('amount'),
            'total_events' => Event::where('date', '>=', now())->count(),
            'new_members' => User::where('role', 'member')->whereMonth('created_at', now()->month)->count(),
            'attendance_rate' => $this->calculateAttendanceRate(),
        ];
        
        return view('admin.dashboard', compact(
            'totalCongregants',
            'growthPercentage',
            'activeParishes',
            'upcomingEvents',
            'newEventsThisMonth',
            'recentActivities',
            'stats'
        ));
    }
    public function __construct()
{
    view()->share([
        'getActivityColor' => function($type) {
            return Activity::getTypeColors()[$type] ?? Activity::getTypeColors()['default'];
        },
        'getActivityIcon' => function($type) {
            return Activity::getTypeIcons()[$type] ?? 'info';
        },
    ]);
}
    
    private function calculateAttendanceRate()
    {
        // Implement your attendance logic here
        // This is a placeholder - adjust based on your actual data structure
        $totalMembers = User::where('role', 'member')->count();
        $attendedThisMonth = 0; // You'll need to query your attendance records
        
        return $totalMembers > 0 ? ($attendedThisMonth / $totalMembers) * 100 : 0;
    }
    
    // API endpoint for chart data (optional)
    public function getChartData()
    {
        // Monthly user growth for the last 6 months
        $monthlyData = User::select(
                DB::raw('DATE_FORMAT(created_at, "%Y-%m") as month'),
                DB::raw('COUNT(*) as count')
            )
            ->where('created_at', '>=', now()->subMonths(6))
            ->groupBy('month')
            ->orderBy('month')
            ->get();
            
        // Donation data for the last 6 months
        $donationData = Donation::select(
                DB::raw('DATE_FORMAT(created_at, "%Y-%m") as month'),
                DB::raw('SUM(amount) as total')
            )
            ->where('created_at', '>=', now()->subMonths(6))
            ->groupBy('month')
            ->orderBy('month')
            ->get();
            
        return response()->json([
            'user_growth' => $monthlyData,
            'donations' => $donationData,
        ]);
    }
}