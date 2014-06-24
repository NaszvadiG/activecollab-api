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

    /**
     * Find a text document by ID
     * @param int $id
     * @return TextDocument
     */
    public function findById($id)
    {
        return new TextDocument(
            $this->getApiClient()->get($this->getContext() . '/text-documents/' . $id),
            $this
        );
    }

    /**
     * Add a new text document to the project
     * @param TextDocument $document
     * @return TextDocument
     */
    public function create(TextDocument $document)
    {
        $result = $this->getApiClient()->post(
            $this->getContext().'/text-documents/add',
            $this->getPostData($document)
        );

        return new TextDocument($result, $this);
    }

    /**
     * Update text document on the project
     * @param TextDocument $document
     * @return TextDocument
     */
    public function update(TextDocument $document)
    {
        $result = $this->getApiClient()->post(
            $this->getContext().'/text-documents/'.$document->id.'/edit',
            $this->getPostData($document)
        );

        return new TextDocument($result, $this);
    }

    /**
     * Validate and prepare text document properties for POST
     * @param TextDocument $document
     * @return array
     */
    protected function getPostData(TextDocument $document)
    {
        return $this->compilePostFields($document, [
            'name'         => 'string',
            'body'         => 'text',
            'visibility'   => 'integer',
            'milestone_id' => 'integer',
            'category_id'  => 'integer'
        ]);
    }
}