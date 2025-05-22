<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlanController extends Controller
{
    public function index()
    {
        $household = Auth::user()->household;
        $plans = $household->plans;

        return view('plans', ['plans' => $plans]);
    }

    public function store(Request $request)
    {
        $name = $request->validate([
            'name' => 'required'
        ])['name'];

        Auth::user()->household->plans()->create([
            'name' => $name
        ]);

        return redirect()->route('plans.index');
    }

    public function destroy(int $id)
    {
        if (Auth::user()->household != Plan::find($id)->household) {
            return back()->withErrors([
                'delete' => "Cannot delete plan in another household"
            ]);
        }

        Plan::destroy($id);

        return redirect()->route('plans.index');
    }

    public function update(Request $request, int $id)
    {
        if (Auth::user()->household != Plan::find($id)->household) {
            return back()->withErrors([
                'edit' => "Cannot edit plan in another household"
            ]);
        }

        $name = $request->validate([
            'name' => 'required'
        ])['name'];

        Plan::findOrFail($id)->update(['name' => $name]);

        return redirect()->route('plans.index');
    }
}
