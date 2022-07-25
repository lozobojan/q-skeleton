<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Cache;

class Authenticate extends Middleware
{
    public function handle($request, Closure $next, ...$guards)
    {
        // TODO: handle refreshing the token
        if(!$this->checkApiAuth()){
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

    /**
     * @return bool
     */
    private function checkApiAuth(): bool{
        return Cache::tags('auth')->has('bearerToken')
            && !is_null(Cache::tags('auth')->get('bearerToken'))
            && Cache::tags('auth')->has('tokenExpiresAt')
            && Carbon::parse(Cache::tags('auth')->get('tokenExpiresAt'))->greaterThan(Carbon::now());
    }
}
