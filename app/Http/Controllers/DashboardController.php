<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        $recentSales = Sale::with(['customer', 'salesDetails.product'])
            ->latest('sales_date')
            ->take(8)
            ->get();

        return view('dashboard', [
            'totalSales' => Sale::count(),
            'totalCustomers' => Customer::count(),
            'totalProducts' => Product::count(),
            'totalRevenue' => (float) Payment::sum('amount'),
            'recentSales' => $recentSales,
        ]);
    }
}
