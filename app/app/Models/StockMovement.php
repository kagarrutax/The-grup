<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
<<<<<<< HEAD

class StockMovement extends Model
{
    use HasFactory;
=======
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StockMovement extends Model
{
    /** @use HasFactory<\Database\Factories\StockMovementFactory> */
    use HasFactory;

    public const TYPE_ENTRADA = 'entrada';

    public const TYPE_SALIDA = 'salida';

>>>>>>> d959ad24edda2faacd434ad042d52e081eb02510
    protected $fillable = [
        'product_id',
        'user_id',
        'type',
        'quantity',
        'reason',
    ];

<<<<<<< HEAD
    /**
     * Get the product that was moved.
     */
    public function product()
=======
    protected function casts(): array
    {
        return [
            'quantity' => 'integer',
        ];
    }

    public function product(): BelongsTo
>>>>>>> d959ad24edda2faacd434ad042d52e081eb02510
    {
        return $this->belongsTo(Product::class);
    }

<<<<<<< HEAD
    /**
     * Get the user who registered the movement.
     */
    public function user()
=======
    public function user(): BelongsTo
>>>>>>> d959ad24edda2faacd434ad042d52e081eb02510
    {
        return $this->belongsTo(User::class);
    }
}
