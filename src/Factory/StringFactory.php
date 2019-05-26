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
        if ($this->isFunction()) {
            return $this->parseFunction();
        }

        return [
            'method' => $this->source,
            'arguments' => []
        ];
    }

    protected function parseFunction()
    {
        preg_match('/([^\(]*)\(([^\)]*)\)/', $this->source, $matches);
        if (count($matches) !== 3) {
            throw InvalidFunctionException($this->source);
        }

        return [
            'method' => $matches[1],
            'arguments' => explode(',', $matches[2])
        ];
    }

    protected function isFunction()
    {
        return mb_strpos($this->source, '(') !== false;
    }
}