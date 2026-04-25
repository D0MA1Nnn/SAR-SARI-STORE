<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("ALTER TABLE stock_in MODIFY stock_date DATETIME NULL");
        DB::statement("ALTER TABLE stock_in MODIFY unit_cost DECIMAL(10,2) NULL");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE stock_in MODIFY stock_date DATE NULL");
    }
};
