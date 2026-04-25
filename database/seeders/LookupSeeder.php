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
        DB::table('supplier')->insert([
        ['supplier_name' => 'Pepsi Cola Products', 'contact_number' => '02-888-1234', 'contact_person' => 'Juan Dela Cruz', 'email' => 'pepsi@example.com', 'address' => '123 Business Ave, Manila'],
        ['supplier_name' => 'San Miguel Corp', 'contact_number' => '02-888-5678', 'contact_person' => 'Maria Santos', 'email' => 'sanmiguel@example.com', 'address' => '456 Corporate St, Makati'],
        ['supplier_name' => 'Universal Robina', 'contact_number' => '02-888-9012', 'contact_person' => 'Jose Rizal', 'email' => 'urc@example.com', 'address' => '789 Industrial Park, Pasig'],
        ['supplier_name' => 'Nestle Philippines', 'contact_number' => '02-888-3456', 'contact_person' => 'Teresa Gomez', 'email' => 'nestle@example.com', 'address' => '321 Food Terminal, Taguig'],
        ['supplier_name' => 'Procter & Gamble', 'contact_number' => '02-888-7890', 'contact_person' => 'Roberto Carlos', 'email' => 'pg@example.com', 'address' => '654 Commercial Center, Quezon City'],
        ]);
    }
}
