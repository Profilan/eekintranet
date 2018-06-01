<?php

namespace ProUser\Options;

use Zend\Stdlib\AbstractOptions;

class ModuleOptions extends AbstractOptions
{
    /**
     * Turn off strict options mode
     */
    protected $__strictMode__ = false;
    
    /**
     * @var array
     */
    protected $ldapOptions;
    
    /**
     * 
     * @var array
     */
    protected $ldapAuthOptions;

    /**
     *
     * @return array
     * 
     */
    public function getLdapOptions()
    {
        return $this->ldapOptions;
    }

    /**
     *
     * @param array $ldapOptions
     * @return ModuleOptions
     *            
     */
    public function setLdapOptions($ldapOptions)
    {
        $this->ldapOptions = $ldapOptions;
        return $this;
    }

    /**
     *
     * @return array
     */
    public function getLdapAuthOptions()
    {
        return $this->ldapAuthOptions;
    }

    /**
     *
     * @param array $ldapAuthOptions            
     * @return ModuleOptions
     */
    public function setLdapAuthOptions(array $ldapAuthOptions)
    {
        $this->ldapAuthOptions = $ldapAuthOptions;
        return $this;
    }
  
    
    
}
