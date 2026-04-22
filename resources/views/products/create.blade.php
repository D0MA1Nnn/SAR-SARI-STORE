<x-layouts.app :title="'Create Product'">
    <div class="mx-auto max-w-2xl">
        <div class="mb-6">
            <h1 class="text-2xl font-bold tracking-tight text-slate-800">Create Product</h1>
            <p class="mt-1 text-sm text-slate-500">Add a new product to your inventory.</p>
        </div>

        <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
            <form action="{{ route('products.store') }}" method="POST">
                @include('products._form', ['buttonText' => 'Save Product'])
            </form>
        </div>
    </div>
</x-layouts.app>