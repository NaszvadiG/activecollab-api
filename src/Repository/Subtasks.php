<?php

namespace Terminal42\ActiveCollabApi\Repository;

use Terminal42\ActiveCollabApi\Model\Subtask;

class Subtasks extends AbstractRepository
{
    use ContextAwareTrait;

    /**
     * Get all discussions on the project
     * @return Subtask[]
     */
    public function findAll()
    {
        $subtasks = array();
        $records = $this->getApiClient()->get($this->getContext() . '/subtasks');

        foreach ($records as $data) {
            $subtasks[] = new Subtask($data, $this);
        }

        return $subtasks;
    }
}