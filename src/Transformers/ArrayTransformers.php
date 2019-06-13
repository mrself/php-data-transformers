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

    public function itemMap($value, ...$args): array
    {
        if (count($args) === 1) {
            if (is_string($args[0])) {
                $key = $args[0];
                return array_map(function ($item) use ($key) {
                    return $item[$key];
                }, $value);
            }
        }
    }
}