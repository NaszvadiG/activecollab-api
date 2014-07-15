<?php

namespace Terminal42\ActiveCollabApi\Model;

use Terminal42\ActiveCollabApi\Command\CompletionStatus;
use Terminal42\ActiveCollabApi\Command\CompletionStatusInterface;
use Terminal42\ActiveCollabApi\Command\State;
use Terminal42\ActiveCollabApi\Command\StateInterface;
use Terminal42\ActiveCollabApi\Command\Subscription;
use Terminal42\ActiveCollabApi\Command\SubscriptionInterface;
use Terminal42\ActiveCollabApi\Repository\Attachments;
use Terminal42\ActiveCollabApi\Repository\AttachmentsInterface;
use Terminal42\ActiveCollabApi\Repository\Categories;
use Terminal42\ActiveCollabApi\Repository\CategoriesInterface;
use Terminal42\ActiveCollabApi\Repository\Comments;
use Terminal42\ActiveCollabApi\Repository\CommentsInterface;
use Terminal42\ActiveCollabApi\Repository\Reminders;
use Terminal42\ActiveCollabApi\Repository\RemindersInterface;
use Terminal42\ActiveCollabApi\Repository\Subtasks;
use Terminal42\ActiveCollabApi\Repository\Tasks;

/**
 * Class Task
 * *
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
 *
 * @property-read int $id
 * @property-read string $task_id
 * @property-read array $created_by
 *
 * @property-write string $created_by_name Use for anonymous user, who don't have an account in the system (can not be used with created_by_id).
 * @property-write string $created_by_email Used for anonymous users.
 *
 * @method Tasks getRepository()
 */
class Task extends AbstractModel implements
    CategoriesInterface,
    AttachmentsInterface,
    CommentsInterface,
    RemindersInterface,
    SubscriptionInterface,
    CompletionStatusInterface,
    StateInterface
{
    use ProjectObjectTrait;

    /**
     * Get subtasks repository for this task
     * @return Subtasks
     */
    public function subtasks()
    {
        $subtasks = new Subtasks($this->getRepository()->getApiClient());
        $subtasks->setContext($this->getContext());

        return $subtasks;
    }

    /**
     * Get categories repository for this task
     * @return Categories
     */
    public function categories()
    {
        $categories = new Categories($this->getRepository()->getApiClient());
        $categories->setContext($this->getContext());

        return $categories;
    }

    /**
     * Get attachments repository for this task
     * @return Attachments
     */
    public function attachments()
    {
        $attachments = new Attachments($this->getRepository()->getApiClient());
        $attachments->setContext($this->getContext());

        return $attachments;
    }

    /**
     * Get comments repository for this task
     * @return Comments
     */
    public function comments()
    {
        $comments = new Comments($this->getRepository()->getApiClient());
        $comments->setContext($this->getContext());

        return $comments;
    }

    /**
     * Get reminders repository for this task
     * @return Reminders
     */
    public function reminders()
    {
        $categories = new Reminders($this->getRepository()->getApiClient());
        $categories->setContext($this->getContext());

        return $categories;
    }

    /**
     * Get subscription commands for this task
     * @return Subscription
     */
    public function subscription()
    {
        $subscription = new Subscription($this->getRepository()->getApiClient());
        $subscription->setContext($this->getContext());

        return $subscription;
    }

    /**
     * Get completion status commands for this task
     * @return CompletionStatus
     */
    public function completionStatus()
    {
        $completion = new CompletionStatus($this->getRepository()->getApiClient());
        $completion->setContext($this->getContext());

        return $completion;
    }

    /**
     * Get state commands for this task
     * @return State
     */
    public function state()
    {
        $state = new State($this->getRepository()->getApiClient());
        $state->setContext($this->getContext());

        return $state;
    }

    /**
     * Get context for this task
     * @return string
     */
    protected function getContext()
    {
        return $this->getRepository()->getContext().'/tasks/'.$this->id;
    }
}