<?php

namespace Terminal42\ActiveCollabApi;

use Terminal42\ActiveCollabApi\Model\Info;
use Terminal42\ActiveCollabApi\Repository\Attachments;
use Terminal42\ActiveCollabApi\Repository\Categories;
use Terminal42\ActiveCollabApi\Repository\Comments;
use Terminal42\ActiveCollabApi\Repository\Companies;
use Terminal42\ActiveCollabApi\Repository\Discussions;
use Terminal42\ActiveCollabApi\Repository\Files;
use Terminal42\ActiveCollabApi\Repository\Milestones;
use Terminal42\ActiveCollabApi\Repository\Notebooks;
use Terminal42\ActiveCollabApi\Repository\Projects;
use Terminal42\ActiveCollabApi\Repository\Tasks;
use Terminal42\ActiveCollabApi\Repository\TextDocuments;
use Terminal42\ActiveCollabApi\Repository\Users;

class ApiClient extends BaseApiClient
{

    /**
     * Returns the system information about the installation that you are working with.
     * This information includes the system version, the users that are currently logged in, the API mode, etc.
     *
     * @return Info
     */
    public function getInfo()
    {
        return new Info($this->get('info'));
    }

    /**
     * Get companies repository
     * @return Companies
     */
    public function companies()
    {
        return new Companies($this);
    }

    /**
     * Users for given company ID
     * @param int $id
     * @return Users
     */
    public function usersForCompany($id)
    {
        $repository = new Users($this);
        $repository->setCompanyId($id);

        return $repository;
    }

    /**
     * Get projects repository
     * @return Projects
     */
    public function projects()
    {
        return new Projects($this);
    }

    /**
     * Get tasks repository for given project
     * @param  string $id_or_slug
     * @return Tasks
     */
    public function tasksForProject($id_or_slug)
    {
        $repository = new Tasks($this);
        $repository->setProjectId($id_or_slug);

        return $repository;
    }

    /**
     * Get discussions repository for given project
     * @param  string $id_or_slug
     * @return Discussions
     */
    public function discussionsForProject($id_or_slug)
    {
        $repository = new Discussions($this);
        $repository->setProjectId($id_or_slug);

        return $repository;
    }

    /**
     * Get notebooks repository for given project
     * @param  string $id_or_slug
     * @return Notebooks
     */
    public function notebooksForProject($id_or_slug)
    {
        $repository = new Notebooks($this);
        $repository->setProjectId($id_or_slug);

        return $repository;
    }

    /**
     * Get milestones repository for given project
     * @param  string $id_or_slug
     * @return Milestones
     */
    public function milestonesForProject($id_or_slug)
    {
        $repository = new Milestones($this);
        $repository->setProjectId($id_or_slug);

        return $repository;
    }

    /**
     * Get files repository for given project
     * @param  string $id_or_slug
     * @return Files
     */
    public function filesForProject($id_or_slug)
    {
        $repository = new Files($this);
        $repository->setProjectId($id_or_slug);

        return $repository;
    }

    /**
     * Get text documents repository for given project
     * @param  string $id_or_slug
     * @return TextDocuments
     */
    public function textDocumentsForProject($id_or_slug)
    {
        $repository = new TextDocuments($this);
        $repository->setProjectId($id_or_slug);

        return $repository;
    }

    /**
     * Get comments repository for given context
     * @param string $context
     * @return Comments
     */
    public function commentsForContext($context)
    {
        $repository = new Comments($this);
        $repository->setContext($context);

        return $repository;
    }

    /**
     * Get attachments repository for context
     * @param string $context
     * @return Attachments
     */
    public function attachmentsForContext($context)
    {
        $repository = new Attachments($this);
        $repository->setContext($context);

        return $repository;
    }

    /**
     * Get categories repository for context
     * @param string $context
     * @return Categories
     */
    public function categoriesForContext($context)
    {
        $repository = new Categories($this);
        $repository->setContext($context);

        return $repository;
    }
}