<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function show($page)
    {
        if (view()->exists("$page.index")) {
            return view("$page.index");
        }

        abort(404);
    }
}
