<?php

namespace ContainerOryA2sE;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getBanWordValidatorService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private 'App\Validator\BanWordValidator' shared autowired service.
     *
     * @return \App\Validator\BanWordValidator
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).'/vendor/symfony/validator/ConstraintValidatorInterface.php';
        include_once \dirname(__DIR__, 4).'/vendor/symfony/validator/ConstraintValidator.php';
        include_once \dirname(__DIR__, 4).'/src/Validator/BanWordValidator.php';

        return $container->privates['App\\Validator\\BanWordValidator'] = new \App\Validator\BanWordValidator();
    }
}
