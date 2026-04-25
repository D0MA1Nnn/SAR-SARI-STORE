<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProductController extends Controller
{
    //Display All Products
    public function index(): View
    {
        $search = request('search');

        $products = Product::with('category')
            ->when($search, fn ($query) => $query->where('name', 'like', "%{$search}%"))
            ->orderBy('name')
            ->paginate(10)
            ->withQueryString();

        return view('products.index', compact('products', 'search'));
    }

    //Show Create Form
    public function create(): View
    {
        $categories = Category::orderBy('description')->get();

        return view('products.create', compact('categories'));
    }

    //(CREATE operation)
    public function store(StoreProductRequest $request): RedirectResponse
    {
        $data = $request->validated();
        
        // Set default markup_percent if not provided
        if (!isset($data['markup_percent'])) {
            $data['markup_percent'] = 20;
        }
        
        // Set last_cost same as current_price for new products
        $data['last_cost'] = $data['current_price'];
        
        Product::create($data);

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    //(READ operation)
    public function show(Product $product): View
    {
        $product->load('category');

        return view('products.show', compact('product'));
    }

    //Show Edit Form
    public function edit(Product $product): View
    {
        $categories = Category::orderBy('description')->get();

        return view('products.edit', compact('product', 'categories'));
    }

    //(UPDATE operation)
    public function update(UpdateProductRequest $request, Product $product): RedirectResponse
    {
        $data = $request->validated();
        
        // If price is manually changed, update last_cost and markup_percent accordingly
        if (isset($data['current_price']) && $data['current_price'] != $product->current_price) {
            // Calculate implied last_cost based on markup_percent
            $markupPercent = $data['markup_percent'] ?? $product->markup_percent ?? 20;
            $data['last_cost'] = round($data['current_price'] / (1 + ($markupPercent / 100)), 2);
        }
        
        $product->update($data);

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    //(DELETE operation)
    public function destroy(Product $product): RedirectResponse
    {
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}
