<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\StockMovement;
use App\Support\InventorySchema;
use App\Support\InventoryNotificationService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        if (InventorySchema::hasNotificationsTable()) {
            InventoryNotificationService::syncStockAlerts();
        }

        $days = collect(range(6, 0))->map(fn ($i) => now()->subDays($i));
        $chartLabels = $days->map(fn ($d) => ucfirst($d->translatedFormat('d M')))->all();

        $today = now();
        $yesterday = now()->copy()->subDay();

        $sumMovementsByDay = function (string $type, $date): int {
            return (int) StockMovement::query()
                ->where('type', $type)
                ->whereDate('created_at', $date->toDateString())
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

        $chartEntradas = $days->map(function ($day) {
            return StockMovement::query()
                ->where('type', StockMovement::TYPE_ENTRADA)
                ->whereDate('created_at', $day->toDateString())
                ->sum('quantity');
        })->all();

        $chartSalidas = $days->map(function ($day) {
            return StockMovement::query()
                ->where('type', StockMovement::TYPE_SALIDA)
                ->whereDate('created_at', $day->toDateString())
                ->sum('quantity');
        })->all();

        $productsCount = (int) Product::query()->count();
        $productsPrevious = max($productsCount - 3, 1);
        $productsTrend = $formatTrend($productsCount, $productsPrevious);

        $lowStockCount = (int) Product::query()->lowStock()->count();
        $lowStockPrevious = max($lowStockCount - 1, 1);
        $lowStockTrend = $formatTrend($lowStockCount, $lowStockPrevious);

        $entriesToday = $sumMovementsByDay(StockMovement::TYPE_ENTRADA, $today);
        $entriesYesterday = $sumMovementsByDay(StockMovement::TYPE_ENTRADA, $yesterday);
        $entriesTrend = $formatTrend($entriesToday, $entriesYesterday);

        $salidasToday = $sumMovementsByDay(StockMovement::TYPE_SALIDA, $today);
        $salidasYesterday = $sumMovementsByDay(StockMovement::TYPE_SALIDA, $yesterday);
        $salidasTrend = $formatTrend($salidasToday, $salidasYesterday);

        $priceColumn = InventorySchema::productHasPurchasePrice() ? 'purchase_price' : 'price';

        $totalInventoryValue = (float) Product::query()
            ->selectRaw("COALESCE(SUM({$priceColumn} * stock_quantity), 0) as total")
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
                'title' => 'Stock bajo',
                'value' => number_format($lowStockCount),
                'description' => 'Productos por reabastecer',
                'icon' => 'bi-exclamation-circle',
                'tone' => 'warning',
                'trend' => $lowStockTrend['value'],
                'trendDirection' => $lowStockTrend['direction'],
            ],
            [
                'title' => 'Entradas del día',
                'value' => number_format($entriesToday),
                'description' => 'Ingresos de hoy',
                'icon' => 'bi-arrow-down-circle',
                'tone' => 'success',
                'trend' => $entriesTrend['value'],
                'trendDirection' => $entriesTrend['direction'],
            ],
            [
                'title' => 'Salidas del día',
                'value' => number_format($salidasToday),
                'description' => 'Despachos de hoy',
                'icon' => 'bi-arrow-up-circle',
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
                    'sku' => '#'.$movement->product->id.' · '.$movement->product->sku,
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
                    'id' => $product->id,
                    'current' => $product->stock_quantity,
                    'max' => $max,
                    'percent' => $percent,
                    'level' => $level,
                    'icon' => $level === 'danger' ? 'bi-bag-x' : 'bi-bag',
                    'code' => $product->sku,
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
