<x-layouts.app :title="'Supplier Details'">
    <div class="mx-auto max-w-2xl">
        <div class="mb-6">
            <h1 class="text-2xl font-bold tracking-tight text-slate-800">Supplier Details</h1>
            <p class="mt-1 text-sm text-slate-500">View supplier profile.</p>
        </div>

        <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="space-y-4">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Supplier Name</p>
                    <p class="mt-1 text-base font-semibold text-slate-800">{{ $supplier->supplier_name }}</p>
                </div>
                <div>
                    <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Contact Number</p>
                    <p class="mt-1 text-sm text-slate-700">{{ $supplier->contact_number ?? 'Not provided' }}</p>
                </div>
            </div>

            <div class="mt-6 flex items-center gap-3 pt-4 border-t border-slate-100">
                <a href="{{ route('suppliers.edit', $supplier) }}" class="inline-flex items-center gap-2 rounded-lg bg-emerald-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-emerald-700">
                    <i class="fa-regular fa-pen-to-square text-xs"></i>
                    Edit Supplier
                </a>
                <a href="{{ route('suppliers.index') }}" class="inline-flex items-center gap-2 rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-sm font-medium text-slate-600 transition hover:bg-slate-50">
                    <i class="fa-solid fa-arrow-left text-xs"></i>
                    Back to List
                </a>
            </div>
        </div>
    </div>
</x-layouts.app>
