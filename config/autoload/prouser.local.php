<?php

$ldapOptions = array(
    'host' => 'dc-eek-zwd-05.zwd.deeekhoorn.com',
    'port' => '389',
    'useStartTls' => 'false',
    'accountDomainName' => 'zwd.deeekhoorn.com',
    'accountDomainNameShort' => 'EEKZWD',
    'accountCanonicalForm' => '4',
    'baseDn' => 'OU=Accounts,DC=zwd,DC=deeekhoorn,DC=com',
    'username' => 'administrator@zwd.deeekhoorn.com',
    'password' => 'dihap',
);

return array(
    'prouser' => array(
        'ldap_options' => array(
                'host'                      => $ldapOptions['host'],
                'port'                      => $ldapOptions['port'],
                'useStartTls'               => $ldapOptions['useStartTls'],
                'username'                  => $ldapOptions['username'],
                'password'                  => $ldapOptions['password'],
                'accountDomainName'         => $ldapOptions['accountDomainName'],
                'accountDomainNameShort'    => $ldapOptions['accountDomainNameShort'],
                'baseDn'                    => $ldapOptions['baseDn'],    
        ),
        'ldap_auth_options' => array(
            'server' => array(
                'host'                      => $ldapOptions['host'],
                'port'                      => $ldapOptions['port'],
                'useStartTls'               => $ldapOptions['useStartTls'],
                'accountDomainName'         => $ldapOptions['accountDomainName'],
                'accountDomainNameShort'    => $ldapOptions['accountDomainNameShort'],
                'accountCanonicalForm'      => $ldapOptions['accountCanonicalForm'],
                'baseDn'                    => $ldapOptions['baseDn'],
            ),
        ),
        
    ),
);