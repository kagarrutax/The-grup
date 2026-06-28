<?php

namespace Database\Seeders;

use App\Models\User;
<<<<<<< HEAD
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Crear usuario administrador
        User::factory()->admin()->create([
            'name' => 'Administrador',
            'email' => 'admin@supermercado.com',
            'password' => Hash::make('password'),
        ]);

        // 2. Definir categorías y sus productos asociados
        $categoriesData = [
            'Lácteos' => [
                'description' => 'Leche, quesos, yogures y derivados lácteos.',
                'products' => [
                    ['name' => 'Leche Entera 1L', 'unit' => 'litro', 'price' => 24.50],
                    ['name' => 'Yogur Natural 1kg', 'unit' => 'pieza', 'price' => 45.00],
                    ['name' => 'Queso Cotija 250g', 'unit' => 'pieza', 'price' => 58.50],
                    ['name' => 'Mantequilla con sal 90g', 'unit' => 'pieza', 'price' => 19.90],
                    ['name' => 'Crema Ácida 200ml', 'unit' => 'pieza', 'price' => 15.00],
                    ['name' => 'Queso Oaxaca 400g', 'unit' => 'pieza', 'price' => 85.00],
                ]
            ],
            'Carnes' => [
                'description' => 'Carnes rojas, pollo, pescado y embutidos.',
                'products' => [
                    ['name' => 'Pechuga de Pollo 1kg', 'unit' => 'kg', 'price' => 110.00],
                    ['name' => 'Bife de Res 500g', 'unit' => 'pieza', 'price' => 145.00],
                    ['name' => 'Filete de Pescado 1kg', 'unit' => 'kg', 'price' => 160.00],
                    ['name' => 'Milanesa de Cerdo 1kg', 'unit' => 'kg', 'price' => 98.00],
                    ['name' => 'Jamón de Pavo 250g', 'unit' => 'pieza', 'price' => 38.00],
                    ['name' => 'Tocino de Cerdo 200g', 'unit' => 'pieza', 'price' => 52.00],
                ]
            ],
            'Bebidas' => [
                'description' => 'Aguas, jugos, refrescos y licores.',
                'products' => [
                    ['name' => 'Coca-Cola 2L', 'unit' => 'pieza', 'price' => 35.00],
                    ['name' => 'Jugo de Naranja 1L', 'unit' => 'pieza', 'price' => 22.00],
                    ['name' => 'Agua Mineral 1.5L', 'unit' => 'pieza', 'price' => 16.50],
                    ['name' => 'Cerveza Lager 6pack', 'unit' => 'paquete', 'price' => 95.00],
                    ['name' => 'Refresco de Limón 600ml', 'unit' => 'pieza', 'price' => 15.00],
                    ['name' => 'Té Helado Durazno 1.5L', 'unit' => 'pieza', 'price' => 28.00],
                ]
            ],
            'Limpieza' => [
                'description' => 'Productos de aseo para el hogar.',
                'products' => [
                    ['name' => 'Detergente en Polvo 1kg', 'unit' => 'pieza', 'price' => 42.00],
                    ['name' => 'Limpiador Multiusos 1L', 'unit' => 'pieza', 'price' => 26.00],
                    ['name' => 'Cloro Líquido 1L', 'unit' => 'pieza', 'price' => 18.00],
                    ['name' => 'Jabón de Tocador 4pack', 'unit' => 'paquete', 'price' => 48.00],
                    ['name' => 'Lavavajillas Líquido 750ml', 'unit' => 'pieza', 'price' => 32.00],
                    ['name' => 'Limpiador de Vidrios 500ml', 'unit' => 'pieza', 'price' => 29.00],
                ]
            ],
            'Panadería' => [
                'description' => 'Pan dulce, pan de caja, galletas y repostería.',
                'products' => [
                    ['name' => 'Pan de Caja Integral', 'unit' => 'pieza', 'price' => 42.00],
                    ['name' => 'Bolillo Recién Horneado', 'unit' => 'pieza', 'price' => 2.50],
                    ['name' => 'Baguette de Trigo', 'unit' => 'pieza', 'price' => 18.00],
                    ['name' => 'Mantecadas 4pack', 'unit' => 'paquete', 'price' => 28.00],
                    ['name' => 'Galletas de Avena con Chispas', 'unit' => 'pieza', 'price' => 32.00],
                    ['name' => 'Donas de Chocolate 4pack', 'unit' => 'paquete', 'price' => 36.00],
                ]
            ]
        ];

        // 3. Insertar categorías y productos en bucle
        foreach ($categoriesData as $categoryName => $data) {
            $category = Category::create([
                'name' => $categoryName,
                'description' => $data['description'],
            ]);

            foreach ($data['products'] as $prod) {
                // Generar un SKU único y representativo: "LAC-00001", "CAR-00002", etc.
                $skuPrefix = strtoupper(substr($categoryName, 0, 3));
                $sku = $skuPrefix . '-' . fake()->unique()->numerify('#####');

                Product::factory()->create([
                    'category_id' => $category->id,
                    'name' => $prod['name'],
                    'sku' => $sku,
                    'price' => $prod['price'],
                    'unit' => $prod['unit'],
                    'stock_quantity' => fake()->numberBetween(0, 100),
                    'stock_minimum' => fake()->numberBetween(5, 15),
                    'status' => 'activo',
                ]);
            }
        }
=======
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Administrador',
            'email' => 'admin@supermercado.com',
            'role' => User::ROLE_ADMIN,
        ]);
>>>>>>> d959ad24edda2faacd434ad042d52e081eb02510
    }
}
