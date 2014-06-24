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
use Terminal42\ActiveCollabApi\Repository\Discussions;
use Terminal42\ActiveCollabApi\Repository\Reminders;
use Terminal42\ActiveCollabApi\Repository\RemindersInterface;

/**
 * Class Discussion
 * @property int $id
 * @property string $name
 * @property string $body
 * @property int $category_id
 * @property int $visibility
 * @property int $milestone_id
 */
class Discussion extends AbstractModel implements
    CategoriesInterface,
    AttachmentsInterface,
    CommentsInterface,
    RemindersInterface,
    SubscriptionInterface,
    StateInterface
{
    use ProjectObjectTrait;

    /**
     * @var Discussions
     */
    protected $repository;


    /**
     * Get categories repository for this discussion
     * @return Categories
     */
    public function categories()
    {
        $categories = new Categories($this->repository->getApiClient());
        $categories->setContext($this->getContext());

        return $categories;
    }

    /**
     * Get attachments repository for this discussion
     * @return Attachments
     */
    public function attachments()
    {
        $attachments = new Attachments($this->repository->getApiClient());
        $attachments->setContext($this->getContext());

        return $attachments;
    }

    /**
     * Get comments repository for this discussion
     * @return Comments
     */
    public function comments()
    {
        $comments = new Comments($this->repository->getApiClient());
        $comments->setContext($this->getContext());

        return $comments;
    }

    /**
     * Get reminders repository for this discussion
     * @return Reminders
     */
    public function reminders()
    {
        $categories = new Reminders($this->repository->getApiClient());
        $categories->setContext($this->getContext());

        return $categories;
    }

    /**
     * Get subscription commands for this discussion
     * @return Subscription
     */
    public function subscription()
    {
        $subscription = new Subscription($this->repository->getApiClient());
        $subscription->setContext($this->getContext());

        return $subscription;
    }

    /**
     * Get state commands for this discussion
     * @return State
     */
    public function state()
    {
        $state = new State($this->repository->getApiClient());
        $state->setContext($this->getContext());

        return $state;
    }

    /**
     * Get context for this discussion
     * @return string
     */
    protected function getContext()
    {
        return $this->repository->getContext().'/discussions/'.$this->id;
    }
}