<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductDetails;
use App\Models\ProductImages;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::factory()->times(50)->create()->each(function($product){
            ProductImages::factory()->times(3)->create(['product_id'=>$product->id]);
            ProductDetails::factory()->create(['product_id' => $product->id]);
        });
    }
}
