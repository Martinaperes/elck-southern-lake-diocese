<?php

namespace App\Http\Controllers;  // CHANGE THIS LINE

use App\Http\Controllers\Controller;
use App\Models\Sermon;
use Illuminate\Http\Request;

class SermonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sermons = Sermon::where('is_published', true)
                        ->latest()
                        ->paginate(9);
        return view('sermons.index', compact('sermons'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Sermon $sermon)
    {
        if (!$sermon->is_published) {
            abort(404);
        }
        
        return view('sermons.show', compact('sermon'));
    }
}