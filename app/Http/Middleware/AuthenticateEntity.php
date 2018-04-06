<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

use App\HintList;

class AuthenticateEntity
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::user()->type != HintList::getUserTypeByCode('entity')) {
            if ($request->ajax() || $request->wantsJson()) {
                return response('Forbidden.', 403);
            } else {
                return redirect()->route('cabinet.profile');
            }
        }

        return $next($request);
    }
}
