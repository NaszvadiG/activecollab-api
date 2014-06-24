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

    /**
     * Find a discussion by ID
     * @param int $id
     * @return Discussion
     */
    public function findById($id)
    {
        return new Discussion(
            $this->getApiClient()->get($this->getContext() . '/discussions/' . $id),
            $this
        );
    }

    /**
     * Add a new discussion to the project
     * @param Discussion $discussion
     * @return Discussion
     */
    public function create(Discussion $discussion)
    {
        $result = $this->getApiClient()->post(
            $this->getContext().'/discussions/add',
            $this->getPostData($discussion)
        );

        return new Discussion($result, $this);
    }

    /**
     * Update discussion on the project
     * @param Discussion $discussion
     * @return Discussion
     */
    public function update(Discussion $discussion)
    {
        $result = $this->getApiClient()->post(
            $this->getContext().'/discussions/'.$discussion->id.'/edit',
            $this->getPostData($discussion)
        );

        return new Discussion($result, $this);
    }

    /**
     * Validate and prepare discussion properties for POST
     * @param Discussion $discussion
     * @return array
     */
    protected function getPostData(Discussion $discussion)
    {
        // @todo validate discussion properties
        return $this->compilePostFields($discussion, [
            'name'         => 'string',
            'body'         => 'string',
            'category_id'  => 'integer',
            'visibility'   => 'integer',
            'milestone_id' => 'integer'
        ]);
    }
}