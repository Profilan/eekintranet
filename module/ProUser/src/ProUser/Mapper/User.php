<?php
namespace ProUser\Mapper;

use Zend\Ldap\Ldap;
use ProUser\Options\ModuleOptions;
use Zend\Stdlib\Hydrator\HydratorInterface;
use ProLdap\ORM\EntityManager;
use ProLdap\Stdlib\Hydrator\LdapObject;
use Zend\Stdlib\Hydrator\ClassMethods;

class User implements UserInterface
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
        
        return $this->em->getRepository('user')->findAll(array('displayname' => 'ASC'));
        
    }
    
    public function findBy($criteria)
    {
        $this->initialize();
        
        return $this->em->getRepository('user')->findBy($criteria, array('displayname' => 'ASC'));
    }
    
    /**
     *
     * {@inheritDoc}
     *
     * @see \ProUser\Mapper\UserInterface::findByEmail()
     */
    public function findByEmail($email)
    {
        $this->initialize();
        
        return $this->em->getRepository('user')->findBy(array('email' => $email), array('displayname' => 'ASC'));
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \ProUser\Mapper\UserInterface::findByUsername()
     */
    public function findByUsername($username)
    {
        $this->initialize();
        
        return $this->em->getRepository('user')->findBy(array('userprincipalname' => $username), array('displayname' => 'ASC'));
    }
    
    public function findByDepartment($department)
    {
        $this->initialize();
        
        return $this->em->getRepository('user')->findBy(array('department' => $department), array('displayname' => 'ASC'));
    }
    
    public function getByGUID($objectguid) 
    {
        $this->initialize();
        
        return $this->em->getRepository('user')->findBy(array('objectguid' => $objectguid), array('displayname' => 'ASC'));
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \ProUser\Mapper\UserInterface::insert()
     */
    public function insert($user)
    {
        // TODO: Auto-generated method stub
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \ProUser\Mapper\UserInterface::update()
     */
    public function update($user)
    {
        $this->initialize();
        
        return $this->em->getRepository('user')->update($user);
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
