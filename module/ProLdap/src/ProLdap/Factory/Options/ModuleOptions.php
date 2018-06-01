<?php
namespace ProLdap\Factory\Options;


use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use ProLdap\Options;

class ModuleOptions implements FactoryInterface
{

    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $config = $serviceLocator->get('Config');
        return new Options\ModuleOptions(isset($config['proldap']) ? $config['proldap'] : array());
    }
}
