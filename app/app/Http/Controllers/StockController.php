<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockMovement;
use App\Models\User;
use App\Support\InventoryNotificationService;
use App\Support\SqlSearch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class StockController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->string('search')->trim()->toString();
        $searchPattern = SqlSearch::like($search);
        $type = $request->string('type')->trim()->toString();
        $userId = $request->integer('user_id') ?: null;
        $productId = $request->integer('product_id') ?: null;
        $dateFrom = $request->string('date_from')->trim()->toString();
        $dateTo = $request->string('date_to')->trim()->toString();

        $movements = StockMovement::query()
            ->select('stock_movements.*')
            ->with(['product.category', 'product.supplier', 'user'])
            ->join('products', 'products.id', '=', 'stock_movements.product_id')
            ->leftJoin('users', 'users.id', '=', 'stock_movements.user_id')
            ->when($search !== '', function ($query) use ($searchPattern): void {
                $query->where(function ($query) use ($searchPattern): void {
                    $query->whereRaw(SqlSearch::expression('CAST(products.id AS CHAR)').' LIKE ?', [$searchPattern])
                        ->orWhereRaw(SqlSearch::expression('products.name').' LIKE ?', [$searchPattern])
                        ->orWhereRaw(SqlSearch::expression('products.sku').' LIKE ?', [$searchPattern])
                        ->orWhereRaw(SqlSearch::expression('users.name').' LIKE ?', [$searchPattern]);
                });
            })
            ->when($type !== '', fn ($query) => $query->where('stock_movements.type', $type))
            ->when($userId !== null, fn ($query) => $query->where('stock_movements.user_id', $userId))
            ->when($productId !== null, fn ($query) => $query->where('stock_movements.product_id', $productId))
            ->when($dateFrom !== '', fn ($query) => $query->whereDate('stock_movements.created_at', '>=', $dateFrom))
            ->when($dateTo !== '', fn ($query) => $query->whereDate('stock_movements.created_at', '<=', $dateTo))
            ->latest('stock_movements.created_at')
            ->paginate(12)
            ->withQueryString();
        $products = Product::query()->orderBy('name')->get();
        $users = User::query()->orderBy('name')->get();

        if ($request->ajax()) {
            return view('stock.partials.table', compact('movements'));
        }

        return view('stock.index', compact('movements', 'products', 'users'));
    }

    public function create()
    {
        $products = Product::query()->with(['category', 'supplier'])->orderBy('name')->get();
        $users = User::query()->orderBy('name')->get();

        return view('stock.create', compact('products', 'users'));
    }

    public function show(StockMovement $stock)
    {
        return view('stock.partials.show', [
            'movement' => $stock->load(['product.category', 'product.supplier', 'user']),
        ]);
    }

    public function edit(StockMovement $stock)
    {
        return response()->json(
            $stock->load(['product.category', 'product.supplier', 'user'])
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate($this->rules());

        DB::transaction(function () use ($validated, $request): void {
            $product = Product::query()
                ->lockForUpdate()
                ->findOrFail($validated['product_id']);

            $this->applyMovementToProduct($validated['type'], (int) $validated['quantity'], $product);
            $movement = StockMovement::create([
                'product_id' => $product->id,
                'user_id' => $validated['user_id'] ?? $request->user()->id,
                'type' => $validated['type'],
                'quantity' => $validated['quantity'],
                'reason' => $validated['reason'] ?? null,
                'observations' => $validated['observations'] ?? null,
            ]);

            InventoryNotificationService::create(
                'movement.created',
                'Nuevo movimiento registrado',
                ucfirst($validated['type']).' de '.$validated['quantity'].' unidades para '.$product->name.'.',
                $validated['type'] === StockMovement::TYPE_ENTRADA ? 'bi-arrow-down-circle' : 'bi-arrow-up-circle',
                StockMovement::class,
                $movement->id
            );
        });

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Movimiento registrado correctamente.',
            ]);
        }

        return redirect()->route('stock.index')->with('success', 'Movimiento registrado correctamente.');
    }

    public function update(Request $request, StockMovement $stock)
    {
        $validated = $request->validate($this->rules());

        DB::transaction(function () use ($validated, $request, $stock): void {
            $movement = StockMovement::query()
                ->lockForUpdate()
                ->findOrFail($stock->id);

            $originalProduct = Product::query()
                ->lockForUpdate()
                ->findOrFail($movement->product_id);

            $this->reverseMovementFromProduct(
                $movement,
                $originalProduct,
                'No se puede editar este movimiento porque el stock actual ya no permite revertirlo.'
            );

            $targetProduct = (int) $validated['product_id'] === $originalProduct->id
                ? $originalProduct
                : Product::query()->lockForUpdate()->findOrFail($validated['product_id']);

            $this->applyMovementToProduct($validated['type'], (int) $validated['quantity'], $targetProduct);

            $movement->update([
                'product_id' => $targetProduct->id,
                'user_id' => $validated['user_id'] ?? $request->user()->id,
                'type' => $validated['type'],
                'quantity' => $validated['quantity'],
                'reason' => $validated['reason'] ?? null,
                'observations' => $validated['observations'] ?? null,
            ]);
        });

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Movimiento actualizado correctamente.',
            ]);
        }

        return redirect()->route('stock.index')->with('success', 'Movimiento actualizado correctamente.');
    }

    public function destroy(Request $request, StockMovement $stock)
    {
        DB::transaction(function () use ($stock): void {
            $movement = StockMovement::query()
                ->lockForUpdate()
                ->findOrFail($stock->id);

            $product = Product::query()
                ->lockForUpdate()
                ->findOrFail($movement->product_id);

            $this->reverseMovementFromProduct(
                $movement,
                $product,
                'No se puede eliminar este movimiento porque el stock actual depende de ese ingreso.'
            );

            $movement->delete();
        });

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Movimiento eliminado correctamente.',
            ]);
        }

        return redirect()->route('stock.index')->with('success', 'Movimiento eliminado correctamente.');
    }

    private function rules(): array
    {
        return [
            'product_id' => ['required', 'integer', 'exists:products,id'],
            'type' => ['required', 'string', Rule::in([StockMovement::TYPE_ENTRADA, StockMovement::TYPE_SALIDA])],
            'quantity' => ['required', 'integer', 'min:1'],
            'user_id' => ['nullable', 'integer', 'exists:users,id'],
            'reason' => ['nullable', 'string', 'max:500'],
            'observations' => ['nullable', 'string', 'max:2000'],
        ];
    }

    private function applyMovementToProduct(string $type, int $quantity, Product $product): void
    {
        if ($type === StockMovement::TYPE_SALIDA && $quantity > $product->stock_quantity) {
            throw ValidationException::withMessages([
                'quantity' => 'Stock insuficiente. Disponible: '.$product->stock_quantity,
            ]);
        }

        if ($type === StockMovement::TYPE_ENTRADA) {
            $product->increment('stock_quantity', $quantity);

            return;
        }

        $product->decrement('stock_quantity', $quantity);
    }

    private function reverseMovementFromProduct(StockMovement $movement, Product $product, string $message): void
    {
        if ($movement->type === StockMovement::TYPE_ENTRADA) {
            if ($movement->quantity > $product->stock_quantity) {
                throw ValidationException::withMessages([
                    'quantity' => $message,
                ]);
            }

            $product->decrement('stock_quantity', $movement->quantity);

            return;
        }

        $product->increment('stock_quantity', $movement->quantity);
    }
}
