<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('stock_out', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')
                ->constrained('product')
                ->cascadeOnDelete();
            $table->integer('quantity');
            $table->string('reason');
            $table->dateTime('stock_date');
            $table->text('notes')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stock_out');
    }
};
