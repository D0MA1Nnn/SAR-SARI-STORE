<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSaleRequest;
use App\Http\Requests\UpdateSaleRequest;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $search = request('search');

        $sales = Sale::with(['customer', 'salesDetails.product'])
            ->when($search, fn ($query) => $query->whereHas('customer', function ($q) use ($search) {
                $q->where('customer_firstname', 'like', "%{$search}%")
                    ->orWhere('customer_middlename', 'like', "%{$search}%")
                    ->orWhere('customer_lastname', 'like', "%{$search}%");
            }))
            ->latest('sales_date')
            ->paginate(10)
            ->withQueryString();

        return view('sales.index', compact('sales', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $customers = Customer::orderBy('customer_lastname')
            ->orderBy('customer_firstname')
            ->get();
        $products = Product::orderBy('name')->get();

        return view('sales.create', compact('customers', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSaleRequest $request): RedirectResponse
    {
        DB::transaction(function () use ($request): void {
            $sale = Sale::create($request->safe()->only(['customer_id', 'sales_date']));

            foreach ($request->validated('details') as $detail) {
                $sale->salesDetails()->create($detail);
            }
        });

        return redirect()->route('sales.index')->with('success', 'Sale saved successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Sale $sale): View
    {
        $sale->load(['customer', 'salesDetails.product']);

        return view('sales.show', compact('sale'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sale $sale): View
    {
        $sale->load('salesDetails');
        $customers = Customer::orderBy('customer_lastname')
            ->orderBy('customer_firstname')
            ->get();
        $products = Product::orderBy('name')->get();

        return view('sales.edit', compact('sale', 'customers', 'products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSaleRequest $request, Sale $sale): RedirectResponse
    {
        DB::transaction(function () use ($request, $sale): void {
            $sale->update($request->safe()->only(['customer_id', 'sales_date']));
            $sale->salesDetails()->delete();

            foreach ($request->validated('details') as $detail) {
                $sale->salesDetails()->create($detail);
            }
        });

        return redirect()->route('sales.index')->with('success', 'Sale updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sale $sale): RedirectResponse
    {
        $sale->delete();

        return redirect()->route('sales.index')->with('success', 'Sale deleted successfully.');
    }
}
