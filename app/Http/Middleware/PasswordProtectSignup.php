<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Symfony\Component\HttpFoundation\Response;

class PasswordProtectSignup
{
    /**
     * Ensure the configured password is provided for modification requests
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $signup_code = $request->input('signup_code', '');

        if (Config::get('auth.signup_code') === $signup_code) {
            return $next($request);
        }

        return back()->withErrors([
            'signup_code' => 'Invalid signup code provided.',
        ])->withInput();
    }
}
