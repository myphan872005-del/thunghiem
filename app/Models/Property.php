<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;
    
    // Đảm bảo khóa chính là PropertyID
    protected $primaryKey = 'PropertyID';

    // Quan hệ với người đăng
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // ⭐️ Quan hệ với City (theo trường CityID) ⭐️
    public function city()
    {
        // Giả định Model City và khóa chính là CityID
        return $this->belongsTo(City::class, 'CityID', 'CityID');
    }

    // ⭐️ Quan hệ với Ward (theo trường WardID) ⭐️
    public function ward()
    {
        // Giả định Model Ward và khóa chính là WardID
        return $this->belongsTo(Ward::class, 'WardID', 'WardID');
    }
}