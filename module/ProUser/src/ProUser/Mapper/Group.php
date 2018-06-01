<?php
namespace ProUser\Mapper;

use Zend\Ldap\Ldap;
use ProUser\Options\ModuleOptions;
use Zend\Stdlib\Hydrator\HydratorInterface;
use ProLdap\ORM\EntityManager;
use ProLdap\Stdlib\Hydrator\LdapObject;
use Zend\Stdlib\Hydrator\ClassMethods;

class Group implements GroupInterface
{
    /**
     * 
     * @var EntityManager
     */
    protected $em;
    
    /**
     * 
     * @var HydratorInterface
     */
    protected $hydrator;
    
    /**
     * 
     * @var ModuleOptions
     */
    protected $options;

    /**
     * @var boolean
     */
    private $isInitialized = false;

    /**
     * Performs some basic initialization setup and checks before running a query
     * @return null
     */
    protected function initialize()
    {
        if ($this->isInitialized) {
            return;
        }

        if (!$this->em instanceof EntityManager) {
            throw new \Exception('No EntityManager object present');
        }

        if (!$this->hydrator instanceof HydratorInterface) {
            $this->hydrator = new ClassMethods();
            
        }

//         if (!is_object($this->entityPrototype)) {
//             throw new \Exception('No entity prototype set');
//         }

        $this->isInitialized = true;
    }
    
    public function findAll()
    {
        $this->initialize();
        
        return $this->em->getRepository('group')->findAll(array('name' => 'ASC'));
        
    }
    
    /**
     *
     * {@inheritDoc}
     *
     * @see \ProUser\Mapper\GroupInterface::findByDistinguishedname()
     */
    public function findByDistinguishedname($distinguishedname)
    {
        $this->initialize();
        
        return $this->em->getRepository('group')->findBy(array('distinguishedname' => $distinguishedname), array('name' => 'ASC'));
    }
    
    public function findByName($name)
    {
        $this->initialize();
        
        return $this->em->getRepository('group')->findBy(array('name' => $name), array('name' => 'ASC'));
    }
    
    public function findByGUID($objectguid) 
    {
        $this->initialize();
        
        return $this->em->getRepository('group')->findBy(array('objectguid' => $objectguid), array('name' => 'ASC'));
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \ProUser\Mapper\GroupInterface::insert()
     */
    public function insert($group)
    {
        // TODO: Auto-generated method stub
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \ProUser\Mapper\GroupInterface::update()
     */
    public function update($group)
    {
        $this->initialize();
        
        return $this->em->getRepository('group')->update($group);
    }

    /**
     * @return HydratorInterface
     */
    public function getHydrator()
    {
        if (!$this->hydrator) {
            $this->hydrator = new ClassMethods();
        }
        return $this->hydrator;
    }
    
    /**
     * @param HydratorInterface $hydrator
     * @return AbstractDbMapper
     */
    public function setHydrator(HydratorInterface $hydrator)
    {
        $this->hydrator = $hydrator;
//        $this->resultSetPrototype = null;
        return $this;
    }
    
    public function getEntityManager()
    {
        return $this->em;
    }
    
    public function setEntityManager(EntityManager $em)
    {
        $this->em = $em;
        
        return $this;
    }
    
    protected function getDistinguishedName($username)
    {
        return $this->ldap->getCanonicalAccountName($username, Ldap::ACCTNAME_FORM_DN);
    }
    
    
}
