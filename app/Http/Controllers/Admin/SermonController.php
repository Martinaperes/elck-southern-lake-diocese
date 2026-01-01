<?php\n\nnamespace App\Http\Controllers\Admin;\n\n// app/Http/Controllers/Admin/SermonController.php



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
                  ->orWhere('scripture_references', 'like', '%' . $request->search . '%');
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
        
        // Add this line to count unique preachers
        $uniquePreachers = Sermon::distinct()->whereNotNull('preacher')->count('preacher');

        return view('admin.sermons.index', compact(
            'sermons', 
            'totalSermons', 
            'publishedSermons', 
            'thisMonthSermons',
            'uniquePreachers' // Add this
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

        return response()->json([
            'success' => true,
            'is_published' => $sermon->is_published
        ]);
    }
}
