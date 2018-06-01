<?php
namespace ProUser\Factory\Mapper;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use ProUser\Mapper;
use Zend\Ldap\Ldap;

class User implements FactoryInterface
{

    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $em = $serviceLocator->get('proldap_entity_manager');
        
        $mapper = new Mapper\User();
        $mapper->setEntityManager($em);
        $mapper->setHydrator(new Mapper\UserHydrator());

        return $mapper;
    }
}
