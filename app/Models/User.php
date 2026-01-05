<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
public function donations()
{
    return $this->hasMany(Donation::class, 'member_id');
}

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function member()
{
    return $this->hasOne(Member::class);
}
 public function hasMemberProfile(): bool
    {
        return $this->member !== null;
    }
    public function parish()
{
    return $this->belongsTo(Parish::class);
}

public function createMemberProfile(array $memberData): Member
{
    // Create member profile associated with this user
    return $this->member()->create(array_merge($memberData, [
        'user_id' => $this->id,
        'email' => $this->email,
        'joined_at' => now(),
        'is_active' => true,
    ]));
}
}
