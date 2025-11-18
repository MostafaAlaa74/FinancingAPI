<?php

namespace App\Http\Controllers;

use App\Models\Expenses;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreExpenseRequest;
use App\Http\Requests\UpdateExpenseRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ExpensesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Auth::user()->expenses, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreExpenseRequest $request)
    {
        $expenses = Expenses::create([
            'title' => $request->title,
            'description' => $request->description,
            'amount' => $request->amount,
            'expense_date' => $request->expense_date,
            'user_id' => Auth::id()
        ]);

        return response()->json(['Message' => 'Expense Saved', 'Expense' => $expenses], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Expenses $expenses)
    {
        Gate::authorize('view', $expenses);
        return response()->json($expenses, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateExpenseRequest $request, Expenses $expenses)
    {
        Gate::authorize('update', $expenses);
        $expenses->update($request->validated());
        return response()->json(['Message' => 'Expense Updated ', $expenses], 200);
    }

    /**
     * Remove the specified resource from storage.     */
    public function destroy(Expenses $expenses)
    {
        Gate::authorize('delete', $expenses);
        $expenses->delete();
        return response()->json(['messaga' => 'Expense Deleted'], 200);
    }
}
