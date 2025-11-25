<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $table = 'notifications';

    protected $fillable = [
        'user_id',
        'title', 
        'message',
        'type',
        'read',
        'data'
    ];

    protected $casts = [
        'read' => 'boolean',
        'data' => 'array'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Scope for unread notifications
    public function scopeUnread($query)
    {
        return $query->where('read', false);
    }

    // Mark as read
    public function markAsRead()
    {
        $this->update(['read' => true]);
    }
}