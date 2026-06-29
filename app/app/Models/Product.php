<?php

namespace App\Models;

use App\Support\InventorySchema;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

    protected $fillable = [
        'category_id',
        'supplier_id',
        'name',
        'sku',
        'image_url',
        'price',
        'purchase_price',
        'sale_price',
        'stock_quantity',
        'stock_minimum',
        'unit',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'purchase_price' => 'decimal:2',
            'sale_price' => 'decimal:2',
            'stock_quantity' => 'integer',
            'stock_minimum' => 'integer',
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }

    public function stockMovements(): HasMany
    {
        return $this->hasMany(StockMovement::class);
    }

    public function scopeLowStock(Builder $query): Builder
    {
        return $query->whereColumn('stock_quantity', '<=', 'stock_minimum');
    }

    public function getPurchasePriceAttribute($value): float
    {
        if ($value !== null) {
            return (float) $value;
        }

        return InventorySchema::productHasPurchasePrice()
            ? 0.0
            : (float) ($this->attributes['price'] ?? 0);
    }

    public function getSalePriceAttribute($value): float
    {
        if ($value !== null) {
            return (float) $value;
        }

        return InventorySchema::productHasSalePrice()
            ? 0.0
            : (float) ($this->attributes['price'] ?? 0);
    }
}
