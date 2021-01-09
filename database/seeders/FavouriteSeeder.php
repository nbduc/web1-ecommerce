<?php

namespace Database\Seeders;

use App\Models\Favourite;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class FavouriteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = Product::all();
        Favourite::factory()->times(55)->create()->each(function ($favourite) use($products){
            $favourite->product_id = $products->random(1)->pluck('id')->first();
        });
    }
}
