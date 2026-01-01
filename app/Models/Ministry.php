<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany; 

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
        'image_url',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    // Relationship with events
    public function events(): HasMany
    {
        return $this->hasMany(Event::class);
    }

    // Relationship with members through ministry_members pivot
    public function members()
    {
        return $this->belongsToMany(Member::class, 'ministry_members', 'ministry_id', 'member_id')
                    ->withPivot('role', 'joined_at', 'is_active')
                    ->withTimestamps();
    }
    
    // Relationship with MinistryMember model
    public function ministryMembers()
    {
        return $this->hasMany(MinistryMember::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
    
    //Accessor for active members count
    public function getActiveMembersCountAttribute(): int
    {
        return $this->ministryMembers()->where('is_active', true)->count();
    }
    
    public function getCreatedAtFormattedAttribute(): string
    {
        return $this->created_at ? $this->created_at->format('M j, Y') : 'N/A';
    }
    
    public function getUpdatedAtFormattedAttribute(): string
    {
        return $this->updated_at ? $this->updated_at->format('M j, Y') : 'N/A';
    }
    
    public function getCreatedAtHumanAttribute(): string
    {
        return $this->created_at ? $this->created_at->diffForHumans() : 'N/A';
    }
    
    // Add this accessor for abbreviation
    public function getAbbreviationAttribute(): string
    {
        $words = explode(' ', $this->name);
        $abbreviation = '';
        
        foreach ($words as $word) {
            $abbreviation .= strtoupper(substr($word, 0, 1));
        }
        
        return substr($abbreviation, 0, 3) ?: strtoupper(substr($this->name, 0, 3));
    }
    
    // Scope for active ministries
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
    
    // Scope for searching ministries
    public function scopeSearch($query, $search)
    {
        return $query->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhere('leader_name', 'like', "%{$search}%");
    }
    
    //  Get active members
    public function activeMembers()
    {
        return $this->members()->wherePivot('is_active', true);
    }
    
    //  Get ministry leaders
    public function leaders()
    {
        return $this->members()
                    ->wherePivot('role', 'like', '%leader%')
                    ->wherePivot('is_active', true);
    }
}