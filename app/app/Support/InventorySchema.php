<?php

namespace App\Support;

use Illuminate\Support\Facades\Schema;

class InventorySchema
{
    private static array $cache = [];

    public static function hasSuppliersTable(): bool
    {
        return self::hasTable('suppliers');
    }

    public static function hasNotificationsTable(): bool
    {
        return self::hasTable('inventory_notifications');
    }

    public static function productHasSupplierId(): bool
    {
        return self::hasColumn('products', 'supplier_id');
    }

    public static function productHasPurchasePrice(): bool
    {
        return self::hasColumn('products', 'purchase_price');
    }

    public static function productHasSalePrice(): bool
    {
        return self::hasColumn('products', 'sale_price');
    }

    public static function productHasImageUrl(): bool
    {
        return self::hasColumn('products', 'image_url');
    }

    private static function hasTable(string $table): bool
    {
        $key = 'table:'.$table;

        return self::$cache[$key] ??= Schema::hasTable($table);
    }

    private static function hasColumn(string $table, string $column): bool
    {
        $key = 'column:'.$table.'.'.$column;

        return self::$cache[$key] ??= self::hasTable($table) && Schema::hasColumn($table, $column);
    }
}
