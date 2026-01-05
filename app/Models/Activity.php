<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Activity extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'type',
        'description',
        'subject_id',
        'subject_type',
        'user_id',
        'metadata',
        'performed_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'metadata' => 'array',
        'performed_at' => 'datetime',
    ];

    /**
     * Get the subject of the activity.
     */
    public function subject(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Get the user who performed the activity.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Log a new activity.
     */
    public static function log(string $type, string $description, $subject = null, array $metadata = []): self
    {
        return self::create([
            'type' => $type,
            'description' => $description,
            'subject_id' => $subject?->id,
            'subject_type' => $subject ? get_class($subject) : null,
            'user_id' => auth()->id(),
            'metadata' => $metadata,
            'performed_at' => now(),
        ]);
    }

    /**
     * Get activity types with their icons.
     */
    public static function getTypeIcons(): array
    {
        return [
            'member_added' => 'person_add',
            'event_created' => 'edit_calendar',
            'donation_received' => 'payments',
            'attendance_uploaded' => 'cloud_upload',
            'user_updated' => 'edit',
            'parish_created' => 'church',
            'default' => 'info',
        ];
    }

    /**
     * Get activity types with their colors.
     */
    public static function getTypeColors(): array
    {
        return [
            'member_added' => 'bg-green-500/10 text-green-500',
            'event_created' => 'bg-orange-500/10 text-orange-500',
            'donation_received' => 'bg-blue-500/10 text-blue-500',
            'attendance_uploaded' => 'bg-primary/10 text-primary',
            'user_updated' => 'bg-purple-500/10 text-purple-500',
            'parish_created' => 'bg-indigo-500/10 text-indigo-500',
            'default' => 'bg-slate-500/10 text-slate-500',
        ];
    }

    /**
     * Get the icon for this activity type.
     */
    public function getIconAttribute(): string
    {
        return self::getTypeIcons()[$this->type] ?? 'info';
    }

    /**
     * Get the color class for this activity type.
     */
    public function getColorClassAttribute(): string
    {
        return self::getTypeColors()[$this->type] ?? self::getTypeColors()['default'];
    }
}