<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('stock_out', function (Blueprint $table) {
            if (!Schema::hasColumn('stock_out', 'reason')) {
                $table->string('reason')->nullable()->after('quantity');
            }
            if (Schema::hasColumn('stock_out', 'customer_id')) {
                $table->dropConstrainedForeignId('customer_id');
            }
        });
    }

    public function down(): void
    {
        Schema::table('stock_out', function (Blueprint $table) {
            if (Schema::hasColumn('stock_out', 'reason')) {
                $table->dropColumn('reason');
            }
        });
    }
};
