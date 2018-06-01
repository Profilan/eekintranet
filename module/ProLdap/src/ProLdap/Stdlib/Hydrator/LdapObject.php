<?php
namespace ProLdap\Stdlib\Hydrator;

use Zend\Stdlib\Hydrator\AbstractHydrator;
use Zend\Ldap\Ldap;

class LdapObject extends AbstractHydrator
{
    /**
     * The Zend\Ldap\Ldap context.
     * 
     * @var Ldap
     */
    protected $ldap = null;
    
    /**
     * Constructor
     *
     * @param Ldap $ldap The Ldap context to use
     */
    public function __construct(Ldap $ldap)
    {
        parent::__construct();
    
        $this->ldap     = $ldap;
    }

    /**
     * Extract values from an object
     *
     * @param  object $object
     * @return array
     */
    public function extract($object)
    {
        
    }
    
    /**
     * Hydrate $object with the provided $data.
     *
     * @param  array  $data
     * @param  object $object
     * @return object
     */
    public function hydrate(array $data, $object)
    {
        
    }
    
}