<x-layouts.app :title="'Block List'">
    <div class="space-y-6">
        <!-- Header -->
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        </div>

        <!-- Stats Grid -->
        <div class="grid gap-6 sm:grid-cols-2">
            <div class="rounded-xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium uppercase tracking-wider text-slate-500">Total Blocks</p>
                        <p class="mt-2 text-3xl font-bold text-slate-800">{{ $blockLists->total() }}</p>
                    </div>
                    <div class="rounded-lg bg-red-50 p-3">
                        <i class="fa-solid fa-ban text-red-500 text-lg"></i>
                    </div>
                </div>
            </div>

            <div class="rounded-xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium uppercase tracking-wider text-slate-500">Violation Types</p>
                        <p class="mt-2 text-3xl font-bold text-slate-800">{{ $blockLists->pluck('violation_id')->unique()->count() }}</p>
                    </div>
                    <div class="rounded-lg bg-amber-50 p-3">
                        <i class="fa-solid fa-gavel text-amber-500 text-lg"></i>
                    </div>
                </div>
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
                                    value="{{ request('search') }}"
                                    placeholder="Search by customer name..."
                                    class="w-full rounded-lg border border-slate-300 px-4 py-2.5 pl-10 text-sm text-slate-700 placeholder:text-slate-400 focus:border-emerald-500 focus:outline-none focus:ring-1 focus:ring-emerald-500">
                        </div>
                    </div>
                    <div class="flex gap-2">
                        <button type="submit" class="inline-flex items-center justify-center gap-2 rounded-lg bg-slate-700 px-5 py-2.5 text-sm font-medium text-white transition hover:bg-slate-800 focus:outline-none focus:ring-2 focus:ring-slate-500 focus:ring-offset-2">
                            <i class="fa-solid fa-magnifying-glass text-xs"></i>
                            Search
                        </button>
                        @if(request('search'))
                            <a href="{{ route('block-list.index') }}" class="inline-flex items-center justify-center gap-2 rounded-lg border border-slate-300 bg-white px-5 py-2.5 text-sm font-medium text-slate-600 transition hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-slate-400 focus:ring-offset-2">
                                <i class="fa-solid fa-xmark text-xs"></i>
                                Clear
                            </a>
                        @endif
                    </div>
                </form>
            </div>
            <a href="{{ route('block-list.create') }}" class="inline-flex items-center justify-center gap-2 rounded-lg bg-emerald-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 sm:w-auto w-full">
                <i class="fa-solid fa-plus text-xs"></i>
                Add New Block
            </a>
        </div>

        <!-- Block List Table -->
        <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">
            <div class="border-b border-slate-200 bg-slate-50/80 px-6 py-3">
                <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">
                    {{ $blockLists->total() }} {{ Str::plural('entry', $blockLists->total()) }} found
                </p>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                        <tr class="border-b border-slate-100 bg-slate-50/50 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                            <th class="px-6 py-3">Customer</th>
                            <th class="px-6 py-3">Violation Type</th>
                            <th class="px-6 py-3">Blocked Since</th>
                            <th class="px-6 py-3 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm">
                        @forelse($blockLists as $blockList)
                            <tr class="transition-colors hover:bg-slate-50/50">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="flex h-9 w-9 items-center justify-center rounded-full bg-emerald-100 text-sm font-semibold text-emerald-700">
                                            {{ strtoupper(substr($blockList->customer->customer_firstname ?? 'N', 0, 1) . substr($blockList->customer->customer_lastname ?? '', 0, 1)) }}
                                        </div>
                                        <div>
                                            <p class="font-medium text-slate-800">
                                                {{ $blockList->customer ? trim($blockList->customer->customer_firstname . ' ' . ($blockList->customer->customer_middlename ?? '') . ' ' . $blockList->customer->customer_lastname) : 'N/A' }}
                                            </p>
                                            <p class="text-xs text-slate-400">ID: #{{ $blockList->customer->id ?? 'N/A' }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-red-100 px-3 py-1 text-xs font-medium text-red-700">
                                        <i class="fa-solid fa-circle-exclamation text-xs"></i>
                                        {{ $blockList->violation->description ?? 'N/A' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-slate-600">
                                    {{ $blockList->created_at ? $blockList->created_at->format('M d, Y') : 'N/A' }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-end gap-3">
                                        <a href="{{ route('block-list.edit', $blockList) }}" class="inline-flex items-center gap-1 text-sm font-medium text-blue-600 transition hover:text-blue-800">
                                            <i class="fa-regular fa-pen-to-square text-xs"></i>
                                            Edit
                                        </a>
                                        <form method="POST" action="{{ route('block-list.destroy', $blockList) }}" onsubmit="return confirm('Remove this customer from the block list? This action cannot be undone.')" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="inline-flex items-center gap-1 text-sm font-medium text-red-600 transition hover:text-red-800">
                                                <i class="fa-regular fa-trash-can text-xs"></i>
                                                Remove
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center gap-2">
                                        <i class="fa-solid fa-ban text-3xl text-slate-300"></i>
                                        <p class="text-sm text-slate-400">No blocked customers found.</p>
                                        <a href="{{ route('block-list.create') }}" class="mt-2 text-sm text-emerald-600 hover:text-emerald-700">Add your first block →</a>
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
            {{ $blockLists->withQueryString()->links() }}
        </div>
    </div>
</x-layouts.app>