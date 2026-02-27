<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Ministry;
use App\Http\Requests\MinistrySubscribeRequest;
use App\Services\MinistryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MinistryController extends Controller
{
    protected $ministryService;

    public function __construct(MinistryService $ministryService)
    {
        $this->ministryService = $ministryService;
    }

    public function index()
    {
        $ministries = Ministry::where('is_active', true)
                            ->orderBy('name')
                            ->get();

        return view('ministries.index', compact('ministries'));
    }

    public function show(Ministry $ministry)
    {
        // Eager load everything needed for the view
        $upcomingEvents = Event::where('start_time', '>=', now())
            ->where(function($query) use ($ministry) {
                $query->where('ministry_id', $ministry->id)
                      ->orWhere('is_public', true);
            })
            ->orderBy('start_time')
            ->limit(10)
            ->get();

        $relatedMinistries = Ministry::where('is_active', true)
            ->where('id', '!=', $ministry->id)
            ->inRandomOrder()
            ->limit(3)
            ->get();

        $isMember = false;
        $userEmail = null;

        if (auth()->check()) {
            $userEmail = auth()->user()->email;
            $isMember = $ministry->members()
                ->whereHas('member', fn($q) => $q->where('email', $userEmail))
                ->where('is_active', true)
                ->exists();
        }

        Log::info('Showing ministry', [
            'ministry' => $ministry->slug,
            'isMember' => $isMember
        ]);

        return view('ministries.show', compact(
            'ministry',
            'relatedMinistries',
            'upcomingEvents',
            'isMember',
            'userEmail'
        ));
    }

    public function subscribeForm(Ministry $ministry)
    {
        return view('ministries.subscribe', compact('ministry'));
    }

    public function subscribe(MinistrySubscribeRequest $request, Ministry $ministry)
    {
        try {
            $this->ministryService->handleSubscription($ministry, $request->validated());

            return redirect()->route('ministries.show', $ministry->slug)
                ->with('success', "Congratulations! You have successfully joined {$ministry->name}. Welcome to our community!");
        } catch (\Exception $e) {
            Log::error('Ministry subscription error: ' . $e->getMessage());
            return back()->withInput()->with('error', 'Something went wrong. Please try again.');
        }
    }
}