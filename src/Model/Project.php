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
 * @property \Terminal42\ActiveCollabApi\Model\User\User $created_by
 * @property \DateTime $updated_on
 * @property int $updated_by_id
 * @property \Terminal42\ActiveCollabApi\Model\User\User $updated_by
 * @property int $state
 * @property int $is_completed
 * @property int $category_id
 * @property \Terminal42\ActiveCollabApi\Model\Category\Category $category
 * @property int $label_id
 * @property $label
 * @property $is_favorite
 * @property int $company_id
 * @property int $leader_id
 * @property $currency
 * @property $budget
 * @property $progress
 * @property \Terminal42\ActiveCollabApi\Model\User\User $leader
 * @property \Terminal42\ActiveCollabApi\Model\Company\Company $company
 */
class Project extends AbstractModel implements StateInterface
{
    /**
     * @var Projects
     */
    protected $repository;


    public function tasks()
    {
        return $this->repository->getApiClient()->tasksForProject($this->id);
    }

    public function state()
    {
        $state = new State($this->repository->getApiClient());
        $state->setContext('projects/'.$this->id);

        return $state;
    }
}
