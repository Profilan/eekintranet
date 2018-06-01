<?php
namespace ProUser\Factory\View\Helper;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use ProUser\View;

class ProUserDisplayName implements FactoryInterface
{

    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceManager
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceManager)
    {
        $locator = $serviceManager->getServiceLocator();
        $viewHelper = new View\Helper\ProUserDisplayName;
        $viewHelper->setAuthService($locator->get('prouser_auth_service'));
        return $viewHelper;
    }
}
