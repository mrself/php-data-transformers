<?php declare(strict_types=1);

namespace Mrself\DataTransformers;

use Mrself\DataTransformers\Transformers\AbstractTransformers;

class AbsentTransformerException extends DataTransformersException
{
    /**
     * @var AbstractTransformers
     */
    protected $transformers;

    /**
     * @var array
     */
    protected $transformersMeta;

    /**
     * @var mixed
     */
    protected $value;

    public function __construct(
        AbstractTransformers $transformers,
        array $transformerMeta,
        $value
    ) {
        $this->transformers = $transformers;
        $this->transformersMeta = $transformerMeta;
        $this->value = $value;

        $transformerClass = get_class($transformers);
        $value = json_encode($value);
        parent::__construct("The transformer '#{$transformerMeta['method']}' does not exist in the defined object transformer '$transformerClass' for the value '$value'");
    }
}