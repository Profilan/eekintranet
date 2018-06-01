<?php
namespace ProUser\Factory\Controller\Plugin;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use ProUser\Controller;
use Zend\Authentication\AuthenticationService;
use Zend\Authentication\Adapter\Ldap;

class ProUserAuthentication implements FactoryInterface
{

    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceManager
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceManager)
    {
        $serviceLocator = $serviceManager->getServiceLocator();
        $options = $serviceLocator->get('prouser_module_options');
        
        $authService = $serviceLocator->get('prouser_auth_service');
        $authAdapter = new Ldap($options->getLdapAuthOptions());
        
        $controllerPlugin = new Controller\Plugin\ProUserAuthentication;
        $controllerPlugin->setAuthService($authService);
        $controllerPlugin->setAuthAdapter($authAdapter);
        
        return $controllerPlugin;
        
    }
}
