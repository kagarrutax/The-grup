<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
<<<<<<< Updated upstream
<<<<<<< HEAD

class Category extends Model
{
    use HasFactory;
=======
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    /** @use HasFactory<\Database\Factories\CategoryFactory> */
    use HasFactory;

>>>>>>> d959ad24edda2faacd434ad042d52e081eb02510
=======
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    /** @use HasFactory<\Database\Factories\CategoryFactory> */
    use HasFactory;

>>>>>>> Stashed changes
    protected $fillable = [
        'name',
        'description',
    ];

<<<<<<< Updated upstream
<<<<<<< HEAD
    /**
     * Get the products for the category.
     */
    public function products()
=======
    public function products(): HasMany
>>>>>>> d959ad24edda2faacd434ad042d52e081eb02510
=======
    public function products(): HasMany
>>>>>>> Stashed changes
    {
        return $this->hasMany(Product::class);
    }
}
