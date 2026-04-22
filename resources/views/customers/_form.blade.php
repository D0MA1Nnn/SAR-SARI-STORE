@csrf
<div class="space-y-6">
    <div>
        <label for="customer_name" class="mb-1.5 block text-sm font-semibold text-slate-700">Customer Name</label>
        <input type="text"
                name="customer_name"
                id="customer_name"
                value="{{ old('customer_name', $customer->customer_name ?? '') }}"
                placeholder="Enter full name..."
                class="w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm text-slate-700 placeholder:text-slate-400 focus:border-emerald-500 focus:outline-none focus:ring-1 focus:ring-emerald-500">
        @error('customer_name')
            <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="contact_number" class="mb-1.5 block text-sm font-semibold text-slate-700">Contact Number</label>
        <div class="relative">
            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">
                <i class="fa-solid fa-phone text-xs"></i>
            </span>
            <input type="text"
                    name="contact_number"
                    id="contact_number"
                    value="{{ old('contact_number', $customer->contact_number ?? '') }}"
                    placeholder="0912 345 6789"
                    class="w-full rounded-lg border border-slate-300 px-4 py-2.5 pl-10 text-sm text-slate-700 placeholder:text-slate-400 focus:border-emerald-500 focus:outline-none focus:ring-1 focus:ring-emerald-500">
        </div>
        @error('contact_number')
            <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="collateral_type_id" class="mb-1.5 block text-sm font-semibold text-slate-700">Collateral Type</label>
        <select name="collateral_type_id" 
                id="collateral_type_id"
                class="w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm text-slate-700 focus:border-emerald-500 focus:outline-none focus:ring-1 focus:ring-emerald-500">
            <option value="">Select collateral type</option>
            @foreach($collateralTypes as $type)
                <option value="{{ $type->id }}" @selected(old('collateral_type_id', $customer->collateral_type_id ?? '') == $type->id)>
                    {{ $type->description }}
                </option>
            @endforeach
        </select>
        @error('collateral_type_id')
            <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="flex items-center gap-3 pt-2">
        <button type="submit" class="rounded-lg bg-emerald-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2">
            {{ $buttonText }}
        </button>
        <a href="{{ route('customers.index') }}" class="rounded-lg border border-slate-300 bg-white px-5 py-2.5 text-sm font-medium text-slate-600 transition hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-slate-400 focus:ring-offset-2">
            Cancel
        </a>
    </div>
</div>