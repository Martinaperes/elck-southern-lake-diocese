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
        'contact_email',
        'meeting_schedule',
        'image_url',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }
    public function members()
{
    return $this->belongsToMany(Member::class, 'ministry_members')
                ->withPivot('role', 'joined_at', 'is_active')
                ->withTimestamps();
}
public function ministries()
{
    return $this->belongsToMany(Ministry::class, 'ministry_members')
                ->withPivot('role', 'joined_at', 'is_active')
                ->withTimestamps();
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

}