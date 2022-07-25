<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response as Response;

class RemoteApiService
{
    private string $url;
    private Client $httpClient;
    private bool $isAuthorized = false;

    /**
     * @param string $url
     */
    public function __construct(string $url)
    {
        $this->httpClient = new Client();
        $this->url = $url;
    }

    /**
     * URL setter
     * @param string $url
     * @return $this
     */
    public function setUrl(string $url): static
    {
        $this->url = $url;
        return $this;
    }

    /**
     * URL getter
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * append URI part to URL
     * @param string $uri
     * @return RemoteApiService
     */
    public function appendUri (string $uri): static
    {
        $this->url .= $uri;
        return $this;
    }

    /**
     * HTTP request should be authorized
     * @return $this
     */
    public function authorize(): static
    {
        $this->isAuthorized = true;
        return $this;
    }

    /**
     * generate headers for HTTP request
     * @return array
     */
    public function generateHeaders(): array
    {
        return $this->isAuthorized ?
            [
                "Authorization" => "Bearer ".Session::get('bearerToken')
            ] : [];
    }

    /**
     * Perform an HTTP request to the remote API
     * @param string $method
     * @param array $data
     * @return void
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function request(string $method, array $data = []): ?Object{
        $response = $this->httpClient->request(
            $method,
            $this->url,
            [
                'json' => $data,
                'headers' => $this->generateHeaders()
            ]
        );
        if (in_array($response->getStatusCode(), [Response::HTTP_OK, Response::HTTP_NO_CONTENT])){
            return json_decode($response->getBody());
        }else{
            // TODO: throw custom exception
            abort($response->getStatusCode());
        }
    }
}
