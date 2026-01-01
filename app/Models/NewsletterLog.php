<?php
// app/Models/NewsletterLog.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NewsletterLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'campaign_id',
        'subscriber_id',
        'status',
        'sent_at',
        'opened_at',
        'clicked_at',
        'notes'
    ];

    protected $casts = [
        'sent_at' => 'datetime',
        'opened_at' => 'datetime',
        'clicked_at' => 'datetime'
    ];

    public function campaign()
    {
        return $this->belongsTo(NewsletterCampaign::class);
    }

    public function subscriber()
    {
        return $this->belongsTo(NewsletterSubscriber::class);
    }
}