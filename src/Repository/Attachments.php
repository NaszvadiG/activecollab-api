<?php

namespace Terminal42\ActiveCollabApi\Repository;

use Terminal42\ActiveCollabApi\Model\Attachment;

class Attachments extends AbstractRepository
{
    use ContextAwareTrait;

    /**
     * Get all attachments for current context
     * @return Attachment[]
     */
    public function findAll()
    {
        $attachments = array();
        $records = $this->getApiClient()->get($this->getContext() . '/attachments');

        foreach ($records as $data) {
            $attachments[] = new Attachment($data, $this);
        }

        return $attachments;
    }

    // @todo implement {context}/attachments/:attachment_id
}