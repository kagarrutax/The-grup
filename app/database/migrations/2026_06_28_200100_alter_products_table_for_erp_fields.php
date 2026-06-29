<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->foreignId('supplier_id')->nullable()->after('category_id')->constrained()->nullOnDelete();
            $table->string('image_url', 2048)->nullable()->after('sku');
            $table->decimal('purchase_price', 10, 2)->default(0)->after('price');
            $table->decimal('sale_price', 10, 2)->default(0)->after('purchase_price');
        });

        DB::table('products')->update([
            'purchase_price' => DB::raw('price'),
            'sale_price' => DB::raw('price'),
        ]);
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropConstrainedForeignId('supplier_id');
            $table->dropColumn(['image_url', 'purchase_price', 'sale_price']);
        });
    }
};
