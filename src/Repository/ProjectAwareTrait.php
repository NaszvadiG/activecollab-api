<?php

namespace Terminal42\ActiveCollabApi\Repository;

trait ProjectAwareTrait
{
    use ContextAwareTrait;

    /**
     * Set project ID or slug
     * @param string $id_or_slug
     * @return $this
     */
    public function setProjectId($id_or_slug)
    {
        return $this->setContext('projects/'.$id_or_slug);
    }
}