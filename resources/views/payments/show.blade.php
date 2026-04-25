<x-layouts.app :title="'Payment Details'">
    <div class="mx-auto max-w-2xl">
        <div class="mb-6">
            <h1 class="text-2xl font-bold tracking-tight text-slate-800">Payment Details</h1>
            <p class="mt-1 text-sm text-slate-500">View complete payment information.</p>
        </div>

        <div class="rounded-xl border border-slate-200 bg-white shadow-sm">
            <div class="border-b border-slate-200 bg-gradient-to-r from-emerald-50 to-white p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Payment Reference</p>
                        <p class="mt-1 font-mono text-sm font-semibold text-slate-800">#{{ $payment->id }}</p>
                    </div>
                    @php
                        $statusClass = match($payment->paymentStatus?->description) {
                            'Paid', 'Completed' => 'bg-emerald-100 text-emerald-700',
                            'Pending' => 'bg-yellow-100 text-yellow-700',
                            'Failed', 'Cancelled' => 'bg-red-100 text-red-700',
                            default => 'bg-slate-100 text-slate-600'
                        };
                    @endphp
                    <span class="inline-flex rounded-full px-3 py-1 text-xs font-semibold {{ $statusClass }}">
                        {{ $payment->paymentStatus?->description ?? 'N/A' }}
                    </span>
                </div>
            </div>

            <div class="p-6 space-y-4">
                <div class="grid gap-4 sm:grid-cols-2">
                    <div class="flex items-start gap-3">
                        <div class="rounded-lg bg-slate-100 p-2">
                            <i class="fa-regular fa-user text-slate-500"></i>
                        </div>
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Customer</p>
                            <p class="mt-0.5 text-base font-semibold text-slate-800">
                                {{ $payment->customer ? trim($payment->customer->customer_firstname . ' ' . ($payment->customer->customer_middlename ?? '') . ' ' . $payment->customer->customer_lastname) : 'N/A' }}
                            </p>
                        </div>
                    </div>

                    <div class="flex items-start gap-3">
                        <div class="rounded-lg bg-slate-100 p-2">
                            <i class="fa-regular fa-calendar text-slate-500"></i>
                        </div>
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Payment Date</p>
                            <p class="mt-0.5 text-base font-semibold text-slate-800">{{ optional($payment->payment_date)->format('F d, Y') ?? '—' }}</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-3">
                        <div class="rounded-lg bg-slate-100 p-2">
                            <i class="fa-regular fa-credit-card text-slate-500"></i>
                        </div>
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Payment Method</p>
                            <p class="mt-0.5 text-base font-semibold text-slate-800">{{ $payment->paymentMethod?->description ?? 'N/A' }}</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-3">
                        <div class="rounded-lg bg-emerald-100 p-2">
                            <i class="fa-solid fa-currency-sign text-emerald-600"></i>
                        </div>
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Amount</p>
                            <p class="mt-0.5 text-2xl font-bold text-emerald-700">₱ {{ number_format($payment->amount, 2) }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex items-center gap-3 border-t border-slate-200 px-6 py-4">
                <a href="{{ route('payments.edit', $payment) }}" class="inline-flex items-center gap-2 rounded-lg bg-emerald-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-emerald-700">
                    <i class="fa-regular fa-pen-to-square text-xs"></i>
                    Edit Payment
                </a>
                <a href="{{ route('payments.index') }}" class="inline-flex items-center gap-2 rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-sm font-medium text-slate-600 transition hover:bg-slate-50">
                    <i class="fa-solid fa-arrow-left text-xs"></i>
                    Back to List
                </a>
            </div>
        </div>
    </div>
</x-layouts.app>