<?php
namespace ProUser\Service;

use Zend\ServiceManager\ServiceManagerAwareInterface;
use ProUser\Mapper\GroupInterface as GroupMapperInterface;

class Group implements ServiceManagerAwareInterface
{

    /**
     * 
     * @var GroupMapperInterface
     */
    protected $groupMapper;
    
    /**
     * @var ServiceManager
     */
    protected $serviceManager;

    public function findAll()
    {
        return $this->getGroupMapper()->findAll();
    }
    
    public function findByDistinguishedname($distinguishedname)
    {
        return $this->getGroupMapper()->findByDistinguishedname($distinguishedname);
    }

    public function findByName($name)
    {
        return $this->getGroupMapper()->findByName($name);
    }
    
    public function update($data)
    {
        return $this->getGroupMapper()->update($data);
    }
    
    /**
     * getGroupMapper
     *
     * @return GroupMapperInterface
     */
    public function getGroupMapper()
    {
        if (null === $this->groupMapper) {
            $this->groupMapper = $this->getServiceManager()->get('prouser_group_mapper');
        }
        return $this->groupMapper;
    }
    
    /**
     * setGroupMapper
     *
     * @param GroupMapperInterface $groupMapper
     * @return Group
     */
    public function setGroupMapper(GroupMapperInterface $groupMapper)
    {
        $this->groupMapper = $groupMapper;
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


