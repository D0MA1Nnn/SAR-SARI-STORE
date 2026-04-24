<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CategoryController extends Controller
{
    //Display All Categories
    public function index(): View
    {
        $search = request('search');

        $categories = Category::query()
            ->when($search, fn ($query) => $query->where('description', 'like', "%{$search}%"))
            ->orderBy('id')
            ->paginate(10)
            ->withQueryString();

        return view('categories.index', compact('categories', 'search'));
    }

    //Show Create Form
    public function create(): View
    {
        return view('categories.create');
    }

    //(CREATE operation)
    public function store(StoreCategoryRequest $request): RedirectResponse
    {
        Category::create($request->validated());

        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }

    //(READ operation)
    public function show(Category $category): View
    {
        return view('categories.show', compact('category'));
    }

    //Show Edit Form
    public function edit(Category $category): View
    {
        return view('categories.edit', compact('category'));
    }

    //(UPDATE operation)
    public function update(UpdateCategoryRequest $request, Category $category): RedirectResponse
    {
        $category->update($request->validated());

        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    //(DELETE operation)
    public function destroy(Category $category): RedirectResponse
    {
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
}
