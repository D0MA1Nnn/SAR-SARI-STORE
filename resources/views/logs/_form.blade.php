@csrf
<div class="space-y-6">
    <div class="grid gap-6 md:grid-cols-3">
        <div>
            <label for="start_cash" class="mb-1.5 block text-sm font-semibold text-slate-700">Start Cash (PHP)</label>
            <div class="relative">
                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">₱</span>
                <input type="number"
                        step="0.01"
                        name="start_cash"
                        id="start_cash"
                        value="{{ old('start_cash', $cashLog->start_cash ?? '') }}"
                        placeholder="0.00"
                        class="w-full rounded-lg border border-slate-300 px-4 py-2.5 pl-8 text-sm text-slate-700 placeholder:text-slate-400 focus:border-emerald-500 focus:outline-none focus:ring-1 focus:ring-emerald-500">
            </div>
            @error('start_cash')
                <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="end_cash" class="mb-1.5 block text-sm font-semibold text-slate-700">End Cash (PHP)</label>
            <div class="relative">
                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">₱</span>
                <input type="number"
                        step="0.01"
                        name="end_cash"
                        id="end_cash"
                        value="{{ old('end_cash', $cashLog->end_cash ?? '') }}"
                        placeholder="0.00"
                        class="w-full rounded-lg border border-slate-300 px-4 py-2.5 pl-8 text-sm text-slate-700 placeholder:text-slate-400 focus:border-emerald-500 focus:outline-none focus:ring-1 focus:ring-emerald-500">
            </div>
            @error('end_cash')
                <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="log_date" class="mb-1.5 block text-sm font-semibold text-slate-700">Log Date</label>
            <div class="relative">
                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">
                    <i class="fa-regular fa-calendar text-xs"></i>
                </span>
                <input type="date"
                        name="log_date"
                        id="log_date"
                        value="{{ old('log_date', isset($cashLog) ? optional($cashLog->log_date)->format('Y-m-d') : now()->toDateString()) }}" 
                        class="w-full rounded-lg border border-slate-300 px-4 py-2.5 pl-10 text-sm text-slate-700 focus:border-emerald-500 focus:outline-none focus:ring-1 focus:ring-emerald-500">
            </div>
            @error('log_date')
                <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="flex items-center gap-3 pt-4 border-t border-slate-200">
        <button type="submit" class="rounded-lg bg-emerald-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2">
            {{ $buttonText }}
        </button>
        <a href="{{ route('logs.index') }}" class="rounded-lg border border-slate-300 bg-white px-5 py-2.5 text-sm font-medium text-slate-600 transition hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-slate-400 focus:ring-offset-2">
            Cancel
        </a>
    </div>
</div>