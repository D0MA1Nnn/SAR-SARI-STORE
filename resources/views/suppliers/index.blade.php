<x-layouts.app :title="'Suppliers'">
    <div class="space-y-6">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div class="flex-1">
                <form method="GET" class="flex flex-col gap-3 sm:flex-row sm:items-center">
                    <div class="flex-1">
                        <input type="text"
                                name="search"
                                value="{{ $search }}"
                                placeholder="Search supplier name..."
                                class="w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm text-slate-700 placeholder:text-slate-400 focus:border-emerald-500 focus:outline-none focus:ring-1 focus:ring-emerald-500">
                    </div>
                    <div class="flex gap-2">
                        <button type="submit" class="inline-flex items-center justify-center gap-2 rounded-lg bg-slate-700 px-5 py-2.5 text-sm font-medium text-white transition hover:bg-slate-800 focus:outline-none focus:ring-2 focus:ring-slate-500 focus:ring-offset-2">
                            <i class="fa-solid fa-magnifying-glass text-xs"></i>
                            Search
                        </button>
                        @if($search)
                            <a href="{{ route('suppliers.index') }}" class="inline-flex items-center justify-center gap-2 rounded-lg border border-slate-300 bg-white px-5 py-2.5 text-sm font-medium text-slate-600 transition hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-slate-400 focus:ring-offset-2">
                                <i class="fa-solid fa-xmark text-xs"></i>
                                Clear
                            </a>
                        @endif
                    </div>
                </form>
            </div>
            <a href="{{ route('suppliers.create') }}" class="inline-flex items-center justify-center gap-2 rounded-lg bg-emerald-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 sm:w-auto w-full">
                <i class="fa-solid fa-plus text-xs"></i>
                Add Supplier
            </a>
        </div>

        <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">
            <div class="border-b border-slate-200 bg-slate-50/80 px-6 py-3">
                <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">
                    {{ $suppliers->total() }} {{ Str::plural('supplier', $suppliers->total()) }} found
                </p>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                        <tr class="border-b border-slate-100 bg-slate-50/50 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                            <th class="px-6 py-3">Supplier</th>
                            <th class="px-6 py-3">Contact</th>
                            <th class="px-6 py-3 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm">
                        @forelse($suppliers as $supplier)
                            <tr class="transition-colors hover:bg-slate-50/50">
                                <td class="px-6 py-4 font-medium text-slate-700">{{ $supplier->supplier_name }}</td>
                                <td class="px-6 py-4 text-slate-600">{{ $supplier->contact_number ?? '—' }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-end gap-4">
                                        <a href="{{ route('suppliers.show', $supplier) }}" class="inline-flex items-center gap-1 text-sm font-medium text-emerald-600 transition hover:text-emerald-800">
                                            <i class="fa-regular fa-eye text-xs"></i>
                                            View
                                        </a>
                                        <a href="{{ route('suppliers.edit', $supplier) }}" class="inline-flex items-center gap-1 text-sm font-medium text-blue-600 transition hover:text-blue-800">
                                            <i class="fa-regular fa-pen-to-square text-xs"></i>
                                            Edit
                                        </a>
                                        <form method="POST" action="{{ route('suppliers.destroy', $supplier) }}" onsubmit="return confirm('Delete this supplier? This action cannot be undone.');" class="inline">
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
                                <td colspan="3" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center gap-2">
                                        <i class="fa-regular fa-building text-3xl text-slate-300"></i>
                                        <p class="text-sm text-slate-400">No suppliers found.</p>
                                        <a href="{{ route('suppliers.create') }}" class="mt-2 text-sm text-emerald-600 hover:text-emerald-700">Add your first supplier →</a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-4">
            {{ $suppliers->withQueryString()->links() }}
        </div>
    </div>
</x-layouts.app>
