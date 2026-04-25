<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("ALTER TABLE stock_out MODIFY stock_date DATETIME NULL");

        if (Schema::hasColumn('stock_out', 'reference')) {
            DB::statement("ALTER TABLE stock_out DROP COLUMN reference");
        }

        if (!Schema::hasColumn('stock_out', 'reason')) {
            DB::statement("ALTER TABLE stock_out ADD COLUMN reason VARCHAR(255) NULL AFTER quantity");
        }
    }

    public function down(): void
    {
        if (!Schema::hasColumn('stock_out', 'reference')) {
            DB::statement("ALTER TABLE stock_out ADD COLUMN reference VARCHAR(255) NULL AFTER stock_date");
        }

        if (Schema::hasColumn('stock_out', 'reason')) {
            DB::statement("ALTER TABLE stock_out DROP COLUMN reason");
        }

        DB::statement("ALTER TABLE stock_out MODIFY stock_date DATE NULL");
    }
};
