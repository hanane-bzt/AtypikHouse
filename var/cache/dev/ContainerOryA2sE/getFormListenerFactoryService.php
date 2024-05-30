<?php

namespace ContainerOryA2sE;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getFormListenerFactoryService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private 'App\Form\FormListenerFactory' shared autowired service.
     *
     * @return \App\Form\FormListenerFactory
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).'/src/Form/FormListenerFactory.php';
        include_once \dirname(__DIR__, 4).'/vendor/symfony/string/Slugger/SluggerInterface.php';
        include_once \dirname(__DIR__, 4).'/vendor/symfony/string/Slugger/AsciiSlugger.php';

        return $container->privates['App\\Form\\FormListenerFactory'] = new \App\Form\FormListenerFactory(($container->privates['slugger'] ??= new \Symfony\Component\String\Slugger\AsciiSlugger('en')));
    }
}
