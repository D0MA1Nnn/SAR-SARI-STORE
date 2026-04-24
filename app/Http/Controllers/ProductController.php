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
            ->when($search, fn ($query) => $query->where('product_name', 'like', "%{$search}%"))
            ->orderBy('id')
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
        Product::create($request->validated());

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
        $product->update($request->validated());

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    //(DELETE operation)
    public function destroy(Product $product): RedirectResponse
    {
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}
