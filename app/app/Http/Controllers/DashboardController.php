<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\StockMovement;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $months = collect(range(5, 0))->map(fn ($i) => now()->subMonths($i));
        $chartLabels = $months->map(fn ($d) => ucfirst($d->translatedFormat('M')))->all();

        $chartEntradas = $months->map(function ($month) {
            return StockMovement::query()
                ->where('type', StockMovement::TYPE_ENTRADA)
                ->whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)
                ->sum('quantity');
        })->all();

        $chartSalidas = $months->map(function ($month) {
            return StockMovement::query()
                ->where('type', StockMovement::TYPE_SALIDA)
                ->whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)
                ->sum('quantity');
        })->all();

        $recentActivity = StockMovement::query()
            ->with('product')
            ->latest()
            ->limit(4)
            ->get()
            ->map(function (StockMovement $movement) {
                $sign = $movement->type === StockMovement::TYPE_ENTRADA ? '+' : '-';

                return [
                    'product' => $movement->product->name,
                    'detail' => ($movement->type === StockMovement::TYPE_ENTRADA ? 'Entrada' : 'Salida').' · '.$movement->quantity.' uds',
                    'time' => $movement->created_at->diffForHumans(),
                    'sku' => $movement->product->sku,
                    'type' => $movement->type,
                    'qty' => $sign.$movement->quantity,
                ];
            })
            ->all();

        $lowStock = Product::query()
            ->lowStock()
            ->orderBy('stock_quantity')
            ->limit(3)
            ->get()
            ->map(function (Product $product) {
                $max = max($product->stock_minimum * 2, 1);
                $percent = min(100, (int) round(($product->stock_quantity / $max) * 100));
                $level = $product->stock_quantity <= ($product->stock_minimum / 2) ? 'danger' : 'warning';

                return [
                    'name' => $product->name,
                    'current' => $product->stock_quantity,
                    'max' => $max,
                    'percent' => $percent,
                    'level' => $level,
                ];
            })
            ->all();

        $topCategories = Category::query()
            ->withCount('products')
            ->orderByDesc('products_count')
            ->limit(5)
            ->get()
            ->map(fn (Category $cat) => ['name' => $cat->name, 'count' => $cat->products_count])
            ->all();

        return view('dashboard.index', compact(
            'chartLabels',
            'chartEntradas',
            'chartSalidas',
            'recentActivity',
            'lowStock',
            'topCategories',
        ));
    }
}
