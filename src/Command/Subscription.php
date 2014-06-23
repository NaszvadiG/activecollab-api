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
        $this->getApiClient()->get($this->getContext().'/subscribe');
    }

    public function unsubscribe()
    {
        $this->getApiClient()->get($this->getContext().'/unsubscribe');
    }
}