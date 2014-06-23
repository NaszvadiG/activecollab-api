<?php

namespace Terminal42\ActiveCollabApi\Model;

use Terminal42\ActiveCollabApi\Command\State;
use Terminal42\ActiveCollabApi\Command\StateInterface;
use Terminal42\ActiveCollabApi\Repository\Milestones;

/**
 * Class Milestone
 * @property int $id
 */
class Milestone extends AbstractModel implements StateInterface
{
    use ProjectObjectTrait;

    /**
     * @var Milestones
     */
    protected $repository;


    /**
     * Get state command for this milestone
     * @return State
     */
    public function state()
    {
        $state = new State($this->repository->getApiClient());
        $state->setContext($this->getContext());

        return $state;
    }

    /**
     * Get context for this milestone
     * @return string
     */
    protected function getContext()
    {
        return 'projects/'.$this->repository->getProjectId().'/milestones/'.$this->id;
    }
}