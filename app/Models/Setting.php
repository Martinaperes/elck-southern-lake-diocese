<?php
// app/Models/Setting.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = ['key', 'value', 'type', 'group'];

    // Cast value based on type
    protected $casts = [
        'value' => 'string', // We'll handle custom casting manually
    ];

    // Get setting value with proper casting
    public function getCastedValueAttribute()
    {
        return match($this->type) {
            'boolean' => (bool) $this->value,
            'integer' => (int) $this->value,
            'json' => json_decode($this->value, true),
            default => $this->value,
        };
    }

    // Scope for grouping
    public function scopeGroup($query, $group)
    {
        return $query->where('group', $group);
    }
}