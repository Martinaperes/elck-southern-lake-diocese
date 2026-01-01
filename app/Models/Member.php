<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'email',
        'phone',
        'address',
        'joined_at',
        'photo',
        'date_of_birth',
        'gender',
        'marital_status',
        'baptism_date',
        'confirmation_date',
        'membership_number',
        'home_congregation',
        'emergency_contact_name',
        'emergency_contact_phone',
        'is_active',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'baptism_date' => 'date',
        'confirmation_date' => 'date',
        'joined_at' => 'date',
        'is_active' => 'boolean'
    ];

    /**
     * A member belongs to a user (optional).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
   
    public function getFullNameAttribute(): string
    {
        return trim($this->first_name . ' ' . $this->last_name);
    }

    /**
     * Calculate age
     */
    public function getAgeAttribute(): ?int
    {
        if (!$this->date_of_birth) {
            return null;
        }

        return $this->date_of_birth->age;
    }
    
    public function getSafeAgeAttribute(): string
    {
        $age = $this->age;
        return $age ? $age . ' years old' : 'N/A';
    }
    
    /**
     * A member can register for many events.
     */
    public function events()
    {
        return $this->belongsToMany(Event::class, 'event_registration')
                    ->withPivot('number_of_guests', 'status')
                    ->withTimestamps();
    }

    /**
     * A member has many event registrations (direct access to pivot table).
     */
    public function eventRegistrations()
    {
        return $this->hasMany(EventRegistration::class);
    }
    
    /**
     * ✅ FIXED: Correct relationship with ministries
     */
    public function ministries()
    {
        return $this->belongsToMany(Ministry::class, 'ministry_members', 'member_id', 'ministry_id')
                    ->withPivot('role', 'joined_at', 'is_active')
                    ->withTimestamps();
    }
    
    /**
     * ✅ NEW: Relationship with MinistryMember model
     */
    public function ministryMembers()
    {
        return $this->hasMany(MinistryMember::class);
    }
    
    /**
     * ✅ NEW: Get member's active ministries
     */
    public function activeMinistries()
    {
        return $this->ministries()
                    ->wherePivot('is_active', true);
    }
    
    /**
     * ✅ NEW: Accessor for initials
     */
    public function getInitialsAttribute(): string
    {
        return strtoupper(
            substr($this->first_name, 0, 1) . 
            substr($this->last_name, 0, 1)
        );
    }
    
    /**
     * ✅ NEW: Scope for active members
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
    
    /**
     * ✅ NEW: Scope for searching members
     */
    public function scopeSearch($query, $search)
    {
        return $query->where('first_name', 'like', "%{$search}%")
                    ->orWhere('last_name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('membership_number', 'like', "%{$search}%");
    }
}