<?php

namespace Terminal42\ActiveCollabApi\Model;

use Terminal42\ActiveCollabApi\Command\State;
use Terminal42\ActiveCollabApi\Command\StateInterface;
use Terminal42\ActiveCollabApi\Repository\Files;

/**
 * Class File
 * @property int $id
 */
class File extends AbstractModel implements StateInterface
{
    use ProjectObjectTrait;

    /**
     * @var Files
     */
    protected $repository;

    /**
     * Get state commands for this notebook
     * @return State
     */
    public function state()
    {
        $state = new State($this->repository->getApiClient());
        $state->setContext($this->getContext());

        return $state;
    }

    /**
     * Get context for this notebook
     * @return string
     */
    protected function getContext()
    {
        return $this->repository->getContext().'/files/files/'.$this->id;
    }
}