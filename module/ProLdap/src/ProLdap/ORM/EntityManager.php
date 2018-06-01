<?php
namespace ProLdap\ORM;

use ProLdap\Options\ModuleOptions;
use Zend\Ldap\Ldap;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use ProLdap\Factory\ORM\Repository\RepositoryFactory;
use ProLdap\Factory\ORM\Mapping\ClassMetadataFactory;

class EntityManager implements EntityManagerInterface, ServiceLocatorAwareInterface
{
    /**
     * 
     * @var ModuleOptions
     */
    protected  $options;
    
    /**
     * 
     * @var array
     */
    protected $ldaps = array();

    /**
     * The repository factory used to create dynamic repositories.
     *
     * @var \ProLdap\Factory\ORM\Repository\RepositoryFactory
     */
    protected $repositoryFactory;
    
    /**
     * 
     * @var \ProLdap\Factory\ORM\Mapping\ClassMetadataFactory
     */
    protected $metadataFactory;
    
    protected $serviceLocator;
    
    /**
     * 
     * @param ModuleOptions $options
     */
    public function __construct(ModuleOptions $options)
    {
        
        $this->options  = $options;
        
        foreach ($options->getLdapOptions() as $option) {
            $this->ldaps[] = new Ldap($option);
        }
        
        $this->repositoryFactory = new RepositoryFactory();
        $this->metadataFactory = new ClassMetadataFactory();
    }
    

    /**
     * Gets the repository for an entity class.
     *
     * @param string $objectClass The name of the object class.
     *
     * @return EntityRepository The repository class.
     */
    public function getRepository($objectClass)
    {
        return $this->repositoryFactory->getRepository($this, $objectClass);
    }
    
    /**
     * Returns the ORM metadata descriptor for a class.
     *
     * The class name must be the fully-qualified class name without a leading backslash
     * (as it is returned by get_class($obj)) or an aliased class name.
     *
     * Examples:
     * MyProject\Domain\User
     * sales:PriceRequest
     *
     * Internal note: Performance-sensitive method.
     *
     * @param string $className
     *
     * @return \ProLdap\ORM\Mapping\ClassMetadata
     */
    public function getClassMetadata($className)
    {
        return $this->metadataFactory->getMetadataFor($className);
    }

    /**
     *
     * @return array
     */
    public function getLdaps()
    {
        return $this->ldaps;
    }
    
    /**
     * @return ModuleOptions
     */
    public function getOptions()
    {
        return $this->getOptions();
    }
    
    /**
     * {@inheritDoc}
     * @see \Zend\ServiceManager\ServiceLocatorAwareInterface::setServiceLocator()
     */
    public function setServiceLocator(\Zend\ServiceManager\ServiceLocatorInterface $serviceLocator)
    {
       $this->serviceLocator = $serviceLocator;
    }

    /**
     * {@inheritDoc}
     * @see \Zend\ServiceManager\ServiceLocatorAwareInterface::getServiceLocator()
     */
    public function getServiceLocator()
    {
        return $this->serviceLocator;
    }
}