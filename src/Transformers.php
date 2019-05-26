<?php declare(strict_types=1);

namespace Mrself\DataTransformers;

use Mrself\DataTransformers\Factory\StringFactory;

class Transformers
{
    public function applyTransformers($value, $transformers)
    {
        $transformers = (array) $transformers;
        foreach ($transformers as $transformer) {
            $value = $this->applyTransformer($value, $transformer);
        }
        return $value;
    }

    public function applyTransformer($value, $transformer)
    {
        if (is_string($transformer)) {
            $transformers = StringFactory::make(['source' => $transformer])->run();
            return $this->applyTransformers($value, $transformers);
        }

        if (is_array($transformer)) {
            $arguments = array_merge([$value], $transformer['arguments']);
            return call_user_func_array([$this, $transformer['method']], $arguments);
        }

        throw new \RuntimeException('Invalid transformer');
    }

    public function array($source)
    {
        return (array) $source;
    }

    public function int($source)
    {
        return (int) $source;
    }

    public function float($source)
    {
        return (float) $source;
    }

    public function string($source)
    {
        return (string) $source;
    }

    public function first($source)
    {
        if (is_string($source)) {
            return mb_substr($source, 0, 1);
        }

        if (is_array($source)) {
            return $source[0];
        }
    }

    public function skip($source, $skipString)
    {
        return str_replace($skipString, '', $source);
    }
}