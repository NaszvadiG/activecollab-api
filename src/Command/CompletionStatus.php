<?php

namespace Terminal42\ActiveCollabApi\Command;

use Terminal42\ActiveCollabApi\ApiClientAwareTrait;
use Terminal42\ActiveCollabApi\Repository\AbstractRepository;
use Terminal42\ActiveCollabApi\Repository\ContextAwareTrait;

class CompletionStatus extends AbstractRepository
{
    use ContextAwareTrait, ApiClientAwareTrait;

    public function complete()
    {
        $this->getApiClient()->post($this->getContext().'/complete');
    }

    public function reopen()
    {
        $this->getApiClient()->post($this->getContext().'/reopen');
    }
}