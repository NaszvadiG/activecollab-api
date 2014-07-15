<?php

namespace Terminal42\ActiveCollabApi;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Message\RequestInterface;
use GuzzleHttp\Message\ResponseInterface;
use Terminal42\ActiveCollabApi\Exception\ApiException;
use Terminal42\ActiveCollabApi\Exception\ApiDisabledException;
use Terminal42\ActiveCollabApi\Exception\AuthenticationFailedException;

class BaseApiClient
{
    /**
     * HTTP client
     * @var ClientInterface
     */
    protected $client;

    /**
     * activeCollab API token
     * @var string
     */
    protected $api_token;

    /**
     * HTTP response
     * @var ResponseInterface
     */
    protected $response;


    /**
     * Create API client for URL and token
     * @param string $base_url
     * @param string $api_token
     * @return static
     */
    public static function createWithUrl($base_url, $api_token)
    {
        $httpClient = new Client(['base_url' => $base_url]);

        $apiClient = new static($httpClient);
        $apiClient->setApiToken($api_token);

        return $apiClient;
    }

    /**
     * Create API client with HTTP client
     * @param ClientInterface $client
     * @param bool $testIsAlive
     * @throws Exception\ApiDisabledException
     */
    public function __construct(ClientInterface $client, $testIsAlive = true)
    {
        $this->client = $client;

        if ($testIsAlive && !$this->isAlive()) {
            throw new ApiDisabledException($this->response);
        }
    }

    /**
     * Set API token
     * @param string $api_token
     * @return $this
     */
    public function setApiToken($api_token)
    {
        $this->api_token = (string) $api_token;

        return $this;
    }

    /**
     * Get API token
     * @return string
     */
    public function getApiToken()
    {
        return $this->api_token;
    }

    /**
     * Check if API is alive
     * @return bool
     */
    public function isAlive()
    {
        try {
            $request = $this->client->createRequest('GET');
            $request->setQuery(['check_if_alive' => '1']);
            $response = $this->send($request, false);

            if ($response->api_is_alive == 'yes') {
                return true;
            }

            return false;
        } catch (ApiException $e) {
            return false;
        }
    }

    /**
     * Send a GET request to activeCollab
     * @param $path
     * @return object
     * @throws Exception\ApiException
     * @throws Exception\AuthenticationFailedException
     */
    public function get($path)
    {
        $request = $this->client->createRequest('GET');
        $request->setQuery(['path_info' => $path]);

        return $this->send($request);
    }

    /**
     * Send a POST request to activeCollab
     * @param $path
     * @param array $data
     * @return object
     * @throws Exception\ApiException
     * @throws Exception\AuthenticationFailedException
     */
    public function post($path, array $data = array())
    {
        // Apparently the activeCollab API requires this
        if (!isset($data['submitted'])) {
            $data['submitted'] = 'submitted';
        }

        $request = $this->client->createRequest('POST', null, ['body' => $data]);
        $request->setQuery(['path_info' => $path]);

        return $this->send($request);
    }

    /**
     * Set HTTP request to activeCollab API
     * @param RequestInterface $request
     * @param bool $authenticate
     * @return object
     * @throws Exception\ApiException
     * @throws Exception\AuthenticationFailedException
     */
    public function send(RequestInterface $request, $authenticate = true)
    {
        $request->addHeader('Accept', 'application/json');

        if ($authenticate) {
            $request->setQuery(
                $request->getQuery()->set('auth_api_token', $this->api_token)
            );
        }

        try {

            /** @var ResponseInterface $response */
            $response = $this->client->send($request);

        } catch (RequestException $e) {
            $response = $e->getResponse();

            if ($response->getStatusCode() < 200 || $response->getStatusCode() >= 300) {
                switch ($response->getStatusCode()) {
                    case 403:
                        throw new AuthenticationFailedException($response);

                    default:
                        throw new ApiException($response);
                }
            }
        }

        return $this->parseResponse($request, $response);
    }

    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @return object
     */
    protected function parseResponse(RequestInterface $request, ResponseInterface $response)
    {
        $this->response = $response;

        if ($request->getQuery()->get('check_if_alive') == '1') {
            $xml = $response->xml();
            return (object) array($xml->getName() => (string) $xml);
        }

        return $response->json();
    }
}