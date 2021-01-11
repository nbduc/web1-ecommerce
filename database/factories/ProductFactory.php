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
            /*'feature_img' => '/storage/images/'.$this->faker->image('public/storage/images',165,165, null, false),*/
            'feature_img' => $this->faker->randomElement([
                'iphone-11-pro-max-512gb-gold-400x400.jpg',
                'iphone-12-pro-max-xanh-duong-new-600x600-600x600.jpg',
                'iphone-12-pro-xam-new-600x600-600x600.jpg',
                'iphone-12-pro-xanh-duong-new-600x600-600x600.jpg',
                'iphone-12-red.jpg',
                'iphone1264gb.jpg',
                'samsung-galaxy-a12-trang-600x600-600x600.jpg',
                'samsung-galaxy-z-fold-2-vang-600x600-600x600.jpg',
            
            ]),
            'description' => $this->faker->paragraph($nbSentences = 20, $variableNbSentences = true),
            'price' => $this->faker->randomElement(['23.990.000','30.990.000','50.000.000','29.990.000','16.490.000']),
            'likes' => $this->faker->randomNumber($nbDigits = 2, $strict = false),
            'in_stock' => $this->faker->randomNumber($nbDigits = 2, $strict = false),
        ];
    }
}
