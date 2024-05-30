<?php

namespace ContainerRRtTwMy;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class get_ServiceLocator_MipyDkaService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private '.service_locator.MipyDka' shared service.
     *
     * @return \Symfony\Component\DependencyInjection\ServiceLocator
     */
    public static function do($container, $lazyLoad = true)
    {
        return $container->privates['.service_locator.MipyDka'] = new \Symfony\Component\DependencyInjection\Argument\ServiceLocator($container->getService ??= $container->getService(...), [
            'Help' => ['privates', 'Vich\\UploaderBundle\\Templating\\Helper\\UploaderHelper', 'getUploaderHelperService', true],
            'em' => ['services', 'doctrine.orm.default_entity_manager', 'getDoctrine_Orm_DefaultEntityManagerService', false],
            'habitat' => ['privates', '.errored..service_locator.MipyDka.App\\Entity\\Habitat', NULL, 'Cannot autowire service ".service_locator.MipyDka": it needs an instance of "App\\Entity\\Habitat" but this type has been excluded in "config/services.yaml".'],
        ], [
            'Help' => 'Vich\\UploaderBundle\\Templating\\Helper\\UploaderHelper',
            'em' => '?',
            'habitat' => 'App\\Entity\\Habitat',
        ]);
    }
}
