<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// app/Models/City.php
class City extends Model
{
    // ...
    protected $primaryKey = 'CityID';

    public function wards()
    {
        // City có nhiều Wards
        return $this->hasMany(Ward::class, 'CityID', 'CityID');
    }
}