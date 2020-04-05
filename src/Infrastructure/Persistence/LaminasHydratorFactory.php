<?php

declare(strict_types=1);

namespace Todo\Infrastructure\Persistence;

use Laminas\Hydrator\Filter\FilterComposite;
use Laminas\Hydrator\HydratorInterface;
use Laminas\Hydrator\NamingStrategy\UnderscoreNamingStrategy;
use Laminas\Hydrator\ReflectionHydrator;
use Laminas\Hydrator\Strategy\DateTimeFormatterStrategy;

final class LaminasHydratorFactory
{
    public function __invoke(): HydratorInterface
    {
        $hydrator = new ReflectionHydrator();
        $hydrator->setNamingStrategy(new UnderscoreNamingStrategy());
        $hydrator->addFilter(
            'exclude',
            function ($property) {
                return 'recorded_events' !== $property;
            },
            FilterComposite::CONDITION_AND
        );

        return $hydrator;
    }
}
