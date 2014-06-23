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
        $this->getApiClient()->sendCommand($this->getContext().'/archive');
    }

    public function unarchive()
    {
        $this->getApiClient()->sendCommand($this->getContext().'/unarchive');
    }

    public function trash()
    {
        $this->getApiClient()->sendCommand($this->getContext().'/trash');
    }

    public function untrash()
    {
        $this->getApiClient()->sendCommand($this->getContext().'/untrash');
    }
}