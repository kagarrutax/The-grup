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

        $currentMonth = now();
        $previousMonth = now()->copy()->subMonth();

        $sumMovementsByMonth = function (string $type, $month): int {
            return (int) StockMovement::query()
                ->where('type', $type)
                ->whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)
                ->sum('quantity');
        };

        $formatTrend = function (int|float $current, int|float $previous): array {
            if ($previous <= 0) {
                return [
                    'value' => '+0%',
                    'direction' => 'up',
                ];
            }

            $delta = (($current - $previous) / $previous) * 100;

            return [
                'value' => ($delta >= 0 ? '+' : '').round($delta).'%',
                'direction' => $delta >= 0 ? 'up' : 'down',
            ];
        };

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

        $productsCount = (int) Product::query()->count();
        $productsPrevious = max($productsCount - 3, 1);
        $productsTrend = $formatTrend($productsCount, $productsPrevious);

        $entriesThisMonth = $sumMovementsByMonth(StockMovement::TYPE_ENTRADA, $currentMonth);
        $entriesLastMonth = $sumMovementsByMonth(StockMovement::TYPE_ENTRADA, $previousMonth);
        $entriesTrend = $formatTrend($entriesThisMonth, $entriesLastMonth);

        $salidasThisMonth = $sumMovementsByMonth(StockMovement::TYPE_SALIDA, $currentMonth);
        $salidasLastMonth = $sumMovementsByMonth(StockMovement::TYPE_SALIDA, $previousMonth);
        $salidasTrend = $formatTrend($salidasThisMonth, $salidasLastMonth);

        $totalInventoryValue = (float) Product::query()
            ->selectRaw('COALESCE(SUM(price * stock_quantity), 0) as total')
            ->value('total');
        $inventoryPrevious = max($totalInventoryValue - 3200, 1);
        $inventoryTrend = $formatTrend($totalInventoryValue, $inventoryPrevious);

        $summaryCards = [
            [
                'title' => 'Productos',
                'value' => number_format($productsCount),
                'description' => 'Total en catálogo',
                'icon' => 'bi-box-seam',
                'tone' => 'primary',
                'trend' => $productsTrend['value'],
                'trendDirection' => $productsTrend['direction'],
            ],
            [
                'title' => 'Entradas',
                'value' => number_format($entriesThisMonth),
                'description' => 'Este mes',
                'icon' => 'bi-arrow-down',
                'tone' => 'success',
                'trend' => $entriesTrend['value'],
                'trendDirection' => $entriesTrend['direction'],
            ],
            [
                'title' => 'Salidas',
                'value' => number_format($salidasThisMonth),
                'description' => 'Este mes',
                'icon' => 'bi-arrow-up',
                'tone' => 'danger',
                'trend' => $salidasTrend['value'],
                'trendDirection' => $salidasTrend['direction'],
            ],
            [
                'title' => 'Valor total',
                'value' => '$ '.number_format($totalInventoryValue, 0),
                'description' => 'Valor del inventario',
                'icon' => 'bi-currency-dollar',
                'tone' => 'violet',
                'trend' => $inventoryTrend['value'],
                'trendDirection' => $inventoryTrend['direction'],
            ],
        ];

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
                    'icon' => $movement->type === StockMovement::TYPE_ENTRADA ? 'bi-bag-check' : 'bi-bag-dash',
                ];
            })
            ->all();

        $lowStock = Product::query()
            ->lowStock()
            ->orderBy('stock_quantity')
            ->limit(4)
            ->get()
            ->map(function (Product $product) {
                $max = max($product->stock_minimum * 2, $product->stock_quantity, 1);
                $percent = min(100, (int) round(($product->stock_quantity / $max) * 100));
                $level = $product->stock_quantity <= ($product->stock_minimum / 2) ? 'danger' : 'warning';

                return [
                    'name' => $product->name,
                    'current' => $product->stock_quantity,
                    'max' => $max,
                    'percent' => $percent,
                    'level' => $level,
                    'icon' => $level === 'danger' ? 'bi-bag-x' : 'bi-bag',
                ];
            })
            ->all();

        $topCategories = Category::query()
            ->withCount('products')
            ->withSum('products as stock_total', 'stock_quantity')
            ->orderByDesc('products_count')
            ->limit(5)
            ->get()
            ->values()
            ->map(function (Category $cat, int $index) {
                $icons = ['bi-cup-hot', 'bi-cup-straw', 'bi-basket', 'bi-droplet', 'bi-cookie'];

                return [
                    'name' => $cat->name,
                    'count' => $cat->products_count,
                    'stock_total' => (int) ($cat->stock_total ?? 0),
                    'icon' => $icons[$index] ?? 'bi-grid',
                ];
            })
            ->all();

        return view('dashboard.index', compact(
            'summaryCards',
            'chartLabels',
            'chartEntradas',
            'chartSalidas',
            'recentActivity',
            'lowStock',
            'topCategories',
        ));
    }
}
