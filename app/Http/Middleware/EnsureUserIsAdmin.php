<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsAdmin
{
    /**
     * 403, not a redirect-to-login -- a logged-in non-admin hitting /admin
     * is already authenticated, so sending them to the login form again
     * is just confusing. The 'auth' middleware (applied before this one
     * on every admin route) already handles the guest case.
     */
    public function handle(Request $request, Closure $next): Response
    {
        abort_unless($request->user()?->is_admin, 403);

        return $next($request);
    }
}
