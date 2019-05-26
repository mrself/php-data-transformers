<?php declare(strict_types=1);

namespace Mrself\DataTransformers\Tests\Functional\Transformers;

use Mrself\DataTransformers\Transformers;
use PHPUnit\Framework\TestCase;

class ApplyTransformerTest extends TestCase
{
    public function testItWorksWithStringTransformer()
    {
        $result = (new Transformers())->applyTransformer([1,2], 'first');
        $this->assertEquals(1, $result);
    }

    public function testItWorksWithStringTransformerAsFunction()
    {
        $result = (new Transformers())->applyTransformer('$1', 'skip($)');
        $this->assertEquals('1', $result);
    }

    public function testItWorksWithStringMultipleTransformers()
    {
        $result = (new Transformers())->applyTransformer([1,2], 'first|string');
        $this->assertEquals('1', $result);
    }
}