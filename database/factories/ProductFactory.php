<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->randomElement([
                'Samsung Galaxy Note 20 Ultra',
                'iPhone 12 Pro 128GB',
                'iPhone 12 mini 256GB',
                'Samsung Galaxy S20+',
                'OPPO Find X2',
                'Vivo V20',
                'OPPO Reno5',
                'Samsung Galaxy M51',
                'Realme C15',
                'Vivo Y51',
                'Samsung Galaxy Z Flip',
                'Nokia 8.3 5G',
                'Vsmart Aris Pro',
                'Xiaomi POCO X3 NFC',
                'Nokia 5.4',
            ]),
            'feature_img' => '/storage/images/'.$this->faker->image('public/storage/images',165,165, null, false),
            'description' => $this->faker->paragraph($nbSentences = 20, $variableNbSentences = true),
            'price' => $this->faker->randomFloat($nbMaxDecimals = 2, $min = 999, $max = 99),
            'likes' => $this->faker->randomNumber($nbDigits = 2, $strict = false),
            'in_stock' => $this->faker->randomNumber($nbDigits = 2, $strict = false),
        ];
    }
}
