<?php

namespace App\Services;

use GuzzleHttp\Client;
use Symfony\Component\HttpFoundation\Response as Response;

class RemoteApiService
{
    private string $url;
    private Client $httpClient;

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
     * Perform an HTTP request to the remote API
     * @param string $method
     * @param array $data
     * @return void
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function request(string $method, array $data): ?Object{
        $response = $this->httpClient->request(
            $method,
            $this->url,
            count($data) > 0 ? [ 'json' => $data ] : []
        );
        if ($response->getStatusCode() == Response::HTTP_OK){
            return json_decode($response->getBody());
        }else{
            // TODO: throw custom exception
            abort($response->getStatusCode());
        }
    }
}
