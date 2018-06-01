<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ProUser for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace ProUser;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\ServiceProviderInterface;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

class Module implements 
    AutoloaderProviderInterface,
    ConfigProviderInterface,
    ServiceProviderInterface
{
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
		    // if we're in a namespace deeper than one level we need to fix the \ in the path
                    __NAMESPACE__ => __DIR__ . '/src/' . str_replace('\\', '/' , __NAMESPACE__),
                ),
            ),
        );
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getServiceConfig()
    {
        return array(
            'invokables' => array(
                'prouser_user_service' => 'ProUser\Service\User',
                'prouser_group_service' => 'ProUser\Service\Group',
            ),
            'factories' => array(
                'prouser_module_options' => 'ProUser\Factory\Options\ModuleOptions',
                'prouser_auth_service' => 'ProUser\Factory\AuthenticationService',
                'prouser_user_mapper' => 'ProUser\Factory\Mapper\User',
                'prouser_group_mapper' => 'ProUser\Factory\Mapper\Group',
            ),
        );
    }

    public function getViewHelperConfig()
    {
        return array(
            'factories' => array(
                'userIdentity' => 'ProUser\Factory\View\Helper\ProUserIdentity',
                'userDisplayName' => 'ProUser\Factory\View\Helper\ProUserDisplayName',
            ),
        );
    
    }
    
    public function getControllerPluginConfig()
    {
        return array(
            'factories' => array(
                'proUserAuthentication' => 'ProUser\Factory\Controller\Plugin\ProUserAuthentication',
            ),
        );
    }
    
    public function onBootstrap(MvcEvent $e)
    {
        // You may not need to do this if you're doing it elsewhere in your
        // application
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
    }
}
