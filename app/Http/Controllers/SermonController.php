<?php

namespace App\Http\Controllers;

use App\Models\Sermon;
use Illuminate\Http\Request;

class SermonController extends Controller
{
    public function index()
    {
        $sermons = Sermon::where('is_published', true)
                        ->latest('sermon_date')
                        ->paginate(9);
        
        // Get the latest sermon for featured section
        $latestSermon = Sermon::where('is_published', true)
                            ->latest('sermon_date')
                            ->first();
        
        return view('sermons.index', compact('sermons', 'latestSermon'));
    }

    public function show(Sermon $sermon)
    {
        if (!$sermon->is_published) {
            abort(404);
        }
        
        // Get related sermons (same preacher or recent ones)
        $relatedSermons = Sermon::where('is_published', true)
                                ->where('id', '!=', $sermon->id)
                                ->where(function($query) use ($sermon) {
                                    $query->where('preacher', $sermon->preacher)
                                          ->orWhereDate('sermon_date', '>=', now()->subMonth());
                                })
                                ->latest('sermon_date')
                                ->limit(3)
                                ->get();
        
        return view('sermons.show', compact('sermon', 'relatedSermons'));
    }
}