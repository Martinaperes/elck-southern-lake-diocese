<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Parish;
use App\Models\Event;
use App\Models\Activity;
use App\Models\Donation;
use App\Models\Member;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display the admin dashboard.
     */
    public function index()
    {
        $currentMonth = now()->month;
        $currentYear = now()->year;

        return view('admin.dashboard', [
            'totalCongregants' => User::whereIn('role', ['member', 'user'])->count(),
            'growthPercentage' => $this->calculateGrowthPercentage(),
            'activeParishes' => Parish::where('is_active', true)->count(),
            'upcomingEvents' => Event::upcoming()->count(),
            'newEventsThisMonth' => Event::whereMonth('created_at', $currentMonth)->whereYear('created_at', $currentYear)->count(),
            'recentActivities' => Activity::with(['user', 'subject'])->latest('performed_at')->take(10)->get(),
            'stats' => $this->getQuickStats(),
            'getActivityColor' => function($type) {
                return match($type) {
                    'created' => 'bg-emerald-100 text-emerald-600 dark:bg-emerald-900/30 dark:text-emerald-400',
                    'updated' => 'bg-blue-100 text-blue-600 dark:bg-blue-900/30 dark:text-blue-400',
                    'deleted' => 'bg-red-100 text-red-600 dark:bg-red-900/30 dark:text-red-400',
                    default => 'bg-slate-100 text-slate-600 dark:bg-slate-800 dark:text-slate-400',
                };
            },
            'getActivityIcon' => function($type) {
                return match($type) {
                    'created' => 'add',
                    'updated' => 'edit',
                    'deleted' => 'delete',
                    default => 'history',
                };
            },
        ]);
    }

    /**
     * Calculate member growth percentage compared to last month.
     */
    private function calculateGrowthPercentage(): float
    {
        $currentMonthCount = User::whereIn('role', ['member', 'user'])
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();
            
        $lastMonthCount = User::whereIn('role', ['member', 'user'])
            ->whereMonth('created_at', now()->subMonth()->month)
            ->whereYear('created_at', now()->subMonth()->year)
            ->count();
            
        return $lastMonthCount > 0 
            ? (($currentMonthCount - $lastMonthCount) / $lastMonthCount) * 100 
            : 0;
    }

    /**
     * Get quick statistics for the dashboard cards.
     */
    private function getQuickStats(): array
    {
        $currentMonth = now()->month;
        $currentYear = now()->year;

        return [
            'total_tithes' => Donation::whereMonth('created_at', $currentMonth)
                                      ->whereYear('created_at', $currentYear)
                                      ->sum('amount'),
            'total_events' => Event::upcoming()->count(),
            'new_this_month' => Member::whereMonth('created_at', $currentMonth)
                                       ->whereYear('created_at', $currentYear)
                                       ->count(),
            'total_members' => Member::count(),
            'active_members' => Member::where('is_active', true)->count(),
            'total_ministries' => \App\Models\Ministry::count(),
            'active_ministries' => \App\Models\Ministry::where('is_active', true)->count(),
            'upcoming_events' => Event::upcoming()->count(),
        ];
    }

    /**
     * Get chart data for user growth and donations (API endpoint).
     */
    public function getChartData()
    {
        $last6Months = now()->subMonths(6);

        $userGrowth = User::select(
                DB::raw('DATE_FORMAT(created_at, "%Y-%m") as month'),
                DB::raw('COUNT(*) as count')
            )
            ->where('created_at', '>=', $last6Months)
            ->groupBy('month')
            ->orderBy('month')
            ->get();
            
        $donations = Donation::select(
                DB::raw('DATE_FORMAT(created_at, "%Y-%m") as month'),
                DB::raw('SUM(amount) as total')
            )
            ->where('created_at', '>=', $last6Months)
            ->groupBy('month')
            ->orderBy('month')
            ->get();
            
        return response()->json([
            'user_growth' => $userGrowth,
            'donations' => $donations,
        ]);
    }
}