<?php
namespace ProLdap\Ldap;

use Zend\Ldap\Ldap;

class Ldap extends \Zend\Ldap\Ldap
{
    public function __construct($options = array())
    {
        parent::__construct($options);
        
        
    }
}