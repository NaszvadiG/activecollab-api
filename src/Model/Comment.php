<?php

namespace Terminal42\ActiveCollabApi\Model;

use Terminal42\ActiveCollabApi\Repository\Comments;

/**
 * Class Comment
 * @property int $id
 * @property string $body
 */
class Comment extends AbstractModel
{
    /**
     * @var Comments
     */
    protected $repository;


    public function attachments()
    {
        return $this->repository->getApiClient()->attachmentsForContext($this->repository->getContext());
    }
}