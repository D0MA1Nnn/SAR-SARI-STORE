@csrf
<div class="space-y-6">
    <div class="grid gap-6 md:grid-cols-2">
        <div>
            <label for="customer_id" class="mb-1.5 block text-sm font-semibold text-slate-700">Customer</label>
            <select name="customer_id"
                    id="customer_id"
                    class="w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm text-slate-700 focus:border-emerald-500 focus:outline-none focus:ring-1 focus:ring-emerald-500">
                <option value="">Select a customer</option>
                @foreach($customers as $customer)
                    <option value="{{ $customer->id }}" @selected(old('customer_id', $sale->customer_id ?? '') == $customer->id)>
                        {{ $customer->customer_name }}
                    </option>
                @endforeach
            </select>
            @error('customer_id')
                <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="sales_date" class="mb-1.5 block text-sm font-semibold text-slate-700">Sales Date</label>
            <div class="relative">
                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">
                    <i class="fa-regular fa-calendar text-xs"></i>
                </span>
                <input type="date"
                        name="sales_date"
                        id="sales_date"
                        value="{{ old('sales_date', isset($sale) ? optional($sale->sales_date)->format('Y-m-d') : now()->toDateString()) }}" 
                        class="w-full rounded-lg border border-slate-300 px-4 py-2.5 pl-10 text-sm text-slate-700 focus:border-emerald-500 focus:outline-none focus:ring-1 focus:ring-emerald-500">
            </div>
            @error('sales_date')
                <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div>
        <div class="mb-4 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h4 class="text-base font-semibold text-slate-800">Sales Items</h4>
                <p class="text-xs text-slate-500">Add products to this transaction</p>
            </div>
            <button type="button" id="add-row" class="inline-flex items-center justify-center gap-2 rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-2 text-sm font-medium text-emerald-700 transition hover:bg-emerald-100">
                <i class="fa-solid fa-plus text-xs"></i>
                Add Item
            </button>
        </div>

        <div id="detail-rows" class="space-y-3">
            @php($details = old('details', isset($sale) ? $sale->salesDetails->map(fn($d) => ['product_id' => $d->product_id, 'quantity' => $d->quantity])->toArray() : [['product_id' => '', 'quantity' => 1]]))
            @foreach($details as $idx => $detail)
                <div class="detail-row rounded-lg border border-slate-200 bg-slate-50/30 p-4 transition-all">
                    <div class="grid gap-3 md:grid-cols-[1fr,150px,100px]">
                        <div>
                            <label class="mb-1 block text-xs font-medium text-slate-500">Product</label>
                            <select name="details[{{ $idx }}][product_id]" class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm focus:border-emerald-500 focus:outline-none focus:ring-1 focus:ring-emerald-500" required>
                                <option value="">Select product</option>
                                @foreach($products as $product)
                                    <option value="{{ $product->id }}" data-price="{{ $product->price }}" @selected(($detail['product_id'] ?? '') == $product->id)>
                                        {{ $product->product_name }} - ₱ {{ number_format($product->price, 2) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="mb-1 block text-xs font-medium text-slate-500">Quantity</label>
                            <input type="number" min="1" name="details[{{ $idx }}][quantity]" value="{{ $detail['quantity'] ?? 1 }}" class="quantity-input w-full rounded-lg border border-slate-300 px-3 py-2 text-sm focus:border-emerald-500 focus:outline-none focus:ring-1 focus:ring-emerald-500" required>
                        </div>
                        <div class="flex items-end">
                            <button type="button" class="remove-row w-full rounded-lg border border-red-200 bg-red-50 px-3 py-2 text-sm font-medium text-red-600 transition hover:bg-red-100">
                                <i class="fa-regular fa-trash-can mr-1"></i> Remove
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        @error('details')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="flex items-center gap-3 pt-4 border-t border-slate-200">
        <button type="submit" class="rounded-lg bg-emerald-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2">
            {{ $buttonText }}
        </button>
        <a href="{{ route('sales.index') }}" class="rounded-lg border border-slate-300 bg-white px-5 py-2.5 text-sm font-medium text-slate-600 transition hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-slate-400 focus:ring-offset-2">
            Cancel
        </a>
    </div>
</div>

<script>
    (() => {
        const products = @json($products->map(fn($p) => ['id' => $p->id, 'name' => $p->product_name, 'price' => $p->price]));
        const rows = document.getElementById('detail-rows');
        const addBtn = document.getElementById('add-row');

        function createRow(index) {
            const options = products.map(p => `<option value="${p.id}" data-price="${p.price}">${p.name} - ₱ ${p.price.toFixed(2)}</option>`).join('');
            const div = document.createElement('div');
            div.className = 'detail-row rounded-lg border border-slate-200 bg-slate-50/30 p-4 transition-all';
            div.innerHTML = `
                <div class="grid gap-3 md:grid-cols-[1fr,150px,100px]">
                    <div>
                        <label class="mb-1 block text-xs font-medium text-slate-500">Product</label>
                        <select name="details[${index}][product_id]" class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm focus:border-emerald-500 focus:outline-none focus:ring-1 focus:ring-emerald-500" required>
                            <option value="">Select product</option>
                            ${options}
                        </select>
                    </div>
                    <div>
                        <label class="mb-1 block text-xs font-medium text-slate-500">Quantity</label>
                        <input type="number" min="1" name="details[${index}][quantity]" value="1" class="quantity-input w-full rounded-lg border border-slate-300 px-3 py-2 text-sm focus:border-emerald-500 focus:outline-none focus:ring-1 focus:ring-emerald-500" required>
                    </div>
                    <div class="flex items-end">
                        <button type="button" class="remove-row w-full rounded-lg border border-red-200 bg-red-50 px-3 py-2 text-sm font-medium text-red-600 transition hover:bg-red-100">
                            <i class="fa-regular fa-trash-can mr-1"></i> Remove
                        </button>
                    </div>
                </div>`;
            return div;
        }

        addBtn?.addEventListener('click', () => {
            const index = rows.querySelectorAll('.detail-row').length;
            rows.appendChild(createRow(index));
        });

        rows?.addEventListener('click', (e) => {
            const removeBtn = e.target.closest('.remove-row');
            if (removeBtn && rows.querySelectorAll('.detail-row').length > 1) {
                removeBtn.closest('.detail-row')?.remove();
            } else if (removeBtn && rows.querySelectorAll('.detail-row').length === 1) {
                alert('At least one item is required for the sale.');
            }
        });
    })();
</script>