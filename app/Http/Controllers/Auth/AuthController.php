<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Services\AuthService;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Cache;

class AuthController extends Controller
{

    /**
     * Attempt user login
     * @param LoginRequest $request
     * @return RedirectResponse
     * @throws GuzzleException
     */
    public function login(LoginRequest $request): RedirectResponse
    {
        // TODO: implement error messages in blade file
        $credentials = $request->only(['email', 'password']);
        $loginSuccessful = AuthService::login($credentials);

        if ($loginSuccessful){
            return redirect()->route('profile-view');
        }
        Cache::tags('auth')->flush();
        return redirect()->route('auth.login-view');
    }

    /**
     * Perform user logout
     * @return RedirectResponse
     */
    public function logout(): RedirectResponse
    {
        AuthService::logout();
        return redirect()->route('auth.login-view');
    }
}
