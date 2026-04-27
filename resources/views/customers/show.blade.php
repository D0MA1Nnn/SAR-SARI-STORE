<x-layouts.app :title="'Customer Details'">
    <div class="mx-auto max-w-2xl">
        <div class="mb-6">
            <h1 class="text-2xl font-bold tracking-tight text-slate-800">Customer Details</h1>
            <p class="mt-1 text-sm text-slate-500">View complete customer information.</p>
        </div>

        <div class="rounded-xl border border-slate-200 bg-white shadow-sm">
            <div class="border-b border-slate-200 bg-gradient-to-r from-emerald-50 to-white p-6">
                <div class="flex items-center gap-3">
                    <div class="rounded-full bg-emerald-100 p-2">
                        <i class="fa-regular fa-user text-emerald-600"></i>
                    </div>
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Customer Profile</p>
                        <p class="mt-0.5 font-mono text-sm font-semibold text-slate-800">#{{ $customer->id }}</p>
                    </div>
                </div>
            </div>

            <div class="p-6 space-y-4">
                <div class="grid gap-4 sm:grid-cols-2">
                    <div class="flex items-start gap-3 border-b border-slate-100 pb-4">
                        <div class="rounded-lg bg-slate-100 p-2">
                            <i class="fa-regular fa-user text-slate-500"></i>
                        </div>
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">First Name</p>
                            <p class="mt-0.5 text-base font-semibold text-slate-800">{{ $customer->customer_firstname }}</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-3 border-b border-slate-100 pb-4">
                        <div class="rounded-lg bg-slate-100 p-2">
                            <i class="fa-regular fa-user text-slate-500"></i>
                        </div>
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Middle Name</p>
                            <p class="mt-0.5 text-base text-slate-700">{{ $customer->customer_middlename ?? 'Not provided' }}</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-3 border-b border-slate-100 pb-4">
                        <div class="rounded-lg bg-slate-100 p-2">
                            <i class="fa-regular fa-user text-slate-500"></i>
                        </div>
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Last Name</p>
                            <p class="mt-0.5 text-base font-semibold text-slate-800">{{ $customer->customer_lastname }}</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-3 border-b border-slate-100 pb-4">
                        <div class="rounded-lg bg-blue-50 p-2">
                            <i class="fa-solid fa-phone text-blue-600"></i>
                        </div>
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Contact Number</p>
                            <p class="mt-0.5 text-sm text-slate-700">{{ $customer->contact_number ?? 'Not provided' }}</p>
                        </div>
                    </div>
                </div>

                <div class="flex items-start gap-3 pt-2">
                    <div class="rounded-lg bg-amber-50 p-2">
                        <i class="fa-solid fa-gem text-amber-600"></i>
                    </div>
                    <div>
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

            <div class="flex items-center gap-3 border-t border-slate-200 px-6 py-4">
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