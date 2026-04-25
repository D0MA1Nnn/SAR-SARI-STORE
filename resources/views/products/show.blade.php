<x-layouts.app :title="'Product Details'">
    <div class="mx-auto max-w-2xl">
        <div class="mb-6">
            <h1 class="text-2xl font-bold tracking-tight text-slate-800">Product Details</h1>
            <p class="mt-1 text-sm text-slate-500">View and manage product information.</p>
        </div>

        <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="space-y-4">
                <div class="flex items-start gap-3 border-b border-slate-100 pb-4">
                    <div class="rounded-lg bg-emerald-50 p-2">
                        <i class="fa-solid fa-box text-emerald-600"></i>
                    </div>
                    <div class="flex-1">
                        <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Product Name</p>
                        <p class="mt-0.5 text-base font-semibold text-slate-800">{{ $product->name }}</p>
                    </div>
                </div>

                <div class="flex items-start gap-3 border-b border-slate-100 pb-4">
                    <div class="rounded-lg bg-slate-100 p-2">
                        <i class="fa-solid fa-tag text-slate-500"></i>
                    </div>
                    <div class="flex-1">
                        <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Category</p>
                        <p class="mt-0.5 text-sm text-slate-700">
                            <span class="inline-flex rounded-full bg-emerald-50 px-2.5 py-0.5 text-xs font-medium text-emerald-700">
                                {{ $product->category?->description ?? 'Uncategorized' }}
                            </span>
                        </p>
                    </div>
                </div>

                <div class="flex items-start gap-3">
                    <div class="rounded-lg bg-amber-50 p-2">
                        <i class="fa-solid fa-currency-sign text-amber-600"></i>
                    </div>
                    <div class="flex-1">
                        <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Current Price</p>
                        <p class="mt-0.5 text-2xl font-bold text-emerald-700">₱ {{ number_format($product->current_price, 2) }}</p>
                    </div>
                </div>

                <div class="flex items-start gap-3 border-t border-slate-100 pt-4">
                    <div class="rounded-lg bg-slate-100 p-2">
                        <i class="fa-solid fa-tag text-slate-500"></i>
                    </div>
                    <div class="flex-1">
                        <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Stock</p>
                        <p class="mt-0.5 text-sm text-slate-700">{{ $product->stock ?? 0 }}</p>
                    </div>
                </div>

                <div class="flex items-start gap-3">
                    <div class="rounded-lg bg-slate-100 p-2">
                        <i class="fa-solid fa-circle-check text-slate-500"></i>
                    </div>
                    <div class="flex-1">
                        <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Status</p>
                        <p class="mt-0.5 text-sm text-slate-700">{{ $product->is_active ? 'Active' : 'Inactive' }}</p>
                    </div>
                </div>
            </div>

            <div class="mt-6 flex items-center gap-3 pt-4 border-t border-slate-100">
                <a href="{{ route('products.edit', $product) }}" class="inline-flex items-center gap-2 rounded-lg bg-emerald-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-emerald-700">
                    <i class="fa-regular fa-pen-to-square text-xs"></i>
                    Edit Product
                </a>
                <a href="{{ route('products.index') }}" class="inline-flex items-center gap-2 rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-sm font-medium text-slate-600 transition hover:bg-slate-50">
                    <i class="fa-solid fa-arrow-left text-xs"></i>
                    Back to List
                </a>
            </div>
        </div>
    </div>
</x-layouts.app>