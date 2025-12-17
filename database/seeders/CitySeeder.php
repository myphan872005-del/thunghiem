<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitySeeder extends Seeder
{
    public function run(): void
    {
        // 👇 Đổi insert thành insertOrIgnore
        DB::table('cities')->insertOrIgnore([
            ['CityID' => 1, 'Name' => 'Đà Nẵng'],
            ['CityID' => 2, 'Name' => 'Hà Nội'],
            ['CityID' => 3, 'Name' => 'Huế'], // Cái này sẽ được thêm vào
        ]);
    }
}
