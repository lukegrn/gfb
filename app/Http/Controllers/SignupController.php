<?php

namespace App\Http\Controllers;

use App\Models\Household;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SignupController extends Controller
{
    public function render()
    {
        return view('signup');
    }

    public function create(Request $request)
    {
        $body = $request->validate([
            'email' => ['required', 'email', 'unique:App\Models\User,email'],
            'password' => ['required', 'same:confirm_password'],
            'household' => ['required'],
            'name' => ['required'],
        ]);

        // Create the household
        $household = new Household();
        $household->name = $body['household'];

        $user = new User();
        $user->email = $body['email'];
        $user->name = $body['name'];
        $user->password = Hash::make($body['password']);

        $household->save();
        $household->users()->save($user);

        return redirect('/success');
    }
}
