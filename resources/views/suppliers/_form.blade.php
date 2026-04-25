@csrf
<div class="space-y-6">
    <div class="grid gap-6 md:grid-cols-2">
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
            <label for="contact_person" class="mb-1.5 block text-sm font-semibold text-slate-700">Contact Person</label>
            <input type="text"
                    name="contact_person"
                    id="contact_person"
                    value="{{ old('contact_person', $supplier->contact_person ?? '') }}"
                    placeholder="Enter contact person name..."
                    class="w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm text-slate-700 placeholder:text-slate-400 focus:border-emerald-500 focus:outline-none focus:ring-1 focus:ring-emerald-500">
            @error('contact_person')
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

        <div>
            <label for="email" class="mb-1.5 block text-sm font-semibold text-slate-700">Email Address</label>
            <input type="email"
                    name="email"
                    id="email"
                    value="{{ old('email', $supplier->email ?? '') }}"
                    placeholder="supplier@example.com"
                    class="w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm text-slate-700 placeholder:text-slate-400 focus:border-emerald-500 focus:outline-none focus:ring-1 focus:ring-emerald-500">
            @error('email')
                <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="md:col-span-2">
            <label for="address" class="mb-1.5 block text-sm font-semibold text-slate-700">Address</label>
            <textarea name="address"
                    id="address"
                    rows="2"
                    placeholder="Enter supplier address..."
                    class="w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm text-slate-700 placeholder:text-slate-400 focus:border-emerald-500 focus:outline-none focus:ring-1 focus:ring-emerald-500">{{ old('address', $supplier->address ?? '') }}</textarea>
            @error('address')
                <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
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