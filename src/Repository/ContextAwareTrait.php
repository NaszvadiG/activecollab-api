<?php

namespace Terminal42\ActiveCollabApi\Repository;

trait ContextAwareTrait
{
    /**
     * @var string
     */
    protected $context;

    /**
     * Get current context
     * @return string
     */
    public function getContext()
    {
        return $this->context;
    }

    /**
     * Set current context
     * @param string $context
     * @return $this
     */
    public function setContext($context)
    {
        $this->context = $context;

        return $this;
    }
}