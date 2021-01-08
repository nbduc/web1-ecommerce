<?php

namespace Database\Factories;

use App\Models\ProductDetails;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductDetailsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProductDetails::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'display' => $this->faker->randomElement([
                'OLED, 6.1", Super Retina XDR',
                'Dynamic AMOLED 2X, 6.7", Quad HD+ (2K+)',
                'AMOLED, 6.78", Quad HD+ (2K+)',
                'OLED, 5.4", Super Retina XDR',
                'PLS TFT LCD, 6.5", HD+',
                'TFT LCD, 6.5", HD+',
                'LTPS IPS LCD, 6.5", Full HD+',
                'IPS LCD, 6.3", Full HD+',
                'IPS LCD, 6.39", HD+',
                'IPS LCD, 6.51", HD+',
            ]),
            'front_camera' => $this->faker->randomElement([
                '12 MP',
                '10 MP',
                '16 MP',
                '32 MP',
                '8 MP',
            ]),
            'rear_camera' => $this->faker->randomElement([
                '2 camera 12 MP',
                'Chính 12 MP & Phụ 64 MP, 12 MP, TOF 3D',
                'Chính 48 MP & Phụ 48 MP, 8 MP, 5 MP',
                'Chính 48 MP & Phụ 13 MP, 12 MP',
                'Chính 48 MP & Phụ 5 MP, 2 MP, 2 MP',
                'Chính 48 MP & Phụ 8 MP, 2 MP, 2 MP',
                'Chính 48 MP & Phụ 8 MP, 5 MP, 2 MP',
                'Chính 13 MP & Phụ 2 MP, 2 MP',
                'Chính 12 MP & Phụ 2 MP, 2 MP',
            ]),
            'storage' => $this->faker->randomElement([
                '32 GB',
                '64 GB',
                '128 GB',
                '256 GB',
            ]),
            'os' => $this->faker->randomElement([
                'iOS 14',
                'Android 10',
                'Android 9 (Pie)'
            ])
        ];
    }
}
