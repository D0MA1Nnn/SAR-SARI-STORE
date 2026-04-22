<x-layouts.app :title="'Create Category'">
    <div class="mx-auto max-w-2xl">
        <div class="mb-6">
            <h1 class="text-2xl font-bold tracking-tight text-slate-800">Create Category</h1>
            <p class="mt-1 text-sm text-slate-500">Add a new category to organize your products.</p>
        </div>

        <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
            <form action="{{ route('categories.store') }}" method="POST">
                @include('categories._form', ['buttonText' => 'Save Category'])
            </form>
        </div>
    </div>
</x-layouts.app>