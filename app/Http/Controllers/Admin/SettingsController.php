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
        $settings = \App\Models\Setting::pluck('value', 'key')->toArray();
        
        // Provide defaults if missing
        $settings = array_merge([
            'system_name' => 'ELCK Southern Lake',
            'church_name' => 'E.L.C.K Southern Lake Diocese',
            'contact_email' => 'contact@southernlake.elck.org',
            'timezone' => 'Africa/Nairobi',
            'date_format' => 'F j, Y',
            'items_per_page' => 10,
            'theme' => 'dark',
            'dark_mode' => '1',
            'email_notifications' => '1',
            'maintenance_mode' => '0',
        ], $settings);
        
        return view('admin.settings.index', compact('settings'));
    }

    /**
     * Update general settings.
     */
    public function update(Request $request)
    {
        $data = $request->except(['_token', '_method']);
        
        // Handle checkboxes (if not sent, default to 0)
        $checkboxes = ['dark_mode', 'email_notifications', 'maintenance_mode'];
        foreach ($checkboxes as $field) {
            if ($request->has('system_prefs') && !isset($data[$field])) {
                $data[$field] = '0';
            }
        }

        foreach ($data as $key => $value) {
            if ($key !== 'system_prefs') {
                \App\Models\Setting::updateOrCreate(
                    ['key' => $key],
                    ['value' => $value ?? '', 'type' => 'string', 'group' => 'general']
                );
            }
        }

        return back()->with('success', 'Settings updated successfully!');
    }

    /**
     * Display church-specific settings.
     */
    public function church()
    {
        return redirect()->route('admin.settings.index');
    }

    /**
     * Update church information.
     */
    public function churchUpdate(Request $request)
    {
        $request->validate([
            'church_name' => 'required|string|max:255',
            'contact_email' => 'required|email|max:255',
        ]);

        \App\Models\Setting::updateOrCreate(['key' => 'church_name'], ['value' => $request->church_name, 'type' => 'string']);
        \App\Models\Setting::updateOrCreate(['key' => 'contact_email'], ['value' => $request->contact_email, 'type' => 'string']);

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
