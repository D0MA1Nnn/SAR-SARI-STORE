<x-layouts.app :title="'Customer Details'">
    <div class="mx-auto max-w-2xl">
        <div class="mb-6">
            <h1 class="text-2xl font-bold tracking-tight text-slate-800">Customer Details</h1>
            <p class="mt-1 text-sm text-slate-500">View and manage customer information.</p>
        </div>

        <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="space-y-4">
                <div class="flex items-start gap-3 border-b border-slate-100 pb-4">
                    <div class="rounded-lg bg-emerald-50 p-2">
                        <i class="fa-regular fa-user text-emerald-600"></i>
                    </div>
                    <div class="flex-1">
                        <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Customer Name</p>
                        <p class="mt-0.5 text-base font-semibold text-slate-800">{{ $customer->customer_name }}</p>
                    </div>
                </div>

                <div class="flex items-start gap-3 border-b border-slate-100 pb-4">
                    <div class="rounded-lg bg-blue-50 p-2">
                        <i class="fa-solid fa-phone text-blue-600"></i>
                    </div>
                    <div class="flex-1">
                        <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Contact Number</p>
                        <p class="mt-0.5 text-sm text-slate-700">{{ $customer->contact_number ?? 'Not provided' }}</p>
                    </div>
                </div>

                <div class="flex items-start gap-3">
                    <div class="rounded-lg bg-amber-50 p-2">
                        <i class="fa-solid fa-gem text-amber-600"></i>
                    </div>
                    <div class="flex-1">
                        <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Collateral Type</p>
                        <p class="mt-0.5 text-sm text-slate-700">
                            @if($customer->collateralType)
                                <span class="inline-flex rounded-full bg-amber-50 px-2.5 py-0.5 text-xs font-medium text-amber-700">
                                    {{ $customer->collateralType->description }}
                                </span>
                            @else
                                <span class="text-slate-400">No collateral assigned</span>
                            @endif
                        </p>
                    </div>
                </div>
            </div>

            <div class="mt-6 flex items-center gap-3 pt-4 border-t border-slate-100">
                <a href="{{ route('customers.edit', $customer) }}" class="inline-flex items-center gap-2 rounded-lg bg-emerald-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-emerald-700">
                    <i class="fa-regular fa-pen-to-square text-xs"></i>
                    Edit Customer
                </a>
                <a href="{{ route('customers.index') }}" class="inline-flex items-center gap-2 rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-sm font-medium text-slate-600 transition hover:bg-slate-50">
                    <i class="fa-solid fa-arrow-left text-xs"></i>
                    Back to List
                </a>
            </div>
        </div>
    </div>
</x-layouts.app>