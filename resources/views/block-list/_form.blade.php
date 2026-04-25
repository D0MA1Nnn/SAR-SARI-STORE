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
                    <option value="{{ $customer->id }}" @selected(old('customer_id', $blockList->customer_id ?? null) == $customer->id)>
                        {{ trim($customer->customer_firstname . ' ' . ($customer->customer_middlename ?? '') . ' ' . $customer->customer_lastname) }}
                    </option>
                @endforeach
            </select>
            @error('customer_id')
                <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="violation_id" class="mb-1.5 block text-sm font-semibold text-slate-700">Violation Type</label>
            <select name="violation_id"
                    id="violation_id"
                    class="w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm text-slate-700 focus:border-emerald-500 focus:outline-none focus:ring-1 focus:ring-emerald-500">
                <option value="">Select a violation</option>
                @foreach($violations as $violation)
                    <option value="{{ $violation->id }}" @selected(old('violation_id', $blockList->violation_id ?? null) == $violation->id)>
                        {{ $violation->description }}
                    </option>
                @endforeach
            </select>
            @error('violation_id')
                <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="flex items-center justify-end gap-3 pt-4 border-t border-slate-200">
        <a href="{{ route('block-list.index') }}" class="rounded-lg border border-slate-300 bg-white px-5 py-2.5 text-sm font-medium text-slate-600 transition hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-slate-400 focus:ring-offset-2">
            Cancel
        </a>
        <button type="submit" class="rounded-lg bg-emerald-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2">
            {{ $buttonText }}
        </button>
    </div>
</div>