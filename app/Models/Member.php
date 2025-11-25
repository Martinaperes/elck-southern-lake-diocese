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

    /**
     * A member belongs to a user (optional).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
   
    public function getFullNameAttribute(): string
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    /**
     * Calculate age
     */
     public function getAgeAttribute(): ?int
    {
        if (!$this->date_of_birth) {
            return null;
        }

        // Ensure date_of_birth is a Carbon instance
        $dob = $this->date_of_birth instanceof \Carbon\Carbon 
            ? $this->date_of_birth 
            : \Carbon\Carbon::parse($this->date_of_birth);

        return $dob->age;
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
                    ->withPivot('number_of_guests',  'status')
                    ->withTimestamps();
    }

    /**
     * A member has many event registrations (direct access to pivot table).
     */
    public function eventRegistrations()
    {
        return $this->hasMany(EventRegistration::class);
    }
    
    public function ministries()
    {
        return $this->belongsToMany(Ministry::class, 'ministry_members', 'member_id', 'ministries_id')
                    ->withPivot('role', 'joined_at', 'is_active')
                    ->withTimestamps();
    }
}
