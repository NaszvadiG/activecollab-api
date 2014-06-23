<?php

namespace Terminal42\ActiveCollabApi\Model;

trait ProjectObjectTrait
{
    use RepositoryAwareTrait;

    /**
     * Copy a project object to a specific project
     * @param int $id
     */
    public function copyToProject($id)
    {
        $this->getRepository()->getApiClient()->post(
            $this->getRepository()->getContext().'/copy-to-project',
            ['copy_to_project_id' => $id]
        );
    }

    /**
     * Move project object to a specific project
     * @param int $id
     */
    public function moveToProject($id)
    {
        $this->getRepository()->getApiClient()->post(
            $this->getContext().'/move-to-project',
            ['move_to_project_id' => $id]
        );
    }
} 