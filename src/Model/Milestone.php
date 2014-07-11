<?php

namespace Terminal42\ActiveCollabApi\Model;

use Terminal42\ActiveCollabApi\Command\State;
use Terminal42\ActiveCollabApi\Command\StateInterface;
use Terminal42\ActiveCollabApi\Repository\Milestones;

/**
 * Class Milestone
 * @property int $id
 * @method Milestones getRepository()
 */
class Milestone extends AbstractModel implements StateInterface
{
    use ProjectObjectTrait;

    /**
     * Get state command for this milestone
     * @return State
     */
    public function state()
    {
        $state = new State($this->getRepository()->getApiClient());
        $state->setContext($this->getContext());

        return $state;
    }

    /**
     * Get context for this milestone
     * @return string
     */
    protected function getContext()
    {
        return $this->getRepository()->getContext().'/milestones/'.$this->id;
    }
}