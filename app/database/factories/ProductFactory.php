<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        return [
            'category_id' => Category::factory(),
            'name' => fake()->words(3, true),
            'sku' => strtoupper(fake()->unique()->bothify('SKU-####')),
            'price' => fake()->randomFloat(2, 1, 500),
            'stock_quantity' => 0,
            'stock_minimum' => fake()->numberBetween(1, 10),
            'unit' => fake()->randomElement(['unidad', 'kg', 'litro', 'caja']),
            'status' => 'activo',
        ];
    }
}
