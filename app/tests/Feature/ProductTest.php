<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    public function test_product_sku_must_be_unique(): void
    {
        $user = User::factory()->create();
        $category = Category::factory()->create();
        Product::factory()->create(['sku' => 'DUP-001', 'category_id' => $category->id]);

        $response = $this->actingAs($user)->post(route('products.store'), [
            'category_id' => $category->id,
            'name' => 'Otro producto',
            'sku' => 'DUP-001',
            'price' => 1.00,
            'stock_minimum' => 1,
            'unit' => 'unidad',
            'status' => 'activo',
        ]);

        $response->assertSessionHasErrors('sku');
        $this->assertDatabaseCount('products', 1);
    }

    public function test_stock_quantity_is_not_updated_from_product_form(): void
    {
        $user = User::factory()->create();
        $category = Category::factory()->create();
        $product = Product::factory()->create([
            'category_id' => $category->id,
            'stock_quantity' => 25,
        ]);

        $this->actingAs($user)->put(route('products.update', $product), [
            'category_id' => $category->id,
            'name' => $product->name,
            'sku' => $product->sku,
            'price' => $product->price,
            'stock_minimum' => $product->stock_minimum,
            'unit' => $product->unit,
            'status' => $product->status,
            'stock_quantity' => 999,
        ])->assertRedirect(route('products.index'));

        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'stock_quantity' => 25,
        ]);
    }

    public function test_product_index_filters_by_name(): void
    {
        $user = User::factory()->create();
        $category = Category::factory()->create();
        Product::factory()->create([
            'category_id' => $category->id,
            'name' => 'Leche entera',
            'sku' => 'LEC-001',
        ]);
        Product::factory()->create([
            'category_id' => $category->id,
            'name' => 'Pan integral',
            'sku' => 'PAN-001',
        ]);

        $response = $this->actingAs($user)->get(route('products.index', ['search' => 'Leche']));

        $response
            ->assertOk()
            ->assertViewHas('products', fn ($products) => $products->count() === 1
                && $products->first()->name === 'Leche entera')
            ->assertSee('Leche entera')
            ->assertDontSee('Pan integral');
    }

    public function test_product_index_filters_by_sku(): void
    {
        $user = User::factory()->create();
        $category = Category::factory()->create();
        Product::factory()->create([
            'category_id' => $category->id,
            'name' => 'Arroz',
            'sku' => 'ARR-500',
        ]);
        Product::factory()->create([
            'category_id' => $category->id,
            'name' => 'Frijol',
            'sku' => 'FRI-001',
        ]);

        $response = $this->actingAs($user)->get(route('products.index', ['search' => 'ARR-500']));

        $response
            ->assertOk()
            ->assertViewHas('products', fn ($products) => $products->count() === 1
                && $products->first()->sku === 'ARR-500')
            ->assertSee('Arroz')
            ->assertDontSee('Frijol');
    }

    public function test_product_index_filters_by_category(): void
    {
        $user = User::factory()->create();
        $lacteos = Category::factory()->create(['name' => 'Lácteos']);
        $bebidas = Category::factory()->create(['name' => 'Bebidas']);
        Product::factory()->create([
            'category_id' => $lacteos->id,
            'name' => 'Yogurt',
        ]);
        Product::factory()->create([
            'category_id' => $bebidas->id,
            'name' => 'Refresco',
        ]);

        $response = $this->actingAs($user)->get(route('products.index', ['category_id' => $lacteos->id]));

        $response
            ->assertOk()
            ->assertViewHas('products', fn ($products) => $products->count() === 1
                && $products->first()->name === 'Yogurt')
            ->assertSee('Yogurt')
            ->assertDontSee('Refresco');
    }

    public function test_product_index_preserves_filters_in_pagination(): void
    {
        $user = User::factory()->create();
        $category = Category::factory()->create();

        Product::factory()->count(20)->create([
            'category_id' => $category->id,
            'name' => 'Producto filtrado',
        ]);
        Product::factory()->create([
            'category_id' => $category->id,
            'name' => 'Otro producto',
        ]);

        $response = $this->actingAs($user)->get(route('products.index', [
            'search' => 'filtrado',
            'category_id' => $category->id,
            'page' => 2,
        ]));

        $response
            ->assertOk()
            ->assertViewHas('products', fn ($products) => $products->currentPage() === 2);
    }
}
