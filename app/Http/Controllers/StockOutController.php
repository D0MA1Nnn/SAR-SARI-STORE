<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStockOutRequest;
use App\Http\Requests\UpdateStockOutRequest;
use App\Models\Product;
use App\Models\StockOut;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use RuntimeException;

class StockOutController extends Controller
{
    public function index(): View
    {
        $search = request('search');

        $stockOuts = StockOut::with(['product'])
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->whereHas('product', fn ($p) => $p->where('name', 'like', "%{$search}%"))
                        ->orWhere('reason', 'like', "%{$search}%");
                });
            })
            ->orderByDesc('stock_date')
            ->orderByDesc('id')
            ->paginate(10)
            ->withQueryString();

        return view('stock-out.index', compact('stockOuts', 'search'));
    }

    public function create(): View
    {
        $products = Product::orderBy('name')->get();
        return view('stock-out.create', compact('products'));
    }

    public function store(StoreStockOutRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $error = null;

        DB::transaction(function () use ($data, &$error): void {
            $product = Product::lockForUpdate()->findOrFail($data['product_id']);
            $available = $product->stock ?? 0;

            if ($available < $data['quantity']) {
                $error = 'Insufficient stock for this product.';
                return;
            }

            // ONLY update stock - NO pricing changes
            $product->stock = $available - $data['quantity'];
            $product->save();

            StockOut::create($data);
        });

        if ($error) {
            return back()->withErrors(['quantity' => $error])->withInput();
        }

        return redirect()->route('stock-out.index')->with('success', 'Stock out recorded successfully.');
    }

    public function show(StockOut $stockOut): View
    {
        $stockOut->load(['product']);

        return view('stock-out.show', compact('stockOut'));
    }

    public function edit(StockOut $stockOut): View
    {
        $products = Product::orderBy('name')->get();
        return view('stock-out.edit', compact('stockOut', 'products'));
    }

    public function update(UpdateStockOutRequest $request, StockOut $stockOut): RedirectResponse
    {
        $data = $request->validated();

        try {
            DB::transaction(function () use ($data, $stockOut): void {
                $originalProduct = Product::lockForUpdate()->findOrFail($stockOut->product_id);
                $newProduct = $stockOut->product_id === (int) $data['product_id']
                    ? $originalProduct
                    : Product::lockForUpdate()->findOrFail($data['product_id']);

                $available = ($newProduct->stock ?? 0) + ($stockOut->product_id === (int) $data['product_id'] ? $stockOut->quantity : 0);

                if ($available < $data['quantity']) {
                    throw new RuntimeException('Insufficient stock for this product.');
                }

                $originalProduct->stock = ($originalProduct->stock ?? 0) + $stockOut->quantity;
                $originalProduct->save();

                $newProduct->stock = ($newProduct->stock ?? 0) - $data['quantity'];
                $newProduct->save();

                $stockOut->update($data);
            });
        } catch (RuntimeException $exception) {
            return back()->withErrors(['quantity' => $exception->getMessage()])->withInput();
        }

        return redirect()->route('stock-out.index')->with('success', 'Stock out updated successfully.');
    }

    public function destroy(StockOut $stockOut): RedirectResponse
    {
        DB::transaction(function () use ($stockOut): void {
            $product = Product::lockForUpdate()->findOrFail($stockOut->product_id);
            $product->stock = ($product->stock ?? 0) + $stockOut->quantity;
            $product->save();

            $stockOut->delete();
        });

        return redirect()->route('stock-out.index')->with('success', 'Stock out deleted successfully.');
    }
}
