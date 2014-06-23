<?php

namespace Terminal42\ActiveCollabApi\Model;

use Terminal42\ActiveCollabApi\Repository\AbstractRepository;
use Terminal42\ActiveCollabApi\Repository\Users;

abstract class AbstractModel
{

    /**
     * @var object
     */
    protected $data;

    /**
     * @var AbstractRepository
     */
    protected $repository;

    /**
     * @param \stdClass $data
     * @param AbstractRepository $repository
     */
    public function __construct(\stdClass $data, AbstractRepository $repository = null)
    {
        $this->data = $data;
        $this->repository = $repository;
    }

    /**
     * @param string $key
     * @return mixed
     */
    public function __get($key)
    {
        $varValue = $this->data->$key;

        if (is_object($varValue) && $varValue->class != '') {
            switch ($varValue->class) {

                // Convert to PHP DateTime
                case 'DateTimeValue':
                    // @todo add timezone information if available
                    $varValue = \DateTime::createFromFormat('U', $varValue->timestamp);
                    break;

                // Convert to User object
                case 'Administrator':
                    $varValue = new User($varValue, new Users($this->repository->getApiClient()));
                    break;
            }
        }

        return $varValue;
    }

    /**
     * @return AbstractRepository
     */
    public function getRepository()
    {
        return $this->repository;
    }
}