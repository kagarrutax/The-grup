<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\StockMovement;
use App\Models\Supplier;
use App\Support\InventorySchema;
use App\Support\ReportPdfExporter;
use App\Support\ReportSpreadsheetExporter;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $suppliersAvailable = InventorySchema::hasSuppliersTable() && InventorySchema::productHasSupplierId();

        $filters = [
            'date_from' => $request->string('date_from')->toString(),
            'date_to' => $request->string('date_to')->toString(),
            'category_id' => $request->integer('category_id') ?: null,
            'product_id' => $request->integer('product_id') ?: null,
            'supplier_id' => $suppliersAvailable ? ($request->integer('supplier_id') ?: null) : null,
        ];

        $rows = $this->buildRows($filters);

        if ($request->ajax()) {
            return view('reports.partials.preview', compact('rows'));
        }

        $categories = Category::query()->orderBy('name')->get();
        $products = Product::query()->orderBy('name')->get();
        $suppliers = $suppliersAvailable ? Supplier::query()->orderBy('company_name')->get() : collect();

        return view('reports.index', compact('rows', 'categories', 'products', 'suppliers', 'filters'));
    }

    public function exportExcel(Request $request)
    {
        $filters = $this->resolveFilters($request);
        $rows = $this->buildRows($filters);

        return ReportSpreadsheetExporter::download('reporte-inventario.xls', $rows, $filters);
    }

    public function exportPdf(Request $request)
    {
        $filters = $this->resolveFilters($request);
        $rows = $this->buildRows($filters);

        return ReportPdfExporter::download('reporte-inventario.pdf', $rows, $filters);
    }

    private function buildRows(array $filters)
    {
        $dateFrom = $filters['date_from'] ?? null;
        $dateTo = $filters['date_to'] ?? null;
        $categoryId = isset($filters['category_id']) ? (int) $filters['category_id'] : null;
        $productId = isset($filters['product_id']) ? (int) $filters['product_id'] : null;
        $suppliersAvailable = InventorySchema::hasSuppliersTable() && InventorySchema::productHasSupplierId();
        $supplierId = $suppliersAvailable && isset($filters['supplier_id']) ? (int) $filters['supplier_id'] : null;

        return StockMovement::query()
            ->select('stock_movements.*')
            ->with(['product.category', 'product.supplier', 'user'])
            ->join('products', 'products.id', '=', 'stock_movements.product_id')
            ->when($dateFrom, fn ($query) => $query->whereDate('stock_movements.created_at', '>=', $dateFrom))
            ->when($dateTo, fn ($query) => $query->whereDate('stock_movements.created_at', '<=', $dateTo))
            ->when($categoryId, fn ($query) => $query->where('products.category_id', $categoryId))
            ->when($productId, fn ($query) => $query->where('stock_movements.product_id', $productId))
            ->when($suppliersAvailable && $supplierId, fn ($query) => $query->where('products.supplier_id', $supplierId))
            ->latest('stock_movements.created_at')
            ->get()
            ->map(function (StockMovement $movement) {
                return [
                    'date' => $movement->created_at->format('d/m/Y H:i'),
                    'product' => optional($movement->product)->name,
                    'product_id' => optional($movement->product)->id,
                    'code' => optional($movement->product)->sku,
                    'category' => optional(optional($movement->product)->category)->name,
                    'supplier' => optional(optional($movement->product)->supplier)->company_name ?? 'Sin proveedor',
                    'type' => ucfirst($movement->type),
                    'quantity' => $movement->quantity,
                    'user' => optional($movement->user)->name,
                    'reason' => $movement->reason ?: '—',
                ];
            })
            ->values();
    }

    private function resolveFilters(Request $request): array
    {
        $categoryId = $request->integer('category_id') ?: null;
        $productId = $request->integer('product_id') ?: null;
        $suppliersAvailable = InventorySchema::hasSuppliersTable() && InventorySchema::productHasSupplierId();
        $supplierId = $suppliersAvailable ? ($request->integer('supplier_id') ?: null) : null;

        return [
            'date_from' => $request->string('date_from')->toString(),
            'date_to' => $request->string('date_to')->toString(),
            'category_id' => $categoryId,
            'product_id' => $productId,
            'supplier_id' => $supplierId,
            'category_name' => $categoryId ? Category::query()->whereKey($categoryId)->value('name') : null,
            'product_name' => $productId ? Product::query()->whereKey($productId)->value('name') : null,
            'supplier_name' => $suppliersAvailable && $supplierId
                ? Supplier::query()->whereKey($supplierId)->value('company_name')
                : null,
        ];
    }
}
