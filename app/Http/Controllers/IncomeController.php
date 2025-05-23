<?php

namespace App\Http\Controllers;

use App\Models\Income;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IncomeController extends Controller
{
    public function index()
    {
        $incomes = Auth::user()->household->incomes;

        return view('incomes', [
            'incomes' => $incomes
        ]);
    }

    public function store(Request $request)
    {
        $payload = $request->validate([
            'name' => 'required',
            'expectation' => ['required', 'decimal:0,2', 'gt:0']
        ]);

        Auth::user()->household->incomes()->create([
            'name' => $payload['name'],
            'expectation' => $payload['expectation']
        ]);

        return redirect()->route('incomes.index');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Income $income)
    {
        if (Auth::user()->household != $income->household) {
            return back()->withErrors([
                'edit' => "Cannot edit income in another household"
            ]);
        }

        $payload = $request->validate([
            'name' => 'required',
            'expectation' => ['required', 'decimal:0,2', 'gt:0']
        ]);

        $income->name = $payload['name'];
        $income->expectation = $payload['expectation'];
        $income->save();

        return redirect()->route('incomes.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Income $income)
    {
        if (Auth::user()->household != $income->household) {
            return back()->withErrors([
                'delete' => "Cannot delete income in another household"
            ]);
        }

        $income->delete();

        return redirect()->route('incomes.index');
    }
}
