<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WardSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('wards')->insert([
            ['Name' => 'Phường Hải Châu 1', 'CityID' => 1],
            ['Name' => 'Phường Hải Châu 2', 'CityID' => 1],
            ['Name' => 'Phường Ba Đình 1', 'CityID' => 2],
            ['Name' => 'Phường Ba Đình 2', 'CityID' => 2],
        ]);
    }
}
