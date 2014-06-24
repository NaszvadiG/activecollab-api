<?php

namespace Terminal42\ActiveCollabApi\Repository;

use Terminal42\ActiveCollabApi\Model\Notebook;

class Notebooks extends AbstractRepository
{
    use ProjectAwareTrait;

    /**
     * Get all notebooks on the project
     * @return Notebook[]
     */
    public function findAll()
    {
        $notebooks = array();
        $records = $this->getApiClient()->get($this->getContext() . '/notebooks');

        foreach ($records as $data) {
            $notebooks[] = new Notebook($data, $this);
        }

        return $notebooks;
    }

    /**
     * Get archived notebooks on the project
     * @return Notebook[]
     */
    public function findArchived()
    {
        $notebooks = array();
        $records = $this->getApiClient()->get($this->getContext() . '/notebooks/archive');

        foreach ($records as $data) {
            $notebooks[] = new Notebook($data, $this);
        }

        return $notebooks;
    }

    /**
     * Find a notebook by ID
     * @param int $id
     * @return Notebook
     */
    public function findById($id)
    {
        return new Notebook(
            $this->getApiClient()->get($this->getContext() . '/notebooks/' . $id),
            $this
        );
    }

    /**
     * Add a new notebook to the project
     * @param Notebook $notebook
     * @return Notebook
     */
    public function create(Notebook $notebook)
    {
        $result = $this->getApiClient()->post(
            $this->getContext().'/notebooks/add',
            $this->getPostData($notebook)
        );

        return new Notebook($result, $this);
    }

    /**
     * Update notebook on the project
     * @param Notebook $notebook
     * @return Notebook
     */
    public function update(Notebook $notebook)
    {
        $result = $this->getApiClient()->post(
            $this->getContext().'/notebooks/'.$notebook->id.'/edit',
            $this->getPostData($notebook)
        );

        return new Notebook($result, $this);
    }

    /**
     * Validate and prepare notebook properties for POST
     * @param Notebook $notebook
     * @return array
     */
    protected function getPostData(Notebook $notebook)
    {
        return $this->compilePostFields($notebook, [
            'name'         => 'string',
            'body'         => 'text',
            'visibility'   => 'integer',
            'milestone_id' => 'integer'
        ]);
    }
}