<?php

namespace ContainerRRtTwMy;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class get_ServiceLocator_DxaZoDOService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private '.service_locator.DxaZoDO' shared service.
     *
     * @return \Symfony\Component\DependencyInjection\ServiceLocator
     */
    public static function do($container, $lazyLoad = true)
    {
        return $container->privates['.service_locator.DxaZoDO'] = new \Symfony\Component\DependencyInjection\Argument\ServiceLocator($container->getService ??= $container->getService(...), [
            'address' => ['privates', '.errored..service_locator.DxaZoDO.App\\Entity\\Address', NULL, 'Cannot autowire service ".service_locator.DxaZoDO": it needs an instance of "App\\Entity\\Address" but this type has been excluded in "config/services.yaml".'],
            'em' => ['services', 'doctrine.orm.default_entity_manager', 'getDoctrine_Orm_DefaultEntityManagerService', false],
        ], [
            'address' => 'App\\Entity\\Address',
            'em' => '?',
        ]);
    }
}
