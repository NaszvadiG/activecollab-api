<?php

namespace Terminal42\ActiveCollabApi\Model;

use Terminal42\ActiveCollabApi\Command\State;
use Terminal42\ActiveCollabApi\Command\StateInterface;
use Terminal42\ActiveCollabApi\Repository\Users;

/**
 * Class User
 *
 * @property int    $id
 * @property string $email
 * @property string $password
 * @property string $password_a
 * @property string $first_name
 * @property string $last_name
 * @property string $type
 * @property string $title
 * @property string $phone_mobile
 * @property string $phone_work
 */
class User extends AbstractModel implements StateInterface
{
    /**
     * @var Users
     */
    protected $repository;

    /**
     * Get state commands for this user
     * @return State
     */
    public function state()
    {
        $state = new State($this->repository->getApiClient());
        $state->setContext($this->repository->getContext().'/users/'.$this->id);

        return $state;
    }
}