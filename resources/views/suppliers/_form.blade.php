@csrf
<div class="space-y-6">
    <div>
        <label for="supplier_name" class="mb-1.5 block text-sm font-semibold text-slate-700">Supplier Name</label>
        <input type="text"
                name="supplier_name"
                id="supplier_name"
                value="{{ old('supplier_name', $supplier->supplier_name ?? '') }}"
                placeholder="Enter supplier name..."
                class="w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm text-slate-700 placeholder:text-slate-400 focus:border-emerald-500 focus:outline-none focus:ring-1 focus:ring-emerald-500">
        @error('supplier_name')
            <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="contact_number" class="mb-1.5 block text-sm font-semibold text-slate-700">Contact Number</label>
        <input type="text"
                name="contact_number"
                id="contact_number"
                value="{{ old('contact_number', $supplier->contact_number ?? '') }}"
                placeholder="0912 345 6789"
                class="w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm text-slate-700 placeholder:text-slate-400 focus:border-emerald-500 focus:outline-none focus:ring-1 focus:ring-emerald-500">
        @error('contact_number')
            <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="flex items-center gap-3 pt-2">
        <button type="submit" class="rounded-lg bg-emerald-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2">
            {{ $buttonText }}
        </button>
        <a href="{{ route('suppliers.index') }}" class="rounded-lg border border-slate-300 bg-white px-5 py-2.5 text-sm font-medium text-slate-600 transition hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-slate-400 focus:ring-offset-2">
            Cancel
        </a>
    </div>
</div>
