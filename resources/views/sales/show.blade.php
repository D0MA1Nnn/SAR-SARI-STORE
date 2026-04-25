<x-layouts.app :title="'Sale Details'">
    <div class="mx-auto max-w-3xl">
        <div class="mb-6">
            <h1 class="text-2xl font-bold tracking-tight text-slate-800">Sale Details</h1>
            <p class="mt-1 text-sm text-slate-500">View complete transaction information.</p>
        </div>

        <div class="rounded-xl border border-slate-200 bg-white shadow-sm">
            <!-- Header -->
            <div class="border-b border-slate-200 bg-gradient-to-r from-emerald-50 to-white p-6">
                <div class="grid gap-4 sm:grid-cols-2">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Customer</p>
                        <p class="mt-1 text-base font-semibold text-slate-800">
                            {{ $sale->customer ? trim($sale->customer->customer_firstname . ' ' . ($sale->customer->customer_middlename ?? '') . ' ' . $sale->customer->customer_lastname) : 'Walk-in Customer' }}
                        </p>
                    </div>
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Sales Date</p>
                        <p class="mt-1 text-base font-semibold text-slate-800">{{ optional($sale->sales_date)->format('F d, Y') ?? '—' }}</p>
                    </div>
                </div>
            </div>

            <!-- Items Table -->
            <div class="p-6">
                <h4 class="mb-3 text-sm font-semibold text-slate-700">Items Purchased</h4>
                <div class="overflow-hidden rounded-lg border border-slate-200">
                    <table class="min-w-full text-sm">
                        <thead class="bg-slate-50">
                            <tr class="border-b border-slate-200">
                                <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Product</th>
                                <th class="px-4 py-3 text-right text-xs font-semibold uppercase tracking-wider text-slate-500">Quantity</th>
                                <th class="px-4 py-3 text-right text-xs font-semibold uppercase tracking-wider text-slate-500">Unit Price</th>
                                <th class="px-4 py-3 text-right text-xs font-semibold uppercase tracking-wider text-slate-500">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @foreach($sale->salesDetails as $detail)
                                <tr class="hover:bg-slate-50/50">
                                    <td class="px-4 py-3 font-medium text-slate-700">{{ $detail->product?->name ?? 'N/A' }}</td>
                                    <td class="px-4 py-3 text-right text-slate-600">{{ $detail->quantity }}</td>
                                    <td class="px-4 py-3 text-right text-slate-600">₱ {{ number_format($detail->product?->current_price ?? 0, 2) }}</td>
                                    <td class="px-4 py-3 text-right font-semibold text-emerald-700">₱ {{ number_format(($detail->product?->current_price ?? 0) * $detail->quantity, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="bg-slate-50">
                            <tr class="border-t border-slate-200">
                                <td colspan="3" class="px-4 py-3 text-right font-semibold text-slate-700">Total:</td>
                                <td class="px-4 py-3 text-right text-lg font-bold text-emerald-700">₱ {{ number_format($sale->total_amount, 2) }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

            <!-- Actions -->
            <div class="flex items-center gap-3 border-t border-slate-200 px-6 py-4">
                <a href="{{ route('sales.edit', $sale) }}" class="inline-flex items-center gap-2 rounded-lg bg-emerald-600 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-emerald-700">
                    <i class="fa-regular fa-pen-to-square text-xs"></i>
                    Edit Sale
                </a>
                <a href="{{ route('sales.index') }}" class="inline-flex items-center gap-2 rounded-lg border border-slate-300 bg-white px-4 py-2 text-sm font-medium text-slate-600 transition hover:bg-slate-50">
                    <i class="fa-solid fa-arrow-left text-xs"></i>
                    Back to List
                </a>
            </div>
        </div>
    </div>
</x-layouts.app>