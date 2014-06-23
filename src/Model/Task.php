<?php

namespace Terminal42\ActiveCollabApi\Model;

use Terminal42\ActiveCollabApi\Repository\Attachments;
use Terminal42\ActiveCollabApi\Repository\Comments;
use Terminal42\ActiveCollabApi\Repository\Tasks;
use Terminal42\ActiveCollabApi\Command\CompletionStatus;
use Terminal42\ActiveCollabApi\Command\CompletionStatusInterface;
use Terminal42\ActiveCollabApi\Command\State;
use Terminal42\ActiveCollabApi\Command\StateInterface;

/**
 * Class Task
 *
 * @property int $id
 * @property string $name The Task name is a required field when creating a Task.
 * @property string $body The Task description.
 * @property int $visibility Object visibility. 0 is private and 1 is the value of normal visibility.
 * @property int $category_id Object category.
 * @property int $label_id Object label.
 * @property int $milestone_id ID of the parent Milestone.
 * @property int $priority The priority can have one of five integer values, ranging from -2 (lowest) to 2 (highest). 0 marks normal.
 * @property int $assignee_id The user assigned and responsible for the Task.
 * @property array $other_assignees The people assigned to the Task.
 * @property \DateTime $due_on The task due date.
 * @property int $created_by_id Use for a known user who already has an account in the system.
 * @property string $created_by_name Use for anonymous user, who don't have an account in the system (can not be used with created_by_id).
 * @property string $created_by_email Used for anonymous users.
 */
class Task extends AbstractModel implements StateInterface, CompletionStatusInterface
{
    /**
     * @var Tasks
     */
    protected $repository;

    /**
     * Get comments repository for this task
     * @return Comments
     */
    public function comments()
    {
        $comments = new Comments($this->repository->getApiClient());
        $comments->setContext($this->getContext());

        return $comments;
    }

    /**
     * Get attachments repository for this task
     * @return Attachments
     */
    public function attachments()
    {
        $attachments = new Attachments($this->repository->getApiClient());
        $attachments->setContext($this->getContext());

        return $attachments;
    }

    /**
     * Get state commands for this task
     * @return State
     */
    public function state()
    {
        $state = new State($this->repository->getApiClient());
        $state->setContext($this->getContext());

        return $state;
    }

    /**
     * Get completion status commands for this task
     * @return CompletionStatus
     */
    public function completionStatus()
    {
        $completion = new CompletionStatus($this->repository->getApiClient());
        $completion->setContext($this->getContext());

        return $completion;
    }

    /**
     * Get context for this task
     * @return string
     */
    protected function getContext()
    {
        return 'projects/'.$this->repository->getProjectId().'/tasks/'.$this->id;
    }
}