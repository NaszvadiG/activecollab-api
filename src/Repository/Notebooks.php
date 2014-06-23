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
}