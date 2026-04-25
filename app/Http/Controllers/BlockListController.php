<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBlockListRequest;
use App\Http\Requests\UpdateBlockListRequest;
use App\Models\BlockList;
use App\Models\Customer;
use App\Models\Violation;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class BlockListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $search = request('search');

        $blockLists = BlockList::with(['customer', 'violation'])
            ->when($search, fn ($query) => $query->whereHas('customer', function ($q) use ($search) {
                $q->where('customer_firstname', 'like', "%{$search}%")
                    ->orWhere('customer_middlename', 'like', "%{$search}%")
                    ->orWhere('customer_lastname', 'like', "%{$search}%");
            }))
            ->orderByDesc('id')
            ->paginate(10)
            ->withQueryString();

        return view('block-list.index', compact('blockLists', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $customers = Customer::orderBy('customer_lastname')
            ->orderBy('customer_firstname')
            ->get();
        $violations = Violation::orderBy('description')->get();

        return view('block-list.create', compact('customers', 'violations'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBlockListRequest $request): RedirectResponse
    {
        BlockList::create($request->validated());

        return redirect()->route('block-list.index')->with('success', 'Block list entry created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(BlockList $blockList): View
    {
        $blockList->load(['customer', 'violation']);

        return view('block-list.show', compact('blockList'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BlockList $blockList): View
    {
        $customers = Customer::orderBy('customer_lastname')
            ->orderBy('customer_firstname')
            ->get();
        $violations = Violation::orderBy('description')->get();

        return view('block-list.edit', compact('blockList', 'customers', 'violations'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBlockListRequest $request, BlockList $blockList): RedirectResponse
    {
        $blockList->update($request->validated());

        return redirect()->route('block-list.index')->with('success', 'Block list entry updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BlockList $blockList): RedirectResponse
    {
        $blockList->delete();

        return redirect()->route('block-list.index')->with('success', 'Block list entry deleted.');
    }
}
