@csrf
<div class="space-y-6">
    <div class="grid gap-6 md:grid-cols-2">
        <div>
            <label for="customer_firstname" class="mb-1.5 block text-sm font-semibold text-slate-700">
                First Name <span class="text-red-500">*</span>
            </label>
            <input type="text"
                    name="customer_firstname"
                    id="customer_firstname"
                    value="{{ old('customer_firstname', $customer->customer_firstname ?? '') }}"
                    placeholder="Enter first name..."
                    class="w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm text-slate-700 placeholder:text-slate-400 focus:border-emerald-500 focus:outline-none focus:ring-1 focus:ring-emerald-500"
                    required>
            @error('customer_firstname')
                <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="customer_middlename" class="mb-1.5 block text-sm font-semibold text-slate-700">
                Middle Name <span class="text-slate-400 text-xs">(Optional)</span>
            </label>
            <input type="text"
                    name="customer_middlename"
                    id="customer_middlename"
                    value="{{ old('customer_middlename', $customer->customer_middlename ?? '') }}"
                    placeholder="Enter middle name..."
                    class="w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm text-slate-700 placeholder:text-slate-400 focus:border-emerald-500 focus:outline-none focus:ring-1 focus:ring-emerald-500">
            @error('customer_middlename')
                <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="customer_lastname" class="mb-1.5 block text-sm font-semibold text-slate-700">
                Last Name <span class="text-red-500">*</span>
            </label>
            <input type="text"
                    name="customer_lastname"
                    id="customer_lastname"
                    value="{{ old('customer_lastname', $customer->customer_lastname ?? '') }}"
                    placeholder="Enter last name..."
                    class="w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm text-slate-700 placeholder:text-slate-400 focus:border-emerald-500 focus:outline-none focus:ring-1 focus:ring-emerald-500"
                    required>
            @error('customer_lastname')
                <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="contact_number" class="mb-1.5 block text-sm font-semibold text-slate-700">
                Contact Number <span class="text-slate-400 text-xs">(Optional)</span>
            </label>
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

        <div class="md:col-span-2">
            <label for="collateral_type_id" class="mb-1.5 block text-sm font-semibold text-slate-700">
                Collateral Type <span class="text-slate-400 text-xs">(Optional)</span>
            </label>
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