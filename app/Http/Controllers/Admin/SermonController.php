<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sermon;
use App\Http\Requests\Admin\SermonRequest;
use Illuminate\Http\Request;

class SermonController extends Controller
{
    public function index(Request $request)
    {
        $query = Sermon::query();

        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', "%{$request->search}%")
                  ->orWhere('preacher', 'like', "%{$request->search}%")
                  ->orWhere('scripture_references', 'like', "%{$request->search}%")
                  ->orWhere('description', 'like', "%{$request->search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('is_published', $request->status === 'published');
        }

        $sermons = $query->latest('sermon_date')->paginate(10);
        
        $stats = [
            'totalSermons' => Sermon::count(),
            'publishedSermons' => Sermon::published()->count(),
            'thisMonthSermons' => Sermon::whereMonth('sermon_date', now()->month)
                                        ->whereYear('sermon_date', now()->year)->count(),
            'uniquePreachers' => Sermon::distinct('preacher')->count('preacher'),
        ];
        
        $currentWeekScripture = Sermon::featured()->published()->thisWeek()->latest('sermon_date')->first();

        return view('admin.sermons.index', array_merge(compact('sermons', 'currentWeekScripture'), $stats));
    }

    public function create()
    {
        return view('admin.sermons.create', $this->getBasicStats());
    }

    public function store(SermonRequest $request)
    {
        Sermon::create($request->validated());
        return redirect()->route('admin.sermons.index')->with('success', 'Sermon created successfully!');
    }

    public function show(Sermon $sermon)
    {
        return view('admin.sermons.show', compact('sermon'));
    }

    public function edit(Sermon $sermon)
    {
        return view('admin.sermons.edit', array_merge(compact('sermon'), $this->getBasicStats()));
    }

    public function update(SermonRequest $request, Sermon $sermon)
    {
        $sermon->update($request->validated());
        return redirect()->route('admin.sermons.index')->with('success', 'Sermon updated successfully!');
    }

    public function destroy(Sermon $sermon)
    {
        $sermon->delete();
        return redirect()->route('admin.sermons.index')->with('success', 'Sermon deleted successfully!');
    }

    public function togglePublish(Sermon $sermon)
    {
        $sermon->update(['is_published' => !$sermon->is_published]);
        
        $msg = $sermon->is_published ? 'published' : 'unpublished';
        return back()->with('success', "Sermon {$msg} successfully!");
    }

    public function toggleFeatured(Sermon $sermon)
    {
        if (!$sermon->featured) {
            Sermon::featured()->thisWeek()->where('id', '!=', $sermon->id)->update(['featured' => false]);
        }

        $sermon->update([
            'featured' => !$sermon->featured,
            'is_published' => true
        ]);

        return back()->with('success', $sermon->featured ? 'Set as Scripture of the Week!' : 'Removed from featured.');
    }

    protected function getBasicStats(): array
    {
        return [
            'totalSermons' => Sermon::count(),
            'publishedSermons' => Sermon::published()->count(),
            'thisMonthSermons' => Sermon::whereMonth('sermon_date', now()->month)->count(),
        ];
    }
}
