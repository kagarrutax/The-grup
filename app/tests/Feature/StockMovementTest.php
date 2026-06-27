<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\StockMovement;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StockMovementTest extends TestCase
{
    use RefreshDatabase;

    public function test_guests_cannot_register_stock_movements(): void
    {
        $product = Product::factory()->create();

        $this->post(route('stock.store'), [
            'product_id' => $product->id,
            'type' => StockMovement::TYPE_ENTRADA,
            'quantity' => 10,
        ])->assertRedirect(route('login'));
    }

    public function test_entrada_increments_stock_quantity(): void
    {
        $user = User::factory()->create();
        $product = Product::factory()->create(['stock_quantity' => 10]);

        $response = $this->actingAs($user)->post(route('stock.store'), [
            'product_id' => $product->id,
            'type' => StockMovement::TYPE_ENTRADA,
            'quantity' => 15,
            'reason' => 'Compra proveedor',
        ]);

        $response
            ->assertRedirect(route('stock.index'))
            ->assertSessionHas('success');

        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'stock_quantity' => 25,
        ]);

        $this->assertDatabaseHas('stock_movements', [
            'product_id' => $product->id,
            'user_id' => $user->id,
            'type' => StockMovement::TYPE_ENTRADA,
            'quantity' => 15,
            'reason' => 'Compra proveedor',
        ]);
    }

    public function test_salida_decrements_stock_quantity(): void
    {
        $user = User::factory()->create();
        $product = Product::factory()->create(['stock_quantity' => 30]);

        $response = $this->actingAs($user)->post(route('stock.store'), [
            'product_id' => $product->id,
            'type' => StockMovement::TYPE_SALIDA,
            'quantity' => 12,
            'reason' => 'Ajuste inventario',
        ]);

        $response->assertRedirect(route('stock.index'));

        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'stock_quantity' => 18,
        ]);
    }

    public function test_salida_with_insufficient_stock_fails_without_changing_stock(): void
    {
        $user = User::factory()->create();
        $product = Product::factory()->create(['stock_quantity' => 5]);

        $response = $this->actingAs($user)->post(route('stock.store'), [
            'product_id' => $product->id,
            'type' => StockMovement::TYPE_SALIDA,
            'quantity' => 10,
        ]);

        $response->assertSessionHasErrors('quantity');

        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'stock_quantity' => 5,
        ]);

        $this->assertDatabaseCount('stock_movements', 0);
    }

    public function test_quantity_must_be_at_least_one(): void
    {
        $user = User::factory()->create();
        $product = Product::factory()->create(['stock_quantity' => 10]);

        $response = $this->actingAs($user)->post(route('stock.store'), [
            'product_id' => $product->id,
            'type' => StockMovement::TYPE_ENTRADA,
            'quantity' => 0,
        ]);

        $response->assertSessionHasErrors('quantity');

        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'stock_quantity' => 10,
        ]);
    }
}
