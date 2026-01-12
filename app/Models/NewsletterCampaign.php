<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NewsletterCampaign extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject',
        'content',
        'status',
        'created_by',
        'scheduled_at',
        'sent_at',
        'sent_count',
        'opened_count',
        'clicked_count',
        'excerpt',        
        'category',       
        'featured_image', 
        'is_featured'    
    ];

    protected $casts = [
        'scheduled_at' => 'datetime',
        'sent_at' => 'datetime',
        'is_featured' => 'boolean' 
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function logs()
    {
        return $this->hasMany(NewsletterLog::class);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'sent');
    }

    public function scopeScheduled($query)
    {
        return $query->where('status', 'scheduled');
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }
    
    public function scopePublished($query)
    {
        return $query->where('status', 'sent');
    }
    
    public function scopeDraft($query)
    {
        return $query->where('status', 'draft');
    }
}