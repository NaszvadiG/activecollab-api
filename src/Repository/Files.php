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
}