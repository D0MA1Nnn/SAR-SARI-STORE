<x-layouts.app :title="'Edit Product'">
    <div class="mx-auto max-w-2xl">
        <div class="mb-6">
            <h1 class="text-2xl font-bold tracking-tight text-slate-800">Edit Product</h1>
            <p class="mt-1 text-sm text-slate-500">Update product information.</p>
        </div>

        <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
            <form action="{{ route('products.update', $product) }}" method="POST">
                @method('PUT')
                @include('products._form', ['buttonText' => 'Update Product'])
            </form>
        </div>
    </div>
</x-layouts.app>