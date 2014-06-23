<?php

namespace Terminal42\ActiveCollabApi\Model;

use Terminal42\ActiveCollabApi\Command\State;
use Terminal42\ActiveCollabApi\Command\StateInterface;
use Terminal42\ActiveCollabApi\Repository\TextDocuments;

class TextDocument extends AbstractModel implements StateInterface
{
    /**
     * @var TextDocuments
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
        return 'projects/'.$this->repository->getProjectId().'/files/text-documents/'.$this->id;
    }
}