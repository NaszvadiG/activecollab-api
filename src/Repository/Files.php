<?php

namespace Terminal42\ActiveCollabApi\Repository;

use Terminal42\ActiveCollabApi\Model\File;

class Files extends AbstractRepository
{
    use ProjectAwareTrait;

    /**
     * Get all files on the project
     * @return File[]
     */
    public function findAll()
    {
        $files = array();
        $records = $this->getApiClient()->get($this->getContext() . '/files/files');

        foreach ($records as $data) {
            $files[] = new File($data, $this);
        }

        return $files;
    }

    /**
     * Get archived files on the project
     * @return File[]
     */
    public function findArchived()
    {
        $files = array();
        $records = $this->getApiClient()->get($this->getContext() . '/files/archive');

        foreach ($records as $data) {
            $files[] = new File($data, $this);
        }

        return $files;
    }

    /**
     * Find a file by ID
     * @param int $id
     * @return File
     */
    public function findById($id)
    {
        return new File(
            $this->getApiClient()->get($this->getContext() . '/files/files/' . $id),
            $this
        );
    }
}