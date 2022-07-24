<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Services\AuthService;
use App\Services\RemoteApiService;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    /**
     * @param LoginRequest $request
     * @return RedirectResponse
     * @throws GuzzleException
     */
    public function login(LoginRequest $request): RedirectResponse
    {
        // TODO: implement error messages in blade file
        $credentials = $request->only(['email','password']);

        $remoteApiUrl = config('app.skeleton_api_base_url')."/api/v2/token";
        $remoteApiService = new RemoteApiService($remoteApiUrl);
        $remoteApiResponse = $remoteApiService->request('POST', $credentials);

        if ($remoteApiResponse){
            AuthService::saveLoginData($remoteApiResponse);
            return redirect()->route('profile-view');
        }else{
            Session::flush();
            return redirect()->route('auth.login-view');
        }

    }

    /**
     * Perform user logout
     *
     * @return RedirectResponse
     */
    public function logout(): RedirectResponse
    {
        Session::flush();
        return redirect()->route('auth.login-view');
    }
}
