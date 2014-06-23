<?php

namespace Terminal42\ActiveCollabApi\Model;

use Terminal42\ActiveCollabApi\Repository\Invoices;

/**
 * Class Invoice
 * @property int $id
 */
class Invoice extends AbstractModel
{
    /**
     * @var Invoices
     */
    protected $repository;
}
