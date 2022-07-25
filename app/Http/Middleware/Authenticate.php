<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Cache;

class Authenticate extends Middleware
{
    public function handle($request, Closure $next, ...$guards)
    {
        // TODO: compare expiration time and handle refreshing the token
        if(!Cache::tags('auth')->has('bearerToken') || is_null(Cache::tags('auth')->get('bearerToken'))){
            return redirect($this->redirectTo($request));
        }
        return $next($request);
    }

    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request): ?string
    {
        if (! $request->expectsJson()) {
            return route('auth.login-view');
        }
    }
}
