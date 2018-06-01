<?php
namespace ProLdap\Service;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use ProLdap\ORM\EntityManager;

class EntityManagerFactory implements FactoryInterface
{
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $options = $serviceLocator->get('proldap_module_options');
        $em = new EntityManager($options);
        $em->setServiceLocator($serviceLocator);
        
        return $em;
    }

    
}