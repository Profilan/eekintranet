<?php
namespace ProLdap\ORM\Mapping;

class ClassMetadata implements ClassMetadataInterface
{
    /**
     * 
     * @var string
     */
    public $name;
    
    /**
     * 
     * @param string $entityName
     */
    public function __construct($entityName)
    {
        $this->name = $entityName;
    }

    /**
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
 
    
    
}