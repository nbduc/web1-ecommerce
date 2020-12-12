<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            ['name' => 'Admin', 'class' => 'badge badge-pill badge-warning', 'created_at' => now()], 
            ['name' => 'Customer', 'class' => 'badge badge-pill badge-primary', 'created_at' => now()]
        ]);
    }
}
