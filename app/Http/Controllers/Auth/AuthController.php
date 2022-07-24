<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response as Response;

class AuthController extends Controller
{
    /**
     * Attempt API login
     *
     * @throws GuzzleException
     */
    public function login(LoginRequest $request){
        // TODO: implement error messages in blade file

        $httpClient = new Client();
        $response = $httpClient->post('https://symfony-skeleton.q-tests.com/api/v2/token', [
                'json' => [
                    'email' => 'ahsoka.tano@q.agency',
                    'password' => 'Kryze4President',
                ]
            ]
        );

        if ($response->getStatusCode() == Response::HTTP_OK){
            $responseParsed = json_decode($response->getBody());
            Session::put('bearerToken', $responseParsed->token_key);

            redirect()->route('');
        }else{
            Session::flush();
            // TODO: throw custom exception
            abort($response->getStatusCode());
        }

    }
}
