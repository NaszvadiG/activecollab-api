<?php

namespace Terminal42\ActiveCollabApi\Model;

use Terminal42\ActiveCollabApi\Command\State;
use Terminal42\ActiveCollabApi\Command\StateInterface;
use Terminal42\ActiveCollabApi\Repository\Projects;

/**
 * Class Project
 * @property int $id
 * @property string $slug
 * @property string $name The project name.
 * @property string $permalink
 * @property \DateTime $created_on
 * @property int $created_by_id
 * @property \Terminal42\ActiveCollabApi\Model\User $created_by
 * @property \DateTime $updated_on
 * @property int $updated_by_id
 * @property \Terminal42\ActiveCollabApi\Model\User $updated_by
 * @property int $state
 * @property int $is_completed
 * @property int $category_id
 * @property \Terminal42\ActiveCollabApi\Model\Category $category
 * @property int $label_id
 * @property $label
 * @property $is_favorite
 * @property int $company_id
 * @property int $leader_id
 * @property $currency
 * @property $budget
 * @property $progress
 * @property \Terminal42\ActiveCollabApi\Model\User $leader
 * @property \Terminal42\ActiveCollabApi\Model\Company $company
 */
class Project extends AbstractModel implements StateInterface
{
    /**
     * @var Projects
     */
    protected $repository;

    /**
     * Get tasks repository for project
     * @return \Terminal42\ActiveCollabApi\Repository\Tasks
     */
    public function tasks()
    {
        return $this->repository->getApiClient()->tasksForProject($this->id);
    }

    /**
     * Get discussions repository for project
     * @return \Terminal42\ActiveCollabApi\Repository\Discussions
     */
    public function discussions()
    {
        return $this->repository->getApiClient()->discussionsForProject($this->id);
    }

    /**
     * Get notebooks repository for project
     * @return \Terminal42\ActiveCollabApi\Repository\Notebooks
     */
    public function notebooks()
    {
        return $this->repository->getApiClient()->notebooksForProject($this->id);
    }

    /**
     * Get milestones repository for project
     * @return \Terminal42\ActiveCollabApi\Repository\Milestones
     */
    public function milestones()
    {
        return $this->repository->getApiClient()->milestonesForProject($this->id);
    }

    /**
     * Get files repository for project
     * @return \Terminal42\ActiveCollabApi\Repository\Files
     */
    public function files()
    {
        return $this->repository->getApiClient()->filesForProject($this->id);
    }

    /**
     * Get text documents repository for project
     * @return \Terminal42\ActiveCollabApi\Repository\TextDocuments
     */
    public function textDocuments()
    {
        return $this->repository->getApiClient()->textDocumentsForProject($this->id);
    }

    /**
     * Get categories repository for project
     * @return \Terminal42\ActiveCollabApi\Repository\Categories
     */
    public function categories()
    {
        return $this->repository->getApiClient()->categoriesForContext($this->getContext());
    }

    /**
     * Get state command for project
     * @return State
     */
    public function state()
    {
        $state = new State($this->repository->getApiClient());
        $state->setContext($this->getContext());

        return $state;
    }

    /**
     * Get project context
     * @return string
     */
    protected function getContext()
    {
        return 'projects/'.$this->id;
    }
}
