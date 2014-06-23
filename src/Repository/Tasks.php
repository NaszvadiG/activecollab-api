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
        $records = $this->getApiClient()->get($this->getContext() . '/tasks');

        foreach ($records as $data) {
            $tasks[] = new Task($data, $this);
        }

        return $tasks;
    }

    /**
     * Get archived tasks on the project
     * @return Task[]
     */
    public function findArchived()
    {
        $tasks = array();
        $records = $this->getApiClient()->get($this->getContext() . '/tasks/archive');

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
            $this->getApiClient()->get($this->getContext() . '/tasks/' . $id),
            $this
        );
    }

    /**
     * Add a new task to the project
     * @param Task $task
     * @return Task
     */
    public function create(Task $task)
    {
        $result = $this->getApiClient()->post(
            $this->getContext().'/tasks/add',
            $this->getPostData($task)
        );

        return new Task($result, $this);
    }

    /**
     * Update task on the project
     * @param Task $task
     * @return Task
     */
    public function update(Task $task)
    {
        $result = $this->getApiClient()->post(
            $this->getContext().'/tasks/'.$task->id.'/edit',
            $this->getPostData($task)
        );

        return new Task($result, $this);
    }

    /**
     * Validate and prepare task properties for POST
     * @param Task $task
     * @return array
     */
    protected function getPostData(Task $task)
    {
        return $this->compilePostFields($task, [
            'name'             => 'string',
            'body'             => 'text',
            'visibility'       => 'integer',
            'category_id'      => 'integer',
            'label_id'         => 'integer',
            'milestone_id'     => 'integer',
            'priority'         => 'integer',
            'assignee_id'      => 'integer',
//            'other_assignees'  => 'array', @todo we don't know what the array looks like
            'due_on'           => 'date',
            'created_by_id'    => 'integer',
            'created_by_name'  => 'string',
            'created_by_email' => 'string'
        ]);
    }
}