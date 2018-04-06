<?php

namespace App\Http\Middleware;

use Auth;

use Closure;

class AuthenticateNotAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param $request
     * @param callable $next
     * @return \Illuminate\Contracts\Routing\ResponseFactory|
     *         \Illuminate\Http\RedirectResponse|
     *         \Symfony\Component\HttpFoundation\Response
     */
    public function handle($request, Closure $next)
    {
        if (Auth::user()->is_admin) {
            if ($request->ajax() || $request->wantsJson()) {
                return response('Forbidden.', 403);
            } else {
                return redirect()->guest('admin');
            }
        }

        return $next($request);
    }
}
