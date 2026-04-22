<x-layouts.app :title="'Create Customer'">
    <div class="mx-auto max-w-2xl">
        <div class="mb-6">
            <h1 class="text-2xl font-bold tracking-tight text-slate-800">Create Customer</h1>
            <p class="mt-1 text-sm text-slate-500">Add a new customer to your records.</p>
        </div>

        <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
            <form action="{{ route('customers.store') }}" method="POST">
                @include('customers._form', ['buttonText' => 'Save Customer'])
            </form>
        </div>
    </div>
</x-layouts.app>