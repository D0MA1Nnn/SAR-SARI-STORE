<x-layouts.app :title="'Edit Category'">
    <div class="mx-auto max-w-2xl">
        <div class="mb-6">
            <h1 class="text-2xl font-bold tracking-tight text-slate-800">Edit Category</h1>
            <p class="mt-1 text-sm text-slate-500">Update the category description.</p>
        </div>

        <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
            <form action="{{ route('categories.update', $category) }}" method="POST">
                @method('PUT')
                @include('categories._form', ['buttonText' => 'Update Category'])
            </form>
        </div>
    </div>
</x-layouts.app>