<?php
namespace ProUser\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Stdlib\Hydrator\ClassMethods;
use ProLdap\Stdlib\Hydrator\LdapObjectStrategy;

class UserHydrator implements FactoryInterface
{

    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $hydrator = new ClassMethods();
        $hydrator->addStrategy('displayname', new LdapObjectStrategy());
        $hydrator->addStrategy('userprincipalname', new LdapObjectStrategy());
        $hydrator->addStrategy('mail', new LdapObjectStrategy());
        $hydrator->addStrategy('title', new LdapObjectStrategy());
        $hydrator->addStrategy('department', new LdapObjectStrategy());
        $hydrator->addStrategy('telephonenumber', new LdapObjectStrategy());
        $hydrator->addStrategy('mobile', new LdapObjectStrategy());
        $hydrator->addStrategy('url', new LdapObjectStrategy());
        
        return $hydrator;
    }
}
