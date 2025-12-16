<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitySeeder extends Seeder
{
    public function run(): void
    {
        DB::table('cities')->insert([
            ['CityID' => 1, 'Name' => 'Đà Nẵng'],
            ['CityID' => 2, 'Name' => 'Hà Nội'],
        ]);
    }
}
