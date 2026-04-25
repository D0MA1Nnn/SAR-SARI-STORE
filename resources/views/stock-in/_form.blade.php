@csrf
<div class="space-y-6">
    <div class="grid gap-6 md:grid-cols-2">
        <div>
            <label for="product_id" class="mb-1.5 block text-sm font-semibold text-slate-700">Product</label>
            <select name="product_id"
                    id="product_id"
                    class="w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm text-slate-700 focus:border-emerald-500 focus:outline-none focus:ring-1 focus:ring-emerald-500">
                <option value="">Select a product</option>
                @foreach($products as $product)
                    <option value="{{ $product->id }}" @selected(old('product_id', $stockIn->product_id ?? '') == $product->id)>
                        {{ $product->name }} (Current: ₱{{ number_format($product->current_price, 2) }} | Stock: {{ $product->stock ?? 0 }})
                    </option>
                @endforeach
            </select>
            @error('product_id')
                <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="supplier_id" class="mb-1.5 block text-sm font-semibold text-slate-700">Supplier</label>
            <select name="supplier_id"
                    id="supplier_id"
                    class="w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm text-slate-700 focus:border-emerald-500 focus:outline-none focus:ring-1 focus:ring-emerald-500">
                <option value="">Select a supplier (optional)</option>
                @foreach($suppliers as $supplier)
                    <option value="{{ $supplier->id }}" @selected(old('supplier_id', $stockIn->supplier_id ?? '') == $supplier->id)>
                        {{ $supplier->supplier_name }}
                    </option>
                @endforeach
            </select>
            @error('supplier_id')
                <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="quantity" class="mb-1.5 block text-sm font-semibold text-slate-700">Quantity</label>
            <input type="number"
                    min="1"
                    name="quantity"
                    id="quantity"
                    value="{{ old('quantity', $stockIn->quantity ?? 1) }}"
                    placeholder="0"
                    class="w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm text-slate-700 placeholder:text-slate-400 focus:border-emerald-500 focus:outline-none focus:ring-1 focus:ring-emerald-500">
            @error('quantity')
                <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="unit_cost" class="mb-1.5 block text-sm font-semibold text-slate-700">Unit Cost (PHP)</label>
            <div class="relative">
                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">₱</span>
                <input type="number"
                        step="0.01"
                        name="unit_cost"
                        id="unit_cost"
                        value="{{ old('unit_cost', $stockIn->unit_cost ?? '') }}"
                        placeholder="0.00"
                        class="w-full rounded-lg border border-slate-300 px-4 py-2.5 pl-8 text-sm text-slate-700 placeholder:text-slate-400 focus:border-emerald-500 focus:outline-none focus:ring-1 focus:ring-emerald-500">
            </div>
            @error('unit_cost')
                <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="stock_date" class="mb-1.5 block text-sm font-semibold text-slate-700">Date & Time</label>
            <input type="datetime-local"
                    name="stock_date"
                    id="stock_date"
                    value="{{ old('stock_date', isset($stockIn) ? optional($stockIn->stock_date)->format('Y-m-d\TH:i') : now()->format('Y-m-d\TH:i')) }}"
                    class="w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm text-slate-700 focus:border-emerald-500 focus:outline-none focus:ring-1 focus:ring-emerald-500">
            @error('stock_date')
                <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="reference" class="mb-1.5 block text-sm font-semibold text-slate-700">Reference</label>
            <input type="text"
                    name="reference"
                    id="reference"
                    value="{{ old('reference', $stockIn->reference ?? '') }}"
                    placeholder="Delivery receipt, PO, etc."
                    class="w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm text-slate-700 placeholder:text-slate-400 focus:border-emerald-500 focus:outline-none focus:ring-1 focus:ring-emerald-500">
            @error('reference')
                <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div>
        <label for="notes" class="mb-1.5 block text-sm font-semibold text-slate-700">Notes</label>
        <textarea name="notes"
                id="notes"
                rows="3"
                placeholder="Optional notes..."
                class="w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm text-slate-700 placeholder:text-slate-400 focus:border-emerald-500 focus:outline-none focus:ring-1 focus:ring-emerald-500">{{ old('notes', $stockIn->notes ?? '') }}</textarea>
        @error('notes')
            <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="flex items-center gap-3 pt-2">
        <button type="submit" class="rounded-lg bg-emerald-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2">
            {{ $buttonText }}
        </button>
        <a href="{{ route('stock-in.index') }}" class="rounded-lg border border-slate-300 bg-white px-5 py-2.5 text-sm font-medium text-slate-600 transition hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-slate-400 focus:ring-offset-2">
            Cancel
        </a>
    </div>
</div>