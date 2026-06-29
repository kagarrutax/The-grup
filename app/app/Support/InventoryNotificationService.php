<?php

namespace App\Support;

use App\Models\InventoryNotification;
use App\Models\Product;

class InventoryNotificationService
{
    public static function create(
        string $type,
        string $title,
        string $description,
        string $icon,
        ?string $entityType = null,
        ?int $entityId = null
    ): InventoryNotification {
        if (! InventorySchema::hasNotificationsTable()) {
            return new InventoryNotification([
                'type' => $type,
                'title' => $title,
                'description' => $description,
                'icon' => $icon,
                'entity_type' => $entityType,
                'entity_id' => $entityId,
            ]);
        }

        return InventoryNotification::create([
            'type' => $type,
            'title' => $title,
            'description' => $description,
            'icon' => $icon,
            'entity_type' => $entityType,
            'entity_id' => $entityId,
        ]);
    }

    public static function syncStockAlerts(): void
    {
        if (! InventorySchema::hasNotificationsTable()) {
            return;
        }

        Product::query()
            ->where('stock_quantity', '<=', 'stock_minimum')
            ->where('status', 'activo')
            ->get()
            ->each(function (Product $product): void {
                $type = $product->stock_quantity <= 0 ? 'stock.out' : 'stock.low';

                $title = $product->stock_quantity <= 0
                    ? 'Producto agotado'
                    : 'Producto con stock bajo';

                $description = $product->stock_quantity <= 0
                    ? $product->name.' se quedó sin existencias.'
                    : $product->name.' está por debajo del mínimo configurado.';

                $icon = $product->stock_quantity <= 0 ? 'bi-box-seam' : 'bi-exclamation-circle';

                $exists = InventoryNotification::query()
                    ->visible()
                    ->where('type', $type)
                    ->where('entity_type', Product::class)
                    ->where('entity_id', $product->id)
                    ->exists();

                if (! $exists) {
                    self::create($type, $title, $description, $icon, Product::class, $product->id);
                }
            });
    }

    public static function unreadCount(): int
    {
        if (! InventorySchema::hasNotificationsTable()) {
            return 0;
        }

        self::syncStockAlerts();

        return InventoryNotification::query()
            ->visible()
            ->whereNull('read_at')
            ->count();
    }
}
