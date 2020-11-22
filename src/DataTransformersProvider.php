<?php declare(strict_types=1);

namespace Mrself\DataTransformers;

use Mrself\Container\Container;
use Mrself\Container\ServiceProvider;

class DataTransformersProvider extends ServiceProvider
{
    protected function getContainer(): Container
    {
        $container = Container::make();
        $container->on(DataTransformers::class, function () {
            return DataTransformers::make();
        }, true);

        return $container;
    }

    protected function getNamespace(): string
    {
        return 'Mrself\DataTransformers';
    }

}