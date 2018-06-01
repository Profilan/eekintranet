<?php

$ldapOptions1 = array(
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

$ldapOptions2 = array(
    'host' => 'dcbl02.basiclabel.local',
    'port' => '389',
    'useStartTls' => 'false',
    'accountDomainName' => 'basiclabel.local',
    'accountDomainNameShort' => 'BASICLABEL',
    'accountCanonicalForm' => '4',
    'baseDn' => 'OU=Filialen,DC=basiclabel,DC=local',
    'username' => 'administrator@basiclabel.local',
    'password' => 'd1hap2',
);

return array(
    'proldap' => array(
        'ldap_options' => array(
            'server1' => array(
                'host'                      => $ldapOptions1['host'],
                'port'                      => $ldapOptions1['port'],
                'useStartTls'               => $ldapOptions1['useStartTls'],
                'username'                  => $ldapOptions1['username'],
                'password'                  => $ldapOptions1['password'],
                'accountDomainName'         => $ldapOptions1['accountDomainName'],
                'accountDomainNameShort'    => $ldapOptions1['accountDomainNameShort'],
                'baseDn'                    => $ldapOptions1['baseDn'],
            ),
            'server2' => array(
                'host'                      => $ldapOptions2['host'],
                'port'                      => $ldapOptions2['port'],
                'useStartTls'               => $ldapOptions2['useStartTls'],
                'username'                  => $ldapOptions2['username'],
                'password'                  => $ldapOptions2['password'],
                'accountDomainName'         => $ldapOptions2['accountDomainName'],
                'accountDomainNameShort'    => $ldapOptions2['accountDomainNameShort'],
                'baseDn'                    => $ldapOptions2['baseDn'],
            ),
        ),
    ),
);