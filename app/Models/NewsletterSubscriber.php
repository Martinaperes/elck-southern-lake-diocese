<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsletterSubscriber extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'preferences',
        'status',
        'subscription_token',
        'unsubscribe_token',
        'email_verified_at'
    ];

    protected $casts = [
        'preferences' => 'array',
        'email_verified_at' => 'datetime'
    ];

    /**
     * Bootstrap the model and its traits.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($subscriber) {
            if (empty($subscriber->unsubscribe_token)) {
                $subscriber->unsubscribe_token = \Str::random(32);
            }
        });
    }

    /**
     * Check if subscriber is active
     */
    public function isActive()
    {
        return $this->status === 'active' && $this->email_verified_at !== null;
    }

    /**
     * Get preferences array
     */
    public function getPreferencesAttribute($value)
    {
        return $value ? json_decode($value, true) : [];
    }
}