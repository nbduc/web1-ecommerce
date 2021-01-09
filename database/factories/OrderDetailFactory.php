<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderDetailFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = OrderDetail::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $product = Product::pluck('id')->toArray();
        return [
            //
            'order_id' => function(){
                return Order::factory()->create()->id();
            },
            'product_id' => $this->faker->randomElement($product),
            'quantity' => $this->faker->numberBetween($min = 1, $max = 5),
            'unit_price' => $this->faker->numberBetween($min = 500000, $max = 50000000),
        ];
    }
}
