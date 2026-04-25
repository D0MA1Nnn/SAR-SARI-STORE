<x-layouts.app :title="'Edit Stock In'">
    <div class="mx-auto max-w-3xl">
        <div class="mb-6">
            <h1 class="text-2xl font-bold tracking-tight text-slate-800">Edit Stock In</h1>
            <p class="mt-1 text-sm text-slate-500">Update stock in record details.</p>
        </div>

        <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
            <form method="POST" action="{{ route('stock-in.update', $stockIn) }}">
                @method('PUT')
                @include('stock-in._form', ['buttonText' => 'Update Stock In'])
            </form>
        </div>
    </div>
</x-layouts.app>
