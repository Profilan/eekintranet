<?php
namespace ProLdap\Stdlib\Hydrator;


use Zend\Stdlib\Hydrator\Strategy\StrategyInterface;

class LdapObjectStrategy implements StrategyInterface
{
    /**
     * {@inheritDoc}
     * @see \Zend\Stdlib\Hydrator\Strategy\StrategyInterface::extract()
     */
    public function extract($value)
    {
        if ($value === null) {
            return null;
        }
        
        return $value;
    }

    /**
     * {@inheritDoc}
     * @see \Zend\Stdlib\Hydrator\Strategy\StrategyInterface::hydrate()
     */
    public function hydrate($value)
    {
        if ($value === null || $value === '') {
            return null;
        }
        
        return $value[0];
    }

    
}