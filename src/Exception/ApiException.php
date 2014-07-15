<?php

namespace Terminal42\ActiveCollabApi\Exception;

use GuzzleHttp\Message\ResponseInterface;

class ApiException extends \Exception
{
    /**
     * API response object
     * @var ResponseInterface
     */
    protected $response;

    public function __construct(ResponseInterface $response, \Exception $previous = null)
    {
        parent::__construct($response->getReasonPhrase(), $response->getStatusCode(), $previous);

        $this->response = $response;
    }

    /**
     * Get HTTP response object
     * @return ResponseInterface
     */
    public function getResponseObject()
    {
        return $this->response;
    }
}