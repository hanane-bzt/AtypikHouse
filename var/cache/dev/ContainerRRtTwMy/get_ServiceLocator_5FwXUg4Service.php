<?php

namespace ContainerRRtTwMy;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class get_ServiceLocator_5FwXUg4Service extends App_KernelDevDebugContainer
{
    /**
     * Gets the private '.service_locator.5FwXUg4' shared service.
     *
     * @return \Symfony\Component\DependencyInjection\ServiceLocator
     */
    public static function do($container, $lazyLoad = true)
    {
        return $container->privates['.service_locator.5FwXUg4'] = new \Symfony\Component\DependencyInjection\Argument\ServiceLocator($container->getService ??= $container->getService(...), [
            'repository' => ['privates', 'App\\Repository\\HabitatRepository', 'getHabitatRepositoryService', true],
        ], [
            'repository' => 'App\\Repository\\HabitatRepository',
        ]);
    }
}
