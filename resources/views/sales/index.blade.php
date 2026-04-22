<x-layouts.app :title="'Sales'">
    <div class="space-y-6">
        <!-- Header -->
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl font-bold tracking-tight text-slate-800"></h1>
            </div>
            <a href="{{ route('sales.create') }}" class="inline-flex items-center justify-center gap-2 rounded-lg bg-emerald-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2">
                <i class="fa-solid fa-plus text-xs"></i>
                New Sale
            </a>
        </div>

        <!-- Search Bar -->
        <div class="rounded-xl border border-slate-200 bg-white p-4 shadow-sm">
            <form method="GET" class="flex flex-col gap-3 sm:flex-row">
                <div class="flex-1">
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">
                            <i class="fa-solid fa-magnifying-glass text-xs"></i>
                        </span>
                        <input type="text"
                                name="search"
                                value="{{ $search }}"
                                placeholder="Search by customer name..."
                                class="w-full rounded-lg border border-slate-300 px-4 py-2.5 pl-10 text-sm text-slate-700 placeholder:text-slate-400 focus:border-emerald-500 focus:outline-none focus:ring-1 focus:ring-emerald-500">
                    </div>
                </div>
                <button type="submit" class="rounded-lg bg-slate-700 px-5 py-2.5 text-sm font-medium text-white transition hover:bg-slate-800 focus:outline-none focus:ring-2 focus:ring-slate-500 focus:ring-offset-2">
                    Search
                </button>
            </form>
        </div>

        <!-- Sales Table -->
        <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">
            <div class="border-b border-slate-200 bg-slate-50/80 px-6 py-3">
                <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">
                    {{ $sales->total() }} {{ Str::plural('sale', $sales->total()) }} found
                </p>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                        <tr class="border-b border-slate-100 bg-slate-50/50 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                            <th class="px-6 py-3">Date</th>
                            <th class="px-6 py-3">Customer</th>
                            <th class="px-6 py-3">Items</th>
                            <th class="px-6 py-3">Total Amount</th>
                            <th class="px-6 py-3 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm">
                        @forelse($sales as $sale)
                            <tr class="transition-colors hover:bg-slate-50/50">
                                <td class="px-6 py-4 text-slate-600">{{ optional($sale->sales_date)->format('M d, Y') ?? '—' }}</td>
                                <td class="px-6 py-4 font-medium text-slate-700">{{ $sale->customer?->customer_name ?? 'Walk-in Customer' }}</td>
                                <td class="px-6 py-4 text-slate-600">{{ $sale->salesDetails->sum('quantity') }} items</td>
                                <td class="px-6 py-4 font-semibold text-emerald-700">₱ {{ number_format($sale->total_amount, 2) }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-end gap-4">
                                        <a href="{{ route('sales.show', $sale) }}" class="inline-flex items-center gap-1 text-sm font-medium text-emerald-600 transition hover:text-emerald-800">
                                            <i class="fa-regular fa-eye text-xs"></i>
                                            View
                                        </a>
                                        <a href="{{ route('sales.edit', $sale) }}" class="inline-flex items-center gap-1 text-sm font-medium text-blue-600 transition hover:text-blue-800">
                                            <i class="fa-regular fa-pen-to-square text-xs"></i>
                                            Edit
                                        </a>
                                        <form method="POST" action="{{ route('sales.destroy', $sale) }}" onsubmit="return confirm('Delete this sale? This action cannot be undone.')" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="inline-flex items-center gap-1 text-sm font-medium text-red-600 transition hover:text-red-800">
                                                <i class="fa-regular fa-trash-can text-xs"></i>
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center gap-2">
                                        <i class="fa-regular fa-receipt text-3xl text-slate-300"></i>
                                        <p class="text-sm text-slate-400">No sales records found.</p>
                                        <a href="{{ route('sales.create') }}" class="mt-2 text-sm text-emerald-600 hover:text-emerald-700">Create your first sale →</a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $sales->withQueryString()->links() }}
        </div>
    </div>
</x-layouts.app>