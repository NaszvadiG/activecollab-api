<?php

namespace Terminal42\ActiveCollabApi\Repository;

trait CompanyAwareTrait
{
    use ContextAwareTrait;

    /**
     * Set company ID
     * @param int $id
     * @return $this
     */
    public function setCompanyId($id)
    {
        return $this->setContext('people/'.$id);
    }
}