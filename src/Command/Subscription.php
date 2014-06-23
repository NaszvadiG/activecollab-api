<?php

namespace Terminal42\ActiveCollabApi\Command;

use Terminal42\ActiveCollabApi\ApiClientAwareTrait;
use Terminal42\ActiveCollabApi\Repository\AbstractRepository;
use Terminal42\ActiveCollabApi\Repository\ContextAwareTrait;

class Subscription extends AbstractRepository
{
    use ContextAwareTrait, ApiClientAwareTrait;

    public function subscribe()
    {
        $this->getApiClient()->post($this->getContext().'/subscribe');
    }

    public function unsubscribe()
    {
        $this->getApiClient()->post($this->getContext().'/unsubscribe');
    }
}