<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('customer', function (Blueprint $table) {
            $table->id();
            $table->string('customer_firstname');
            $table->string('customer_middlename')->nullable();
            $table->string('customer_lastname');
            $table->string('contact_number', 20)->nullable();
            $table->foreignId('collateral_type_id')
                ->nullable()
                ->constrained('collateral_type')
                ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer');
    }
};
