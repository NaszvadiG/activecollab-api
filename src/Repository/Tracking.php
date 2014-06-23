<?php

namespace Terminal42\ActiveCollabApi\Repository;

class Tracking extends AbstractRepository
{
    use ContextAwareTrait;

    /**
     * Get all time and expense records for current context
     * @return array
     */
    public function findAll()
    {
        $tracking = array();
        $records = $this->getApiClient()->get($this->context.'/tracking');

        foreach ($records as $data) {
            $class = $data->class;
            $tracking[] = new $class($data, $this);
        }

        return $tracking;
    }
}