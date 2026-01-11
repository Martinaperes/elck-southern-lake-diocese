<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MinistryMember extends Model
{
    use HasFactory;

    protected $table = 'ministry_members';
    
    protected $fillable = [
        'ministry_id',
        'member_id',
        'role',
        'joined_at',
        'is_active'
    ];

    protected $casts = [
        'joined_at' => 'date',
        'is_active' => 'boolean'
    ];

    /**
     * Relationship with Ministry
     */
    public function ministry()
    {
        return $this->belongsTo(Ministry::class);
    }

    /**
     * Relationship with Member
     */
    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    /**
     * Accessor for member's full name
     */
    public function getMemberNameAttribute()
    {
        return $this->member ? $this->member->full_name : null;
    }

    /**
     * Accessor for ministry name
     */
    public function getMinistryNameAttribute()
    {
        return $this->ministry ? $this->ministry->name : null;
    }

    /**
     * Accessor for member number
     */
    public function getMemberNumberAttribute()
    {
        return $this->member ? $this->member->membership_number : null;
    }
    
    /**
     * Accessor for formatted joined date
     */
    public function getJoinedAtFormattedAttribute()
    {
        if (!$this->joined_at) {
            return 'N/A';
        }
        
        try {
            return $this->joined_at->format('M d, Y');
        } catch (\Exception $e) {
            return 'N/A';
        }
    }

    /**
     * Accessor for relative joined date
     */
    public function getJoinedAtRelativeAttribute()
    {
        if (!$this->joined_at) {
            return 'Not specified';
        }
        
        try {
            return $this->joined_at->diffForHumans();
        } catch (\Exception $e) {
            return 'Not specified';
        }
    }

    /**
     * Scope for active ministry members
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
    
    /**
     * Scope for leaders
     */
    public function scopeLeaders($query)
    {
        return $query->where('role', 'like', '%leader%');
    }
    
    /**
     * Scope for members of a specific ministry
     */
    public function scopeForMinistry($query, $ministryId)
    {
        return $query->where('ministry_id', $ministryId);
    }
    
    /**
     * Scope for specific member
     */
    public function scopeForMember($query, $memberId)
    {
        return $query->where('member_id', $memberId);
    }
}