<?php

namespace Terminal42\ActiveCollabApi;


trait ApiClientAwareTrait
{
    /**
     * @var ApiClient
     */
    protected $apiClient;

    /**
     * Get API client
     * @return ApiClient
     */
    public function getApiClient()
    {
        return $this->apiClient;
    }

    /**
     * Set API client
     * @param ApiClient $apiClient
     * @return $this
     */
    public function setApiClient(ApiClient $apiClient)
    {
        $this->apiClient = $apiClient;

        return $this;
    }
} 