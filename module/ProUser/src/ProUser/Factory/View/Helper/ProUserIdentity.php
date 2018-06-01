<?php
namespace ProUser\Factory\View\Helper;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use ProUser\View;

class ProUserIdentity implements FactoryInterface
{

    public function createService(ServiceLocatorInterface $serviceManager)
    {
        $locator = $serviceManager->getServiceLocator();
        $viewHelper = new View\Helper\ProUserIdentity;
        $viewHelper->setAuthService($locator->get('prouser_auth_service'));
        return $viewHelper;
    }
}
