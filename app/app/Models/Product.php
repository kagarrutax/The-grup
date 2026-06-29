<?php

namespace App\Models;

<<<<<<< Updated upstream
<<<<<<< HEAD
=======
use Illuminate\Database\Eloquent\Builder;
>>>>>>> Stashed changes
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
<<<<<<< Updated upstream
    use HasFactory;
=======
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

>>>>>>> d959ad24edda2faacd434ad042d52e081eb02510
=======
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

>>>>>>> Stashed changes
    protected $fillable = [
        'category_id',
        'name',
        'sku',
        'price',
<<<<<<< Updated upstream
<<<<<<< HEAD
        'stock_quantity',
=======
>>>>>>> d959ad24edda2faacd434ad042d52e081eb02510
=======
>>>>>>> Stashed changes
        'stock_minimum',
        'unit',
        'status',
    ];

<<<<<<< Updated upstream
<<<<<<< HEAD
    /**
     * Get the category that owns the product.
     */
    public function category()
=======
=======
>>>>>>> Stashed changes
    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'stock_quantity' => 'integer',
            'stock_minimum' => 'integer',
        ];
    }

    public function category(): BelongsTo
<<<<<<< Updated upstream
>>>>>>> d959ad24edda2faacd434ad042d52e081eb02510
=======
>>>>>>> Stashed changes
    {
        return $this->belongsTo(Category::class);
    }

<<<<<<< Updated upstream
<<<<<<< HEAD
    /**
     * Get the stock movements for the product.
     */
    public function stockMovements()
    {
        return $this->hasMany(StockMovement::class);
    }
=======
    public function stockMovements(): HasMany
    {
        return $this->hasMany(StockMovement::class);
    }
=======
    public function stockMovements(): HasMany
    {
        return $this->hasMany(StockMovement::class);
    }
>>>>>>> Stashed changes

    public function scopeLowStock(Builder $query): Builder
    {
        return $query->whereColumn('stock_quantity', '<=', 'stock_minimum');
    }

    public function scopeSearch(Builder $query, ?string $search = null, ?int $categoryId = null): Builder
    {
        return $query
            ->when($search, function (Builder $query) use ($search): void {
                $query->where(function (Builder $query) use ($search): void {
                    $query->where('name', 'like', '%'.$search.'%')
                        ->orWhere('sku', 'like', '%'.$search.'%');
                });
            })
            ->when($categoryId, fn (Builder $query) => $query->where('category_id', $categoryId));
    }
<<<<<<< Updated upstream
>>>>>>> d959ad24edda2faacd434ad042d52e081eb02510
=======
>>>>>>> Stashed changes
}
