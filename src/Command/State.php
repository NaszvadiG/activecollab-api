<?php

namespace Terminal42\ActiveCollabApi\Command;

use Terminal42\ActiveCollabApi\ApiClientAwareTrait;
use Terminal42\ActiveCollabApi\Repository\AbstractRepository;
use Terminal42\ActiveCollabApi\Repository\ContextAwareTrait;

class State extends AbstractRepository
{
    use ContextAwareTrait, ApiClientAwareTrait;

    public function archive()
    {
        $this->getApiClient()->get($this->getContext().'/archive');
    }

    public function unarchive()
    {
        $this->getApiClient()->get($this->getContext().'/unarchive');
    }

    public function trash()
    {
        $this->getApiClient()->get($this->getContext().'/trash');
    }

    public function untrash()
    {
        $this->getApiClient()->get($this->getContext().'/untrash');
    }
}