<?php declare(strict_types=1);

namespace Mrself\DataTransformers\Factory;

use Mrself\Options\Annotation\Option;
use Mrself\Options\WithOptionsTrait;

class StringFactory
{
    use WithOptionsTrait;

    /**
     * @Option()
     * @var string
     */
    protected $source;

    public function run()
    {
        $parts = explode('|', $this->source);
        return $this->processParts($parts);
    }

    protected function processParts(array $parts)
    {
        return array_map([$this, 'processPart'], $parts);
    }

    protected function processPart(string $part)
    {
        if ($this->isFunction($part)) {
            return $this->parseFunction($part);
        }

        return [
            'method' => $part,
            'arguments' => []
        ];
    }

    protected function parseFunction($source)
    {
        preg_match('/([^\(]*)\(([^\)]*)\)/', $source, $matches);
        if (count($matches) !== 3) {
            throw InvalidFunctionException($source);
        }

        return [
            'method' => $matches[1],
            'arguments' => explode(',', $matches[2])
        ];
    }

    protected function isFunction($source)
    {
        return mb_strpos($source, '(') !== false;
    }
}