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
        'username',
        'phone',
        'RoleID', 
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

    // File: app/Models/User.php
public function properties()
{
    return $this->hasMany(Property::class, 'user_id');
}
public function getRankInfoAttribute()
{
    // Đếm số tin đã duyệt
    $count = \App\Models\Property::where('user_id', $this->id)->where('Status', 'Approved')->count();

    if ($count >= 10) {
        return [
            'name'  => '💎 VIP Bạch Kim',
            'color' => 'text-purple-600', // Tím
            'icon'  => '👑'
        ];
    } elseif ($count >= 5) {
        return [
            'name'  => '🥇 Thành viên Vàng',
            'color' => 'text-yellow-600', // Vàng đậm
            'icon'  => '⭐'
        ];
    } else {
        return [
            'name'  => '🥈 Thành viên Mới',
            'color' => 'text-gray-600', // Xám
            'icon'  => ''
        ];
    }
}
}
