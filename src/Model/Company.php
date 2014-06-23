<?php

namespace Terminal42\ActiveCollabApi\Model;

use Terminal42\ActiveCollabApi\Command\State;
use Terminal42\ActiveCollabApi\Command\StateInterface;
use Terminal42\ActiveCollabApi\Repository\Companies;

/**
 * Class Company
 *
 * @property int    $id
 * @property string $name
 * @property string $office_address
 * @property string $office_phone
 * @property string $office_fax
 * @property string $office_homepage
 * @property string $note
 */
class Company extends AbstractModel implements StateInterface
{
    /**
     * @var Companies
     */
    protected $repository;

    /**
     * Get state commands for this company
     * @return State
     */
    public function state()
    {
        $state = new State($this->repository->getApiClient());
        $state->setContext('people/'.$this->id);

        return $state;
    }
}