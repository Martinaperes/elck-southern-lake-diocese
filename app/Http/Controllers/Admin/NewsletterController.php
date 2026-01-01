<?php\n\nnamespace App\Http\Controllers\Admin;\n\n\n\n\n\n
<?php 
// app/Http/Controllers/Admin/NewsletterController.php

use App\Http\Controllers\Controller;
use App\Models\NewsletterSubscriber;
use App\Models\NewsletterCampaign;
use App\Models\NewsletterLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewsletterCampaign as CampaignMail;

class NewsletterController extends Controller
{
    // Subscribers management
    // In AdminNewsletterController, update the subscribers method:
public function subscribers(Request $request)
{
    $query = NewsletterSubscriber::query();
    
    // Search filter
    if ($request->has('search') && $request->search) {
        $query->where(function($q) use ($request) {
            $q->where('email', 'like', '%' . $request->search . '%')
              ->orWhere('name', 'like', '%' . $request->search . '%');
        });
    }
    
    // Status filter
    if ($request->has('status') && $request->status) {
        $query->where('is_active', $request->status === 'active');
    }
    
    // Parish filter
    if ($request->has('parish') && $request->parish) {
        $query->where('parish', $request->parish);
    }
    
    $subscribers = $query->latest()->paginate(20);
    
    $stats = [
        'activeCount' => NewsletterSubscriber::where('is_active', true)->count(),
        'inactiveCount' => NewsletterSubscriber::where('is_active', false)->count(),
        'thisMonthCount' => NewsletterSubscriber::whereMonth('subscribed_at', now()->month)
            ->whereYear('subscribed_at', now()->year)->count(),
    ];
    
    return view('admin.newsletter.subscribers', array_merge(compact('subscribers'), $stats));
}

    // Create campaign form
    public function createCampaign()
    {
        return view('admin.newsletter.create-campaign');
    }

    // Store campaign
    public function storeCampaign(Request $request)
    {
        $validated = $request->validate([
            'subject' => 'required|string|max:255',
            'content' => 'required|string',
            'scheduled_at' => 'nullable|date|after:now',
            'send_immediately' => 'boolean'
        ]);

        $campaign = NewsletterCampaign::create([
            'subject' => $validated['subject'],
            'content' => $validated['content'],
            'status' => $validated['send_immediately'] ? 'scheduled' : 'draft',
            'created_by' => auth()->id(),
            'scheduled_at' => $validated['scheduled_at'] ?? now()
        ]);

        if ($validated['send_immediately']) {
            $this->sendCampaign($campaign);
        }

        return redirect()->route('admin.newsletter.campaigns')
            ->with('success', 'Newsletter campaign created successfully.');
    }

    // Send campaign
    public function sendCampaign(NewsletterCampaign $campaign)
    {
        $activeSubscribers = NewsletterSubscriber::where('is_active', true)->get();

        foreach ($activeSubscribers as $subscriber) {
            Mail::to($subscriber->email)
                ->queue(new CampaignMail($campaign, $subscriber));

            // Create log entry
            NewsletterLog::create([
                'campaign_id' => $campaign->id,
                'subscriber_id' => $subscriber->id,
                'status' => 'sent',
                'sent_at' => now()
            ]);
        }

        $campaign->update([
            'status' => 'sent',
            'sent_at' => now(),
            'sent_count' => $activeSubscribers->count()
        ]);

        return back()->with('success', 'Campaign sent successfully.');
    }

    // List campaigns
    public function campaigns()
    {
        $campaigns = NewsletterCampaign::with('creator')->latest()->paginate(15);
        return view('admin.newsletter.campaigns', compact('campaigns'));
    }

    // Campaign analytics
    public function analytics(NewsletterCampaign $campaign)
    {
        $logs = $campaign->logs()->with('subscriber')->paginate(20);
        $stats = [
            'sent' => $campaign->logs()->where('status', 'sent')->count(),
            'opened' => $campaign->logs()->whereNotNull('opened_at')->count(),
            'clicked' => $campaign->logs()->whereNotNull('clicked_at')->count(),
        ];

        return view('admin.newsletter.analytics', compact('campaign', 'logs', 'stats'));
    }
    // In AdminNewsletterController.php

public function duplicate(NewsletterCampaign $campaign)
{
    $newCampaign = $campaign->replicate();
    $newCampaign->status = 'draft';
    $newCampaign->sent_at = null;
    $newCampaign->scheduled_at = null;
    $newCampaign->sent_count = 0;
    $newCampaign->opened_count = 0;
    $newCampaign->clicked_count = 0;
    $newCampaign->save();

    return redirect()->route('admin.newsletter.edit', $newCampaign)
        ->with('success', 'Campaign duplicated successfully.');
}

public function cancel(NewsletterCampaign $campaign)
{
    if ($campaign->status === 'scheduled') {
        $campaign->update(['status' => 'cancelled']);
        return back()->with('success', 'Campaign cancelled successfully.');
    }

    return back()->with('error', 'Only scheduled campaigns can be cancelled.');
}

public function resubscribe(NewsletterSubscriber $subscriber)
{
    $subscriber->update([
        'is_active' => true,
        'unsubscribed_at' => null
    ]);

    return back()->with('success', 'Subscriber reactivated successfully.');
}

public function destroySubscriber(NewsletterSubscriber $subscriber)
{
    $subscriber->delete();
    return back()->with('success', 'Subscriber deleted permanently.');
}
}

