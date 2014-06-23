<?php

namespace Terminal42\ActiveCollabApi\Repository;

use Terminal42\ActiveCollabApi\Model\Project;

class Projects extends AbstractRepository
{

    /**
     * Find all active projects
     * @return Project[]
     */
    public function findAll()
    {
        $projects = array();
        $records = $this->getApiClient()->get('projects');

        foreach ($records as $data) {
            $projects[] = new Project($data, $this);
        }

        return $projects;
    }

    /**
     * Find all archived projects
     * @return Project[]
     */
    public function findArchived()
    {
        $projects = array();
        $records = $this->getApiClient()->get('projects/archive');

        foreach ($records as $data) {
            $projects[] = new Project($data, $this);
        }

        return $projects;
    }

    /**
     * Find a project by ID or slug
     * @param $id
     * @return Project
     */
    public function findByIdOrSlug($id)
    {
        return new Project(
            $this->getApiClient()->get('projects/'.$id),
            $this
        );
    }
}
