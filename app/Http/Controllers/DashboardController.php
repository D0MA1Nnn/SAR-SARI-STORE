<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        $startTime = microtime(true);
        
        Log::info('Dashboard loading started');
        
        $totalSales = Sale::count();
        Log::info('Total sales query done', ['time' => microtime(true) - $startTime]);
        
        $totalCustomers = Customer::count();
        Log::info('Total customers query done', ['time' => microtime(true) - $startTime]);
        
        $totalProducts = Product::count();
        Log::info('Total products query done', ['time' => microtime(true) - $startTime]);
        
        $totalRevenue = (float) Payment::sum('amount');
        Log::info('Total revenue query done', ['time' => microtime(true) - $startTime]);
        
        $recentSales = Sale::with(['customer', 'salesDetails.product'])
            ->latest('sales_date')
            ->take(8)
            ->get();
        Log::info('Recent sales query done', ['time' => microtime(true) - $startTime]);
        
        $lowStockCount = Product::where('stock', '<=', 10)->count();
        
        $totalTime = microtime(true) - $startTime;
        Log::info('DASHBOARD TOTAL LOAD TIME', ['time' => $totalTime]);
        
        return view('dashboard', [
            'totalSales' => $totalSales,
            'totalCustomers' => $totalCustomers,
            'totalProducts' => $totalProducts,
            'totalRevenue' => $totalRevenue,
            'recentSales' => $recentSales,
            'lowStockCount' => $lowStockCount,
        ]);
    }
}