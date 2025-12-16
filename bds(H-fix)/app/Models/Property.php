<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    protected $table = 'properties'; // Khai báo rõ tên bảng cho chắc
    protected $primaryKey = 'PropertyID';

    // ⚠️ PHẦN QUAN TRỌNG MỚI THÊM ⚠️
    // Phải khai báo các cột được phép ghi dữ liệu
    protected $fillable = [
        'user_id',
        'Title',
        'Description',
        'Address',
        'Image', // Lưu đường dẫn ảnh
        'CityID',
        'WardID',
        'ListingType', // Sale hoặc Rent
        'Price',
        'Area',
        'Status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'CityID', 'CityID');
    }

    public function ward()
    {
        return $this->belongsTo(Ward::class, 'WardID', 'WardID');
    }
}
