<?php

namespace Terminal42\ActiveCollabApi\Repository;

use Terminal42\ActiveCollabApi\Model\Invoice;

class Invoices extends AbstractRepository
{

    /**
     * Find all active projects
     * @return Invoice[]
     */
    public function findAll()
    {
        $invoices = array();
        $records = $this->getApiClient()->get('invoices');

        foreach ($records as $data) {
            $invoices[] = new Invoice($data, $this);
        }

        return $invoices;
    }
}
