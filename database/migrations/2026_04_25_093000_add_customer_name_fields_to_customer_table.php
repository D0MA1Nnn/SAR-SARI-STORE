<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('customer', function (Blueprint $table) {
            if (!Schema::hasColumn('customer', 'customer_firstname')) {
                $table->string('customer_firstname')->nullable()->after('id');
            }
            if (!Schema::hasColumn('customer', 'customer_middlename')) {
                $table->string('customer_middlename')->nullable()->after('customer_firstname');
            }
            if (!Schema::hasColumn('customer', 'customer_lastname')) {
                $table->string('customer_lastname')->nullable()->after('customer_middlename');
            }
        });

        if (Schema::hasColumn('customer', 'customer_name')) {
            DB::table('customer')
                ->select('id', 'customer_name')
                ->orderBy('id')
                ->chunkById(100, function ($rows): void {
                    foreach ($rows as $row) {
                        $name = trim((string) ($row->customer_name ?? ''));
                        if ($name === '') {
                            continue;
                        }

                        $parts = preg_split('/\s+/', $name);
                        if (!$parts) {
                            continue;
                        }

                        $firstname = $parts[0] ?? null;
                        $lastname = count($parts) > 1 ? $parts[count($parts) - 1] : null;
                        $middlename = null;

                        if (count($parts) > 2) {
                            $middlename = implode(' ', array_slice($parts, 1, -1));
                        }

                        DB::table('customer')
                            ->where('id', $row->id)
                            ->update([
                                'customer_firstname' => $firstname,
                                'customer_middlename' => $middlename,
                                'customer_lastname' => $lastname,
                            ]);
                    }
                });
        }
    }

    public function down(): void
    {
        Schema::table('customer', function (Blueprint $table) {
            if (Schema::hasColumn('customer', 'customer_firstname')) {
                $table->dropColumn('customer_firstname');
            }
            if (Schema::hasColumn('customer', 'customer_middlename')) {
                $table->dropColumn('customer_middlename');
            }
            if (Schema::hasColumn('customer', 'customer_lastname')) {
                $table->dropColumn('customer_lastname');
            }
        });
    }
};
