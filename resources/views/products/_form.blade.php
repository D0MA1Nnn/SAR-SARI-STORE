@csrf
<div class="space-y-6">
    {{-- Product Name - REQUIRED --}}
    <div>
        <label for="name" class="mb-1.5 block text-sm font-semibold text-slate-700">Product Name</label>
        <input type="text"
                name="name"
                id="name"
                value="{{ old('name', $product->name ?? '') }}"
                placeholder="Enter product name..."
                class="w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm text-slate-700 placeholder:text-slate-400 focus:border-emerald-500 focus:outline-none focus:ring-1 focus:ring-emerald-500">
        @error('name')
            <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    {{-- Category - REQUIRED --}}
    <div>
        <label for="category_id" class="mb-1.5 block text-sm font-semibold text-slate-700">Category</label>
        <select name="category_id"
                id="category_id"
                class="w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm text-slate-700 focus:border-emerald-500 focus:outline-none focus:ring-1 focus:ring-emerald-500">
            <option value="">Select a category</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" @selected(old('category_id', $product->category_id ?? '') == $category->id)>
                    {{ $category->description }}
                </option>
            @endforeach
        </select>
        @error('category_id')
            <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    {{-- Price & Markup - Two columns --}}
    <div class="grid gap-6 md:grid-cols-2">
        <div>
            <label for="current_price" class="mb-1.5 block text-sm font-semibold text-slate-700">Selling Price (PHP)</label>
            <div class="relative">
                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">₱</span>
                <input type="number"
                        step="0.01"
                        name="current_price"
                        id="current_price"
                        value="{{ old('current_price', $product->current_price ?? '') }}"
                        placeholder="0.00"
                        class="w-full rounded-lg border border-slate-300 px-4 py-2.5 pl-8 text-sm text-slate-700 placeholder:text-slate-400 focus:border-emerald-500 focus:outline-none focus:ring-1 focus:ring-emerald-500">
            </div>
            @error('current_price')
                <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="markup_percent" class="mb-1.5 block text-sm font-semibold text-slate-700">Markup Percentage (%)</label>
            <div class="relative">
                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">%</span>
                <input type="number"
                        step="0.01"
                        name="markup_percent"
                        id="markup_percent"
                        value="{{ old('markup_percent', $product->markup_percent ?? 20) }}"
                        placeholder="20"
                        class="w-full rounded-lg border border-slate-300 px-4 py-2.5 pl-8 text-sm text-slate-700 placeholder:text-slate-400 focus:border-emerald-500 focus:outline-none focus:ring-1 focus:ring-emerald-500">
            </div>
            <p class="mt-1 text-xs text-slate-500">Used to auto-calculate selling price when stocking in with new cost</p>
            @error('markup_percent')
                <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
    </div>

    {{-- Stock & Status - Two columns --}}
    <div class="grid gap-6 md:grid-cols-2">
        <div>
            <label for="stock" class="mb-1.5 block text-sm font-semibold text-slate-700">Initial Stock</label>
            <input type="number"
                    min="0"
                    name="stock"
                    id="stock"
                    value="{{ old('stock', $product->stock ?? 0) }}"
                    placeholder="0"
                    class="w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm text-slate-700 placeholder:text-slate-400 focus:border-emerald-500 focus:outline-none focus:ring-1 focus:ring-emerald-500">
            @error('stock')
                <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="is_active" class="mb-1.5 block text-sm font-semibold text-slate-700">Status</label>
            <select name="is_active"
                    id="is_active"
                    class="w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm text-slate-700 focus:border-emerald-500 focus:outline-none focus:ring-1 focus:ring-emerald-500">
                <option value="1" @selected(old('is_active', $product->is_active ?? true))>Active</option>
                <option value="0" @selected(!old('is_active', $product->is_active ?? true))>Inactive</option>
            </select>
            @error('is_active')
                <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
    </div>

    {{-- Form Actions --}}
    <div class="flex items-center gap-3 pt-2">
        <button type="submit" class="rounded-lg bg-emerald-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2">
            {{ $buttonText }}
        </button>
        <a href="{{ route('products.index') }}" class="rounded-lg border border-slate-300 bg-white px-5 py-2.5 text-sm font-medium text-slate-600 transition hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-slate-400 focus:ring-offset-2">
            Cancel
        </a>
    </div>
</div>