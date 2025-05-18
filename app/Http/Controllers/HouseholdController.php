<?php

namespace App\Http\Controllers;

use App\Models\SignupLink;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class HouseholdController extends Controller
{
    public function render()
    {
        $household = User::find(Auth::id())->household;
        $users = $household->users;

        return view('household', ['users' => $users, 'household_name' => $household->name]);
    }

    public function addUser()
    {
        $household = User::find(Auth::id())->household;
        $link = $household->signupLinks()->create();
        return view('addUser', ['link' => secure_url('household/join', ["key" => $link->id])]);
    }

    public function join(string $uuid)
    {
        $household = SignupLink::find($uuid)->household;
        return view('joinHousehold', ['household' => $household]);
    }

    public function createAndAddUserToHousehold(Request $request, string $uuid)
    {
        $body = $request->validate([
            'email' => ['required', 'email', 'unique:App\Models\User,email'],
            'password' => ['required', 'same:confirm_password'],
            'name' => ['required'],
        ]);

        $household = SignupLink::find($uuid)->household;

        $user = new User();
        $user->email = $body['email'];
        $user->name = $body['name'];
        $user->password = Hash::make($body['password']);

        $household->users()->save($user);

        // Invalidate the invite code by deleting that record
        SignupLink::destroy($uuid);

        return redirect('/success');
    }
}
