<?php

namespace Terminal42\ActiveCollabApi\Model;

use Terminal42\ActiveCollabApi\Command\State;
use Terminal42\ActiveCollabApi\Command\StateInterface;
use Terminal42\ActiveCollabApi\Repository\Discussions;

/**
 * Class Discussion
 * @property int $id
 */
class Discussion extends AbstractModel implements StateInterface
{
    use ProjectObjectTrait;

    /**
     * @var Discussions
     */
    protected $repository;


    /**
     * Get state commands for this discussion
     * @return State
     */
    public function state()
    {
        $state = new State($this->repository->getApiClient());
        $state->setContext($this->getContext());

        return $state;
    }

    /**
     * Get context for this discussion
     * @return string
     */
    protected function getContext()
    {
        return $this->repository->getContext().'/discussions/'.$this->id;
    }
}