<?php
namespace ProLdap\Factory\View\Helper;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use ProLdap\View;

class ProLdapIsMemberOf implements FactoryInterface
{

    public function createService(ServiceLocatorInterface $serviceManager)
    {
        $locator = $serviceManager->getServiceLocator();
        
        $viewHelper = new View\Helper\ProLdapIsMemberOf();
        $viewHelper->setEntityManager($locator->get('proldap_entity_manager'));
        
        return $viewHelper;
    }
}
