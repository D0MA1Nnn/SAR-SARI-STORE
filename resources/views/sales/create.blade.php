<x-layouts.app :title="'Create Sale'">
    <div class="mx-auto max-w-4xl">
        <div class="mb-6">
            <h1 class="text-2xl font-bold tracking-tight text-slate-800">Create Sale</h1>
            <p class="mt-1 text-sm text-slate-500">Record a new sales transaction.</p>
        </div>

        <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
            <form action="{{ route('sales.store') }}" method="POST">
                @include('sales._form', ['buttonText' => 'Complete Sale'])
            </form>
        </div>
    </div>
</x-layouts.app>