<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use App\Support\InventorySchema;
use App\Support\InventoryNotificationService;
use App\Support\SqlSearch;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->string('search')->trim()->toString();
        $searchPattern = SqlSearch::like($search);
        $categoryId = $request->integer('category_id') ?: null;
        $suppliersAvailable = InventorySchema::hasSuppliersTable() && InventorySchema::productHasSupplierId();
        $supplierId = $suppliersAvailable ? ($request->integer('supplier_id') ?: null) : null;

        $query = Product::query()
            ->select('products.*')
            ->with($suppliersAvailable ? ['category', 'supplier'] : ['category'])
            ->leftJoin('categories', 'categories.id', '=', 'products.category_id');

        if ($suppliersAvailable) {
            $query->leftJoin('suppliers', 'suppliers.id', '=', 'products.supplier_id');
        }

        $query
            ->when($search !== '', function ($query) use ($searchPattern, $suppliersAvailable): void {
                $query->where(function ($query) use ($searchPattern, $suppliersAvailable): void {
                    $query->whereRaw(SqlSearch::expression('CAST(products.id AS CHAR)').' LIKE ?', [$searchPattern])
                        ->orWhereRaw(SqlSearch::expression('products.name').' LIKE ?', [$searchPattern])
                        ->orWhereRaw(SqlSearch::expression('products.sku').' LIKE ?', [$searchPattern])
                        ->orWhereRaw(SqlSearch::expression('categories.name').' LIKE ?', [$searchPattern]);

                    if ($suppliersAvailable) {
                        $query->orWhereRaw(SqlSearch::expression('suppliers.company_name').' LIKE ?', [$searchPattern]);
                    }
                });
            })
            ->when($categoryId !== null, fn ($query) => $query->where('products.category_id', $categoryId))
            ->orderBy('products.name');

        if ($suppliersAvailable) {
            $query->when($supplierId !== null, fn ($query) => $query->where('products.supplier_id', $supplierId));
        }

        $products = $query->paginate(15)->withQueryString();

        $categories = Category::query()->orderBy('name')->get();
        $suppliers = $suppliersAvailable ? Supplier::query()->orderBy('company_name')->get() : collect();

        if ($request->ajax()) {
            return view('products.partials.table', compact('products'));
        }

        return view('products.index', compact('products', 'categories', 'suppliers', 'search', 'categoryId', 'supplierId'));
    }

    public function create()
    {
        $categories = Category::query()->orderBy('name')->get();
        $suppliers = InventorySchema::hasSuppliersTable() && InventorySchema::productHasSupplierId()
            ? Supplier::query()->orderBy('company_name')->get()
            : collect();

        return view('products.create', compact('categories', 'suppliers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate($this->rules());
        $validated = $this->normalizePayloadForCurrentSchema($validated);
        $validated['stock_quantity'] = 0;

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
            $validated['image_url'] = '/storage/' . $imagePath;
        }

        $product = Product::create($validated);

        InventoryNotificationService::create(
            'product.created',
            'Nuevo producto agregado',
            $product->name.' se agregó al inventario.',
            'bi-box-seam',
            Product::class,
            $product->id
        );

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Producto creado correctamente.',
                'product' => $this->serializeProduct($product->fresh()),
            ]);
        }

        return redirect()->route('products.index')->with('success', 'Producto creado correctamente.');
    }

    public function edit(Product $product)
    {
        if (request()->wantsJson()) {
            return response()->json($this->serializeProduct($product));
        }
        
        $categories = Category::query()->orderBy('name')->get();
        $suppliers = InventorySchema::hasSuppliersTable() && InventorySchema::productHasSupplierId()
            ? Supplier::query()->orderBy('company_name')->get()
            : collect();

        return view('products.edit', compact('product', 'categories', 'suppliers'));
    }

    public function show(Product $product)
    {
        return view('products.show', [
            'product' => $product->load(InventorySchema::hasSuppliersTable() && InventorySchema::productHasSupplierId()
                ? ['category', 'supplier']
                : ['category']),
        ]);
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate($this->rules($product));
        $validated = $this->normalizePayloadForCurrentSchema($validated);

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
            $validated['image_url'] = '/storage/' . $imagePath;
        }

        $product->update($validated);

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Producto actualizado correctamente.',
                'product' => $this->serializeProduct($product->fresh()),
            ]);
        }

        return redirect()->route('products.index')->with('success', 'Producto actualizado correctamente.');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        if (request()->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Producto eliminado correctamente.'
            ]);
        }

        return redirect()->route('products.index')->with('success', 'Producto eliminado correctamente.');
    }

    public function list()
    {
        $suppliersAvailable = InventorySchema::hasSuppliersTable() && InventorySchema::productHasSupplierId();

        $products = Product::query()
            ->with($suppliersAvailable ? ['category', 'supplier'] : ['category'])
            ->orderBy('name')
            ->get()
            ->map(fn (Product $product) => [
                'id' => $product->id,
                'name' => $product->name,
                'code' => $product->sku,
                'label' => '#'.$product->id.' · '.$product->name.' · '.$product->sku,
                'category' => optional($product->category)->name,
                'supplier' => $suppliersAvailable ? optional($product->supplier)->company_name : null,
            ]);

        return response()->json($products);
    }

    private function rules(?Product $product = null): array
    {
        $uniqueSku = Rule::unique('products', 'sku');
        $suppliersAvailable = InventorySchema::hasSuppliersTable() && InventorySchema::productHasSupplierId();

        if ($product !== null) {
            $uniqueSku = $uniqueSku->ignore($product->id);
        }

        $rules = [
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'name' => ['required', 'string', 'max:255'],
            'sku' => ['required', 'string', 'max:100', $uniqueSku],
            'stock_minimum' => ['required', 'integer', 'min:0'],
            'unit' => ['required', 'string', 'max:50'],
            'status' => ['required', 'string', Rule::in(['activo', 'inactivo'])],
        ];

        $rules['supplier_id'] = $suppliersAvailable
            ? ['nullable', 'integer', 'exists:suppliers,id']
            : ['nullable'];

        $rules['image'] = InventorySchema::productHasImageUrl()
            ? ['nullable', 'image', 'mimes:jpg,jpeg,png,gif,webp', 'max:2048']
            : ['nullable'];

        if (InventorySchema::productHasPurchasePrice()) {
            $rules['purchase_price'] = ['required', 'numeric', 'min:0'];
        }

        if (InventorySchema::productHasSalePrice()) {
            $rules['sale_price'] = ['required', 'numeric', 'min:0'];
        }

        if (! InventorySchema::productHasPurchasePrice() && ! InventorySchema::productHasSalePrice()) {
            $rules['purchase_price'] = ['nullable', 'numeric', 'min:0'];
            $rules['sale_price'] = ['nullable', 'numeric', 'min:0'];
        }

        return $rules;
    }

    private function normalizePayloadForCurrentSchema(array $validated): array
    {
        $validated['price'] = $validated['sale_price']
            ?? $validated['purchase_price']
            ?? ($validated['price'] ?? 0);

        if (! InventorySchema::hasSuppliersTable() || ! InventorySchema::productHasSupplierId()) {
            unset($validated['supplier_id']);
        }

        // Handle image field - convert to image_url for storage
        if (isset($validated['image'])) {
            unset($validated['image']);
        }

        if (! InventorySchema::productHasImageUrl()) {
            unset($validated['image_url']);
        }

        if (! InventorySchema::productHasPurchasePrice()) {
            unset($validated['purchase_price']);
        }

        if (! InventorySchema::productHasSalePrice()) {
            unset($validated['sale_price']);
        }

        return $validated;
    }

    private function serializeProduct(Product $product): array
    {
        $product->loadMissing(InventorySchema::hasSuppliersTable() && InventorySchema::productHasSupplierId()
            ? ['category', 'supplier']
            : ['category']);

        return [
            'id' => $product->id,
            'category_id' => $product->category_id,
            'supplier_id' => InventorySchema::productHasSupplierId() ? $product->supplier_id : null,
            'name' => $product->name,
            'sku' => $product->sku,
            'image_url' => InventorySchema::productHasImageUrl() ? $product->image_url : null,
            'purchase_price' => $product->purchase_price,
            'sale_price' => $product->sale_price,
            'stock_minimum' => $product->stock_minimum,
            'unit' => $product->unit,
            'status' => $product->status,
        ];
    }
}
