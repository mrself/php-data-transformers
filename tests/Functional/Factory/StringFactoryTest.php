<?php declare(strict_types=1);

namespace Mrself\DataTransformers\Tests\Functional\Factory;

use Mrself\DataTransformers\Factory\StringFactory;
use PHPUnit\Framework\TestCase;

class StringFactoryTest extends TestCase
{
    public function testItReturnsMethodAsSourceIfSourceIsSimpleString()
    {
        $result = StringFactory::make(['source' => 'make'])->run();
        $expected = ['method' => 'make', 'arguments' => []];
        $this->assertEquals($expected, $result);
    }

    public function testItReturnsMethodWithArguments()
    {
        $result = StringFactory::make(['source' => 'make(1,2)'])->run();
        $expected = ['method' => 'make', 'arguments' => ['1','2']];
        $this->assertEquals($expected, $result);
    }
}