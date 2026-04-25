<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('stock_in', function (Blueprint $table) {
            if (!Schema::hasColumn('stock_in', 'supplier_id')) {
                $table->foreignId('supplier_id')
                    ->nullable()
                    ->after('product_id')
                    ->constrained('supplier')
                    ->nullOnDelete();
            }
        });
    }

    public function down(): void
    {
        Schema::table('stock_in', function (Blueprint $table) {
            if (Schema::hasColumn('stock_in', 'supplier_id')) {
                $table->dropConstrainedForeignId('supplier_id');
            }
        });
    }
};