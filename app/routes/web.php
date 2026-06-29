<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\SupplierController;
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
        Route::get('/categories/{category}/show', [CategoryController::class, 'show'])->name('categories.show');
        Route::get('/categories/list', [CategoryController::class, 'list'])->name('categories.list');
        
        Route::resource('products', ProductController::class)->except(['show']);
        Route::get('/products/{product}/show', [ProductController::class, 'show'])->name('products.show');
        Route::get('/products/list', [ProductController::class, 'list'])->name('products.list');
        
        Route::resource('stock', StockController::class);
        Route::resource('suppliers', SupplierController::class)->except(['create', 'show']);
        Route::get('/suppliers/{supplier}/show', [SupplierController::class, 'show'])->name('suppliers.show');
        Route::get('/suppliers/list', [SupplierController::class, 'list'])->name('suppliers.list');
        Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
        Route::get('/reports/export/excel', [ReportController::class, 'exportExcel'])->name('reports.excel');
        Route::get('/reports/export/pdf', [ReportController::class, 'exportPdf'])->name('reports.pdf');
        Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
        Route::get('/notifications/all', [NotificationController::class, 'page'])->name('notifications.page');
        Route::post('/notifications/mark-all-read', [NotificationController::class, 'markAllRead'])->name('notifications.markAllRead');
        Route::post('/notifications/{notification}/read', [NotificationController::class, 'markRead'])->name('notifications.read');
        Route::delete('/notifications/{notification}', [NotificationController::class, 'destroy'])->name('notifications.destroy');

        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });
});
