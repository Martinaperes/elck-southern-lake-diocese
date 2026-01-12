<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NewsletterSubscriber;
use App\Models\NewsletterCampaign;
use App\Models\NewsletterLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NewsletterController extends Controller
{
    // Subscribers management
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
        
        $subscribers = $query->latest()->paginate(20);
        
        $stats = [
            'activeCount' => NewsletterSubscriber::where('is_active', true)->count(),
            'inactiveCount' => NewsletterSubscriber::where('is_active', false)->count(),
            'thisMonthCount' => NewsletterSubscriber::whereMonth('subscribed_at', now()->month)
                ->whereYear('subscribed_at', now()->year)->count(),
        ];
        
        return view('admin.newsletter.subscribers', array_merge(compact('subscribers'), $stats));
    }

    // Show create form
    public function create()
    {
        return view('admin.newsletter.create');
    }

    // Store new campaign
    public function store(Request $request)
    {
        $validated = $request->validate([
            'subject' => 'required|string|max:255',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'required|string',
            'category' => 'nullable|string|max:100',
            'featured_image' => 'nullable|image|max:2048',
            'is_featured' => 'boolean',
            'scheduled_at' => 'nullable|date|after:now',
            'send_option' => 'required|in:draft,now,schedule'
        ]);

        // Handle file upload
        $imagePath = null;
        if ($request->hasFile('featured_image')) {
            $imagePath = $request->file('featured_image')->store('newsletter_images', 'public');
        }

        // Determine status based on send option
        $status = 'draft';
        $scheduledAt = null;
        
        if ($validated['send_option'] === 'now') {
            $status = 'sent';
            $scheduledAt = now();
            
            // For "send now", we'll just mark it as sent without actual email
            $activeSubscribersCount = NewsletterSubscriber::where('is_active', true)->count();
        } elseif ($validated['send_option'] === 'schedule' && $validated['scheduled_at']) {
            $status = 'scheduled';
            $scheduledAt = $validated['scheduled_at'];
        }

        $campaign = NewsletterCampaign::create([
            'subject' => $validated['subject'],
            'excerpt' => $validated['excerpt'],
            'content' => $validated['content'],
            'category' => $validated['category'],
            'featured_image' => $imagePath,
            'is_featured' => $request->has('is_featured'),
            'status' => $status,
            'created_by' => auth()->id(),
            'scheduled_at' => $scheduledAt,
            'sent_at' => $status === 'sent' ? now() : null,
            'sent_count' => $status === 'sent' ? NewsletterSubscriber::where('is_active', true)->count() : 0
        ]);

        // Create logs for sent campaigns
        if ($status === 'sent') {
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

        $message = match($status) {
            'draft' => 'Newsletter saved as draft successfully.',
            'sent' => 'Newsletter marked as sent to ' . NewsletterSubscriber::where('is_active', true)->count() . ' subscribers.',
            'scheduled' => 'Newsletter scheduled for ' . \Carbon\Carbon::parse($scheduledAt)->format('M d, Y \a\t h:i A'),
            default => 'Newsletter created successfully.'
        };

        return redirect()->route('admin.newsletter.show', $campaign)
            ->with('success', $message);
    }

    // Show campaign details
    public function show(NewsletterCampaign $campaign)
    {
        return view('admin.newsletter.show', compact('campaign'));
    }

    // Edit campaign
    public function edit(NewsletterCampaign $campaign)
    {
        if ($campaign->status !== 'draft') {
            return redirect()->route('admin.newsletter.show', $campaign)
                ->with('error', 'Only draft campaigns can be edited.');
        }
        
        return view('admin.newsletter.edit', compact('campaign'));
    }

    // Update campaign
    public function update(Request $request, NewsletterCampaign $campaign)
    {
        if ($campaign->status !== 'draft') {
            return redirect()->route('admin.newsletter.show', $campaign)
                ->with('error', 'Only draft campaigns can be edited.');
        }

        $validated = $request->validate([
            'subject' => 'required|string|max:255',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'required|string',
            'category' => 'nullable|string|max:100',
            'featured_image' => 'nullable|image|max:2048',
            'is_featured' => 'boolean',
            'remove_image' => 'boolean'
        ]);

        // Handle image removal
        if ($request->has('remove_image') && $campaign->featured_image) {
            Storage::disk('public')->delete($campaign->featured_image);
            $validated['featured_image'] = null;
        }
        
        // Handle new image upload
        if ($request->hasFile('featured_image')) {
            // Delete old image if exists
            if ($campaign->featured_image) {
                Storage::disk('public')->delete($campaign->featured_image);
            }
            $imagePath = $request->file('featured_image')->store('newsletter_images', 'public');
            $validated['featured_image'] = $imagePath;
        }

        $campaign->update([
            'subject' => $validated['subject'],
            'excerpt' => $validated['excerpt'],
            'content' => $validated['content'],
            'category' => $validated['category'],
            'featured_image' => $validated['featured_image'] ?? $campaign->featured_image,
            'is_featured' => $request->has('is_featured')
        ]);

        return redirect()->route('admin.newsletter.show', $campaign)
            ->with('success', 'Newsletter updated successfully.');
    }

    // Send campaign manually (without actual email)
    public function send(Request $request, NewsletterCampaign $campaign)
    {
        if ($campaign->status !== 'draft' && $campaign->status !== 'scheduled') {
            return back()->with('error', 'Campaign cannot be sent.');
        }

        // Mark as sent without actual email
        $activeSubscribers = NewsletterSubscriber::where('is_active', true)->get();
        
        foreach ($activeSubscribers as $subscriber) {
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

        return redirect()->route('admin.newsletter.show', $campaign)
            ->with('success', 'Newsletter marked as sent to ' . $activeSubscribers->count() . ' subscribers.');
    }

    // List campaigns
    public function campaigns(Request $request)
    {
        $query = NewsletterCampaign::query();
        
        // Search filter
        if ($request->has('search') && $request->search) {
            $query->where('subject', 'like', '%' . $request->search . '%')
                  ->orWhere('excerpt', 'like', '%' . $request->search . '%');
        }
        
        // Status filter
        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }
        
        $campaigns = $query->with('creator')->latest()->paginate(10);
        
        // Get stats for the dashboard
        $activeSubscribers = NewsletterSubscriber::where('is_active', true)->count();
        $sentCampaigns = NewsletterCampaign::where('status', 'sent')->count();
        $draftCampaigns = NewsletterCampaign::where('status', 'draft')->count();
        
        return view('admin.newsletter.campaigns', compact(
            'campaigns',
            'activeSubscribers',
            'sentCampaigns',
            'draftCampaigns'
        ));
    }

    // Campaign analytics
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

    // Duplicate campaign
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

    // Cancel scheduled campaign
    public function cancel(NewsletterCampaign $campaign)
    {
        if ($campaign->status === 'scheduled') {
            $campaign->update(['status' => 'cancelled']);
            return back()->with('success', 'Campaign cancelled successfully.');
        }

        return back()->with('error', 'Only scheduled campaigns can be cancelled.');
    }

    // Resubscribe user
    public function resubscribe(NewsletterSubscriber $subscriber)
    {
        $subscriber->update([
            'is_active' => true,
            'unsubscribed_at' => null
        ]);

        return back()->with('success', 'Subscriber reactivated successfully.');
    }

    // Delete subscriber
    public function destroySubscriber(NewsletterSubscriber $subscriber)
    {
        $subscriber->delete();
        return back()->with('success', 'Subscriber deleted permanently.');
    }
}