<?php declare(strict_types=1);

namespace Mrself\DataTransformers\Tests\Functional\Transformers;

use Mrself\DataTransformers\DataTransformers;
use PHPUnit\Framework\TestCase;

class ArrayItemMapTest extends TestCase
{
    public function testItMapsArrayKeyAsNewArrayItem()
    {
        $result = (new DataTransformers())
            ->applyTransformer([['a' => 1]], 'itemMap(a)');
        $this->assertEquals([1], $result);
    }
}