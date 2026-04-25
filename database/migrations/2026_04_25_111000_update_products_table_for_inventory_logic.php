<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('product', function (Blueprint $table) {
            if (!Schema::hasColumn('product', 'name')) {
                $table->string('name')->nullable()->after('id');
            }
            if (!Schema::hasColumn('product', 'current_price')) {
                $table->decimal('current_price', 10, 2)->default(0)->after('category_id');
            }
            if (!Schema::hasColumn('product', 'stock')) {
                $table->integer('stock')->default(0)->after('current_price');
            }
            if (!Schema::hasColumn('product', 'is_active')) {
                $table->boolean('is_active')->default(true)->after('stock');
            }
        });

        if (Schema::hasColumn('product', 'product_name')) {
            DB::table('product')->update([
                'name' => DB::raw('COALESCE(name, product_name)'),
            ]);
        }

        if (Schema::hasColumn('product', 'price')) {
            DB::table('product')->update([
                'current_price' => DB::raw('current_price + price - current_price'),
            ]);
        }

        if (Schema::hasColumn('product', 'stocks')) {
            DB::table('product')->update([
                'stock' => DB::raw('stock + stocks - stock'),
            ]);
        }

        DB::table('product')->update([
            'is_active' => DB::raw('COALESCE(is_active, 1)'),
        ]);

        Schema::table('product', function (Blueprint $table) {
            if (Schema::hasColumn('product', 'product_name')) {
                $table->dropColumn('product_name');
            }
            if (Schema::hasColumn('product', 'price')) {
                $table->dropColumn('price');
            }
            if (Schema::hasColumn('product', 'stocks')) {
                $table->dropColumn('stocks');
            }
        });
    }

    public function down(): void
    {
        Schema::table('product', function (Blueprint $table) {
            if (!Schema::hasColumn('product', 'product_name')) {
                $table->string('product_name')->nullable()->after('id');
            }
            if (!Schema::hasColumn('product', 'price')) {
                $table->decimal('price', 10, 2)->nullable()->after('category_id');
            }
            if (!Schema::hasColumn('product', 'stocks')) {
                $table->integer('stocks')->default(0)->after('price');
            }
        });

        if (Schema::hasColumn('product', 'name')) {
            DB::table('product')->update([
                'product_name' => DB::raw('COALESCE(product_name, name)'),
            ]);
        }

        if (Schema::hasColumn('product', 'current_price')) {
            DB::table('product')->update([
                'price' => DB::raw('price + current_price - price'),
            ]);
        }

        if (Schema::hasColumn('product', 'stock')) {
            DB::table('product')->update([
                'stocks' => DB::raw('stocks + stock - stocks'),
            ]);
        }

        Schema::table('product', function (Blueprint $table) {
            if (Schema::hasColumn('product', 'name')) {
                $table->dropColumn('name');
            }
            if (Schema::hasColumn('product', 'current_price')) {
                $table->dropColumn('current_price');
            }
            if (Schema::hasColumn('product', 'stock')) {
                $table->dropColumn('stock');
            }
            if (Schema::hasColumn('product', 'is_active')) {
                $table->dropColumn('is_active');
            }
        });
    }
};
