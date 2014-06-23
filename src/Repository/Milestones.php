<?php

namespace Terminal42\ActiveCollabApi\Repository;

use Terminal42\ActiveCollabApi\Model\Milestone;

class Milestones extends AbstractRepository
{
    use ProjectAwareTrait;

    /**
     * Get all milestones on the project
     * @return Milestone[]
     */
    public function findAll()
    {
        $milestones = array();
        $records = $this->getApiClient()->get($this->getProjectContext() . '/milestones');

        foreach ($records as $data) {
            $milestones[] = new Milestone($data, $this);
        }

        return $milestones;
    }
}