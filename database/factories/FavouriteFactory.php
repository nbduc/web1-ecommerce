<?php

namespace Database\Factories;

use App\Models\Favourite;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class FavouriteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Favourite::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $users = User::pluck('id')->toArray();
        $product = Product::pluck('id')->toArray();
        return [
            'user_id' => $this->faker->randomElement($users),
            'product_id' => $this->faker->randomElement($product),
        ];
    }
}
