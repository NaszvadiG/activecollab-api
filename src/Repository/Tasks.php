<?php

namespace Terminal42\ActiveCollabApi\Repository;

use Terminal42\ActiveCollabApi\Model\Task;

class Tasks extends AbstractRepository
{
    use ProjectAwareTrait;

    /**
     * Get all tasks on the project
     * @return Task[]
     */
    public function findAll()
    {
        $tasks = array();
        $records = $this->getApiClient()->sendCommand($this->getProjectContext() . '/tasks');

        foreach ($records as $data) {
            $tasks[] = new Task($data, $this);
        }

        return $tasks;
    }

    /**
     * Find a task by task ID (not the ProjectObject ID!)
     * @param int $id
     * @return Task
     */
    public function findByTaskId($id)
    {
        return new Task(
            $this->getApiClient()->sendCommand($this->getProjectContext() . '/tasks/' . $id),
            $this
        );
    }
}