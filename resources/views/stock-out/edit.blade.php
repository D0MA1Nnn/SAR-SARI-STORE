<x-layouts.app :title="'Edit Stock Out'">
    <div class="mx-auto max-w-3xl">
        <div class="mb-6">
            <h1 class="text-2xl font-bold tracking-tight text-slate-800">Edit Stock Out</h1>
            <p class="mt-1 text-sm text-slate-500">Update stock out record details.</p>
        </div>

        <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
            <form method="POST" action="{{ route('stock-out.update', $stockOut) }}">
                @method('PUT')
                @include('stock-out._form', ['buttonText' => 'Update Stock Out'])
            </form>
        </div>
    </div>
</x-layouts.app>
