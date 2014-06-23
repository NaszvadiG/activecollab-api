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

    /**
     * Find company by ID
     * @param int $id
     * @return Company
     */
    public function findById($id)
    {
        return new Company(
            $this->getApiClient()->get('people/' . $id),
            $this
        );
    }

    /**
     * Add a new company
     * @param Company $company
     * @return Company
     */
    public function create(Company $company)
    {
        $result = $this->getApiClient()->post(
            'people/add-company',
            $this->getPostData($company)
        );

        return new Company($result, $this);
    }

    /**
     * Update company
     * @param Company $company
     * @return Company
     */
    public function update(Company $company)
    {
        $result = $this->getApiClient()->post(
            'people/'.$company->id.'/edit',
            $this->getPostData($company)
        );

        return new Company($result, $this);
    }

    /**
     * Validate and prepare company properties for POST
     * @param Company $company
     * @return array
     */
    protected function getPostData(Company $company)
    {
        return $this->compilePostFields($company, [
            'name'            => 'string',
            'office_address'  => 'string',
            'office_phone'    => 'string',
            'office_fax'      => 'string',
            'office_homepage' => 'string',
            'note'            => 'string',
        ]);
    }
}