<?php

namespace Terminal42\ActiveCollabApi\Model;

use Terminal42\ActiveCollabApi\Repository\Comments;

/**
 * Class Comment
 * @property int $id
 * @property string $body
 * @method Comments getRepository()
 */
class Comment extends AbstractModel
{
    public function attachments()
    {
        return $this->getRepository()->getApiClient()->attachmentsForContext($this->getRepository()->getContext());
    }
}