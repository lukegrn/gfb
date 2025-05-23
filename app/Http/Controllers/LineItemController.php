<?php

namespace App\Http\Controllers;

use App\Models\LineItem;
use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LineItemController extends Controller
{
    public function store(Request $request, Plan $plan)
    {
        if (Auth::user()->household != $plan->household) {
            return back()->withErrors([
                'addLineItem' => "Cannot add line item to plan in another household",
            ]);
        }

        $payload = $request->validate([
            'name' => ['required'],
            'alloc' => ['required', 'decimal:0,2', 'gt:0'],
            'sinking' => ['boolean']
        ]);

        $lineItem = new LineItem();
        $lineItem->name = $payload['name'];
        $lineItem->alloc = $payload['alloc'];
        $lineItem->sinking = $payload['sinking'] ?? false;

        $plan->lineItems()->save($lineItem);

        return redirect()->route('plans.index');
    }

    public function destroy(Plan $plan, LineItem $lineItem)
    {
        if (Auth::user()->household != $plan->household) {
            return back()->withErrors([
                'deleteLineItem' => "Cannot delete line item on plan in another household",
            ]);
        }

        if ($plan->id != $lineItem->plan->id) {
            return back()->withErrors([
                'deleteLineItem' => "Cannot delete line item on other plan",
            ]);
        }

        $lineItem->delete();

        return redirect()->route('plans.index');
    }

    public function update(Request $request, Plan $plan, LineItem $lineItem)
    {
        if (Auth::user()->household != $plan->household) {
            return back()->withErrors([
                'updateLineItem' => "Cannot update line item on plan in another household",
            ]);
        }

        if ($plan->id != $lineItem->plan->id) {
            return back()->withErrors([
                'updateLineItem' => "Cannot update line item on other plan",
            ]);
        }

        $new = $request->validate([
            'name' => ['required'],
            'alloc' => ['required', 'decimal:0,2', 'gt:0'],
            'sinking' => ['boolean']
        ]);

        $lineItem->name = $new['name'];
        $lineItem->alloc = $new['alloc'];
        $lineItem->sinking = $new['sinking'] ?? false;

        $lineItem->save();

        return redirect()->route('plans.index');
    }
}
