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
        $records = $this->getApiClient()->get($this->getContext() . '/milestones');

        foreach ($records as $data) {
            $milestones[] = new Milestone($data, $this);
        }

        return $milestones;
    }

    /**
     * Get archived milestones on the project
     * @return Milestone[]
     */
    public function findArchived()
    {
        $milestones = array();
        $records = $this->getApiClient()->get($this->getContext() . '/milestones/archive');

        foreach ($records as $data) {
            $milestones[] = new Milestone($data, $this);
        }

        return $milestones;
    }

    /**
     * Find a milestone by ID
     * @param int $id
     * @return Milestone
     */
    public function findById($id)
    {
        return new Milestone(
            $this->getApiClient()->get($this->getContext() . '/milestones/' . $id),
            $this
        );
    }

    /**
     * Add a new milestone to the project
     * @param Milestone $milestone
     * @return Milestone
     */
    public function create(Milestone $milestone)
    {
        $result = $this->getApiClient()->post(
            $this->getContext().'/milestones/add',
            $this->getPostData($milestone)
        );

        return new Milestone($result, $this);
    }

    /**
     * Update milestone on the project
     * @param Milestone $milestone
     * @return Milestone
     */
    public function update(Milestone $milestone)
    {
        $result = $this->getApiClient()->post(
            $this->getContext().'/milestones/'.$milestone->id.'/edit',
            $this->getPostData($milestone)
        );

        return new Milestone($result, $this);
    }

    /**
     * Validate and prepare milestone properties for POST
     * @param Milestone $milestone
     * @return array
     */
    protected function getPostData(Milestone $milestone)
    {
        return $this->compilePostFields($milestone, [
            'name'            => 'string',
            'body'            => 'text',
            'start_on'        => 'date',
            'due_on'          => 'date',
            'priority'        => 'integer',
            'assignee_id'     => 'integer',
            'other_assignees' => 'array'
        ]);
    }
}