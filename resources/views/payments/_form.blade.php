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
                    <option value="{{ $customer->id }}" @selected(old('customer_id', $payment->customer_id ?? '') == $customer->id)>
                        {{ trim($customer->customer_firstname . ' ' . ($customer->customer_middlename ?? '') . ' ' . $customer->customer_lastname) }}
                    </option>
                @endforeach
            </select>
            @error('customer_id')
                <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="amount" class="mb-1.5 block text-sm font-semibold text-slate-700">Amount (PHP)</label>
            <div class="relative">
                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">₱</span>
                <input type="number"
                        step="0.01"
                        name="amount"
                        id="amount"
                        value="{{ old('amount', $payment->amount ?? '') }}"
                        placeholder="0.00"
                        class="w-full rounded-lg border border-slate-300 px-4 py-2.5 pl-8 text-sm text-slate-700 placeholder:text-slate-400 focus:border-emerald-500 focus:outline-none focus:ring-1 focus:ring-emerald-500">
            </div>
            @error('amount')
                <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="payment_method_id" class="mb-1.5 block text-sm font-semibold text-slate-700">Payment Method</label>
            <select name="payment_method_id" 
                    id="payment_method_id"
                    class="w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm text-slate-700 focus:border-emerald-500 focus:outline-none focus:ring-1 focus:ring-emerald-500">
                <option value="">Select payment method</option>
                @foreach($paymentMethods as $method)
                    <option value="{{ $method->id }}" @selected(old('payment_method_id', $payment->payment_method_id ?? '') == $method->id)>
                        {{ $method->description }}
                    </option>
                @endforeach
            </select>
            @error('payment_method_id')
                <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="payment_status_id" class="mb-1.5 block text-sm font-semibold text-slate-700">Payment Status</label>
            <select name="payment_status_id" 
                    id="payment_status_id"
                    class="w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm text-slate-700 focus:border-emerald-500 focus:outline-none focus:ring-1 focus:ring-emerald-500">
                <option value="">Select status</option>
                @foreach($statuses as $status)
                    <option value="{{ $status->id }}" @selected(old('payment_status_id', $payment->payment_status_id ?? '') == $status->id)>
                        {{ $status->description }}
                    </option>
                @endforeach
            </select>
            @error('payment_status_id')
                <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="payment_date" class="mb-1.5 block text-sm font-semibold text-slate-700">Payment Date</label>
            <div class="relative">
                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">
                    <i class="fa-regular fa-calendar text-xs"></i>
                </span>
                <input type="date"
                        name="payment_date"
                        id="payment_date"
                        value="{{ old('payment_date', isset($payment) ? optional($payment->payment_date)->format('Y-m-d') : now()->toDateString()) }}" 
                        class="w-full rounded-lg border border-slate-300 px-4 py-2.5 pl-10 text-sm text-slate-700 focus:border-emerald-500 focus:outline-none focus:ring-1 focus:ring-emerald-500">
            </div>
            @error('payment_date')
                <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="flex items-center gap-3 pt-4 border-t border-slate-200">
        <button type="submit" class="rounded-lg bg-emerald-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2">
            {{ $buttonText }}
        </button>
        <a href="{{ route('payments.index') }}" class="rounded-lg border border-slate-300 bg-white px-5 py-2.5 text-sm font-medium text-slate-600 transition hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-slate-400 focus:ring-offset-2">
            Cancel
        </a>
    </div>
</div>