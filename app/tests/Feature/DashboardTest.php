<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use App\Models\StockMovement;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_guests_cannot_access_dashboard(): void
    {
        $this->get(route('dashboard'))->assertRedirect(route('login'));
    }

    public function test_authenticated_user_sees_dashboard_metrics(): void
    {
        $user = User::factory()->create();
        $categories = Category::factory()->count(3)->create();
        Product::factory()->count(5)->create([
            'category_id' => $categories->first()->id,
            'stock_quantity' => 50,
            'stock_minimum' => 5,
        ]);
        Product::factory()->create([
            'category_id' => $categories->first()->id,
            'stock_quantity' => 2,
            'stock_minimum' => 10,
        ]);
        Product::factory()->create([
            'category_id' => $categories->first()->id,
            'stock_quantity' => 0,
            'stock_minimum' => 5,
        ]);

        $response = $this->actingAs($user)->get(route('dashboard'));

        $response
            ->assertOk()
            ->assertViewHas('totalProducts', 7)
            ->assertViewHas('totalCategories', 3)
            ->assertViewHas('lowStockCount', 2)
            ->assertSee('Total productos')
            ->assertSee('Total categorías')
            ->assertSee('Stock bajo');
    }

    public function test_dashboard_shows_only_last_ten_movements(): void
    {
        $user = User::factory()->create();
        $product = Product::factory()->create();

        StockMovement::factory()->count(12)->create([
            'product_id' => $product->id,
            'user_id' => $user->id,
        ]);

        $response = $this->actingAs($user)->get(route('dashboard'));

        $response
            ->assertOk()
            ->assertViewHas('recentMovements', fn ($movements) => $movements->count() === 10);
    }

    public function test_dashboard_lists_low_stock_products(): void
    {
        $user = User::factory()->create();
        $category = Category::factory()->create(['name' => 'Lácteos']);
        $lowStockProduct = Product::factory()->create([
            'category_id' => $category->id,
            'name' => 'Leche entera',
            'sku' => 'LEC-001',
            'stock_quantity' => 3,
            'stock_minimum' => 10,
        ]);
        Product::factory()->create([
            'category_id' => $category->id,
            'stock_quantity' => 50,
            'stock_minimum' => 5,
        ]);

        $response = $this->actingAs($user)->get(route('dashboard'));

        $response
            ->assertOk()
            ->assertSee('Productos con stock bajo')
            ->assertSee('Leche entera')
            ->assertSee('LEC-001')
            ->assertSee('Lácteos');
    }
}
