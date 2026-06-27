<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\StockMovement;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        return view('dashboard.index', [
            'totalProducts' => Product::query()->count(),
            'totalCategories' => Category::query()->count(),
            'lowStockCount' => Product::query()->lowStock()->count(),
            'lowStockProducts' => Product::query()
                ->with('category')
                ->lowStock()
                ->orderBy('stock_quantity')
                ->get(),
            'recentMovements' => StockMovement::query()
                ->with(['product', 'user'])
                ->latest()
                ->limit(10)
                ->get(),
        ]);
    }
}
