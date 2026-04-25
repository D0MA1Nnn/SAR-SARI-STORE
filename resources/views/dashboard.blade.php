<x-layouts.app :title="'Dashboard'">
    <div class="space-y-8">
        <!-- Stats Grid -->
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
            <!-- Total Sales Card -->
            <div class="group relative overflow-hidden rounded-xl bg-white p-6 shadow-sm ring-1 ring-slate-200 transition-all hover:shadow-md">
                <div class="absolute right-0 top-0 -mr-4 -mt-4 h-20 w-20 rounded-full bg-emerald-50/50 opacity-50"></div>
                <div class="relative">
                    <div class="flex items-center justify-between">
                        <p class="text-sm font-medium uppercase tracking-wider text-slate-500">Total Sales</p>
                        <div class="rounded-lg bg-emerald-50 p-2">
                            <i class="fa-solid fa-chart-line text-emerald-600 text-sm"></i>
                        </div>
                    </div>
                    <p class="mt-3 text-3xl font-bold text-slate-800">{{ number_format($totalSales) }}</p>
                    <p class="mt-1 text-xs text-slate-400">+12% from last month</p>
                </div>
            </div>

            <!-- Total Customers Card -->
            <div class="group relative overflow-hidden rounded-xl bg-white p-6 shadow-sm ring-1 ring-slate-200 transition-all hover:shadow-md">
                <div class="absolute right-0 top-0 -mr-4 -mt-4 h-20 w-20 rounded-full bg-blue-50/50 opacity-50"></div>
                <div class="relative">
                    <div class="flex items-center justify-between">
                        <p class="text-sm font-medium uppercase tracking-wider text-slate-500">Total Customers</p>
                        <div class="rounded-lg bg-blue-50 p-2">
                            <i class="fa-solid fa-users text-blue-600 text-sm"></i>
                        </div>
                    </div>
                    <p class="mt-3 text-3xl font-bold text-slate-800">{{ number_format($totalCustomers) }}</p>
                    <p class="mt-1 text-xs text-slate-400">+8% from last month</p>
                </div>
            </div>

            <!-- Total Products Card -->
            <div class="group relative overflow-hidden rounded-xl bg-white p-6 shadow-sm ring-1 ring-slate-200 transition-all hover:shadow-md">
                <div class="absolute right-0 top-0 -mr-4 -mt-4 h-20 w-20 rounded-full bg-amber-50/50 opacity-50"></div>
                <div class="relative">
                    <div class="flex items-center justify-between">
                        <p class="text-sm font-medium uppercase tracking-wider text-slate-500">Total Products</p>
                        <div class="rounded-lg bg-amber-50 p-2">
                            <i class="fa-solid fa-boxes-stacked text-amber-600 text-sm"></i>
                        </div>
                    </div>
                    <p class="mt-3 text-3xl font-bold text-slate-800">{{ number_format($totalProducts) }}</p>
                    <p class="mt-1 text-xs text-slate-400">{{ $lowStockCount ?? 0 }} items low in stock</p>
                </div>
            </div>

            <!-- Total Revenue Card -->
            <div class="group relative overflow-hidden rounded-xl bg-white p-6 shadow-sm ring-1 ring-slate-200 transition-all hover:shadow-md">
                <div class="absolute right-0 top-0 -mr-4 -mt-4 h-20 w-20 rounded-full bg-violet-50/50 opacity-50"></div>
                <div class="relative">
                    <div class="flex items-center justify-between">
                        <p class="text-sm font-medium uppercase tracking-wider text-slate-500">Total Revenue</p>
                        <div class="rounded-lg bg-violet-50 p-2">
                            <i class="fa-solid fa-currency-sign text-violet-600 text-sm"></i>
                        </div>
                    </div>
                    <p class="mt-3 text-3xl font-bold text-slate-800">₱ {{ number_format($totalRevenue, 2) }}</p>
                    <p class="mt-1 text-xs text-slate-400">+15% from last month</p>
                </div>
            </div>
        </div>

        <!-- Recent Transactions Table -->
        <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">
            <div class="flex flex-col justify-between gap-4 border-b border-slate-200 px-6 py-5 sm:flex-row sm:items-center">
                <div>
                    <h3 class="text-lg font-semibold text-slate-800">Recent Transactions</h3>
                    <p class="mt-0.5 text-sm text-slate-500">Latest sales activity in your store.</p>
                </div>
                <a href="{{ route('sales.index') }}" class="inline-flex items-center justify-center gap-2 rounded-lg bg-slate-800 px-4 py-2 text-sm font-medium text-white transition hover:bg-slate-700">
                    View All
                    <i class="fa-solid fa-arrow-right text-xs"></i>
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                        <tr class="border-b border-slate-100 bg-slate-50/50 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                            <th class="px-6 py-3">Date</th>
                            <th class="px-6 py-3">Customer</th>
                            <th class="px-6 py-3">Items</th>
                            <th class="px-6 py-3 text-right">Total</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm text-slate-700">
                        @forelse($recentSales as $sale)
                            <tr class="transition-colors hover:bg-slate-50/50">
                                <td class="px-6 py-4 font-medium">{{ optional($sale->sales_date)->format('M d, Y') ?? 'N/A' }}</td>
                                <td class="px-6 py-4">
                                    {{ $sale->customer ? trim($sale->customer->customer_firstname . ' ' . ($sale->customer->customer_middlename ?? '') . ' ' . $sale->customer->customer_lastname) : 'Walk-in Customer' }}
                                </td>
                                <td class="px-6 py-4">{{ $sale->salesDetails->sum('quantity') }} items</td>
                                <td class="px-6 py-4 text-right font-semibold text-emerald-700">₱ {{ number_format($sale->total_amount, 2) }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center text-sm text-slate-400">
                                    <div class="flex flex-col items-center gap-2">
                                        <i class="fa-solid fa-receipt text-3xl text-slate-300"></i>
                                        <p>No recent transactions found.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layouts.app>