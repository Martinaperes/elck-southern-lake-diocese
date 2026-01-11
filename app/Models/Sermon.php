<?php
// app/Models/Sermon.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sermon extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'scripture_references',
        'preacher',
        'sermon_date',
        'audio_url',
        'video_url',
        'document_url',
        'duration_minutes',
        'is_published'
    ];

    protected $casts = [
        'sermon_date' => 'date',
        'is_published' => 'boolean'
    ];

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }
    
    public function scopeRecent($query)
    {
        return $query->orderBy('sermon_date', 'desc');
    }

    // Accessor for formatted scripture references
    public function getFormattedScripturesAttribute()
    {
        if (!$this->scripture_references) return null;
        
        return collect(explode(',', $this->scripture_references))
            ->map(fn($ref) => trim($ref))
            ->join(', ');
    }

public function scopeIsCurrentWeek($query)
{
    return $query->whereBetween('sermon_date', [
        now()->startOfWeek(),
        now()->endOfWeek()
    ]);
}
    // Accessor for duration format
    public function getDurationFormattedAttribute()
    {
        if (!$this->duration_minutes) return null;
        
        $hours = floor($this->duration_minutes / 60);
        $minutes = $this->duration_minutes % 60;
        
        if ($hours > 0) {
            return "{$hours}h {$minutes}m";
        }
        
        return "{$minutes}m";
    }
    // Add this scope to your existing Sermon model
public function scopeThisWeek($query)
{
    return $query->whereBetween('sermon_date', [
        now()->startOfWeek(),
        now()->endOfWeek()
    ]);
}

public function scopeFeatured($query)
{
    return $query->where('featured', true);
}
}