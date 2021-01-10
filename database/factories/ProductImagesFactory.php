<?php

namespace Database\Factories;

use App\Models\ProductImages;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductImagesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProductImages::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //'url' => '/storage/images/'.$this->faker->image('public/storage/images', 480, 480, null, false),
            'url' => $this->faker->randomElement([
                '4659.jpg',
                '151021-phones-review-hands.jpg',
                '153887-phones-review-nokia-83.jpg',
                'feature-9.jpg',
                'images.jpg',
                'IMG_1979-scaled.jpg',
                'iphone-12-pro-512gb-281120-1212470.jpg',
                'maxresdefault-3.jpg',   
                'samsung-galaxy-s20.jpg',
                'Vivo-V20-Pro-test.jpg',
            ]),
        ];
    }
}
