<?php

namespace Terminal42\ActiveCollabApi\Repository;

use Terminal42\ActiveCollabApi\Model\TextDocument;

class TextDocuments extends AbstractRepository
{
    use ProjectAwareTrait;

    /**
     * Get all text documents on the project
     * @return TextDocument[]
     */
    public function findAll()
    {
        $documents = array();
        $records = $this->getApiClient()->get($this->getContext() . '/files/text-documents');

        foreach ($records as $data) {
            $documents[] = new TextDocument($data, $this);
        }

        return $documents;
    }
}