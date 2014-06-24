<?php

namespace Terminal42\ActiveCollabApi\Repository;

use Terminal42\ActiveCollabApi\Model\Comment;

class Comments extends AbstractRepository
{
    use ContextAwareTrait;

    public function lock()
    {
        $this->getApiClient()->get($this->context.'/comments/lock');
    }

    public function unlock()
    {
        $this->getApiClient()->get($this->context.'/comments/unlock');
    }

    /**
     * Get all comments for current context
     * @return Comment[]
     */
    public function findAll()
    {
        $comments = array();
        $records = $this->getApiClient()->get($this->getContext() . '/comments');

        foreach ($records as $data) {
            $comments[] = new Comment($data, $this);
        }

        return $comments;
    }
}