<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Comment::class;

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
            'content' => $this->faker->paragraph($nbSentences = 20, $variableNbSentences = true),
        ];
    }
}
