<?php

namespace Terminal42\ActiveCollabApi\Repository;

use Terminal42\ActiveCollabApi\Model\Category;

/**
 * Class Categories
 *
 * @property int $id
 * @property string $name
 */
class Categories extends AbstractRepository
{
    use ContextAwareTrait;

    /**
     * Get all categories for current context
     * @return Category[]
     */
    public function findAll()
    {
        $categories = array();
        $records = $this->getApiClient()->sendCommand($this->getContext().'/categories');

        foreach ($records as $data) {
            $categories[] = new Category($data, $this);
        }

        return $categories;
    }
}