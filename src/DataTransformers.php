<?php declare(strict_types=1);

namespace Mrself\DataTransformers;

use Mrself\DataTransformers\Factory\StringFactory;
use Mrself\DataTransformers\Transformers\ArrayTransformers;
use Mrself\DataTransformers\Transformers\ObjectTransformers;
use Mrself\DataTransformers\Transformers\PrimitiveTransformers;
use Mrself\DataTransformers\Transformers\ResourceTransformers;
use Mrself\Options\WithOptionsTrait;

class DataTransformers
{
    use WithOptionsTrait;

    /**
     * @var array
     */
    protected $transformers = [];

    public function applyTransformers($value, $transformers)
    {
        $transformers = (array) $transformers;
        foreach ($transformers as $transformer) {
            $value = $this->applyTransformer($value, $transformer);
        }
        return $value;
    }

    /**
     * @param $value
     * @param $transformer
     * @return mixed
     * @throws AbsentTransformerException
     */
    public function applyTransformer($value, $transformer)
    {
        if (is_string($transformer)) {
            $transformers = StringFactory::make(['source' => $transformer])->run();
            return $this->applyTransformers($value, $transformers);
        }

        if (is_array($transformer)) {
            return $this->applyTransformerByArray($value, $transformer);
        }

        throw new \RuntimeException('Invalid transformer');
    }

    /**
     * @param $value
     * @param array $transformer
     * @return mixed
     * @throws AbsentTransformerException
     * @throws ApplyTransformerException
     */
    protected function applyTransformerByArray($value, array $transformer)
    {
        $arguments = array_merge([$value], $transformer['arguments']);
        $object = $this->defineTransformerObject($value);
        if (!method_exists($object, $transformer['method'])) {
            throw new AbsentTransformerException($object, $transformer, $value);
        }

        try {
            return call_user_func_array([$object, $transformer['method']], $arguments);
        } catch (\Exception $e) {
            throw new ApplyTransformerException($object, $value, $transformer);
        }
    }

    protected function defineTransformerObject($value)
    {
        if (is_scalar($value)) {
            $class = PrimitiveTransformers::class;
        } elseif (is_array($value)) {
            $class = ArrayTransformers::class;
        } elseif (is_object($value)) {
            $class = ObjectTransformers::class;
        } else {
            $class = ResourceTransformers::class;
        }

        if (array_key_exists($class, $this->transformers)) {
            return $this->transformers[$class];
        }

        return $this->transformers[$class] = $class::make();
    }
}