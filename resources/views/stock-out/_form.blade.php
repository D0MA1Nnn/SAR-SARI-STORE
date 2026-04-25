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
                    <option value="{{ $product->id }}" @selected(old('product_id', $stockOut->product_id ?? '') == $product->id)>
                        {{ $product->name }} (Stock: {{ $product->stock ?? 0 }})
                    </option>
                @endforeach
            </select>
            @error('product_id')
                <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="quantity" class="mb-1.5 block text-sm font-semibold text-slate-700">Quantity</label>
            <input type="number"
                    min="1"
                    name="quantity"
                    id="quantity"
                    value="{{ old('quantity', $stockOut->quantity ?? 1) }}"
                    placeholder="0"
                    class="w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm text-slate-700 placeholder:text-slate-400 focus:border-emerald-500 focus:outline-none focus:ring-1 focus:ring-emerald-500">
            @error('quantity')
                <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="reason" class="mb-1.5 block text-sm font-semibold text-slate-700">Reason</label>
            <input type="text"
                    name="reason"
                    id="reason"
                    value="{{ old('reason', $stockOut->reason ?? '') }}"
                    placeholder="Damaged, expired, lost, etc."
                    class="w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm text-slate-700 placeholder:text-slate-400 focus:border-emerald-500 focus:outline-none focus:ring-1 focus:ring-emerald-500">
            @error('reason')
                <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="stock_date" class="mb-1.5 block text-sm font-semibold text-slate-700">Date & Time</label>
            <input type="datetime-local"
                    name="stock_date"
                    id="stock_date"
                    value="{{ old('stock_date', isset($stockOut) ? optional($stockOut->stock_date)->format('Y-m-d\TH:i') : now()->format('Y-m-d\TH:i')) }}"
                    class="w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm text-slate-700 focus:border-emerald-500 focus:outline-none focus:ring-1 focus:ring-emerald-500">
            @error('stock_date')
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
                class="w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm text-slate-700 placeholder:text-slate-400 focus:border-emerald-500 focus:outline-none focus:ring-1 focus:ring-emerald-500">{{ old('notes', $stockOut->notes ?? '') }}</textarea>
        @error('notes')
            <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="flex items-center gap-3 pt-2">
        <button type="submit" class="rounded-lg bg-emerald-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2">
            {{ $buttonText }}
        </button>
        <a href="{{ route('stock-out.index') }}" class="rounded-lg border border-slate-300 bg-white px-5 py-2.5 text-sm font-medium text-slate-600 transition hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-slate-400 focus:ring-offset-2">
            Cancel
        </a>
    </div>
</div>
