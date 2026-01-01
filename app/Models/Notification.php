<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'message',
        'type',
        'email',
        'phone',
        'inquiry_type',
        'read',
        'data'
    ];

    protected $casts = [
        'read' => 'boolean',
        'data' => 'array'
    ];

    // Relationship to user (if applicable)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Scope for unread notifications
    public function scopeUnread($query)
    {
        return $query->where('read', false);
    }

    // Scope for contact messages
    public function scopeContactMessages($query)
    {
        return $query->where('type', 'contact');
    }

    // Mark as read
    public function markAsRead()
    {
        $this->update(['read' => true]);
        return $this;
    }

    // Mark as unread
    public function markAsUnread()
    {
        $this->update(['read' => false]);
        return $this;
    }
}