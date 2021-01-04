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
            ['name' => 'Pending', 'class' => 'badge badge-primary', 'created_at' => now(), 'updated_at' => now()], 
            ['name' => 'Cancelled', 'class' => 'badge badge-danger', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Awaiting Fulfillment', 'class' => 'badge badge-info', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Awaiting Shipment', 'class' => 'badge badge-warning', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Completed', 'class' => 'badge badge-success', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
