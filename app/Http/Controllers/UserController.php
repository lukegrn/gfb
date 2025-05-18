<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function delete($id)
    {
        if (Auth::user()->household != User::find($id)->household) {
            return back()->withErrors([
                'delete' => "Cannot delete user in another household"
            ]);
        }

        if (Auth::id() == $id) {
            return back()->withErrors([
                'delete' => "Cannoy delete your own user"
            ]);
        }

        User::destroy($id);

        return back();
    }
}
