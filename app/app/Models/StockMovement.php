<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockMovement extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'user_id',
        'type',
        'quantity',
        'reason',
    ];

    /**
     * Get the product that was moved.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get the user who registered the movement.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
