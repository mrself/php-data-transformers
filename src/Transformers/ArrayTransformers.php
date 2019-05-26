<?php declare(strict_types=1);

namespace Mrself\DataTransformers\Transformers;

class ArrayTransformers extends AbstractTransformers
{
    public function first($value)
    {
        return $value[0];
    }

    public function last($value)
    {
        return $value[count($value) - 1];
    }
}