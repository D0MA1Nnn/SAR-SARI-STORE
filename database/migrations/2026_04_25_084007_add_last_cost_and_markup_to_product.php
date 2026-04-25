<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('product', function (Blueprint $table) {
            $table->decimal('last_cost', 10, 2)->nullable()->after('current_price');
            $table->decimal('markup_percent', 5, 2)->default(20)->after('last_cost');
        });
    }

    public function down(): void
    {
        Schema::table('product', function (Blueprint $table) {
            $table->dropColumn(['last_cost', 'markup_percent']);
        });
    }
};