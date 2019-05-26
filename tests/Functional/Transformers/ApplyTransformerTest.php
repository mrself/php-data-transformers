<?php declare(strict_types=1);

namespace Mrself\DataTransformers\Tests\Functional\Transformers;

use Mrself\DataTransformers\DataTransformers;
use PHPUnit\Framework\TestCase;

class ApplyTransformerTest extends TestCase
{
    public function testItWorksWithStringTransformer()
    {
        $result = (new DataTransformers())->applyTransformer([1,2], 'first');
        $this->assertEquals(1, $result);
    }

    public function testItWorksWithStringTransformerAsFunction()
    {
        $result = (new DataTransformers())->applyTransformer('$1', 'skip($)');
        $this->assertEquals('1', $result);
    }

    public function testItWorksWithStringMultipleTransformers()
    {
        $result = (new DataTransformers())->applyTransformer([1,2], 'first|string');
        $this->assertEquals('1', $result);
    }

    /**
     * @expectedException \Mrself\DataTransformers\AbsentTransformerException
     */
    public function testItThrowsExceptionForAbsentTransformer()
    {
        (new DataTransformers())->applyTransformer(0, 'non-existent');
    }
}