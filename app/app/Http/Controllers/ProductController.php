<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->string('search')->trim()->toString();
        $categoryId = $request->integer('category_id') ?: null;

        $products = Product::query()
            ->with('category')
            ->search($search !== '' ? $search : null, $categoryId)
            ->orderBy('name')
            ->paginate(15)
            ->withQueryString();

        $categories = Category::query()->orderBy('name')->get();

        return view('products.index', compact('products', 'categories', 'search', 'categoryId'));
    }

    public function create()
    {
        $categories = Category::query()->orderBy('name')->get();

        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate($this->rules());

        Product::create($validated);

        return redirect()->route('products.index')->with('success', 'Producto creado correctamente.');
    }

    public function edit(Product $product)
    {
        $categories = Category::query()->orderBy('name')->get();

        return view('products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate($this->rules($product));

        $product->update($validated);

        return redirect()->route('products.index')->with('success', 'Producto actualizado correctamente.');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Producto eliminado correctamente.');
    }

    private function rules(?Product $product = null): array
    {
        $uniqueSku = Rule::unique('products', 'sku');

        if ($product !== null) {
            $uniqueSku = $uniqueSku->ignore($product->id);
        }

        return [
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'name' => ['required', 'string', 'max:255'],
            'sku' => ['required', 'string', 'max:100', $uniqueSku],
            'price' => ['required', 'numeric', 'min:0'],
            'stock_minimum' => ['required', 'integer', 'min:0'],
            'unit' => ['required', 'string', 'max:50'],
            'status' => ['required', 'string', Rule::in(['activo', 'inactivo'])],
        ];
    }
}
