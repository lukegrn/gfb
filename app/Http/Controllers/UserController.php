<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function delete(User $user)
    {
        if (Auth::user()->household != $user->household) {
            return back()->withErrors([
                'delete' => "Cannot delete user in another household"
            ]);
        }

        if (Auth::id() == $user->id) {
            return back()->withErrors([
                'delete' => "Cannoy delete your own user"
            ]);
        }

        $user->delete();

        return back();
    }
}
