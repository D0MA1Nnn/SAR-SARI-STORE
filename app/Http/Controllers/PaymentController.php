<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePaymentRequest;
use App\Http\Requests\UpdatePaymentRequest;
use App\Models\Customer;
use App\Models\Payment;
use App\Models\PaymentMethod;
use App\Models\SysStatus;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $search = request('search');

        $payments = Payment::with(['customer', 'paymentMethod', 'paymentStatus'])
            ->when($search, fn ($query) => $query->whereHas('customer', fn ($q) => $q->where('customer_name', 'like', "%{$search}%")))
            ->latest('payment_date')
            ->paginate(10)
            ->withQueryString();

        return view('payments.index', compact('payments', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $customers = Customer::orderBy('customer_name')->get();
        $paymentMethods = PaymentMethod::orderBy('description')->get();
        $statuses = SysStatus::orderBy('description')->get();

        return view('payments.create', compact('customers', 'paymentMethods', 'statuses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePaymentRequest $request): RedirectResponse
    {
        Payment::create($request->validated());

        return redirect()->route('payments.index')->with('success', 'Payment saved successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Payment $payment): View
    {
        $payment->load(['customer', 'paymentMethod', 'paymentStatus']);

        return view('payments.show', compact('payment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payment $payment): View
    {
        $customers = Customer::orderBy('customer_name')->get();
        $paymentMethods = PaymentMethod::orderBy('description')->get();
        $statuses = SysStatus::orderBy('description')->get();

        return view('payments.edit', compact('payment', 'customers', 'paymentMethods', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePaymentRequest $request, Payment $payment): RedirectResponse
    {
        $payment->update($request->validated());

        return redirect()->route('payments.index')->with('success', 'Payment updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment): RedirectResponse
    {
        $payment->delete();

        return redirect()->route('payments.index')->with('success', 'Payment deleted successfully.');
    }
}
