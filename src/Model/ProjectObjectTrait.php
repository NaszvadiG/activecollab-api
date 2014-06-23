<?php

namespace Terminal42\ActiveCollabApi\Model;

use Terminal42\ActiveCollabApi\Repository\ContextAwareTrait;

trait ProjectObjectTrait
{
    use RepositoryAwareTrait;

    public function copyToProject($id)
    {
        $this->getRepository()->getApiClient()->post(
            $this->getRepository()->getContext().'/copy-to-project',
            ['copy_to_project_id' => $id]
        );
    }

    public function moveToProject($id)
    {
        $this->getRepository()->getApiClient()->post(
            $this->getContext().'/move-to-project',
            ['move_to_project_id' => $id]
        );
    }
} 