<?php declare(strict_types=1);

namespace Mrself\DataTransformers\Tests\Functional;

use Mrself\Container\Registry\ContainerRegistry;
use Mrself\DataTransformers\DataTransformers;
use Mrself\DataTransformers\DataTransformersProvider;
use PHPUnit\Framework\TestCase;

class ProviderTest extends TestCase
{
    public function testContainerHasDataTransformersService()
    {
        DataTransformersProvider::make()->registerAndBoot();

        $dataTransformers = ContainerRegistry::get('Mrself\DataTransformers')
            ->get(DataTransformers::class);
        $this->assertInstanceOf(DataTransformers::class, $dataTransformers);
    }

    protected function setUp()
    {
        parent::setUp();
        ContainerRegistry::reset();
    }
}