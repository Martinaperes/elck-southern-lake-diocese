<?php

namespace App\Mail;

use App\Models\NewsletterCampaign;
use App\Models\NewsletterSubscriber;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewsletterCampaignMail extends Mailable
{
    use Queueable, SerializesModels;

    public $campaign;
    public $subscriber;
    public $unsubscribeUrl;
    public $trackingPixel;
    public $trackingUrl;

    /**
     * Create a new message instance.
     */
    public function __construct(NewsletterCampaign $campaign, NewsletterSubscriber $subscriber)
    {
        $this->campaign = $campaign;
        $this->subscriber = $subscriber;
        $this->unsubscribeUrl = route('newsletter.unsubscribe', $subscriber->subscription_token);
        
        // Generate tracking URLs (you'll need to implement tracking endpoints)
        $this->trackingPixel = route('newsletter.track.open', [
            'campaign' => $campaign->id,
            'subscriber' => $subscriber->id,
            'token' => md5($campaign->id . $subscriber->id . config('app.key'))
        ]);
        
        $this->trackingUrl = route('newsletter.track.click', [
            'campaign' => $campaign->id,
            'subscriber' => $subscriber->id,
            'token' => md5($campaign->id . $subscriber->id . config('app.key'))
        ]);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->campaign->subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.newsletter.campaign',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}