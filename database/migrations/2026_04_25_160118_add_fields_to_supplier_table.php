<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('supplier', function (Blueprint $table) {
            if (!Schema::hasColumn('supplier', 'address')) {
                $table->string('address')->nullable()->after('contact_number');
            }
            if (!Schema::hasColumn('supplier', 'email')) {
                $table->string('email')->nullable()->after('address');
            }
            if (!Schema::hasColumn('supplier', 'contact_person')) {
                $table->string('contact_person')->nullable()->after('email');
            }
        });
    }

    public function down(): void
    {
        Schema::table('supplier', function (Blueprint $table) {
            $table->dropColumn(['address', 'email', 'contact_person']);
        });
    }
};