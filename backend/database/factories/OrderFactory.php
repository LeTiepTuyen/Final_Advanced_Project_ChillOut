<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Order>
 */
class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition()
    {
        return [
            'id' => Str::uuid()->toString(),
            'user_id' => $this->faker->uuid(),
            'name' => $this->faker->name(),
            'address' => $this->faker->address(),
            'zipcode' => $this->faker->postcode(),
            'city' => $this->faker->city(),
            'country' => $this->faker->country(),
            'created_at' => now(),
        ];
    }
}
