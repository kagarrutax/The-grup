<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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
    protected $fillable = [
        'name',
        'description',
    ];

<<<<<<< HEAD
    /**
     * Get the products for the category.
     */
    public function products()
=======
    public function products(): HasMany
>>>>>>> d959ad24edda2faacd434ad042d52e081eb02510
    {
        return $this->hasMany(Product::class);
    }
}
