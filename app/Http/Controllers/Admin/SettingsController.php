<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    // SettingsController.php
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

public function update(Request $request)
{
    foreach ($request->except('_token') as $key => $value) {
        // Store in database or config file
        // Option 1: Use spatie/laravel-settings package
        // Option 2: Create a settings table
        // Option 3: Store in config file temporarily
    }
    
    return back()->with('success', 'Settings updated successfully!');
}
}
