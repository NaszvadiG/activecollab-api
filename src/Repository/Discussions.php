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
        $records = $this->getApiClient()->sendCommand($this->getProjectContext() . '/discussions');

        foreach ($records as $data) {
            $discussions[] = new Discussion($data, $this);
        }

        return $discussions;
    }
}