<x-layouts.app :title="'Edit Block List Entry'">
    <div class="mx-auto max-w-2xl">
        <div class="mb-6">
            <h1 class="text-2xl font-bold tracking-tight text-slate-800">Edit Block List Entry</h1>
            <p class="mt-1 text-sm text-slate-500">Update violation details for this customer.</p>
        </div>

        <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
            <form action="{{ route('block-list.update', $blockList) }}" method="POST">
                @method('PUT')
                @include('block-list._form', ['buttonText' => 'Update Entry'])
            </form>
        </div>
    </div>
</x-layouts.app>