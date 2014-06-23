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
        $records = $this->getApiClient()->get($this->getContext().'/users');

        foreach ($records as $data) {
            $users[] = new User($data, $this);
        }

        return $users;
    }

    /**
     * Find archived users in company
     * @return User[]
     */
    public function findArchived()
    {
        $users = array();
        $records = $this->getApiClient()->get($this->getContext().'/users/archive');

        foreach ($records as $data) {
            $users[] = new User($data, $this);
        }

        return $users;
    }

    /**
     * Find user by ID
     * @param int $id
     * @return User
     */
    public function findById($id)
    {
        return new User(
            $this->getApiClient()->get($this->getContext() . '/users/' . $id),
            $this
        );
    }

    /**
     * Add a new user
     * @param User $user
     * @return User
     */
    public function create(User $user)
    {
        $result = $this->getApiClient()->post(
            $this->getContext().'/add-user',
            $this->getPostData($user)
        );

        return new User($result, $this);
    }

    /**
     * Update user
     * @param User $user
     * @return User
     */
    public function update(User $user)
    {
        $result = $this->getApiClient()->post(
            $this->getContext().'/users/'.$user->id.'/edit-profile',
            $this->getPostData($user)
        );

        return new User($result, $this);
    }

    /**
     * Validate and prepare user properties for POST
     * @param User $user
     * @return array
     */
    protected function getPostData(User $user)
    {
        return $this->compilePostFields($user, [
            'email'        => 'string',
            'password'     => 'string',
            'password_a'   => 'string',
            'first_name'   => 'string',
            'last_name'    => 'string',
            'type'         => 'string',
            'title'        => 'string',
            'phone_mobile' => 'string',
            'phone_work'   => 'string',
        ]);
    }
}