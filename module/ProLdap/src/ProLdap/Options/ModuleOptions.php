<?php
namespace ProLdap\Options;

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
     * @return the array
     */
    public function getLdapOptions()
    {
        return $this->ldapOptions;
    }

    /**
     *
     * @param array $ldapOptions            
     */
    public function setLdapOptions(array $ldapOptions)
    {
        $this->ldapOptions = $ldapOptions;
        return $this;
    }
 
    
    
}