<x-layouts.app :title="'Stock In'">
    <div class="mx-auto max-w-3xl">
        <div class="mb-6">
            <h1 class="text-2xl font-bold tracking-tight text-slate-800">Record Stock In</h1>
            <p class="mt-1 text-sm text-slate-500">Add new inventory coming into the store.</p>
        </div>

        <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
            <form method="POST" action="{{ route('stock-in.store') }}">
                @include('stock-in._form', ['buttonText' => 'Save Stock In'])
            </form>
        </div>
    </div>
</x-layouts.app>
