<?php
namespace ProLdap\ORM\Mapping;

interface ClassMetadataInterface
{
    /**
     * Gets the fully-qualified class name of this persistent class.
     *
     * @return string
     */
    public function getName();
    
}