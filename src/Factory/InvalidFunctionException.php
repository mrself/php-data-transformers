<?php declare(strict_types=1);

namespace Mrself\DataTransformers\Factory;

use Mrself\DataTransformers\DataTransformersException;

class InvalidFunctionException extends DataTransformersException
{
    /**
     * @var string
     */
    private $source;

    public function __construct(string $source)
    {
        $this->source = $source;
        parent::__construct('Source is not valid string transformer');
    }

    /**
     * @return string
     */
    public function getSource(): string
    {
        return $this->source;
    }
}