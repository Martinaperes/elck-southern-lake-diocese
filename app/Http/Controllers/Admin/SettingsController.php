<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;

class SettingsController extends Controller
{
    /**
     * Display general settings.
     */
    public function index()
    {
        $settings = [
            'system_name' => 'ELCK Southern Lake',
            'church_name' => 'E.L.C.K Southern Lake Diocese',
            'timezone' => 'Africa/Nairobi',
            'date_format' => 'F j, Y',
            'items_per_page' => 10,
            'theme' => 'dark',
        ];
        
        return view('admin.settings.index', compact('settings'));
    }

    /**
     * Update general settings.
     */
    public function update(Request $request)
    {
        // Logic to update general settings
        return back()->with('success', 'Settings updated successfully!');
    }

    /**
     * Display church-specific settings.
     */
    public function church()
    {
        return view('admin.settings.index'); // Reusing index view or similar
    }

    /**
     * Update church information.
     */
    public function churchUpdate(Request $request)
    {
        // Logic to update church info
        return back()->with('success', 'Church information updated successfully!');
    }

    /**
     * Clear application cache.
     */
    public function clearCache()
    {
        Artisan::call('cache:clear');
        Artisan::call('view:clear');
        Artisan::call('config:clear');
        Artisan::call('route:clear');
        
        return back()->with('success', 'System cache cleared successfully!');
    }

    /**
     * Display system logs.
     */
    public function logs()
    {
        // This could link to a log viewer or return a view
        return back()->with('info', 'Log viewer feature is coming soon.');
    }
}
