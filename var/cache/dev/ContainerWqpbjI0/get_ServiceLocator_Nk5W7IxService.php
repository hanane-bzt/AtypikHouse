<?php

namespace ContainerWqpbjI0;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class get_ServiceLocator_Nk5W7IxService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private '.service_locator.nk5W7Ix' shared service.
     *
     * @return \Symfony\Component\DependencyInjection\ServiceLocator
     */
    public static function do($container, $lazyLoad = true)
    {
        return $container->privates['.service_locator.nk5W7Ix'] = new \Symfony\Component\DependencyInjection\Argument\ServiceLocator($container->getService ??= $container->getService(...), [
            'App\\Controller\\Admin\\AddressController::create' => ['privates', '.service_locator.9kKwU2t', 'get_ServiceLocator_9kKwU2tService', true],
            'App\\Controller\\Admin\\AddressController::edit' => ['privates', '.service_locator.DxaZoDO', 'get_ServiceLocator_DxaZoDOService', true],
            'App\\Controller\\Admin\\AddressController::index' => ['privates', '.service_locator..mLmNK9', 'get_ServiceLocator__MLmNK9Service', true],
            'App\\Controller\\Admin\\AddressController::remove' => ['privates', '.service_locator.DxaZoDO', 'get_ServiceLocator_DxaZoDOService', true],
            'App\\Controller\\Admin\\CategoryController::create' => ['privates', '.service_locator.9kKwU2t', 'get_ServiceLocator_9kKwU2tService', true],
            'App\\Controller\\Admin\\CategoryController::edit' => ['privates', '.service_locator.gKPBAx1', 'get_ServiceLocator_GKPBAx1Service', true],
            'App\\Controller\\Admin\\CategoryController::index' => ['privates', '.service_locator.EywQEQi', 'get_ServiceLocator_EywQEQiService', true],
            'App\\Controller\\Admin\\CategoryController::remove' => ['privates', '.service_locator.gKPBAx1', 'get_ServiceLocator_GKPBAx1Service', true],
            'App\\Controller\\Admin\\CityController::create' => ['privates', '.service_locator.9kKwU2t', 'get_ServiceLocator_9kKwU2tService', true],
            'App\\Controller\\Admin\\CityController::edit' => ['privates', '.service_locator.2_NzmnZ', 'get_ServiceLocator_2NzmnZService', true],
            'App\\Controller\\Admin\\CityController::index' => ['privates', '.service_locator.DYuyVBM', 'get_ServiceLocator_DYuyVBMService', true],
            'App\\Controller\\Admin\\CityController::remove' => ['privates', '.service_locator.2_NzmnZ', 'get_ServiceLocator_2NzmnZService', true],
            'App\\Controller\\Admin\\CountryController::create' => ['privates', '.service_locator.9kKwU2t', 'get_ServiceLocator_9kKwU2tService', true],
            'App\\Controller\\Admin\\CountryController::edit' => ['privates', '.service_locator.1dW180q', 'get_ServiceLocator_1dW180qService', true],
            'App\\Controller\\Admin\\CountryController::index' => ['privates', '.service_locator..7s9Fb7', 'get_ServiceLocator__7s9Fb7Service', true],
            'App\\Controller\\Admin\\CountryController::remove' => ['privates', '.service_locator.1dW180q', 'get_ServiceLocator_1dW180qService', true],
            'App\\Controller\\Admin\\HabitaController::create' => ['privates', '.service_locator.9kKwU2t', 'get_ServiceLocator_9kKwU2tService', true],
            'App\\Controller\\Admin\\HabitaController::edit' => ['privates', '.service_locator.MipyDka', 'get_ServiceLocator_MipyDkaService', true],
            'App\\Controller\\Admin\\HabitaController::index' => ['privates', '.service_locator.5FwXUg4', 'get_ServiceLocator_5FwXUg4Service', true],
            'App\\Controller\\Admin\\HabitaController::remove' => ['privates', '.service_locator.nGsEDpj', 'get_ServiceLocator_NGsEDpjService', true],
            'App\\Controller\\ContactController::contact' => ['privates', '.service_locator.uVvF4gL', 'get_ServiceLocator_UVvF4gLService', true],
            'App\\Controller\\HomeController::index' => ['privates', '.service_locator.r3SIXyQ', 'get_ServiceLocator_R3SIXyQService', true],
            'App\\Controller\\RegistrationController::register' => ['privates', '.service_locator.HT4rftb', 'get_ServiceLocator_HT4rftbService', true],
            'App\\Controller\\RegistrationController::verifyUserEmail' => ['privates', '.service_locator.1Z9fEX7', 'get_ServiceLocator_1Z9fEX7Service', true],
            'App\\Controller\\SecurityController::login' => ['privates', '.service_locator.rSTd.nA', 'get_ServiceLocator_RSTd_NAService', true],
            'App\\Kernel::loadRoutes' => ['privates', '.service_locator.y4_Zrx.', 'get_ServiceLocator_Y4Zrx_Service', true],
            'App\\Kernel::registerContainerConfiguration' => ['privates', '.service_locator.y4_Zrx.', 'get_ServiceLocator_Y4Zrx_Service', true],
            'kernel::loadRoutes' => ['privates', '.service_locator.y4_Zrx.', 'get_ServiceLocator_Y4Zrx_Service', true],
            'kernel::registerContainerConfiguration' => ['privates', '.service_locator.y4_Zrx.', 'get_ServiceLocator_Y4Zrx_Service', true],
            'App\\Controller\\Admin\\AddressController:create' => ['privates', '.service_locator.9kKwU2t', 'get_ServiceLocator_9kKwU2tService', true],
            'App\\Controller\\Admin\\AddressController:edit' => ['privates', '.service_locator.DxaZoDO', 'get_ServiceLocator_DxaZoDOService', true],
            'App\\Controller\\Admin\\AddressController:index' => ['privates', '.service_locator..mLmNK9', 'get_ServiceLocator__MLmNK9Service', true],
            'App\\Controller\\Admin\\AddressController:remove' => ['privates', '.service_locator.DxaZoDO', 'get_ServiceLocator_DxaZoDOService', true],
            'App\\Controller\\Admin\\CategoryController:create' => ['privates', '.service_locator.9kKwU2t', 'get_ServiceLocator_9kKwU2tService', true],
            'App\\Controller\\Admin\\CategoryController:edit' => ['privates', '.service_locator.gKPBAx1', 'get_ServiceLocator_GKPBAx1Service', true],
            'App\\Controller\\Admin\\CategoryController:index' => ['privates', '.service_locator.EywQEQi', 'get_ServiceLocator_EywQEQiService', true],
            'App\\Controller\\Admin\\CategoryController:remove' => ['privates', '.service_locator.gKPBAx1', 'get_ServiceLocator_GKPBAx1Service', true],
            'App\\Controller\\Admin\\CityController:create' => ['privates', '.service_locator.9kKwU2t', 'get_ServiceLocator_9kKwU2tService', true],
            'App\\Controller\\Admin\\CityController:edit' => ['privates', '.service_locator.2_NzmnZ', 'get_ServiceLocator_2NzmnZService', true],
            'App\\Controller\\Admin\\CityController:index' => ['privates', '.service_locator.DYuyVBM', 'get_ServiceLocator_DYuyVBMService', true],
            'App\\Controller\\Admin\\CityController:remove' => ['privates', '.service_locator.2_NzmnZ', 'get_ServiceLocator_2NzmnZService', true],
            'App\\Controller\\Admin\\CountryController:create' => ['privates', '.service_locator.9kKwU2t', 'get_ServiceLocator_9kKwU2tService', true],
            'App\\Controller\\Admin\\CountryController:edit' => ['privates', '.service_locator.1dW180q', 'get_ServiceLocator_1dW180qService', true],
            'App\\Controller\\Admin\\CountryController:index' => ['privates', '.service_locator..7s9Fb7', 'get_ServiceLocator__7s9Fb7Service', true],
            'App\\Controller\\Admin\\CountryController:remove' => ['privates', '.service_locator.1dW180q', 'get_ServiceLocator_1dW180qService', true],
            'App\\Controller\\Admin\\HabitaController:create' => ['privates', '.service_locator.9kKwU2t', 'get_ServiceLocator_9kKwU2tService', true],
            'App\\Controller\\Admin\\HabitaController:edit' => ['privates', '.service_locator.MipyDka', 'get_ServiceLocator_MipyDkaService', true],
            'App\\Controller\\Admin\\HabitaController:index' => ['privates', '.service_locator.5FwXUg4', 'get_ServiceLocator_5FwXUg4Service', true],
            'App\\Controller\\Admin\\HabitaController:remove' => ['privates', '.service_locator.nGsEDpj', 'get_ServiceLocator_NGsEDpjService', true],
            'App\\Controller\\ContactController:contact' => ['privates', '.service_locator.uVvF4gL', 'get_ServiceLocator_UVvF4gLService', true],
            'App\\Controller\\HomeController:index' => ['privates', '.service_locator.r3SIXyQ', 'get_ServiceLocator_R3SIXyQService', true],
            'App\\Controller\\RegistrationController:register' => ['privates', '.service_locator.HT4rftb', 'get_ServiceLocator_HT4rftbService', true],
            'App\\Controller\\RegistrationController:verifyUserEmail' => ['privates', '.service_locator.1Z9fEX7', 'get_ServiceLocator_1Z9fEX7Service', true],
            'App\\Controller\\SecurityController:login' => ['privates', '.service_locator.rSTd.nA', 'get_ServiceLocator_RSTd_NAService', true],
            'kernel:loadRoutes' => ['privates', '.service_locator.y4_Zrx.', 'get_ServiceLocator_Y4Zrx_Service', true],
            'kernel:registerContainerConfiguration' => ['privates', '.service_locator.y4_Zrx.', 'get_ServiceLocator_Y4Zrx_Service', true],
        ], [
            'App\\Controller\\Admin\\AddressController::create' => '?',
            'App\\Controller\\Admin\\AddressController::edit' => '?',
            'App\\Controller\\Admin\\AddressController::index' => '?',
            'App\\Controller\\Admin\\AddressController::remove' => '?',
            'App\\Controller\\Admin\\CategoryController::create' => '?',
            'App\\Controller\\Admin\\CategoryController::edit' => '?',
            'App\\Controller\\Admin\\CategoryController::index' => '?',
            'App\\Controller\\Admin\\CategoryController::remove' => '?',
            'App\\Controller\\Admin\\CityController::create' => '?',
            'App\\Controller\\Admin\\CityController::edit' => '?',
            'App\\Controller\\Admin\\CityController::index' => '?',
            'App\\Controller\\Admin\\CityController::remove' => '?',
            'App\\Controller\\Admin\\CountryController::create' => '?',
            'App\\Controller\\Admin\\CountryController::edit' => '?',
            'App\\Controller\\Admin\\CountryController::index' => '?',
            'App\\Controller\\Admin\\CountryController::remove' => '?',
            'App\\Controller\\Admin\\HabitaController::create' => '?',
            'App\\Controller\\Admin\\HabitaController::edit' => '?',
            'App\\Controller\\Admin\\HabitaController::index' => '?',
            'App\\Controller\\Admin\\HabitaController::remove' => '?',
            'App\\Controller\\ContactController::contact' => '?',
            'App\\Controller\\HomeController::index' => '?',
            'App\\Controller\\RegistrationController::register' => '?',
            'App\\Controller\\RegistrationController::verifyUserEmail' => '?',
            'App\\Controller\\SecurityController::login' => '?',
            'App\\Kernel::loadRoutes' => '?',
            'App\\Kernel::registerContainerConfiguration' => '?',
            'kernel::loadRoutes' => '?',
            'kernel::registerContainerConfiguration' => '?',
            'App\\Controller\\Admin\\AddressController:create' => '?',
            'App\\Controller\\Admin\\AddressController:edit' => '?',
            'App\\Controller\\Admin\\AddressController:index' => '?',
            'App\\Controller\\Admin\\AddressController:remove' => '?',
            'App\\Controller\\Admin\\CategoryController:create' => '?',
            'App\\Controller\\Admin\\CategoryController:edit' => '?',
            'App\\Controller\\Admin\\CategoryController:index' => '?',
            'App\\Controller\\Admin\\CategoryController:remove' => '?',
            'App\\Controller\\Admin\\CityController:create' => '?',
            'App\\Controller\\Admin\\CityController:edit' => '?',
            'App\\Controller\\Admin\\CityController:index' => '?',
            'App\\Controller\\Admin\\CityController:remove' => '?',
            'App\\Controller\\Admin\\CountryController:create' => '?',
            'App\\Controller\\Admin\\CountryController:edit' => '?',
            'App\\Controller\\Admin\\CountryController:index' => '?',
            'App\\Controller\\Admin\\CountryController:remove' => '?',
            'App\\Controller\\Admin\\HabitaController:create' => '?',
            'App\\Controller\\Admin\\HabitaController:edit' => '?',
            'App\\Controller\\Admin\\HabitaController:index' => '?',
            'App\\Controller\\Admin\\HabitaController:remove' => '?',
            'App\\Controller\\ContactController:contact' => '?',
            'App\\Controller\\HomeController:index' => '?',
            'App\\Controller\\RegistrationController:register' => '?',
            'App\\Controller\\RegistrationController:verifyUserEmail' => '?',
            'App\\Controller\\SecurityController:login' => '?',
            'kernel:loadRoutes' => '?',
            'kernel:registerContainerConfiguration' => '?',
        ]);
    }
}
