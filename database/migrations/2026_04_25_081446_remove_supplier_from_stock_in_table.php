<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveSupplierFromStockInTable extends Migration
{
    public function up(): void
    {
        Schema::table('stock_in', function (Blueprint $table) {
            if (Schema::hasColumn('stock_in', 'supplier_id')) {
                $table->dropForeign(['supplier_id']);
                $table->dropColumn('supplier_id');
            }
        });
    }

    public function down(): void
    {
        Schema::table('stock_in', function (Blueprint $table) {
            $table->foreignId('supplier_id')
                    ->nullable()
                    ->constrained('supplier') // or 'suppliers' if plural
                    ->nullOnDelete();
        });
    }
}