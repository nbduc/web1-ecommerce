<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->times(43)->create();
        //create admin
        $role = Role::select('id')->where('name', 'Admin')->first();
        User::create([
            'name' => 'Admin', 
            'email' => 'admin@mail.test', 
            'email_verified_at' => now(),
            'password' => Hash::make('123456789'),
        ])->roles()->attach($role);
    }
}
