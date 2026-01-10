<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ministry extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'leader_name',
        'leader_image',
        'contact_email',
        'meeting_schedule',
        'image_path',
        'is_active',
        'image_url',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Relationship with MinistryMember (members of this ministry)
     */
    public function members()
    {
        return $this->hasMany(MinistryMember::class);
    }

    /**
     * Relationship with Member through MinistryMember
     */
    public function ministryMembers()
    {
        return $this->hasMany(MinistryMember::class);
    }

    /**
     * Get active members
     */
    public function activeMembers()
    {
        return $this->members()->where('is_active', true);
    }

    /**
     * Get leaders of this ministry
     */
    public function leaders()
    {
        return $this->members()->where('role', 'like', '%leader%');
    }

    /**
     * Relationship with Events
     */
    public function events()
    {
        return $this->hasMany(Event::class);
    }

    /**
     * Get upcoming events
     */
    public function upcomingEvents()
    {
        return $this->events()->where('start_time', '>=', now());
    }

    /**
     * Accessor for leader image URL
     */
    public function getLeaderImageUrlAttribute()
    {
        if ($this->leader_image) {
            return asset('storage/' . $this->leader_image);
        }
        return null;
    }

    /**
     * Accessor for image URL
     */
    public function getImageUrlAttribute($value)
    {
        return $value ?: asset('images/default-ministry.png');
    }

    /**
     * Scope for active ministries
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope for searching ministries
     */
    public function scopeSearch($query, $search)
    {
        return $query->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhere('leader_name', 'like', "%{$search}%");
    }

    /**
     * Get total active members count
     */
    public function getActiveMembersCountAttribute()
    {
        return $this->members()->where('is_active', true)->count();
    }

    /**
     * Get next meeting date
     */
    public function getNextMeetingAttribute()
    {
        // Parse meeting schedule if available
        if ($this->meeting_schedule) {
            // You can implement logic to parse schedule
            return 'Every Sunday at 10 AM';
        }
        return 'Schedule not set';
    }
    // Add this method to your Ministry model
public function getBannerUrlAttribute()
{
    if (!$this->image_url) {
        return null;
    }
    
    // Check if it's an uploaded file (starts with 'ministries/banners/')
    if (strpos($this->image_url, 'ministries/banners/') === 0) {
        return Storage::url($this->image_url);
    }
    
    // Check if it's a full URL
    if (filter_var($this->image_url, FILTER_VALIDATE_URL)) {
        return $this->image_url;
    }
    
    // Assume it's a gallery image filename
    return asset('images/gallery/' . $this->image_url);
}

// Optional: Check if banner is uploaded file
public function getHasUploadedBannerAttribute()
{
    return $this->image_url && strpos($this->image_url, 'ministries/banners/') === 0;
}
}