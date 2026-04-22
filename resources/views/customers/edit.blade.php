<x-layouts.app :title="'Edit Customer'">
    <div class="mx-auto max-w-2xl">
        <div class="mb-6">
            <h1 class="text-2xl font-bold tracking-tight text-slate-800">Edit Customer</h1>
            <p class="mt-1 text-sm text-slate-500">Update customer information.</p>
        </div>

        <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
            <form action="{{ route('customers.update', $customer) }}" method="POST">
                @method('PUT')
                @include('customers._form', ['buttonText' => 'Update Customer'])
            </form>
        </div>
    </div>
</x-layouts.app>