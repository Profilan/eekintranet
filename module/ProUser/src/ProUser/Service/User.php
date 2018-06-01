<?php
namespace ProUser\Service;

use Zend\ServiceManager\ServiceManagerAwareInterface;
use ProUser\Mapper\UserInterface as UserMapperInterface;

class User implements ServiceManagerAwareInterface
{

    /**
     * 
     * @var UserMapperInterface
     */
    protected $userMapper;
    
    /**
     * @var ServiceManager
     */
    protected $serviceManager;

    public function findAll()
    {
        return $this->getUserMapper()->findAll();
    }
    
    public function findBy($criteria)
    {
        return $this->getUserMapper()->findBy($criteria);
    }
    
    public function findByUsername($username)
    {
        return $this->getUserMapper()->findByUsername($username);
    }

    public function findByDepartment($department)
    {
        return $this->getUserMapper()->findByDepartment($department);
    }
    
    public function update($data)
    {
        return $this->getUserMapper()->update($data);
    }
    
    /**
     * getUserMapper
     *
     * @return UserMapperInterface
     */
    public function getUserMapper()
    {
        if (null === $this->userMapper) {
            $this->userMapper = $this->getServiceManager()->get('prouser_user_mapper');
        }
        return $this->userMapper;
    }
    
    /**
     * setUserMapper
     *
     * @param UserMapperInterface $userMapper
     * @return User
     */
    public function setUserMapper(UserMapperInterface $userMapper)
    {
        $this->userMapper = $userMapper;
        return $this;
    }

    /**
     * Retrieve service manager instance
     *
     * @return ServiceManager
     */
    public function getServiceManager()
    {
        return $this->serviceManager;
    }
    
    /**
     * Set service manager instance
     *
     * @param ServiceManager $serviceManager
     * @return User
     */
    public function setServiceManager(\Zend\ServiceManager\ServiceManager $serviceManager)
    {
        $this->serviceManager = $serviceManager;
        return $this;
    }

    
}


