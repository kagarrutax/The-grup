<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Support\SqlSearch;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->string('search')->trim()->toString();
        $searchPattern = SqlSearch::like($search);

        $categories = Category::query()
            ->withCount('products')
            ->when($search !== '', function ($query) use ($searchPattern): void {
                $query->where(function ($query) use ($searchPattern): void {
                    $query->whereRaw(SqlSearch::expression('CAST(categories.id AS CHAR)').' LIKE ?', [$searchPattern])
                        ->orWhereRaw(SqlSearch::expression('categories.name').' LIKE ?', [$searchPattern])
                        ->orWhereRaw(SqlSearch::expression('categories.description').' LIKE ?', [$searchPattern]);
                });
            })
            ->orderBy('name')
            ->paginate(15)
            ->withQueryString();

        if ($request->ajax()) {
            return view('categories.partials.table', compact('categories'));
        }

        return view('categories.index', compact('categories'));
    }

    public function list()
    {
        $categories = Category::query()
            ->orderBy('name')
            ->get(['id', 'name']);

        return response()->json($categories);
    }

    public function show(Category $category)
    {
        $category->loadCount('products');

        if (request()->wantsJson()) {
            return response()->json($category);
        }

        return view('categories.show', compact('category'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate($this->rules());

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('categories', 'public');
            $validated['image_url'] = '/storage/' . $imagePath;
        }

        Category::create($validated);

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Categoría creada correctamente.',
            ]);
        }

        return redirect()->route('categories.index')->with('success', 'Categoría creada correctamente.');
    }

    public function edit(Category $category)
    {
        if (request()->wantsJson()) {
            return response()->json($category);
        }

        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $validated = $request->validate($this->rules($category));

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('categories', 'public');
            $validated['image_url'] = '/storage/' . $imagePath;
        }

        $category->update($validated);

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Categoría actualizada correctamente.',
            ]);
        }

        return redirect()->route('categories.index')->with('success', 'Categoría actualizada correctamente.');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        if (request()->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Categoría eliminada correctamente.',
            ]);
        }

        return redirect()->route('categories.index')->with('success', 'Categoría eliminada correctamente.');
    }

    private function rules(?Category $category = null): array
    {
        $uniqueName = 'unique:categories,name';

        if ($category !== null) {
            $uniqueName .= ','.$category->id;
        }

        return [
            'name' => ['required', 'string', 'max:255', $uniqueName],
            'description' => ['nullable', 'string', 'max:1000'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,gif,webp', 'max:2048'],
        ];
    }
}
