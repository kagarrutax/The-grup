<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
<<<<<<< Updated upstream
<<<<<<< HEAD

class StockMovement extends Model
{
    use HasFactory;
=======
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StockMovement extends Model
{
=======
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StockMovement extends Model
{
>>>>>>> Stashed changes
    /** @use HasFactory<\Database\Factories\StockMovementFactory> */
    use HasFactory;

    public const TYPE_ENTRADA = 'entrada';

    public const TYPE_SALIDA = 'salida';

<<<<<<< Updated upstream
>>>>>>> d959ad24edda2faacd434ad042d52e081eb02510
=======
>>>>>>> Stashed changes
    protected $fillable = [
        'product_id',
        'user_id',
        'type',
        'quantity',
        'reason',
    ];

<<<<<<< Updated upstream
<<<<<<< HEAD
    /**
     * Get the product that was moved.
     */
    public function product()
=======
=======
>>>>>>> Stashed changes
    protected function casts(): array
    {
        return [
            'quantity' => 'integer',
        ];
    }

    public function product(): BelongsTo
<<<<<<< Updated upstream
>>>>>>> d959ad24edda2faacd434ad042d52e081eb02510
=======
>>>>>>> Stashed changes
    {
        return $this->belongsTo(Product::class);
    }

<<<<<<< Updated upstream
<<<<<<< HEAD
    /**
     * Get the user who registered the movement.
     */
    public function user()
=======
    public function user(): BelongsTo
>>>>>>> d959ad24edda2faacd434ad042d52e081eb02510
=======
    public function user(): BelongsTo
>>>>>>> Stashed changes
    {
        return $this->belongsTo(User::class);
    }
}
