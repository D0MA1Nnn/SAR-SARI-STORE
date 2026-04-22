<x-layouts.app :title="'Edit Payment'">
    <div class="mx-auto max-w-3xl">
        <div class="mb-6">
            <h1 class="text-2xl font-bold tracking-tight text-slate-800">Edit Payment</h1>
            <p class="mt-1 text-sm text-slate-500">Update payment transaction details.</p>
        </div>

        <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
            <form action="{{ route('payments.update', $payment) }}" method="POST">
                @method('PUT')
                @include('payments._form', ['buttonText' => 'Update Payment'])
            </form>
        </div>
    </div>
</x-layouts.app>