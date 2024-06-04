<?php

namespace ContainerK82Kant;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class get_ServiceLocator_NGsEDpjService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private '.service_locator.nGsEDpj' shared service.
     *
     * @return \Symfony\Component\DependencyInjection\ServiceLocator
     */
    public static function do($container, $lazyLoad = true)
    {
        return $container->privates['.service_locator.nGsEDpj'] = new \Symfony\Component\DependencyInjection\Argument\ServiceLocator($container->getService ??= $container->getService(...), [
            'em' => ['services', 'doctrine.orm.default_entity_manager', 'getDoctrine_Orm_DefaultEntityManagerService', false],
            'habitat' => ['privates', '.errored..service_locator.nGsEDpj.App\\Entity\\Habitat', NULL, 'Cannot autowire service ".service_locator.nGsEDpj": it needs an instance of "App\\Entity\\Habitat" but this type has been excluded in "config/services.yaml".'],
        ], [
            'em' => '?',
            'habitat' => 'App\\Entity\\Habitat',
        ]);
    }
}