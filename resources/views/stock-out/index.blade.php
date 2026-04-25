<x-layouts.app :title="'Stock Out'">
    <div class="space-y-6">
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
                                    placeholder="Search product or reason..."
                                    class="w-full rounded-lg border border-slate-300 px-4 py-2.5 pl-10 text-sm text-slate-700 placeholder:text-slate-400 focus:border-emerald-500 focus:outline-none focus:ring-1 focus:ring-emerald-500">
                        </div>
                    </div>
                    <div class="flex gap-2">
                        <button type="submit" class="inline-flex items-center justify-center gap-2 rounded-lg bg-slate-700 px-5 py-2.5 text-sm font-medium text-white transition hover:bg-slate-800 focus:outline-none focus:ring-2 focus:ring-slate-500 focus:ring-offset-2">
                            <i class="fa-solid fa-magnifying-glass text-xs"></i>
                            Search
                        </button>
                        @if($search)
                            <a href="{{ route('stock-out.index') }}" class="inline-flex items-center justify-center gap-2 rounded-lg border border-slate-300 bg-white px-5 py-2.5 text-sm font-medium text-slate-600 transition hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-slate-400 focus:ring-offset-2">
                                <i class="fa-solid fa-xmark text-xs"></i>
                                Clear
                            </a>
                        @endif
                    </div>
                </form>
            </div>
            <a href="{{ route('stock-out.create') }}" class="inline-flex items-center justify-center gap-2 rounded-lg bg-emerald-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 sm:w-auto w-full">
                <i class="fa-solid fa-plus text-xs"></i>
                Add Stock Out
            </a>
        </div>

        <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">
            <div class="border-b border-slate-200 bg-slate-50/80 px-6 py-3">
                <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">
                    {{ $stockOuts->total() }} {{ Str::plural('record', $stockOuts->total()) }} found
                </p>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                        <tr class="border-b border-slate-100 bg-slate-50/50 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                            <th class="px-6 py-3">Date</th>
                            <th class="px-6 py-3">Product</th>
                            <th class="px-6 py-3">Reason</th>
                            <th class="px-6 py-3">Qty</th>
                            <th class="px-6 py-3 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm">
                        @forelse($stockOuts as $stockOut)
                            <tr class="transition-colors hover:bg-slate-50/50">
                                <td class="px-6 py-4 text-slate-600">{{ optional($stockOut->stock_date)->format('M d, Y g:i A') ?? '—' }}</td>
                                <td class="px-6 py-4 font-medium text-slate-700">{{ $stockOut->product?->name ?? 'N/A' }}</td>
                                <td class="px-6 py-4 text-slate-600">{{ $stockOut->reason ?? '—' }}</td>
                                <td class="px-6 py-4 font-medium text-slate-700">{{ $stockOut->quantity }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-end gap-4">
                                        <a href="{{ route('stock-out.show', $stockOut) }}" class="inline-flex items-center gap-1 text-sm font-medium text-emerald-600 transition hover:text-emerald-800">
                                            <i class="fa-regular fa-eye text-xs"></i>
                                            View
                                        </a>
                                        <a href="{{ route('stock-out.edit', $stockOut) }}" class="inline-flex items-center gap-1 text-sm font-medium text-blue-600 transition hover:text-blue-800">
                                            <i class="fa-regular fa-pen-to-square text-xs"></i>
                                            Edit
                                        </a>
                                        <form method="POST" action="{{ route('stock-out.destroy', $stockOut) }}" onsubmit="return confirm('Delete this stock out record? This action cannot be undone.');" class="inline">
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
                                <td colspan="5" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center gap-2">
                                        <i class="fa-solid fa-box-open text-3xl text-slate-300"></i>
                                        <p class="text-sm text-slate-400">No stock out records found.</p>
                                        <a href="{{ route('stock-out.create') }}" class="mt-2 text-sm text-emerald-600 hover:text-emerald-700">Record your first stock out →</a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-4">
            {{ $stockOuts->withQueryString()->links() }}
        </div>
    </div>
</x-layouts.app>
