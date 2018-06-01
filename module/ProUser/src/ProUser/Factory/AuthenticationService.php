<?php
namespace ProUser\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Authentication\Adapter\Ldap;

class AuthenticationService implements FactoryInterface
{

    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $options = $serviceLocator->get('prouser_module_options');
        
        $adapter = new Ldap($options->getLdapAuthOptions());
        
        return new \Zend\Authentication\AuthenticationService(
            null,
            $adapter
        );
    }
}
