<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Order::factory()::times(25)->create()->each(function($order){
            OrderDetail::factory()->times(3)->create(['order_id' => $order->id]);
        });;
    }
}
