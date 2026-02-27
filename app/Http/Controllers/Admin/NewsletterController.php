<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NewsletterSubscriber;
use App\Models\NewsletterCampaign;
use App\Models\NewsletterLog;
use App\Http\Requests\Admin\NewsletterRequest;
use App\Traits\FileUploadTrait;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    use FileUploadTrait;

    public function subscribers(Request $request)
    {
        $query = NewsletterSubscriber::query();
        
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('email', 'like', "%{$request->search}%")
                  ->orWhere('name', 'like', "%{$request->search}%");
            });
        }
        
        if ($request->filled('status')) {
            $query->where('is_active', $request->status === 'active');
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

    public function create()
    {
        return view('admin.newsletter.create');
    }

    public function store(NewsletterRequest $request)
    {
        $data = $request->validated();
        
        if ($request->hasFile('featured_image')) {
            $data['featured_image'] = $this->uploadImage($request->file('featured_image'), 'newsletter_images');
        }

        $status = 'draft';
        $scheduledAt = null;
        
        if ($data['send_option'] === 'now') {
            $status = 'sent';
            $scheduledAt = now();
        } elseif ($data['send_option'] === 'schedule' && $data['scheduled_at']) {
            $status = 'scheduled';
            $scheduledAt = $data['scheduled_at'];
        }

        $campaign = NewsletterCampaign::create([
            'subject' => $data['subject'],
            'excerpt' => $data['excerpt'],
            'content' => $data['content'],
            'category' => $data['category'],
            'featured_image' => $data['featured_image'] ?? null,
            'is_featured' => $request->has('is_featured'),
            'status' => $status,
            'created_by' => auth()->id(),
            'scheduled_at' => $scheduledAt,
            'sent_at' => $status === 'sent' ? now() : null,
            'sent_count' => $status === 'sent' ? NewsletterSubscriber::where('is_active', true)->count() : 0
        ]);

        if ($status === 'sent') {
            $this->logCampaignSending($campaign);
        }

        return redirect()->route('admin.newsletter.show', $campaign)->with('success', 'Newsletter created successfully.');
    }

    public function show(NewsletterCampaign $campaign)
    {
        return view('admin.newsletter.show', compact('campaign'));
    }

    public function edit(NewsletterCampaign $campaign)
    {
        if ($campaign->status !== 'draft') {
            return redirect()->route('admin.newsletter.show', $campaign)->with('error', 'Only draft campaigns can be edited.');
        }
        return view('admin.newsletter.edit', compact('campaign'));
    }

    public function update(NewsletterRequest $request, NewsletterCampaign $campaign)
    {
        if ($campaign->status !== 'draft') {
            return redirect()->route('admin.newsletter.show', $campaign)->with('error', 'Only draft campaigns can be edited.');
        }

        $data = $request->validated();

        if ($request->has('remove_image')) {
            $this->deleteFile($campaign->featured_image);
            $data['featured_image'] = null;
        } elseif ($request->hasFile('featured_image')) {
            $data['featured_image'] = $this->uploadImage($request->file('featured_image'), 'newsletter_images', $campaign->featured_image);
        }

        $campaign->update([
            'subject' => $data['subject'],
            'excerpt' => $data['excerpt'],
            'content' => $data['content'],
            'category' => $data['category'],
            'featured_image' => $data['featured_image'] ?? $campaign->featured_image,
            'is_featured' => $request->has('is_featured')
        ]);

        return redirect()->route('admin.newsletter.show', $campaign)->with('success', 'Newsletter updated successfully.');
    }

    public function send(NewsletterCampaign $campaign)
    {
        if ($campaign->status !== 'draft' && $campaign->status !== 'scheduled') {
            return back()->with('error', 'Campaign cannot be sent.');
        }

        $this->logCampaignSending($campaign);

        $campaign->update([
            'status' => 'sent',
            'sent_at' => now(),
            'sent_count' => NewsletterSubscriber::where('is_active', true)->count()
        ]);

        return redirect()->route('admin.newsletter.show', $campaign)->with('success', 'Newsletter marked as sent.');
    }

    public function campaigns(Request $request)
    {
        $query = NewsletterCampaign::with('creator');
        
        if ($request->filled('search')) {
            $query->where('subject', 'like', "%{$request->search}%");
        }
        
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        
        $campaigns = $query->latest()->paginate(10);
        
        $stats = [
            'activeSubscribers' => NewsletterSubscriber::where('is_active', true)->count(),
            'sentCampaigns' => NewsletterCampaign::where('status', 'sent')->count(),
            'draftCampaigns' => NewsletterCampaign::where('status', 'draft')->count(),
        ];
        
        return view('admin.newsletter.campaigns', array_merge(compact('campaigns'), $stats));
    }

    public function analytics(NewsletterCampaign $campaign)
    {
        $logs = $campaign->logs()->with('subscriber')->paginate(20);
        $stats = [
            'sent' => $campaign->logs()->where('status', 'sent')->count(),
            'opened' => $campaign->logs()->whereNotNull('opened_at')->count(),
            'clicked' => $campaign->logs()->whereNotNull('clicked_at')->count(),
            'failed' => $campaign->logs()->where('status', 'failed')->count(),
        ];

        return view('admin.newsletter.analytics', compact('campaign', 'logs', 'stats'));
    }

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

        return redirect()->route('admin.newsletter.edit', $newCampaign)->with('success', 'Campaign duplicated.');
    }

    public function cancel(NewsletterCampaign $campaign)
    {
        if ($campaign->status === 'scheduled') {
            $campaign->update(['status' => 'cancelled']);
            return back()->with('success', 'Campaign cancelled.');
        }
        return back()->with('error', 'Only scheduled campaigns can be cancelled.');
    }

    public function resubscribe(NewsletterSubscriber $subscriber)
    {
        $subscriber->update(['is_active' => true, 'unsubscribed_at' => null]);
        return back()->with('success', 'Subscriber reactivated.');
    }

    public function destroySubscriber(NewsletterSubscriber $subscriber)
    {
        $subscriber->delete();
        return back()->with('success', 'Subscriber deleted.');
    }

    protected function logCampaignSending(NewsletterCampaign $campaign)
    {
        $activeSubscribers = NewsletterSubscriber::where('is_active', true)->get();
        foreach ($activeSubscribers as $subscriber) {
            NewsletterLog::create([
                'campaign_id' => $campaign->id,
                'subscriber_id' => $subscriber->id,
                'status' => 'sent',
                'sent_at' => now()
            ]);
        }
    }
}