<x-layouts.app :title="'Stock Out Details'">
    <div class="mx-auto max-w-3xl">
        <div class="mb-6">
            <h1 class="text-2xl font-bold tracking-tight text-slate-800">Stock Out Details</h1>
            <p class="mt-1 text-sm text-slate-500">View stock out record information.</p>
        </div>

        <div class="rounded-xl border border-slate-200 bg-white shadow-sm">
            <div class="border-b border-slate-200 bg-slate-50/80 px-6 py-4">
                <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">Record #{{ $stockOut->id }}</p>
            </div>

            <div class="p-6 space-y-4">
                <div class="grid gap-4 sm:grid-cols-2">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Product</p>
                        <p class="mt-1 text-base font-semibold text-slate-800">{{ $stockOut->product?->name ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Reason</p>
                        <p class="mt-1 text-base font-semibold text-slate-800">{{ $stockOut->reason ?? '—' }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Quantity</p>
                        <p class="mt-1 text-base font-semibold text-slate-800">{{ $stockOut->quantity }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Date</p>
                        <p class="mt-1 text-base font-semibold text-slate-800">{{ optional($stockOut->stock_date)->format('F d, Y g:i A') ?? '—' }}</p>
                    </div>
                </div>

                <div>
                    <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Notes</p>
                    <p class="mt-1 text-sm text-slate-700">{{ $stockOut->notes ?? 'No notes provided.' }}</p>
                </div>
            </div>

            <div class="flex items-center gap-3 border-t border-slate-200 px-6 py-4">
                <a href="{{ route('stock-out.edit', $stockOut) }}" class="inline-flex items-center gap-2 rounded-lg bg-emerald-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-emerald-700">
                    <i class="fa-regular fa-pen-to-square text-xs"></i>
                    Edit Record
                </a>
                <a href="{{ route('stock-out.index') }}" class="inline-flex items-center gap-2 rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-sm font-medium text-slate-600 transition hover:bg-slate-50">
                    <i class="fa-solid fa-arrow-left text-xs"></i>
                    Back to List
                </a>
            </div>
        </div>
    </div>
</x-layouts.app>
