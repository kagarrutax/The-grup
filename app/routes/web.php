<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StockController;
use App\Models\Category;
use App\Models\Product;
use App\Models\StockMovement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::middleware('web')->group(function () {
    Route::get('/', function (Request $request) {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }

        return view('welcome', [
            'highlights' => [
                'products' => Product::query()->count(),
                'categories' => Category::query()->count(),
                'movements' => StockMovement::query()->count(),
            ],
        ]);
    })->name('home');

    Route::get('/login', [AuthController::class, 'showLoginForm'])
        ->name('login');
    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.post');
    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');

    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

        Route::resource('categories', CategoryController::class)->except(['show']);
        Route::get('/categories/list', [CategoryController::class, 'list'])->name('categories.list');
        
        Route::resource('products', ProductController::class)->except(['show']);
        Route::get('/products/{product}/show', [ProductController::class, 'show'])->name('products.show');
        
        Route::resource('stock', StockController::class)->only(['index', 'create', 'store']);

        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });
});
