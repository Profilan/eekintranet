<?php
namespace ProUser\Factory\Mapper;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use ProUser\Mapper;
use Zend\Ldap\Ldap;

class Group implements FactoryInterface
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
        
        $mapper = new Mapper\Group();
        $mapper->setEntityManager($em);
//        $mapper->setHydrator(new Mapper\GroupHydrator());

        return $mapper;
    }
}
