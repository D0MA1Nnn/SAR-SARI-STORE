<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStockInRequest;
use App\Http\Requests\UpdateStockInRequest;
use App\Models\Product;
use App\Models\StockIn;
use App\Models\Supplier;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class StockInController extends Controller
{
    public function index(): View
    {
        $search = request('search');

        $stockIns = StockIn::with(['product'])
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->whereHas('product', fn ($p) => $p->where('name', 'like', "%{$search}%"))
                        ->orWhere('reference', 'like', "%{$search}%");
                });
            })
            ->orderByDesc('stock_date')
            ->orderByDesc('id')
            ->paginate(10)
            ->withQueryString();

        return view('stock-in.index', compact('stockIns', 'search'));
    }

    public function create(): View
    {
        $products = Product::orderBy('name')->get();
        $suppliers = Supplier::orderBy('supplier_name')->get();  // This needs the Supplier class

        return view('stock-in.create', compact('products', 'suppliers'));
    }

    public function store(StoreStockInRequest $request): RedirectResponse
    {
        $data = $request->validated();

        DB::transaction(function () use ($data): void {
            $product = Product::lockForUpdate()->findOrFail($data['product_id']);

            // 1. Update stock quantity
            $product->stock = ($product->stock ?? 0) + $data['quantity'];

            // 2. Update pricing if unit cost is different from last_cost
            if ($product->last_cost != $data['unit_cost']) {
                $product->updatePricing($data['unit_cost']);
            }

            $product->save();

            // 3. Create stock-in record
            StockIn::create($data);
        });

        return redirect()->route('stock-in.index')->with('success', 'Stock in recorded successfully.');
    }

    public function show(StockIn $stockIn): View
    {
        $stockIn->load(['product', 'supplier']);  // Add supplier to load

        return view('stock-in.show', compact('stockIn'));
    }

    public function edit(StockIn $stockIn): View
    {
        $products = Product::orderBy('name')->get();
        $suppliers = Supplier::orderBy('supplier_name')->get();  // Add this

        return view('stock-in.edit', compact('stockIn', 'products', 'suppliers'));
    }

    public function update(UpdateStockInRequest $request, StockIn $stockIn): RedirectResponse
    {
        $data = $request->validated();

        DB::transaction(function () use ($data, $stockIn): void {
            // Reverse original stock-in effect
            $originalProduct = Product::lockForUpdate()->findOrFail($stockIn->product_id);
            $originalProduct->stock = ($originalProduct->stock ?? 0) - $stockIn->quantity;
            $originalProduct->save();

            // Apply new stock-in
            $newProduct = $stockIn->product_id === (int) $data['product_id']
                ? $originalProduct
                : Product::lockForUpdate()->findOrFail($data['product_id']);

            $newProduct->stock = ($newProduct->stock ?? 0) + $data['quantity'];
            
            // Update pricing based on new unit cost
            if ($newProduct->last_cost != $data['unit_cost']) {
                $newProduct->updatePricing($data['unit_cost']);
            }
            
            $newProduct->save();

            $stockIn->update($data);
        });

        return redirect()->route('stock-in.index')->with('success', 'Stock in updated successfully.');
    }

    public function destroy(StockIn $stockIn): RedirectResponse
    {
        $error = null;

        DB::transaction(function () use ($stockIn, &$error): void {
            $product = Product::lockForUpdate()->findOrFail($stockIn->product_id);
            $nextStocks = ($product->stock ?? 0) - $stockIn->quantity;

            if ($nextStocks < 0) {
                $error = 'Cannot delete this record because it would make stock negative.';
                return;
            }

            $product->stock = $nextStocks;
            
            // Get the most recent stock-in for this product (excluding current one)
            $lastStockIn = StockIn::where('product_id', $product->id)
                ->where('id', '!=', $stockIn->id)
                ->latest('stock_date')
                ->first();
            
            if ($lastStockIn) {
                // Revert to previous stock-in's cost
                if ($lastStockIn->unit_cost != $product->last_cost) {
                    $product->updatePricing($lastStockIn->unit_cost);
                }
            } elseif ($product->stock > 0) {
                // No more stock-in records but still has stock, keep current price
                // Don't change pricing
            } else {
                // No stock and no stock-in records, reset last_cost
                $product->last_cost = $product->current_price;
            }
            
            $product->save();
            $stockIn->delete();
        });

        if ($error) {
            return back()->withErrors(['quantity' => $error]);
        }

        return redirect()->route('stock-in.index')->with('success', 'Stock in deleted successfully.');
    }
}