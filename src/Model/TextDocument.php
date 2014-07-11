<?php

namespace Terminal42\ActiveCollabApi\Model;

use Terminal42\ActiveCollabApi\Command\State;
use Terminal42\ActiveCollabApi\Command\StateInterface;
use Terminal42\ActiveCollabApi\Repository\TextDocuments;

/**
 * Class TextDocument
 * @property int $id
 * @method TextDocuments getRepository()
 */
class TextDocument extends AbstractModel implements StateInterface
{
    use ProjectObjectTrait;

    /**
     * Get state commands for this notebook
     * @return State
     */
    public function state()
    {
        $state = new State($this->getRepository()->getApiClient());
        $state->setContext($this->getContext());

        return $state;
    }

    /**
     * Get context for this notebook
     * @return string
     */
    protected function getContext()
    {
        return $this->getRepository()->getContext().'/files/text-documents/'.$this->id;
    }
}