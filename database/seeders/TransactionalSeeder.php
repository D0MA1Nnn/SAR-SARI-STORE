<?php

namespace Database\Seeders;

use App\Models\CashLog;
use App\Models\Customer;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Database\Seeder;

class TransactionalSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 50; $i++) {
            Customer::query()->create([
                'customer_firstname' => 'Customer',
                'customer_middlename' => null,
                'customer_lastname' => (string) $i,
                'contact_number' => '09'.str_pad((string) random_int(0, 999999999), 9, '0', STR_PAD_LEFT),
                'collateral_type_id' => random_int(1, 10),
            ]);

            Product::query()->create([
                'name' => 'Product_'.$i,
                'category_id' => random_int(1, 10),
                'current_price' => random_int(10, 220),
                'stock' => random_int(10, 80),
            ]);

            CashLog::query()->create([
                'start_cash' => random_int(1000, 6000),
                'end_cash' => random_int(1000, 6000),
                'log_date' => now()->subDays(random_int(1, 60))->toDateString(),
            ]);
        }

        for ($i = 0; $i < 50; $i++) {
            $sale = Sale::query()->create([
                'customer_id' => random_int(1, 50),
                'sales_date' => now()->subDays(random_int(1, 60))->toDateString(),
            ]);

            $lines = random_int(1, 4);
            for ($line = 0; $line < $lines; $line++) {
                $sale->salesDetails()->create([
                    'product_id' => random_int(1, 50),
                    'quantity' => random_int(1, 5),
                ]);
            }

            Payment::query()->create([
                'customer_id' => random_int(1, 50),
                'payment_method_id' => random_int(1, 10),
                'payment_status_id' => random_int(1, 10),
                'amount' => random_int(60, 550),
                'payment_date' => now()->subDays(random_int(1, 60))->toDateString(),
            ]);
        }

        for ($i = 0; $i < 10; $i++) {
            \App\Models\BlockList::query()->create([
                'customer_id' => random_int(1, 50),
                'violation_id' => random_int(1, 10),
            ]);
        }
    }
}
