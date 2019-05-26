<?php declare(strict_types=1);

namespace Mrself\DataTransformers\Transformers;

class PrimitiveTransformers extends AbstractTransformers
{
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
        return mb_substr($source, 0, 1);
    }

    public function skip($source, $skipString)
    {
        return str_replace($skipString, '', $source);
    }
}