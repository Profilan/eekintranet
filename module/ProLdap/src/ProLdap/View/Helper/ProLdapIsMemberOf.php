<?php

namespace ProLdap\View\Helper;

use Zend\View\Helper\AbstractHelper;
use ProLdap\ORM\EntityManager;
use ProUser\Entity\User;

class ProLdapIsMemberOf extends AbstractHelper
{
    /**
     * @var EntityManager
     */
    protected $em;

    /**
     * __invoke
     *
     * @param User
     * @param string $groupName
     * @return bool
     */
    public function __invoke(User $user, $groupName)
    {
        foreach ($user->getMemberof() as $group) {
            if ($this->parseGroup($group)['CN'] == $groupName) {
                return true;
            }
        }
        
        return false;
    }

    /**
     * Get entity manager.
     *
     * @return EntityManager
     */
    public function getEntityManager()
    {
        return $this->em;
    }

    /**
     * Set entity manager.
     *
     * @param EntityManager
     * @return ProLdapIsMemberOf
     */
    public function setEntityManager(EntityManager $em)
    {
        $this->em = $em;
        return $this;
    }
    
    protected function parseGroup($group)
    {
        $parts = explode(',', $group);
        
        $result = array();
        foreach ($parts as $part) {
            $pair = explode('=', $part);
            $result[$pair[0]] = $pair[1];
        }
        
        return $result;
    }
}
