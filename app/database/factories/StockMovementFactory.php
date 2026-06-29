<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\StockMovement;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<StockMovement> */
class StockMovementFactory extends Factory
{
    protected $model = StockMovement::class;

    public function definition(): array
    {
        return [
            'product_id' => Product::factory(),
            'user_id' => User::factory(),
            'type' => fake()->randomElement([StockMovement::TYPE_ENTRADA, StockMovement::TYPE_SALIDA]),
            'quantity' => fake()->numberBetween(1, 30),
            'reason' => fake()->sentence(3),
        ];
    }
}
