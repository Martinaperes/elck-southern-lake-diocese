<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory;

    protected $fillable = [
        'member_id',
        'amount',
        'payment_method',
        'transaction_code',
        'purpose',
        'status',
        'notes',
        'completed_at',
    ];

    // If you have a Member model
    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}
