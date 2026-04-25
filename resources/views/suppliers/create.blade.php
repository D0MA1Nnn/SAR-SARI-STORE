<x-layouts.app :title="'Suppliers'">
    <div class="mx-auto max-w-2xl">
        <div class="mb-6">
            <h1 class="text-2xl font-bold tracking-tight text-slate-800">Add Supplier</h1>
            <p class="mt-1 text-sm text-slate-500">Create a new supplier profile.</p>
        </div>

        <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
            <form method="POST" action="{{ route('suppliers.store') }}">
                @include('suppliers._form', ['buttonText' => 'Save Supplier'])
            </form>
        </div>
    </div>
</x-layouts.app>
