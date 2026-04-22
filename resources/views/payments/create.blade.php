<x-layouts.app :title="'Create Payment'">
    <div class="mx-auto max-w-3xl">
        <div class="mb-6">
            <h1 class="text-2xl font-bold tracking-tight text-slate-800">Create Payment</h1>
            <p class="mt-1 text-sm text-slate-500">Record a new customer payment transaction.</p>
        </div>

        <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
            <form action="{{ route('payments.store') }}" method="POST">
                @include('payments._form', ['buttonText' => 'Save Payment'])
            </form>
        </div>
    </div>
</x-layouts.app>