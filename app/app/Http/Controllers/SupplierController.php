<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Support\CollectionPaginator;
use App\Support\InventorySchema;
use App\Support\InventoryNotificationService;
use App\Support\SqlSearch;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SupplierController extends Controller
{
    public function index(Request $request)
    {
        if (! InventorySchema::hasSuppliersTable()) {
            $suppliers = CollectionPaginator::paginate(collect(), 15)->withQueryString();

            if ($request->ajax()) {
                return view('suppliers.partials.table', compact('suppliers'));
            }

            return view('suppliers.index', compact('suppliers'));
        }

        $search = $request->string('search')->trim()->toString();
        $searchPattern = SqlSearch::like($search);

        $suppliers = Supplier::query()
            ->withCount('products')
            ->when($search !== '', function ($query) use ($searchPattern): void {
                $query->where(function ($query) use ($searchPattern): void {
                    $query->whereRaw(SqlSearch::expression('CAST(suppliers.id AS CHAR)').' LIKE ?', [$searchPattern])
                        ->orWhereRaw(SqlSearch::expression('suppliers.company_name').' LIKE ?', [$searchPattern])
                        ->orWhereRaw(SqlSearch::expression('suppliers.contact_name').' LIKE ?', [$searchPattern])
                        ->orWhereRaw(SqlSearch::expression('suppliers.phone').' LIKE ?', [$searchPattern])
                        ->orWhereRaw(SqlSearch::expression('suppliers.email').' LIKE ?', [$searchPattern])
                        ->orWhereRaw(SqlSearch::expression('suppliers.address').' LIKE ?', [$searchPattern])
                        ->orWhereRaw(SqlSearch::expression('suppliers.status').' LIKE ?', [$searchPattern]);
                });
            })
            ->orderBy('company_name')
            ->paginate(15)
            ->withQueryString();

        if ($request->ajax()) {
            return view('suppliers.partials.table', compact('suppliers'));
        }

        return view('suppliers.index', compact('suppliers'));
    }

    public function show(Supplier $supplier)
    {
        $supplier->loadCount('products');

        if (request()->wantsJson()) {
            return response()->json($supplier);
        }

        return view('suppliers.show', compact('supplier'));
    }

    public function store(Request $request)
    {
        if (! InventorySchema::hasSuppliersTable()) {
            return response()->json([
                'success' => false,
                'message' => 'La tabla de proveedores no existe todavía en tu base de datos local.',
            ], 422);
        }

        $supplier = Supplier::create($request->validate($this->rules()));

        InventoryNotificationService::create(
            'supplier.created',
            'Nuevo proveedor registrado',
            $supplier->company_name.' fue agregado como proveedor.',
            'bi-truck',
            Supplier::class,
            $supplier->id
        );

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Proveedor creado correctamente.',
            ]);
        }

        return redirect()->route('suppliers.index')->with('success', 'Proveedor creado correctamente.');
    }

    public function edit(Supplier $supplier)
    {
        if (request()->wantsJson()) {
            return response()->json($supplier);
        }

        return view('suppliers.edit', compact('supplier'));
    }

    public function update(Request $request, Supplier $supplier)
    {
        if (! InventorySchema::hasSuppliersTable()) {
            return response()->json([
                'success' => false,
                'message' => 'La tabla de proveedores no existe todavía en tu base de datos local.',
            ], 422);
        }

        $supplier->update($request->validate($this->rules($supplier)));

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Proveedor actualizado correctamente.',
            ]);
        }

        return redirect()->route('suppliers.index')->with('success', 'Proveedor actualizado correctamente.');
    }

    public function destroy(Supplier $supplier)
    {
        if (! InventorySchema::hasSuppliersTable()) {
            return response()->json([
                'success' => false,
                'message' => 'La tabla de proveedores no existe todavía en tu base de datos local.',
            ], 422);
        }

        $supplier->delete();

        if (request()->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Proveedor eliminado correctamente.',
            ]);
        }

        return redirect()->route('suppliers.index')->with('success', 'Proveedor eliminado correctamente.');
    }

    public function list()
    {
        if (! InventorySchema::hasSuppliersTable()) {
            return response()->json([]);
        }

        return response()->json(
            Supplier::query()
                ->orderBy('company_name')
                ->get(['id', 'company_name'])
                ->map(fn (Supplier $supplier) => [
                    'id' => $supplier->id,
                    'name' => $supplier->company_name,
                ])
        );
    }

    private function rules(?Supplier $supplier = null): array
    {
        $uniqueEmail = Rule::unique('suppliers', 'email');

        if ($supplier !== null) {
            $uniqueEmail = $uniqueEmail->ignore($supplier->id);
        }

        return [
            'company_name' => ['required', 'string', 'max:255'],
            'contact_name' => ['required', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:30'],
            'email' => ['nullable', 'email', 'max:255', $uniqueEmail],
            'address' => ['nullable', 'string', 'max:500'],
            'status' => ['required', 'string', Rule::in(['activo', 'inactivo'])],
        ];
    }
}
