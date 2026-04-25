<x-layouts.app :title="'Edit Supplier'">
    <div class="mx-auto max-w-2xl">
        <div class="mb-6">
            <h1 class="text-2xl font-bold tracking-tight text-slate-800">Edit Supplier</h1>
            <p class="mt-1 text-sm text-slate-500">Update supplier information.</p>
        </div>

        <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
            <form method="POST" action="{{ route('suppliers.update', $supplier) }}">
                @method('PUT')
                @include('suppliers._form', ['buttonText' => 'Update Supplier'])
            </form>
        </div>
    </div>
</x-layouts.app>
