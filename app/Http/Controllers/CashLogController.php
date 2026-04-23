<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCashLogRequest;
use App\Http\Requests\UpdateCashLogRequest;
use App\Models\CashLog;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CashLogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $search = request('search');

        $cashLogs = CashLog::query()
            ->when($search, fn ($query) => $query->whereDate('log_date', $search))
            ->latest('log_date')
            ->paginate(10)
            ->withQueryString();

        return view('logs.index', compact('cashLogs', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('logs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCashLogRequest $request): RedirectResponse
    {
        CashLog::create($request->validated());

        return redirect()->route('logs.index')->with('success', 'Cash log created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(CashLog $log): View
    {
        $cashLog = $log;

        return view('logs.show', compact('cashLog'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CashLog $log): View
    {
        $cashLog = $log;

        return view('logs.edit', compact('cashLog'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCashLogRequest $request, CashLog $log): RedirectResponse
    {
        $log->update($request->validated());

        return redirect()->route('logs.index')->with('success', 'Cash log updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CashLog $log): RedirectResponse
    {
        $log->delete();

        return redirect()->route('logs.index')->with('success', 'Cash log deleted successfully.');
    }
}
