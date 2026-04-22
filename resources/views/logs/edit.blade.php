<x-layouts.app :title="'Edit Cash Log'">
    <div class="mx-auto max-w-3xl">
        <div class="mb-6">
            <h1 class="text-2xl font-bold tracking-tight text-slate-800">Edit Cash Log</h1>
            <p class="mt-1 text-sm text-slate-500">Update cash log information.</p>
        </div>

        <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
            <form action="{{ route('logs.update', $cashLog) }}" method="POST">
                @method('PUT')
                @include('logs._form', ['buttonText' => 'Update Log'])
            </form>
        </div>
    </div>
</x-layouts.app>