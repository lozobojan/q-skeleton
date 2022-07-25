<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
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
                "Authorization" => "Bearer ".Cache::tags('auth')->get('bearerToken')
            ] : [];
    }

    /**
     * @param Request $request
     * @param bool $fetchAll
     * @param RemoteApiService $remoteApiService
     */
    public function appendRequestParams(Request $request, bool $fetchAll): void
    {
        $data = [];
        if($request->has('page'))
            $data['page'] = $request->get('page');
        if($fetchAll)
            $data['limit'] = PHP_INT_MAX;

        $this->appendUri("?".http_build_query($data));
    }

    /**
     * Perform an HTTP request to the remote API
     * @param string $method
     * @param array $data
     * @return Object|null
     * @throws GuzzleException
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
