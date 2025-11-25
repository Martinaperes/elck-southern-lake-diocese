<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ministry;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Str;

class MinistryController extends Controller
{
    /**
     * Display a listing of the ministries.
     */
    public function index(): View
{
    $query = Ministry::query();
    
    // Search functionality
    if (request()->has('search') && request('search')) {
        $search = request('search');
        $query->where(function($q) use ($search) {
            $q->where('name', 'like', "%{$search}%")
              ->orWhere('description', 'like', "%{$search}%")
              ->orWhere('leader_name', 'like', "%{$search}%")
              ->orWhere('contact_email', 'like', "%{$search}%");
        });
    }
    
    // Status filter
    if (request()->has('status') && request('status')) {
        if (request('status') == 'active') {
            $query->where('is_active', true);
        } elseif (request('status') == 'inactive') {
            $query->where('is_active', false);
        }
    }
    
    $ministries = $query->latest()->paginate(10);
    
    return view('admin.ministries.index', compact('ministries'));
}
    /**
     * Show the form for creating a new ministry.
     */
    public function create(): View
    {
        return view('admin.ministries.create');
    }

    /**
     * Store a newly created ministry in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:ministries,name',
            'description' => 'required|string',
            'leader_name' => 'nullable|string|max:255',
            'contact_email' => 'nullable|email',
            'meeting_schedule' => 'nullable|string',
            'image_path' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        // Generate slug from name
        $validated['slug'] = Str::slug($validated['name']);

        Ministry::create(array_merge($validated, [
            'is_active' => $request->has('is_active'),
        ]));

        return redirect()->route('admin.ministries.index')
            ->with('success', 'Ministry created successfully.');
    }

    /**
     * Display the specified ministry.
     */
    public function show(Ministry $ministry): View
    {
        return view('admin.ministries.show', compact('ministry'));
    }

    /**
     * Show the form for editing the specified ministry.
     */
    public function edit(Ministry $ministry): View
    {
        return view('admin.ministries.edit', compact('ministry'));
    }

    /**
     * Update the specified ministry in storage.
     */
    public function update(Request $request, Ministry $ministry): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:ministries,name,' . $ministry->id,
            'description' => 'required|string',
            'leader_name' => 'nullable|string|max:255',
            'contact_email' => 'nullable|email',
            'meeting_schedule' => 'nullable|string',
            'image_path' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        // Generate slug from name if name changed
        if ($ministry->name !== $validated['name']) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        $ministry->update(array_merge($validated, [
            'is_active' => $request->has('is_active'),
        ]));

        return redirect()->route('admin.ministries.index')
            ->with('success', 'Ministry updated successfully.');
    }

    /**
     * Remove the specified ministry from storage.
     */
    public function destroy(Ministry $ministry): RedirectResponse
    {
        $ministry->delete();

        return redirect()->route('admin.ministries.index')
            ->with('success', 'Ministry deleted successfully.');
    }
    public function getCreatedAtFormattedAttribute()
    {
        return $this->created_at ? $this->created_at->format('F j, Y') : 'N/A';
    }

    public function getUpdatedAtFormattedAttribute()
    {
        return $this->updated_at ? $this->updated_at->format('F j, Y') : 'N/A';
    }

    public function getCreatedAtHumanAttribute()
    {
        return $this->created_at ? $this->created_at->diffForHumans() : 'N/A';
    }
}