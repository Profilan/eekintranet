<?php
namespace ProLdap\Factory\ORM\Mapping;

class ClassMetadataFactory
{

    /**
     * @var ClassMetadata[]
     */
    private $loadedMetadata = array();

    /**
     * @var bool
     */
    protected $initialized = false;
    
    public function getMetadataFor($className)
    {
        
        $class = new $className();
        
        $this->loadMetadata($className);
    }
    
    protected function loadMetadata($className)
    {
        $loaded = array();
        
        $class = new $className();
        
        $this->loadedMetadata[$className] = $class;
        
        $loaded[] = $className;
        
        return $loaded;
    }
}