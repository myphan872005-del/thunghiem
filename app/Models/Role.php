<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    // Cấu hình tên bảng và khóa chính tùy chỉnh
    protected $table = 'roles'; 
    protected $primaryKey = 'RoleID';
    
    // Khai báo các cột có thể gán giá trị
    protected $fillable = [
        'name',
        'description',
    ];

    /**
     * Mối quan hệ: Role có nhiều User
     */
    public function users()
    {
        // 'RoleID' là Foreign Key trên bảng 'users'
        return $this->hasMany(User::class, 'RoleID', 'RoleID');
    }
}