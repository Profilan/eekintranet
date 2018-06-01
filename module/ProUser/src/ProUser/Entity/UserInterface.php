<?php
namespace ProUser\Entity;

interface UserInterface
{
    /**
     * Get display name.
     *
     * @return string
     */
    public function getDisplayName();

    /**
     * Set display name.
     *
     * @param string $displayName
     * @return UserInterface
     */
    public function setDisplayName($displayName);
    
    
}