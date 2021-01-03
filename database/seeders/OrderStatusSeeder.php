<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('order_statuses')->insert([
            ['name' => 'Pending', 'created_at' => now(), 'updated_at' => now()], 
            ['name' => 'Cancelled', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Awaiting Fulfillment', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Awaiting Shipment', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Completed', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
