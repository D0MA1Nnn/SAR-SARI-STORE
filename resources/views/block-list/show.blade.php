<x-layouts.app :title="'Block List Details'">
    <div class="mx-auto max-w-2xl">
        <div class="mb-6">
            <h1 class="text-2xl font-bold tracking-tight text-slate-800">Block List Details</h1>
            <p class="mt-1 text-sm text-slate-500">View complete block information.</p>
        </div>

        <div class="rounded-xl border border-slate-200 bg-white shadow-sm">
            <div class="border-b border-slate-200 bg-gradient-to-r from-red-50 to-white p-6">
                <div class="flex items-center gap-3">
                    <div class="rounded-full bg-red-100 p-2">
                        <i class="fa-solid fa-ban text-red-500"></i>
                    </div>
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Block Entry</p>
                        <p class="mt-0.5 font-mono text-sm font-semibold text-slate-800">#{{ $blockList->id }}</p>
                    </div>
                </div>
            </div>

            <div class="p-6 space-y-4">
                <div class="flex items-start gap-3 border-b border-slate-100 pb-4">
                    <div class="rounded-lg bg-emerald-50 p-2">
                        <i class="fa-regular fa-user text-emerald-600"></i>
                    </div>
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Customer</p>
                        <p class="mt-0.5 text-base font-semibold text-slate-800">{{ $blockList->customer->customer_name ?? 'N/A' }}</p>
                        <p class="text-xs text-slate-400">ID: #{{ $blockList->customer->id ?? 'N/A' }}</p>
                    </div>
                </div>

                <div class="flex items-start gap-3 border-b border-slate-100 pb-4">
                    <div class="rounded-lg bg-red-50 p-2">
                        <i class="fa-solid fa-circle-exclamation text-red-500"></i>
                    </div>
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Violation Type</p>
                        <p class="mt-0.5 text-sm text-slate-700">{{ $blockList->violation->description ?? 'N/A' }}</p>
                    </div>
                </div>

                <div class="flex items-start gap-3">
                    <div class="rounded-lg bg-slate-100 p-2">
                        <i class="fa-regular fa-calendar text-slate-500"></i>
                    </div>
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Blocked Since</p>
                        <p class="mt-0.5 text-sm text-slate-700">{{ $blockList->created_at->format('F d, Y \a\t g:i A') }}</p>
                    </div>
                </div>
            </div>

            <div class="flex items-center gap-3 border-t border-slate-200 px-6 py-4">
                <a href="{{ route('block-list.edit', $blockList) }}" class="inline-flex items-center gap-2 rounded-lg bg-emerald-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-emerald-700">
                    <i class="fa-regular fa-pen-to-square text-xs"></i>
                    Edit Entry
                </a>
                <a href="{{ route('block-list.index') }}" class="inline-flex items-center gap-2 rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-sm font-medium text-slate-600 transition hover:bg-slate-50">
                    <i class="fa-solid fa-arrow-left text-xs"></i>
                    Back to List
                </a>
            </div>
        </div>
    </div>
</x-layouts.app>