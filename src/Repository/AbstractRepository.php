<?php

namespace Terminal42\ActiveCollabApi\Repository;

use Terminal42\ActiveCollabApi\ApiClient;
use Terminal42\ActiveCollabApi\ApiClientAwareTrait;
use Terminal42\ActiveCollabApi\Exception\InvalidFieldTypeException;
use Terminal42\ActiveCollabApi\Model\AbstractModel;

abstract class AbstractRepository
{
    use ApiClientAwareTrait;

    /**
     * @param ApiClient $apiClient
     */
    public function __construct(ApiClient $apiClient)
    {
        $this->setApiClient($apiClient);
    }

    /**
     * Validate model fields and generate POST data array
     * @param AbstractModel $model
     * @param array         $config
     * @return array
     */
    protected function compilePostFields(AbstractModel $model, array $config)
    {
        $data = array();
        $invalid = function($property, $type) {
            throw new InvalidFieldTypeException('Property "'.$property.'" is not of type "'.$type.'"');
        };

        foreach ($config as $property => $type) {

            // @todo do we need an option to override this?
            if (!isset($model->$property)) {
                continue;
            }

            $value = $model->$property;

            switch ($type) {
                case 'string':
                case 'text':
                    if (!is_string($value)) {
                        $invalid($property, $type);
                    }
                    break;

                case 'integer':
                case 'int':
                    if (!is_integer($value)) {
                        $invalid($property, $type);
                    }
                    break;

                case 'date':
                    if (!($value instanceof \DateTime)) {
                        $invalid($property, $type);
                    }
                    break;

                default:
                    throw new \LogicException('Unknown model property type "'.$type.'"');
            }

            $data[$property] = $value;
        }

        return $data;
    }
}