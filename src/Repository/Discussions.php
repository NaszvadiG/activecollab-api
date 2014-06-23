<?php

namespace Terminal42\ActiveCollabApi\Repository;

use Terminal42\ActiveCollabApi\Model\Discussion;

class Discussions extends AbstractRepository
{
    use ProjectAwareTrait;

    /**
     * Get all discussions on the project
     * @return Discussion[]
     */
    public function findAll()
    {
        $discussions = array();
        $records = $this->getApiClient()->get($this->getContext() . '/discussions');

        foreach ($records as $data) {
            $discussions[] = new Discussion($data, $this);
        }

        return $discussions;
    }

    /**
     * Get archived discussions on the project
     * @return Discussion[]
     */
    public function findArchived()
    {
        $discussions = array();
        $records = $this->getApiClient()->get($this->getContext() . '/discussions/archive');

        foreach ($records as $data) {
            $discussions[] = new Discussion($data, $this);
        }

        return $discussions;
    }
}