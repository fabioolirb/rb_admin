<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Client\PendingRequest;

/**
 * Service class to interact with the OpenCart API.
 */
class OpenCardIAService
{
    protected PendingRequest $httpClient;
    protected string $tokenCacheKey = 'opencart_api_token';

    /**
     * Create a new service instance.
     */
    public function __construct()
    {
        $this->httpClient = Http::baseUrl(config('services.opencard_ia.url'))
            ->withOptions([
                'timeout' => config('services.opencard_ia.timeout', 30),
            ])
            ->acceptJson();
    }

    /**
     * Logs into the OpenCart API and returns an access token.
     *
     * @return string
     * @throws \Illuminate\Http\Client\RequestException
     */
    private function login(): string
    {
        $response = $this->httpClient->asForm()->post('index.php?route=api/account/login', [
            'username' => config('services.opencard_ia.username'),
            'key' => config('services.opencard_ia.key'),
        ]);

        // This will throw for actual HTTP errors (e.g., 500, 404)
        $response->throw();

        $data = $response->json();
        //dd($data);
        // Use 'api_token' for modern OpenCart versions, with a fallback to 'token' for older ones.
        $token = $data['api_token'] ?? $data['token'] ?? null;

        // If we got a token, great, return it.
        if ($token) {
            return $token;
        }

        // If there's no token, we have a problem.
        // Check for a specific error message from OpenCart.
        if (isset($data['error'])) {
            $errorMessage = is_array($data['error']) ? implode('; ', $data['error']) : $data['error'];
            // Throw an exception that includes the API's error message.
            throw new \Illuminate\Http\Client\RequestException($response, 'Erro de autenticação na API OpenCart: ' . $errorMessage);
        }

        // If there's no token and no error message, throw a generic exception.
        throw new \Illuminate\Http\Client\RequestException($response, 'A resposta da API OpenCart não continha um token ou uma mensagem de erro.');
    }

    /**
     * Retrieves the API token from cache or logs in to get a new one.
     *
     * @return string
     * @throws \Illuminate\Http\Client\RequestException
     */
    private function getToken(): string
    {
        // The closure will now either return the token string or throw an exception with a detailed error.
        // Cache::remember will cache the token on success, or let the exception propagate on failure.
        return Cache::remember($this->tokenCacheKey, now()->addMinutes(55), function () {
            return $this->login();
        });
    }

    /**
     * Generic method to make a GET request to the API.
     *
     * @param string $route
     * @param array $params
     * @return array|null
     */
    public function get(string $route, array $params = []): ?array
    {
        $token = $this->getToken();

        $queryParams = array_merge([
            'route' => $route,
            'api_token' => $token
        ], $params);

        $response = $this->httpClient->get('index.php', $queryParams);
        $response->throw();
        return $response->json();
    }

    /**
     * Generic method to make a POST request to the API.
     *
     * @param string $route
     * @param array $data
     * @return array|null
     */
    public function post(string $route, array $data = []): ?array
    {
        $token = $this->getToken();

        $url = 'index.php?route=' . $route . '&api_token=' . $token;

        $response = $this->httpClient->asForm()->post($url, $data);

        $response->throw();
        return $response->json();
    }

    /**
     * Gets the history and details of a specific order from the API.
     *
     * @param int $orderId
     * @return array|null
     */
    public function getOrder(int $orderId): ?array
    {
        // We now pass only the route path, not the full query string.
        return $this->post('api/sale/order/info', [
            'order_id' => $orderId
        ]);
    }

    /**
     * Adds a history entry to a specific order.
     *
     * @param int $orderId
     * @param int $orderStatusId
     * @param string|null $comment
     * @param bool $notify
     * @param bool $override
     * @return array|null
     */
    public function addOrderHistory(int $orderId, int $orderStatusId, ?string $comment = null, bool $notify = false, bool $override = false): ?array
    {
        $data = [
            'order_id' => $orderId,
            'order_status_id' => $orderStatusId,
            'comment' => $comment,
            'notify' => $notify ? 1 : 0,
            'override' => $override ? 1 : 0,
        ];

        return $this->post('api/sale/order/addHistory', $data);
    }
}