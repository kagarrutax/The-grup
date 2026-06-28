<?php

namespace Database\Factories;

<<<<<<< HEAD
=======
use App\Models\Category;
>>>>>>> d959ad24edda2faacd434ad042d52e081eb02510
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
<<<<<<< HEAD
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
=======
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
>>>>>>> d959ad24edda2faacd434ad042d52e081eb02510
            'status' => 'activo',
        ];
    }
}
