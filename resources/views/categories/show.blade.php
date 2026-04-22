<x-layouts.app :title="'Category Details'">
    <div class="mx-auto max-w-2xl">
        <div class="mb-6">
            <h1 class="text-2xl font-bold tracking-tight text-slate-800">Category Details</h1>
            <p class="mt-1 text-sm text-slate-500">View and manage category information.</p>
        </div>

        <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="space-y-4">
                <div class="flex items-start gap-3 border-b border-slate-100 pb-4">
                    <div class="rounded-lg bg-emerald-50 p-2">
                        <i class="fa-solid fa-tag text-emerald-600"></i>
                    </div>
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Category ID</p>
                        <p class="mt-0.5 font-mono text-sm font-medium text-slate-700">#{{ $category->id }}</p>
                    </div>
                </div>

                <div class="flex items-start gap-3">
                    <div class="rounded-lg bg-slate-100 p-2">
                        <i class="fa-regular fa-rectangle-list text-slate-500"></i>
                    </div>
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Description</p>
                        <p class="mt-0.5 text-sm text-slate-700">{{ $category->description }}</p>
                    </div>
                </div>
            </div>

            <div class="mt-6 flex items-center gap-3 pt-4 border-t border-slate-100">
                <a href="{{ route('categories.edit', $category) }}" class="inline-flex items-center gap-2 rounded-lg bg-emerald-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-emerald-700">
                    <i class="fa-regular fa-pen-to-square text-xs"></i>
                    Edit Category
                </a>
                <a href="{{ route('categories.index') }}" class="inline-flex items-center gap-2 rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-sm font-medium text-slate-600 transition hover:bg-slate-50">
                    <i class="fa-solid fa-arrow-left text-xs"></i>
                    Back to List
                </a>
            </div>
        </div>
    </div>
</x-layouts.app>