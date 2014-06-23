<?php

namespace Terminal42\ActiveCollabApi;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Message\ResponseInterface;
use Terminal42\ActiveCollabApi\Exception\ApiException;
use Terminal42\ActiveCollabApi\Exception\ApiDisabledException;
use Terminal42\ActiveCollabApi\Exception\AuthenticationFailedException;
use Terminal42\ActiveCollabApi\Model\Info;
use Terminal42\ActiveCollabApi\Repository\Attachments;
use Terminal42\ActiveCollabApi\Repository\Categories;
use Terminal42\ActiveCollabApi\Repository\Comments;
use Terminal42\ActiveCollabApi\Repository\Companies;
use Terminal42\ActiveCollabApi\Repository\Projects;
use Terminal42\ActiveCollabApi\Repository\Tasks;
use Terminal42\ActiveCollabApi\Repository\Users;

class ApiClient
{
    /**
     * URL to activeCollab api.php
     * @var string
     */
    protected $base_url;

    /**
     * activeCollab API token
     * @var string
     */
    protected $api_token;

    /**
     * HTTP client
     * @var ClientInterface
     */
    protected $client;

    /**
     * HTTP response
     * @var ResponseInterface
     */
    protected $response;


    public function __construct($base_url, $api_token, ClientInterface $client = null)
    {
        $this->client = $client;
        $this->base_url = $base_url;
        $this->api_token = $api_token;

        if (null === $client) {
            $this->client = new Client();
        }

        if ($this->sendRequest('check_if_alive=1', false)->api_is_alive != 'yes') {
            throw new ApiDisabledException($this->response);
        }
    }

    /**
     * Returns the system information about the installation that you are working with.
     * This information includes the system version, the users that are currently logged in, the API mode, etc.
     *
     * @return Info
     */
    public function getInfo()
    {
        return new Info($this->sendCommand('info'));
    }

    /**
     * Get companies repository
     * @return Companies
     */
    public function companies()
    {
        return new Companies($this);
    }

    /**
     * Users for given company ID
     * @param int $id
     * @return Users
     */
    public function usersForCompany($id)
    {
        $repository = new Users($this);
        $repository->setCompanyId($id);

        return $repository;
    }

    /**
     * Get projects repository
     * @return Projects
     */
    public function projects()
    {
        return new Projects($this);
    }

    /**
     * Get tasks repository for given project
     * @param  string $id_or_slug
     * @return Tasks
     */
    public function tasksForProject($id_or_slug)
    {
        $repository = new Tasks($this);
        $repository->setProjectId($id_or_slug);

        return $repository;
    }

    /**
     * Get comments repository for given context
     * @param $context
     * @return Comments
     */
    public function commentsForContext($context)
    {
        $repository = new Comments($this);
        $repository->setContext($context);

        return $repository;
    }

    /**
     * Get attachments repository for context
     * @param $context
     * @return Attachments
     */
    public function attachmentsForContext($context)
    {
        $repository = new Attachments($this);
        $repository->setContext($context);

        return $repository;
    }

    /**
     * Get categories repository for context
     * @param $context
     * @return Categories
     */
    public function categoriesForContext($context)
    {
        $repository = new Categories($this);
        $repository->setContext($context);

        return $repository;
    }


    public function sendCommand($command)
    {
        return $this->sendRequest('path_info='.$command);
    }

    /**
     * @param string $query
     * @param bool $authenticate
     * @return object
     * @throws Exception\ApiException
     * @throws Exception\AuthenticationFailedException
     */
    public function sendRequest($query, $authenticate = true)
    {
        if ($authenticate) {
            $query .= '&auth_api_token=' . $this->api_token;
        }

        $request = $this->client->createRequest($this->base_url . '?' . $query);
        $request->addHeader('Accept', 'application/json');

        /** @var ResponseInterface $response */
        $response = $this->client->send($request);

        if ($response->getStatusCode() < 200 || $response->getStatusCode() >= 300) {
            switch ($response->getStatusCode()) {
                case 403:
                    throw new AuthenticationFailedException($response);

                default:
                    throw new ApiException($response);
            }
        }

        return $this->parseResponse($query, $response);
    }

    /**
     * @param string $query
     * @param ResponseInterface $response
     * @return object
     */
    protected function parseResponse($query, ResponseInterface $response)
    {
        $this->response = $response;

        switch ($query) {
            case 'check_if_alive=1':
                $xml = $response->xml();
                return (object) array($xml->getName() => (string) $xml);
                break;

            default:
                return $response->json();
        }
    }
}