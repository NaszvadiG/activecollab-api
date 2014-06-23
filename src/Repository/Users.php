<?php

namespace Terminal42\ActiveCollabApi\Repository;

use Terminal42\ActiveCollabApi\Model\User;

class Users extends AbstractRepository
{
    use CompanyAwareTrait;

    /**
     * Get all users in company
     * @return User[]
     */
    public function findAll()
    {
        $users = array();
        $records = $this->getApiClient()->sendCommand($this->getCompanyContext().'/users');

        foreach ($records as $data) {
            $users[] = new User($data, $this);
        }

        return $users;
    }
}