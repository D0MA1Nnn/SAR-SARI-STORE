<x-layouts.app :title="'Payments'">
    <div class="space-y-6">
        <!-- Header -->
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        </div>

        <!-- Summary Cards -->
        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
            <div class="rounded-lg bg-emerald-50 p-4 border border-emerald-100">
                <p class="text-xs font-semibold uppercase tracking-wider text-emerald-600">Total Payments</p>
                <p class="mt-1 text-2xl font-bold text-emerald-700">₱ {{ number_format($payments->sum('amount'), 2) }}</p>
            </div>
            <div class="rounded-lg bg-blue-50 p-4 border border-blue-100">
                <p class="text-xs font-semibold uppercase tracking-wider text-blue-600">Average Payment</p>
                <p class="mt-1 text-2xl font-bold text-blue-700">₱ {{ number_format($payments->avg('amount') ?? 0, 2) }}</p>
            </div>
            <div class="rounded-lg bg-purple-50 p-4 border border-purple-100">
                <p class="text-xs font-semibold uppercase tracking-wider text-purple-600">Total Transactions</p>
                <p class="mt-1 text-2xl font-bold text-purple-700">{{ $payments->total() }}</p>
            </div>
        </div>

        <!-- Search Bar and Add Button in One Row -->
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div class="flex-1">
                <form method="GET" class="flex flex-col gap-3 sm:flex-row sm:items-center">
                    <div class="flex-1">
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">
                                <i class="fa-solid fa-magnifying-glass text-xs"></i>
                            </span>
                            <input type="text"
                                    name="search"
                                    value="{{ $search }}"
                                    placeholder="Search by customer name..."
                                    class="w-full rounded-lg border border-slate-300 px-4 py-2.5 pl-10 text-sm text-slate-700 placeholder:text-slate-400 focus:border-emerald-500 focus:outline-none focus:ring-1 focus:ring-emerald-500">
                        </div>
                    </div>
                    <div class="flex gap-2">
                        <button type="submit" class="inline-flex items-center justify-center gap-2 rounded-lg bg-slate-700 px-5 py-2.5 text-sm font-medium text-white transition hover:bg-slate-800 focus:outline-none focus:ring-2 focus:ring-slate-500 focus:ring-offset-2">
                            <i class="fa-solid fa-magnifying-glass text-xs"></i>
                            Search
                        </button>
                        @if($search)
                            <a href="{{ route('payments.index') }}" class="inline-flex items-center justify-center gap-2 rounded-lg border border-slate-300 bg-white px-5 py-2.5 text-sm font-medium text-slate-600 transition hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-slate-400 focus:ring-offset-2">
                                <i class="fa-solid fa-xmark text-xs"></i>
                                Clear
                            </a>
                        @endif
                    </div>
                </form>
            </div>
            <a href="{{ route('payments.create') }}" class="inline-flex items-center justify-center gap-2 rounded-lg bg-emerald-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 sm:w-auto w-full">
                <i class="fa-solid fa-plus text-xs"></i>
                Add Payment
            </a>
        </div>

        <!-- Payments Table -->
        <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">
            <div class="border-b border-slate-200 bg-slate-50/80 px-6 py-3">
                <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">
                    {{ $payments->total() }} {{ Str::plural('payment', $payments->total()) }} found
                </p>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                        <tr class="border-b border-slate-100 bg-slate-50/50 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                            <th class="px-6 py-3">Payment Date</th>
                            <th class="px-6 py-3">Customer</th>
                            <th class="px-6 py-3">Payment Method</th>
                            <th class="px-6 py-3">Status</th>
                            <th class="px-6 py-3">Amount</th>
                            <th class="px-6 py-3 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm">
                        @forelse($payments as $payment)
                            <tr class="transition-colors hover:bg-slate-50/50">
                                <td class="px-6 py-4 text-slate-600">{{ optional($payment->payment_date)->format('M d, Y') ?? '—' }}</td>
                                <td class="px-6 py-4 font-medium text-slate-700">
                                    {{ $payment->customer ? trim($payment->customer->customer_firstname . ' ' . ($payment->customer->customer_middlename ?? '') . ' ' . $payment->customer->customer_lastname) : 'N/A' }}
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center gap-1 rounded-full bg-blue-50 px-2.5 py-0.5 text-xs font-medium text-blue-700">
                                        <i class="fa-regular fa-credit-card text-xs"></i>
                                        {{ $payment->paymentMethod?->description ?? 'N/A' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    @php
                                        $statusClass = match($payment->paymentStatus?->description) {
                                            'Paid', 'Completed' => 'bg-emerald-100 text-emerald-700',
                                            'Pending' => 'bg-yellow-100 text-yellow-700',
                                            'Failed', 'Cancelled' => 'bg-red-100 text-red-700',
                                            default => 'bg-slate-100 text-slate-600'
                                        };
                                    @endphp
                                    <span class="inline-flex rounded-full px-2.5 py-0.5 text-xs font-medium {{ $statusClass }}">
                                        {{ $payment->paymentStatus?->description ?? 'N/A' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 font-semibold text-emerald-700">₱ {{ number_format($payment->amount, 2) }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-end gap-4">
                                        <a href="{{ route('payments.show', $payment) }}" class="inline-flex items-center gap-1 text-sm font-medium text-emerald-600 transition hover:text-emerald-800">
                                            <i class="fa-regular fa-eye text-xs"></i>
                                            View
                                        </a>
                                        <a href="{{ route('payments.edit', $payment) }}" class="inline-flex items-center gap-1 text-sm font-medium text-blue-600 transition hover:text-blue-800">
                                            <i class="fa-regular fa-pen-to-square text-xs"></i>
                                            Edit
                                        </a>
                                        <form method="POST" action="{{ route('payments.destroy', $payment) }}" onsubmit="return confirm('Delete this payment? This action cannot be undone.')" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="inline-flex items-center gap-1 text-sm font-medium text-red-600 transition hover:text-red-800">
                                                <i class="fa-regular fa-trash-can text-xs"></i>
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center gap-2">
                                        <i class="fa-regular fa-credit-card text-3xl text-slate-300"></i>
                                        <p class="text-sm text-slate-400">No payment records found.</p>
                                        <a href="{{ route('payments.create') }}" class="mt-2 text-sm text-emerald-600 hover:text-emerald-700">Record your first payment →</a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $payments->withQueryString()->links() }}
        </div>
    </div>
</x-layouts.app>