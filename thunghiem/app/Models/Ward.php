<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
    // ...
    protected $primaryKey = 'WardID';

    public function city()
    {
        // Ward thuộc về một City
        return $this->belongsTo(City::class, 'CityID', 'CityID');
    }

    public function properties()
    {
        // Ward có nhiều Properties
        return $this->hasMany(Property::class, 'WardID', 'WardID');
    }
}
