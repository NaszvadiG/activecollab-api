<?php

namespace Terminal42\ActiveCollabApi\Repository;

trait ProjectAwareTrait
{
    /**
     * @var string
     */
    protected $project_id = '';

    /**
     * Get project ID or slug
     * @return string
     */
    public function getProjectId()
    {
        return $this->project_id;
    }

    /**
     * Get context URL for project
     * @return string
     */
    public function getProjectContext()
    {
        return 'projects/'.$this->project_id;
    }

    /**
     * Set project ID or slug
     * @param string $id_or_slug
     * @return $this
     */
    public function setProjectId($id_or_slug)
    {
        $this->project_id = (string) $id_or_slug;

        return $this;
    }
}