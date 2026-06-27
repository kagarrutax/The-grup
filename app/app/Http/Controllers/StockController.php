<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockMovement;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class StockController extends Controller
{
    public function index(): View
    {
        $movements = StockMovement::query()
            ->with(['product', 'user'])
            ->latest()
            ->paginate(20);

        return view('stock.index', compact('movements'));
    }

    public function create(): View
    {
        $products = Product::query()->orderBy('name')->get();

        return view('stock.create', compact('products'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'product_id' => ['required', 'integer', 'exists:products,id'],
            'type' => ['required', 'string', Rule::in([StockMovement::TYPE_ENTRADA, StockMovement::TYPE_SALIDA])],
            'quantity' => ['required', 'integer', 'min:1'],
            'reason' => ['nullable', 'string', 'max:500'],
        ]);

        DB::transaction(function () use ($validated, $request): void {
            $product = Product::query()
                ->lockForUpdate()
                ->findOrFail($validated['product_id']);

            if ($validated['type'] === StockMovement::TYPE_SALIDA && $validated['quantity'] > $product->stock_quantity) {
                throw ValidationException::withMessages([
                    'quantity' => 'Stock insuficiente. Disponible: '.$product->stock_quantity,
                ]);
            }

            if ($validated['type'] === StockMovement::TYPE_ENTRADA) {
                $product->increment('stock_quantity', $validated['quantity']);
            } else {
                $product->decrement('stock_quantity', $validated['quantity']);
            }

            StockMovement::create([
                'product_id' => $product->id,
                'user_id' => $request->user()->id,
                'type' => $validated['type'],
                'quantity' => $validated['quantity'],
                'reason' => $validated['reason'] ?? null,
            ]);
        });

        return redirect()
            ->route('stock.index')
            ->with('success', 'Movimiento registrado correctamente.');
    }
}
