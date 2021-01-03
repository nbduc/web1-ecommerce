<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $users = User::pluck('id')->toArray();
        $statuses = OrderStatus::pluck('id')->toArray();
        return [
            //
            'user_id' => $this->faker->randomElement($users),
            'ship_date' => $this->faker->dateTimeThisMonth($max = 'now'),
            'ship_address' => $this->faker->address,
            'status_id' => $this->faker->randomElement($statuses),
        ];
    }
}
