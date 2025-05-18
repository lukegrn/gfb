<?php

namespace App\Http\Middleware;

use App\Models\SignupLink;
use Closure;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckInviteCode
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $id = $request->route('uuid');

        try {
            $link = SignupLink::findOrFail($id);
        } catch (ModelNotFoundException) {
            return redirect('/invalid-invite');
        }

        if ($link->isExpired) {
            return redirect('/invalid-invite');
        }

        return $next($request);
    }
}
