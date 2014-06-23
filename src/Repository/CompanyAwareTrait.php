<?php

namespace Terminal42\ActiveCollabApi\Repository;

trait CompanyAwareTrait
{
    /**
     * @var int
     */
    protected $company_id = '';

    /**
     * Get company ID
     * @return int
     */
    public function getCompanyId()
    {
        return $this->company_id;
    }

    /**
     * Get context URL for company
     * @return string
     */
    public function getCompanyContext()
    {
        return 'people/'.$this->company_id;
    }

    /**
     * Set company ID
     * @param int $id
     * @return $this
     */
    public function setCompanyId($id)
    {
        $this->company_id = (int) $id;

        return $this;
    }
}