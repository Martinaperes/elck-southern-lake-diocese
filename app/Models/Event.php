<?php
// app/Models/Event.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'start_time',
        'end_time',
        'location',
        'event_type',
        'ministry_id',
        'is_public',
        'poster' // Add poster to fillable
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
        'is_public' => 'boolean'
    ];

    // Relationship with Ministry
    public function ministry(): BelongsTo
    {
        return $this->belongsTo(Ministry::class);
    }

    // Relationship with Event Registrations
    public function registrations(): HasMany
    {
        return $this->hasMany(EventRegistration::class);
    }

    // Accessor for poster URL
    public function getPosterUrlAttribute()
    {
        return $this->poster ? asset('storage/' . $this->poster) : null;
    }

    // Scopes
    public function scopePublic($query)
    {
        return $query->where('is_public', true);
    }

    public function scopeUpcoming($query)
    {
        return $query->where('start_time', '>=', now());
    }

    public function getEventTypeBadgeAttribute()
    {
        $types = [
            'service' => 'primary',
            'meeting' => 'info',
            'conference' => 'success',
            'workshop' => 'warning',
            'other' => 'secondary'
        ];

        $color = $types[$this->event_type] ?? 'secondary';
        return '<span class="badge badge-'.$color.'">'.ucfirst($this->event_type).'</span>';
    }
}