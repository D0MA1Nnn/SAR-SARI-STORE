<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('stock_in', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')
                ->constrained('product')
                ->cascadeOnDelete();
            $table->integer('quantity');
            $table->decimal('unit_cost', 10, 2);
            $table->dateTime('stock_date');
            $table->string('reference')->nullable();
            $table->text('notes')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stock_in');
    }
};
