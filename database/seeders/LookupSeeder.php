<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LookupSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('category')->insert([
            ['description' => 'Beverages'],
            ['description' => 'Snacks'],
            ['description' => 'Canned Goods'],
            ['description' => 'Instant Noodles'],
            ['description' => 'Rice'],
            ['description' => 'Personal Care'],
            ['description' => 'Cleaning Supplies'],
            ['description' => 'School Supplies'],
            ['description' => 'Frozen Foods'],
            ['description' => 'Others'],
        ]);

        DB::table('collateral_type')->insert([
            ['description' => 'Jewelry'],
            ['description' => 'Appliance'],
            ['description' => 'Phone'],
            ['description' => 'Laptop'],
            ['description' => 'Watch'],
            ['description' => 'TV'],
            ['description' => 'Motorcycle'],
            ['description' => 'Bicycle'],
            ['description' => 'Speaker'],
            ['description' => 'Others'],
        ]);

        DB::table('payment_method')->insert([
            ['description' => 'Cash'],
            ['description' => 'GCash'],
            ['description' => 'Maya'],
            ['description' => 'Bank Transfer'],
            ['description' => 'Credit Card'],
            ['description' => 'Debit Card'],
            ['description' => 'COD'],
            ['description' => 'Installment'],
            ['description' => 'QR Payment'],
            ['description' => 'Others'],
        ]);

        DB::table('sys_status')->insert([
            ['description' => 'Pending'],
            ['description' => 'Paid'],
            ['description' => 'Unpaid'],
            ['description' => 'Partially Paid'],
            ['description' => 'Overdue'],
            ['description' => 'Cancelled'],
            ['description' => 'Completed'],
            ['description' => 'Failed'],
            ['description' => 'Processing'],
            ['description' => 'Others'],
        ]);

        DB::table('violation')->insert([
            ['description' => 'Late Payment'],
            ['description' => 'No Payment'],
            ['description' => 'Fraud'],
            ['description' => 'Fake Collateral'],
            ['description' => 'Damaged Item'],
            ['description' => 'Lost Item'],
            ['description' => 'Overdue Loan'],
            ['description' => 'Unpaid Balance'],
            ['description' => 'Policy Violation'],
            ['description' => 'Others'],
        ]);
    }
}
