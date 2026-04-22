<x-layouts.app :title="'Create Block List Entry'">
    <div class="mx-auto max-w-2xl">
        <div class="mb-6">
            <h1 class="text-2xl font-bold tracking-tight text-slate-800">Add to Block List</h1>
            <p class="mt-1 text-sm text-slate-500">Block a customer from making transactions.</p>
        </div>

        <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
            <form action="{{ route('block-list.store') }}" method="POST">
                @include('block-list._form', ['buttonText' => 'Add to Block List'])
            </form>
        </div>
    </div>
</x-layouts.app>