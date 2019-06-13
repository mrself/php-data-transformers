<?php declare(strict_types=1);

namespace Mrself\DataTransformers;

use Mrself\DataTransformers\Transformers\AbstractTransformers;

class ApplyTransformerException extends DataTransformersException
{
    /**
     * @var AbstractTransformers
     */
    protected $object;

    /**
     * @var mixed
     */
    protected $value;

    /**
     * @var array
     */
    protected $transformer;

    public function __construct($object, $value, array $transformer)
    {
        $this->object = $object;
        $this->value = $value;
        $this->transformer = $transformer;

        parent::__construct('Error while applying transformer ' . $transformer['method'] . ' from the object ' . get_class($object));
    }

    /**
     * @return AbstractTransformers
     */
    public function getObject()
    {
        return $this->object;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return array
     */
    public function getTransformer(): array
    {
        return $this->transformer;
    }
}