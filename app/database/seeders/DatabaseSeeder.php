<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\StockMovement;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::factory()->admin()->create([
            'name' => 'Administrador',
            'email' => 'admin@supermercado.com',
            'password' => Hash::make('password'),
        ]);

        $operador = User::factory()->create([
            'name' => 'Operador',
            'email' => 'operador@supermercado.com',
            'password' => Hash::make('password'),
        ]);

        $categoriesData = [
            'Lácteos' => [
                'description' => 'Leche, quesos, yogures y derivados lácteos.',
                'products' => [
                    ['name' => 'Yogurt natural', 'sku' => 'SKU-008', 'unit' => 'unidad', 'price' => 18.50, 'stock' => 5, 'min' => 15],
                    ['name' => 'Leche entera 1L', 'sku' => 'SKU-012', 'unit' => 'litro', 'price' => 24.50, 'stock' => 42, 'min' => 10],
                    ['name' => 'Queso Oaxaca 400g', 'sku' => 'SKU-015', 'unit' => 'pieza', 'price' => 85.00, 'stock' => 20, 'min' => 8],
                ],
            ],
            'Bebidas' => [
                'description' => 'Aguas, jugos, refrescos y licores.',
                'products' => [
                    ['name' => 'Coca-Cola 2L', 'sku' => 'SKU-003', 'unit' => 'pieza', 'price' => 35.00, 'stock' => 60, 'min' => 12],
                    ['name' => 'Jugo de naranja 1L', 'sku' => 'SKU-004', 'unit' => 'litro', 'price' => 22.00, 'stock' => 30, 'min' => 10],
                ],
            ],
            'Abarrotes' => [
                'description' => 'Arroz, frijol, aceites y granos.',
                'products' => [
                    ['name' => 'Arroz premium 500g', 'sku' => 'SKU-001', 'unit' => 'pieza', 'price' => 28.00, 'stock' => 35, 'min' => 10],
                    ['name' => 'Aceite girasol 1L', 'sku' => 'SKU-014', 'unit' => 'litro', 'price' => 45.00, 'stock' => 8, 'min' => 20],
                ],
            ],
            'Limpieza' => [
                'description' => 'Productos de aseo para el hogar.',
                'products' => [
                    ['name' => 'Detergente 2L', 'sku' => 'SKU-022', 'unit' => 'litro', 'price' => 42.00, 'stock' => 24, 'min' => 6],
                    ['name' => 'Limpiador multiusos 1L', 'sku' => 'SKU-025', 'unit' => 'litro', 'price' => 26.00, 'stock' => 18, 'min' => 5],
                ],
            ],
            'Panadería' => [
                'description' => 'Pan, galletas y repostería.',
                'products' => [
                    ['name' => 'Pan integral', 'sku' => 'SKU-023', 'unit' => 'pieza', 'price' => 32.00, 'stock' => 12, 'min' => 30],
                ],
            ],
        ];

        $products = collect();

        foreach ($categoriesData as $categoryName => $data) {
            $category = Category::create([
                'name' => $categoryName,
                'description' => $data['description'],
            ]);

            foreach ($data['products'] as $prod) {
                $products->push(Product::create([
                    'category_id' => $category->id,
                    'name' => $prod['name'],
                    'sku' => $prod['sku'],
                    'price' => $prod['price'],
                    'stock_quantity' => $prod['stock'],
                    'stock_minimum' => $prod['min'],
                    'unit' => $prod['unit'],
                    'status' => 'activo',
                ]));
            }
        }

        $movements = [
            ['sku' => 'SKU-022', 'type' => StockMovement::TYPE_ENTRADA, 'qty' => 24, 'user' => $admin, 'reason' => 'Inventario inicial', 'days' => 5],
            ['sku' => 'SKU-001', 'type' => StockMovement::TYPE_SALIDA, 'qty' => 12, 'user' => $operador, 'reason' => 'Reposición tienda', 'days' => 5],
            ['sku' => 'SKU-014', 'type' => StockMovement::TYPE_ENTRADA, 'qty' => 20, 'user' => $admin, 'reason' => 'Compra proveedor', 'days' => 4],
            ['sku' => 'SKU-012', 'type' => StockMovement::TYPE_SALIDA, 'qty' => 8, 'user' => $operador, 'reason' => 'Venta mostrador', 'days' => 3],
            ['sku' => 'SKU-008', 'type' => StockMovement::TYPE_SALIDA, 'qty' => 5, 'user' => $operador, 'reason' => 'Ajuste inventario', 'days' => 2],
            ['sku' => 'SKU-023', 'type' => StockMovement::TYPE_ENTRADA, 'qty' => 15, 'user' => $admin, 'reason' => 'Recepción almacén', 'days' => 1],
        ];

        foreach ($movements as $mov) {
            $product = $products->firstWhere('sku', $mov['sku']);

            if (! $product) {
                continue;
            }

            StockMovement::create([
                'product_id' => $product->id,
                'user_id' => $mov['user']->id,
                'type' => $mov['type'],
                'quantity' => $mov['qty'],
                'reason' => $mov['reason'],
                'created_at' => now()->subDays($mov['days']),
                'updated_at' => now()->subDays($mov['days']),
            ]);
        }
    }
}
