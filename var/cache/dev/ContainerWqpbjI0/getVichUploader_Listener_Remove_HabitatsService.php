<?php

namespace ContainerWqpbjI0;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getVichUploader_Listener_Remove_HabitatsService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private 'vich_uploader.listener.remove.habitats' shared service.
     *
     * @return \Vich\UploaderBundle\EventListener\Doctrine\RemoveListener
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).'/vendor/vich/uploader-bundle/src/EventListener/Doctrine/BaseListener.php';
        include_once \dirname(__DIR__, 4).'/vendor/vich/uploader-bundle/src/EventListener/Doctrine/RemoveListener.php';
        include_once \dirname(__DIR__, 4).'/vendor/vich/uploader-bundle/src/Adapter/AdapterInterface.php';
        include_once \dirname(__DIR__, 4).'/vendor/vich/uploader-bundle/src/Adapter/ORM/DoctrineORMAdapter.php';

        return $container->privates['vich_uploader.listener.remove.habitats'] = new \Vich\UploaderBundle\EventListener\Doctrine\RemoveListener('habitats', ($container->privates['vich_uploader.adapter.orm'] ??= new \Vich\UploaderBundle\Adapter\ORM\DoctrineORMAdapter()), ($container->privates['vich_uploader.metadata_reader'] ?? self::getVichUploader_MetadataReaderService($container)), ($container->services['vich_uploader.upload_handler'] ?? $container->load('getVichUploader_UploadHandlerService')));
    }
}
