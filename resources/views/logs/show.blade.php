<x-layouts.app :title="'Cash Log Details'">
    <div class="mx-auto max-w-2xl">
        <div class="mb-6">
            <h1 class="text-2xl font-bold tracking-tight text-slate-800">Cash Log Details</h1>
            <p class="mt-1 text-sm text-slate-500">View complete cash log information.</p>
        </div>

        <div class="rounded-xl border border-slate-200 bg-white shadow-sm">
            <div class="border-b border-slate-200 bg-gradient-to-r from-emerald-50 to-white p-6">
                <div class="flex items-center gap-3">
                    <div class="rounded-full bg-emerald-100 p-2">
                        <i class="fa-solid fa-chart-simple text-emerald-500"></i>
                    </div>
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Cash Log Entry</p>
                        <p class="mt-0.5 font-mono text-sm font-semibold text-slate-800">#{{ $cashLog->id }}</p>
                    </div>
                </div>
            </div>

            <div class="p-6 space-y-4">
                <div class="flex items-start gap-3 border-b border-slate-100 pb-4">
                    <div class="rounded-lg bg-slate-100 p-2">
                        <i class="fa-regular fa-calendar text-slate-500"></i>
                    </div>
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Log Date</p>
                        <p class="mt-0.5 text-base font-semibold text-slate-800">
                            {{ $cashLog->log_date ? \Carbon\Carbon::parse($cashLog->log_date)->format('F d, Y') : 'N/A' }}
                        </p>
                    </div>
                </div>

                <div class="flex items-start gap-3 border-b border-slate-100 pb-4">
                    <div class="rounded-lg bg-emerald-50 p-2">
                        <i class="fa-solid fa-arrow-right-to-bracket text-emerald-600"></i>
                    </div>
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Start Cash</p>
                        <p class="mt-0.5 text-2xl font-bold text-emerald-700">₱ {{ number_format($cashLog->start_cash ?? 0, 2) }}</p>
                    </div>
                </div>

                <div class="flex items-start gap-3 border-b border-slate-100 pb-4">
                    <div class="rounded-lg bg-amber-50 p-2">
                        <i class="fa-solid fa-arrow-left-from-bracket text-amber-600"></i>
                    </div>
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">End Cash</p>
                        <p class="mt-0.5 text-2xl font-bold text-amber-700">₱ {{ number_format($cashLog->end_cash ?? 0, 2) }}</p>
                    </div>
                </div>

                <div class="flex items-start gap-3">
                    <div class="rounded-lg {{ ($cashLog->end_cash ?? 0) - ($cashLog->start_cash ?? 0) >= 0 ? 'bg-emerald-100' : 'bg-red-100' }} p-2">
                        <i class="fa-solid fa-chart-line {{ ($cashLog->end_cash ?? 0) - ($cashLog->start_cash ?? 0) >= 0 ? 'text-emerald-600' : 'text-red-600' }}"></i>
                    </div>
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Variance</p>
                        <p class="mt-0.5 text-xl font-bold {{ ($cashLog->end_cash ?? 0) - ($cashLog->start_cash ?? 0) >= 0 ? 'text-emerald-700' : 'text-red-700' }}">
                            ₱ {{ number_format(($cashLog->end_cash ?? 0) - ($cashLog->start_cash ?? 0), 2) }}
                        </p>
                        <p class="text-xs text-slate-400 mt-1">
                            {{ ($cashLog->end_cash ?? 0) - ($cashLog->start_cash ?? 0) >= 0 ? 'Profit / Positive variance' : 'Loss / Negative variance' }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="flex items-center gap-3 border-t border-slate-200 px-6 py-4">
                <a href="{{ route('logs.edit', $cashLog) }}" class="inline-flex items-center gap-2 rounded-lg bg-emerald-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-emerald-700">
                    <i class="fa-regular fa-pen-to-square text-xs"></i>
                    Edit Log
                </a>
                <a href="{{ route('logs.index') }}" class="inline-flex items-center gap-2 rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-sm font-medium text-slate-600 transition hover:bg-slate-50">
                    <i class="fa-solid fa-arrow-left text-xs"></i>
                    Back to List
                </a>
            </div>
        </div>
    </div>
</x-layouts.app>