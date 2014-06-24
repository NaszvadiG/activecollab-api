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

    // @todo implement projects/:project_id/files/files/upload

    /**
     * Update file on the project
     * @param File $file
     * @return File
     */
    public function update(File $file)
    {
        $result = $this->getApiClient()->post(
            $this->getContext().'/milestones/'.$file->id.'/edit',
            $this->getPostData($file)
        );

        return new File($result, $this);
    }

    /**
     * Validate and prepare file properties for POST
     * @param File $file
     * @return array
     */
    protected function getPostData(File $file)
    {
        return $this->compilePostFields($file, [
            'name'            => 'string',
        ]);
    }
}