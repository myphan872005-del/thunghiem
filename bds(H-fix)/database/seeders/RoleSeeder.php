<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('roles')->insert([
            ['RoleID' => 1, 'RoleName' => 'Admin'],
            ['RoleID' => 2, 'RoleName' => 'User'],
            ['RoleID' => 3, 'RoleName' => 'Agent'],
        ]);
    }
}
