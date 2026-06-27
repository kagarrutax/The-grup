<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_guests_cannot_access_category_routes(): void
    {
        $category = Category::factory()->create();

        $this->get(route('categories.index'))->assertRedirect(route('login'));
        $this->post(route('categories.store'), ['name' => 'Nueva'])->assertRedirect(route('login'));
        $this->put(route('categories.update', $category), ['name' => 'Editada'])->assertRedirect(route('login'));
        $this->delete(route('categories.destroy', $category))->assertRedirect(route('login'));
    }

    public function test_authenticated_user_can_create_category(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('categories.store'), [
            'name' => 'Lácteos',
            'description' => 'Leche, queso y derivados',
        ]);

        $response
            ->assertRedirect(route('categories.index'))
            ->assertSessionHas('success');

        $this->assertDatabaseHas('categories', [
            'name' => 'Lácteos',
            'description' => 'Leche, queso y derivados',
        ]);
    }

    public function test_authenticated_user_can_update_category(): void
    {
        $user = User::factory()->create();
        $category = Category::factory()->create(['name' => 'Bebidas']);

        $response = $this->actingAs($user)->put(route('categories.update', $category), [
            'name' => 'Bebidas y jugos',
            'description' => 'Refrescos y jugos naturales',
        ]);

        $response
            ->assertRedirect(route('categories.index'))
            ->assertSessionHas('success');

        $this->assertDatabaseHas('categories', [
            'id' => $category->id,
            'name' => 'Bebidas y jugos',
        ]);
    }

    public function test_authenticated_user_can_delete_category(): void
    {
        $user = User::factory()->create();
        $category = Category::factory()->create();

        $response = $this->actingAs($user)->delete(route('categories.destroy', $category));

        $response
            ->assertRedirect(route('categories.index'))
            ->assertSessionHas('success');

        $this->assertDatabaseMissing('categories', ['id' => $category->id]);
    }

    public function test_category_name_is_required(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('categories.store'), [
            'name' => '',
            'description' => 'Sin nombre',
        ]);

        $response->assertSessionHasErrors('name');
        $this->assertDatabaseCount('categories', 0);
    }

    public function test_category_name_must_be_unique(): void
    {
        $user = User::factory()->create();
        Category::factory()->create(['name' => 'Panadería']);

        $response = $this->actingAs($user)->post(route('categories.store'), [
            'name' => 'Panadería',
            'description' => 'Duplicado',
        ]);

        $response->assertSessionHasErrors('name');
        $this->assertDatabaseCount('categories', 1);
    }
}
