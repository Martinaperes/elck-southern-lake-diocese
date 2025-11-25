<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\NewsletterSubscriber;

class NewsletterSubscription extends Mailable
{
    use Queueable, SerializesModels;

    public $subscriber;

    /**
     * Create a new message instance.
     */
    public function __construct(NewsletterSubscriber $subscriber)
    {
        $this->subscriber = $subscriber;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Welcome to ELCK Southern Lake Diocese Newsletter')
                    ->markdown('emails.newsletter.welcome')
                    ->with([
                        'subscriber' => $this->subscriber,
                        'confirmUrl' => route('newsletter.confirm', $this->subscriber->subscription_token),
                        'unsubscribeUrl' => route('newsletter.unsubscribe', $this->subscriber->unsubscribe_token)
                    ]);
    }
}