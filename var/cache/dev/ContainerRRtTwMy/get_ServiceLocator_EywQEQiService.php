<?php

namespace ContainerRRtTwMy;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class get_ServiceLocator_EywQEQiService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private '.service_locator.EywQEQi' shared service.
     *
     * @return \Symfony\Component\DependencyInjection\ServiceLocator
     */
    public static function do($container, $lazyLoad = true)
    {
        return $container->privates['.service_locator.EywQEQi'] = new \Symfony\Component\DependencyInjection\Argument\ServiceLocator($container->getService ??= $container->getService(...), [
            'repository' => ['privates', 'App\\Repository\\CategoryRepository', 'getCategoryRepositoryService', true],
        ], [
            'repository' => 'App\\Repository\\CategoryRepository',
        ]);
    }
}
