<?php

namespace Terminal42\ActiveCollabApi\Repository;

use Terminal42\ActiveCollabApi\Model\Comment;

class Comments extends AbstractRepository
{
    use ContextAwareTrait;

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

    /**
     * Find a comment by ID
     * @param int $id
     * @return Comment
     */
    public function findById($id)
    {
        return new Comment(
            $this->getApiClient()->get($this->getContext() . '/comments/' . $id),
            $this
        );
    }

    /**
     * Add a new comment
     * @param Comment $comment
     * @return Comment
     */
    public function create(Comment $comment)
    {
        $result = $this->getApiClient()->post(
            $this->getContext() . '/comments/add',
            $this->getPostData($comment)
        );

        return new Comment($result, $this);
    }

    /**
     * Update comment
     * @param Comment $comment
     * @return Comment
     */
    public function update(Comment $comment)
    {
        $result = $this->getApiClient()->post(
            $this->getContext() . '/comments/' . $comment->id . '/edit',
            $this->getPostData($comment)
        );

        return new Comment($result, $this);
    }

    /**
     * Lock comments for current context
     */
    public function lock()
    {
        $this->getApiClient()->post($this->getContext() . '/comments/lock');
    }

    /**
     * Unlock comments for current context
     */
    public function unlock()
    {
        $this->getApiClient()->post($this->getContext() . '/comments/unlock');
    }

    /**
     * Validate and prepare comment properties for POST
     * @param Comment $comment
     * @return array
     */
    protected function getPostData(Comment $comment)
    {
        return $this->compilePostFields($comment, [
            'body' => 'string',
        ]);
    }
}