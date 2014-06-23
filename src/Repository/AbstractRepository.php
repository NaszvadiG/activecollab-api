<?php

namespace Terminal42\ActiveCollabApi\Repository;

use Terminal42\ActiveCollabApi\ApiClient;
use Terminal42\ActiveCollabApi\ApiClientAwareTrait;

abstract class AbstractRepository
{
    use ApiClientAwareTrait;

    /**
     * @param ApiClient $apiClient
     */
    public function __construct(ApiClient $apiClient)
    {
        $this->setApiClient($apiClient);
    }
}