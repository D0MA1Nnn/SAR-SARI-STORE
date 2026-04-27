<x-layouts.app :title="'Customers'">
    <div class="space-y-6">
        <!-- Single Row Header with Stats Card, Search, and Add Button -->
        <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
            <!-- Total Customers Card - Compact -->
            <div class="flex items-center gap-4 rounded-xl bg-white px-5 py-3 shadow-sm ring-1 ring-slate-200">
                <div class="rounded-lg bg-emerald-50 p-2">
                    <i class="fa-solid fa-users text-emerald-500 text-lg"></i>
                </div>
                <div>
                    <p class="text-xs font-medium uppercase tracking-wider text-slate-400">Total Customers</p>
                    <p class="text-2xl font-bold text-slate-800">{{ $customers->total() }}</p>
                </div>
            </div>

            <!-- Search and Add Button Group - Close together -->
            <div class="flex items-center gap-2">
                <!-- Search Form -->
                <form method="GET" class="flex gap-2">
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">
                            <i class="fa-solid fa-magnifying-glass text-xs"></i>
                        </span>
                        <input type="text"
                                name="search"
                                value="{{ $search }}"
                                placeholder="Search customers..."
                                class="w-64 rounded-lg border border-slate-300 px-4 py-2.5 pl-10 text-sm text-slate-700 placeholder:text-slate-400 focus:border-emerald-500 focus:outline-none focus:ring-1 focus:ring-emerald-500">
                    </div>
                    <button type="submit" class="inline-flex items-center justify-center gap-2 rounded-lg bg-slate-700 px-4 py-2.5 text-sm font-medium text-white transition hover:bg-slate-800">
                        <i class="fa-solid fa-magnifying-glass text-xs"></i>
                        Search
                    </button>
                    @if($search)
                        <a href="{{ route('customers.index') }}" class="inline-flex items-center justify-center gap-2 rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-sm font-medium text-slate-600 transition hover:bg-slate-50">
                            <i class="fa-solid fa-xmark text-xs"></i>
                            Clear
                        </a>
                    @endif
                </form>

                <!-- Add Button - Directly next to search -->
                <a href="{{ route('customers.create') }}" class="inline-flex items-center justify-center gap-2 rounded-lg bg-emerald-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2">
                    <i class="fa-solid fa-plus text-xs"></i>
                    Add Customer
                </a>
            </div>
        </div>

        <!-- Customers Table -->
        <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">
            <div class="border-b border-slate-200 bg-slate-50/80 px-6 py-3">
                <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">
                    {{ $customers->total() }} {{ Str::plural('customer', $customers->total()) }} found
                </p>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                        <tr class="border-b border-slate-100 bg-slate-50/50 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                            <th class="px-4 py-3">First Name</th>
                            <th class="px-4 py-3">Middle Name</th>
                            <th class="px-4 py-3">Last Name</th>
                            <th class="px-4 py-3">Contact Number</th>
                            <th class="px-4 py-3">Collateral Type</th>
                            <th class="px-4 py-3 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm">
                        @forelse($customers as $customer)
                            <tr class="transition-colors hover:bg-slate-50/50">
                                <td class="px-4 py-3 font-medium text-slate-700">{{ $customer->customer_firstname }}</td>
                                <td class="px-4 py-3 text-slate-600">{{ $customer->customer_middlename ?? '—' }}</td>
                                <td class="px-4 py-3 font-medium text-slate-700">{{ $customer->customer_lastname }}</td>
                                <td class="px-4 py-3 text-slate-600">{{ $customer->contact_number ?? '—' }}</td>
                                <td class="px-4 py-3">
                                    @if($customer->collateralType)
                                        <span class="inline-flex rounded-full bg-amber-50 px-2.5 py-0.5 text-xs font-medium text-amber-700">
                                            <i class="fa-solid fa-gem mr-1 text-xs"></i>
                                            {{ $customer->collateralType->description }}
                                        </span>
                                    @else
                                        <span class="text-slate-400">—</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center justify-center gap-3">
                                        <a href="{{ route('customers.show', $customer) }}" 
                                           class="inline-flex items-center gap-1 rounded-md bg-emerald-50 px-2.5 py-1.5 text-xs font-medium text-emerald-600 transition hover:bg-emerald-100 hover:text-emerald-700"
                                           title="View Customer">
                                            <i class="fa-regular fa-eye text-xs"></i>
                                            View
                                        </a>
                                        <a href="{{ route('customers.edit', $customer) }}" 
                                           class="inline-flex items-center gap-1 rounded-md bg-blue-50 px-2.5 py-1.5 text-xs font-medium text-blue-600 transition hover:bg-blue-100 hover:text-blue-700"
                                           title="Edit Customer">
                                            <i class="fa-regular fa-pen-to-square text-xs"></i>
                                            Edit
                                        </a>
                                        <form method="POST" action="{{ route('customers.destroy', $customer) }}" 
                                              onsubmit="return confirm('Delete this customer? This action cannot be undone.')" 
                                              class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="inline-flex items-center gap-1 rounded-md bg-red-50 px-2.5 py-1.5 text-xs font-medium text-red-600 transition hover:bg-red-100 hover:text-red-700"
                                                    title="Delete Customer">
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
                                        <i class="fa-regular fa-users text-3xl text-slate-300"></i>
                                        <p class="text-sm text-slate-400">No customers found.</p>
                                        <a href="{{ route('customers.create') }}" class="mt-2 text-sm text-emerald-600 hover:text-emerald-700">Add your first customer →</a>
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
            {{ $customers->withQueryString()->links() }}
        </div>
    </div>
</x-layouts.app>