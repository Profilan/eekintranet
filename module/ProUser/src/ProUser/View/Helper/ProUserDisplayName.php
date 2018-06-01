<?php

namespace ProUser\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\Authentication\AuthenticationService;
use ProUser\Entity\User;

class ProUserDisplayName extends AbstractHelper
{
    /**
     * @var AuthenticationService
     */
    protected $authService;

    /**
     * __invoke
     *
     * @access public
     * @param User $user
     * @throws \ZfcUser\Exception\DomainException
     * @return String
     */
    public function __invoke(User $user = null)
    {
        if (null === $user) {
            if ($this->getAuthService()->hasIdentity()) {
                $identity = $this->getAuthService()->getIdentity();
                
                // Find the user by its identity
                
            } else {
                return false;
            }
        }
        
        $displayName = $user->getDisplayName();
        if (null === $displayName) {
            $displayName = $user->getUsername();
        }
        // User will always have an email, so we do not have to throw error
        if (null === $displayName) {
            $displayName = $user->getEmail();
            $displayName = substr($displayName, 0, strpos($displayName, '@'));
        }
        
        return $displayName;
        
    }

    /**
     * Get authService.
     *
     * @return AuthenticationService
     */
    public function getAuthService()
    {
        return $this->authService;
    }

    /**
     * Set authService.
     *
     * @param AuthenticationService $authService
     * @return \ProUser\View\Helper\ProUserDisplayName
     */
    public function setAuthService(AuthenticationService $authService)
    {
        $this->authService = $authService;
        return $this;
    }
}
