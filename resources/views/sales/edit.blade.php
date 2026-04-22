<x-layouts.app :title="'Edit Sale'">
    <div class="mx-auto max-w-4xl">
        <div class="mb-6">
            <h1 class="text-2xl font-bold tracking-tight text-slate-800">Edit Sale</h1>
            <p class="mt-1 text-sm text-slate-500">Update sales transaction details.</p>
        </div>

        <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
            <form action="{{ route('sales.update', $sale) }}" method="POST">
                @method('PUT')
                @include('sales._form', ['buttonText' => 'Update Sale'])
            </form>
        </div>
    </div>
</x-layouts.app>