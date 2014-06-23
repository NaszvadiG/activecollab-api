<?php

namespace Terminal42\ActiveCollabApi\Repository;

use Terminal42\ActiveCollabApi\Model\Company;

class Companies extends AbstractRepository
{

    /**
     * Find all active companies
     * @return Company[]
     */
    public function findAll()
    {
        $companies = array();
        $records = $this->getApiClient()->get('people');

        foreach ($records as $data) {
            $companies[] = new Company($data, $this);
        }

        return $companies;
    }

    /**
     * Find all archived companies
     * @return Company[]
     */
    public function findArchived()
    {
        $companies = array();
        $records = $this->getApiClient()->get('people/archive');

        foreach ($records as $data) {
            $companies[] = new Company($data, $this);
        }

        return $companies;
    }
}