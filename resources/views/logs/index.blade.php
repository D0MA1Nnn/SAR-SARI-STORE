<x-layouts.app :title="'Cash Logs'">
    <div class="space-y-6">
        <!-- Header -->
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
            </div>
        </div>

        <!-- Summary Cards -->
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            <div class="rounded-xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium uppercase tracking-wider text-slate-500">Total Logs</p>
                        <p class="mt-2 text-3xl font-bold text-slate-800">{{ $cashLogs->total() }}</p>
                    </div>
                    <div class="rounded-lg bg-emerald-50 p-3">
                        <i class="fa-solid fa-chart-line text-emerald-500 text-lg"></i>
                    </div>
                </div>
            </div>

            <div class="rounded-xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium uppercase tracking-wider text-slate-500">Average Start Cash</p>
                        <p class="mt-2 text-3xl font-bold text-slate-800">₱ {{ number_format($cashLogs->avg('start_cash') ?? 0, 2) }}</p>
                    </div>
                    <div class="rounded-lg bg-blue-50 p-3">
                        <i class="fa-solid fa-coins text-blue-500 text-lg"></i>
                    </div>
                </div>
            </div>

            <div class="rounded-xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium uppercase tracking-wider text-slate-500">Total Variance</p>
                        <p class="mt-2 text-3xl font-bold text-emerald-700">₱ {{ number_format($cashLogs->sum(function($log) { return $log->end_cash - $log->start_cash; }), 2) }}</p>
                    </div>
                    <div class="rounded-lg bg-purple-50 p-3">
                        <i class="fa-solid fa-arrow-trend-up text-purple-500 text-lg"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter Bar and Add Button in One Row -->
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div class="flex-1">
                <form method="GET" class="flex flex-col gap-3 sm:flex-row sm:items-center">
                    <div class="flex-1">
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">
                                <i class="fa-regular fa-calendar text-xs"></i>
                            </span>
                            <input type="date" 
                                   name="search" 
                                   value="{{ $search }}"
                                   class="w-full rounded-lg border border-slate-300 px-4 py-2.5 pl-10 text-sm text-slate-700 focus:border-emerald-500 focus:outline-none focus:ring-1 focus:ring-emerald-500">
                        </div>
                    </div>
                    <div class="flex gap-2">
                        <button type="submit" class="inline-flex items-center justify-center gap-2 rounded-lg bg-slate-700 px-5 py-2.5 text-sm font-medium text-white transition hover:bg-slate-800 focus:outline-none focus:ring-2 focus:ring-slate-500 focus:ring-offset-2">
                            <i class="fa-solid fa-filter text-xs"></i>
                            Filter
                        </button>
                        @if($search)
                            <a href="{{ route('logs.index') }}" class="inline-flex items-center justify-center gap-2 rounded-lg border border-slate-300 bg-white px-5 py-2.5 text-sm font-medium text-slate-600 transition hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-slate-400 focus:ring-offset-2">
                                <i class="fa-solid fa-xmark text-xs"></i>
                                Clear
                            </a>
                        @endif
                    </div>
                </form>
            </div>
            <a href="{{ route('logs.create') }}" class="inline-flex items-center justify-center gap-2 rounded-lg bg-emerald-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 sm:w-auto w-full">
                <i class="fa-solid fa-plus text-xs"></i>
                Add Log
            </a>
        </div>

        <!-- Cash Logs Table -->
        <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">
            <div class="border-b border-slate-200 bg-slate-50/80 px-6 py-3">
                <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">
                    {{ $cashLogs->total() }} {{ Str::plural('log', $cashLogs->total()) }} found
                </p>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                        <tr class="border-b border-slate-100 bg-slate-50/50 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                            <th class="px-6 py-3">Log Date</th>
                            <th class="px-6 py-3">Start Cash</th>
                            <th class="px-6 py-3">End Cash</th>
                            <th class="px-6 py-3">Variance</th>
                            <th class="px-6 py-3 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm">
                        @forelse($cashLogs as $log)
                            @php
                                $variance = ($log->end_cash ?? 0) - ($log->start_cash ?? 0);
                                $isPositive = $variance >= 0;
                            @endphp
                            <tr class="transition-colors hover:bg-slate-50/50">
                                <td class="px-6 py-4 font-medium text-slate-700">
                                    {{ $log->log_date ? \Carbon\Carbon::parse($log->log_date)->format('M d, Y') : 'N/A' }}
                                </td>
                                <td class="px-6 py-4 text-slate-600">₱ {{ number_format($log->start_cash ?? 0, 2) }}</td>
                                <td class="px-6 py-4 text-slate-600">₱ {{ number_format($log->end_cash ?? 0, 2) }}</td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center gap-1 rounded-full px-2.5 py-0.5 text-xs font-semibold {{ $isPositive ? 'bg-emerald-100 text-emerald-700' : 'bg-red-100 text-red-700' }}">
                                        @if($isPositive)
                                            <i class="fa-solid fa-arrow-up text-xs"></i>
                                        @else
                                            <i class="fa-solid fa-arrow-down text-xs"></i>
                                        @endif
                                        ₱ {{ number_format(abs($variance), 2) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-end gap-4">
                                        <a href="{{ route('logs.show', $log) }}" class="inline-flex items-center gap-1 text-sm font-medium text-emerald-600 transition hover:text-emerald-800">
                                            <i class="fa-regular fa-eye text-xs"></i>
                                            View
                                        </a>
                                        <a href="{{ route('logs.edit', $log) }}" class="inline-flex items-center gap-1 text-sm font-medium text-blue-600 transition hover:text-blue-800">
                                            <i class="fa-regular fa-pen-to-square text-xs"></i>
                                            Edit
                                        </a>
                                        <form method="POST" action="{{ route('logs.destroy', $log) }}" onsubmit="return confirm('Delete this cash log? This action cannot be undone.')" class="inline">
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
                                        <i class="fa-solid fa-coins text-3xl text-slate-300"></i>
                                        <p class="text-sm text-slate-400">No cash logs found.</p>
                                        <a href="{{ route('logs.create') }}" class="mt-2 text-sm text-emerald-600 hover:text-emerald-700">Create your first cash log →</a>
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
            {{ $cashLogs->withQueryString()->links() }}
        </div>
    </div>
</x-layouts.app>