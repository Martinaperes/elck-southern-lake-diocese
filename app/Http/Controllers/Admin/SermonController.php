<?php
namespace App\Http\Controllers\Admin;



use App\Http\Controllers\Controller;
use App\Models\Sermon;
use Illuminate\Http\Request;

class SermonController extends Controller
{
    public function index(Request $request)
{
    // Build the query with filters
    $query = Sermon::query();

    // Search filter
    if ($request->has('search') && $request->search != '') {
        $query->where(function($q) use ($request) {
            $q->where('title', 'like', '%' . $request->search . '%')
              ->orWhere('preacher', 'like', '%' . $request->search . '%')
              ->orWhere('scripture_references', 'like', '%' . $request->search . '%')
              ->orWhere('description', 'like', '%' . $request->search . '%');
        });
    }

    // Status filter
    if ($request->has('status') && $request->status != '') {
        if ($request->status == 'published') {
            $query->where('is_published', true);
        } elseif ($request->status == 'draft') {
            $query->where('is_published', false);
        }
    }

    $sermons = $query->latest()->paginate(10);
    
    // Statistics
    $totalSermons = Sermon::count();
    $publishedSermons = Sermon::where('is_published', true)->count();
    $thisMonthSermons = Sermon::whereMonth('created_at', now()->month)->count();
    $uniquePreachers = Sermon::distinct()->whereNotNull('preacher')->count('preacher');
    
    // Get current week's featured scripture (scripture of the week)
    // This is the fix - properly define the variable
    $currentWeekScripture = Sermon::where('featured', true)
        ->where('is_published', true)
        ->whereBetween('sermon_date', [
            now()->startOfWeek(),
            now()->endOfWeek()
        ])
        ->latest('sermon_date')
        ->first();

    return view('admin.sermons.index', compact(
        'sermons', 
        'totalSermons', 
        'publishedSermons', 
        'thisMonthSermons',
        'uniquePreachers',
        'currentWeekScripture' // This was missing or incorrectly defined
    ));
}

    public function create()
    {
        $totalSermons = Sermon::count();
        $publishedSermons = Sermon::where('is_published', true)->count();
        $thisMonthSermons = Sermon::whereMonth('created_at', now()->month)->count();

        return view('admin.sermons.create', compact(
            'totalSermons', 
            'publishedSermons', 
            'thisMonthSermons'
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'preacher' => 'required|string|max:255',
            'sermon_date' => 'required|date',
            'scripture_references' => 'nullable|string|max:500',
            'duration_minutes' => 'nullable|integer|min:1',
            'description' => 'nullable|string|max:1000',
            'audio_url' => 'nullable|url|max:500',
            'video_url' => 'nullable|url|max:500',
            'document_url' => 'nullable|url|max:500',
            'is_published' => 'boolean'
        ]);

        // Set default for is_published if not provided
        $validated['is_published'] = $request->has('is_published');

        Sermon::create($validated);

        return redirect()->route('admin.sermons.index')
            ->with('success', 'Sermon created successfully!');
    }

    public function show(Sermon $sermon)
    {
        return view('admin.sermons.show', compact('sermon'));
    }

    public function edit(Sermon $sermon)
    {
        $totalSermons = Sermon::count();
        $publishedSermons = Sermon::where('is_published', true)->count();
        $thisMonthSermons = Sermon::whereMonth('created_at', now()->month)->count();

        return view('admin.sermons.edit', compact(
            'sermon',
            'totalSermons', 
            'publishedSermons', 
            'thisMonthSermons'
        ));
    }

    public function update(Request $request, Sermon $sermon)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'preacher' => 'required|string|max:255',
            'sermon_date' => 'required|date',
            'scripture_references' => 'nullable|string|max:500',
            'duration_minutes' => 'nullable|integer|min:1',
            'description' => 'nullable|string|max:1000',
            'audio_url' => 'nullable|url|max:500',
            'video_url' => 'nullable|url|max:500',
            'document_url' => 'nullable|url|max:500',
            'is_published' => 'boolean'
        ]);

        $validated['is_published'] = $request->has('is_published');

        $sermon->update($validated);

        return redirect()->route('admin.sermons.index')
            ->with('success', 'Sermon updated successfully!');
    }

    public function destroy(Sermon $sermon)
    {
        $sermon->delete();

        return redirect()->route('admin.sermons.index')
            ->with('success', 'Sermon deleted successfully!');
    }
    public function togglePublish(Sermon $sermon)
{
    $sermon->update([
        'is_published' => !$sermon->is_published
    ]);

    return redirect()->back()->with('success', 
        $sermon->is_published 
            ? 'Sermon published successfully! It is now visible to members.' 
            : 'Sermon unpublished. It is now hidden from members.'
    );
}
    public function toggleFeatured(Sermon $sermon)
{
    // If setting as featured, unfeature others from this week
    if (!$sermon->featured) {
        Sermon::where('featured', true)
              ->where('id', '!=', $sermon->id)
              ->whereDate('sermon_date', '>=', now()->startOfWeek())
              ->whereDate('sermon_date', '<=', now()->endOfWeek())
              ->update(['featured' => false]);
    }

    $sermon->update([
        'featured' => !$sermon->featured,
        'is_published' => true // Auto-publish when featured
    ]);

    return redirect()->back()->with('success', $sermon->featured 
        ? 'Set as Scripture of the Week!' 
        : 'Removed from featured scriptures.');
}
}