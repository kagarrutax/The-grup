<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryNotification extends Model
{
    /** @use HasFactory<\Database\Factories\InventoryNotificationFactory> */
    use HasFactory;

    protected $fillable = [
        'type',
        'title',
        'description',
        'icon',
        'entity_type',
        'entity_id',
        'read_at',
        'deleted_at',
    ];

    protected function casts(): array
    {
        return [
            'read_at' => 'datetime',
            'deleted_at' => 'datetime',
        ];
    }

    public function scopeVisible($query)
    {
        return $query->whereNull('deleted_at');
    }

    public function markAsRead(): void
    {
        if ($this->read_at === null) {
            $this->forceFill(['read_at' => now()])->save();
        }
    }
}
