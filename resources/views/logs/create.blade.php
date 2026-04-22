<x-layouts.app :title="'Create Cash Log'">
    <div class="mx-auto max-w-3xl">
        <div class="mb-6">
            <h1 class="text-2xl font-bold tracking-tight text-slate-800">Create Cash Log</h1>
            <p class="mt-1 text-sm text-slate-500">Record daily opening and closing cash balances.</p>
        </div>

        <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
            <form action="{{ route('logs.store') }}" method="POST">
                @include('logs._form', ['buttonText' => 'Save Log'])
            </form>
        </div>
    </div>
</x-layouts.app>