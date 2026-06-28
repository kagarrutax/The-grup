<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'category_id' => \App\Models\Category::factory(),
            'name' => fake()->words(3, true),
            'sku' => strtoupper(fake()->unique()->bothify('??-#####')),
            'price' => fake()->randomFloat(2, 5, 200),
            'stock_quantity' => fake()->numberBetween(0, 100),
            'stock_minimum' => fake()->numberBetween(5, 20),
            'unit' => fake()->randomElement(['pieza', 'kg', 'litro', 'paquete']),
            'status' => 'activo',
        ];
    }
}
