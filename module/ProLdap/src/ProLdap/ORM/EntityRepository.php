<?php
namespace ProLdap\ORM;

use Zend\Ldap\Ldap;
use ProLdap\Options\ModuleOptions;
use Zend\Ldap\Attribute;
use ProUser\Entity\User;
use ProUser\Entity\Group;

class EntityRepository
{
    /**
     * @var string
     */
    protected $objectClass;
    
    /**
     * @var EntityManager
     */
    protected $em;
    
    /**
     * 
     * @var Mapping\ClassMetadata
     */
    protected $class;
    
    protected $attributes = array();

    /**
     * 
     * @param EntityManager $em
     * @param string $objectClass
     */
    public function __construct($em, $objectClass)
    {
        $this->em           = $em;
        $this->objectClass  = $objectClass;
        
        switch ($this->objectClass) {
            case 'user':
                $this->attributes = array(
                    'objectguid',
                    'distinguishedname',
                    'displayname',
                    'userprincipalname',
                    'samaccountname',
                    'jpegphoto',
                    'mail',
                    'title',
                    'extensionattribute1',
                    'extensionattribute2',
                    'extensionattribute3',
                    'extensionattribute4',
                    'extensionattribute5',
                    'extensionattribute6',
                    'extensionattribute7',
                    'extensionattribute8',
                    'extensionattribute9',
                    'extensionattribute10',
                    'extensionattribute11',
                    'department',
                    'telephonenumber',
                    'mobile',
                    'url',
                    'memberof',
                    'useraccountcontrol',
                );
                break;
            case 'group':
                $this->attributes = array(
                    'objectguid',
                    'distinguishedname',
                    'name',
                    'samaccountname',
                    'member',
                );
                break;
        }
    }
    
    public function findAll(array $orderBy = array(), $limit = null, $offset = null)
    {
        return $this->findBy(array(), $orderBy, $limit, $offset);
    }
    
    public function findBy(array $criteria, array $orderBy = array(), $limit = null, $offset = null)
    {
        $items = array();
        foreach ($this->em->getLdaps() as $ldap) {
            $ldap->bind();
            
    //        echo $this->buildQuery($criteria);die();
            
            $result = $ldap->search($this->buildQuery($criteria), null, Ldap::SEARCH_SCOPE_SUB, $this->attributes, $this->buildOrderBy($orderBy), null, $limit);
            
            foreach ($result as $item) {
                switch ($this->objectClass) {
                    case 'user':
                        $user = new User();
                        if (!empty($item['objectguid'])) {
                            $user->setObjectguid($this->GUIDtoStr($item['objectguid'][0]));
                        }
                        if (!empty($item['distinguishedname'])) {
                            $user->setDistinguishedname($item['distinguishedname'][0]);
                        }
                        if (!empty($item['displayname'])) {
                            $user->setDisplayname($item['displayname'][0]);
                        }
                        if (!empty($item['samaccountname'])) {
                            $user->setSamaccountname($item['samaccountname'][0]);
                        }
                        if (!empty($item['jpegphoto'])) {
                            $user->setPhoto(base64_encode($item['jpegphoto'][0]));
                            $user->setJpegphoto($item['jpegphoto'][0]);
                        }
                        if (!empty($item['userprincipalname'])) {
                            $user->setUserprincipalname($item['userprincipalname'][0]);
                        }
                        if (!empty($item['mail'])) {
                            $user->setMail($item['mail'][0]);
                        }
                        if (!empty($item['title'])) {
                            $user->setTitleNl($item['title'][0]);
                        }
                        if (!empty($item['extensionattribute1'])) {
                            $user->setTitleEn($item['extensionattribute1'][0]);
                        }
                        if (!empty($item['extensionattribute4'])) {
                            $user->setTitleDe($item['extensionattribute4'][0]);
                        }
                        if (!empty($item['extensionattribute9'])) {
                            $user->setTitleFr($item['extensionattribute9'][0]);
                        }
                        if (!empty($item['department'])) {
                            $user->setDepartmentNl($item['department'][0]);
                        }
                        if (!empty($item['extensionattribute2'])) {
                            $user->setDepartmentEn($item['extensionattribute2'][0]);            
                        }
                        if (!empty($item['extensionattribute3'])) {
                            $user->setDepartmentDe($item['extensionattribute3'][0]);            
                        }
                        if (!empty($item['extensionattribute10'])) {
                            $user->setDepartmentFr($item['extensionattribute10'][0]);            
                        }
                        if (!empty($item['extensionattribute5'])) {
                            $user->setCommonTelephonenumber($item['extensionattribute5'][0]);
                        }
                        if (!empty($item['extensionattribute6'])) {
                            $user->setSignatureExtra($item['extensionattribute6'][0]);
                        }
                        if (!empty($item['extensionattribute7'])) {
                            $user->setSignatureExtraEn($item['extensionattribute7'][0]);
                        }
                        if (!empty($item['extensionattribute8'])) {
                            $user->setSignatureExtraDe($item['extensionattribute8'][0]);
                        }
                        if (!empty($item['extensionattribute11'])) {
                            $user->setSignatureExtraFr($item['extensionattribute11'][0]);
                        }
                        if (!empty($item['telephonenumber'])) {
                            $user->setTelephonenumber($item['telephonenumber'][0]);
                        }
                        if (!empty($item['mobile'])) {
                            $user->setMobile($item['mobile'][0]);
                        }
                        if (!empty($item['url'])) {
                            $user->setUrl($item['url'][0]);
                        }
                        if (!empty($item['useraccountcontrol'])) {
                            if ($item['useraccountcontrol'][0] & 2) {
                                $user->setEnabled(false);
                            } else {
                                $user->setEnabled(true);
                            }
                            $user->setUseraccountcontrol($item['useraccountcontrol'][0]);
                        }
                        if (!empty($item['memberof'])) {
                            $user->setMemberof($item['memberof']);
                        }
                        $items[] = $user;
                        break;
                    case 'group':
                        $group = new Group();
                        if (!empty($item['objectguid'])) {
                            $group->setObjectguid($this->GUIDtoStr($item['objectguid'][0]));
                        }
                        if (!empty($item['distinguishedname'])) {
                            $group->setDistinguishedname($item['distinguishedname'][0]);
                        }
                        if (!empty($item['name'])) {
                            $group->setName($item['name'][0]);
                        }
                        if (!empty($item['samaccountname'])) {
                            $group->setSamaccountname($item['samaccountname'][0]);
                        }
                        if (!empty($item['member'])) {
                            $group->setMember($item['member']);
                        }
                        $items[] = $group;
                        break;
                }
            }
        
        }
        
        if ($this->objectClass == 'user') {
            usort($items, "self::cmp");
        }
        
        return $items;
    }
    
    public function update($object)
    {
        $data = $object->getArrayCopy();
        
        foreach ($this->em->getLdaps() as $ldap) {
            $ldap->bind();
        
            switch ($this->objectClass) {
                case 'user':
                    $entry = $ldap->search($this->buildQuery(array('userprincipalname' => $data['userprincipalname'])), $ldap->getBaseDn(), Ldap::SEARCH_SCOPE_SUB, $this->attributes);
                    if ($entry) {
                        
                        $hm = $entry->getFirst();
                        unset($hm['objectguid']);
                        unset($hm['mail']);
                        unset($hm['memberof']);
                        unset($hm['useraccountcontrol']);
                        unset($hm['samaccountname']);
                        unset($hm['displayname']);
                        
                        Attribute::setAttribute($hm, 'title', $data['title']);
                        Attribute::setAttribute($hm, 'extensionattribute1', $data['extensionattribute1']);
                        Attribute::setAttribute($hm, 'extensionattribute2', $data['extensionattribute2']);
                        Attribute::setAttribute($hm, 'extensionattribute3', $data['extensionattribute3']);
                        Attribute::setAttribute($hm, 'extensionattribute4', $data['extensionattribute4']);
                        Attribute::setAttribute($hm, 'extensionattribute5', $data['extensionattribute5']);
                        Attribute::setAttribute($hm, 'extensionattribute6', $data['extensionattribute6']);
                        Attribute::setAttribute($hm, 'extensionattribute7', $data['extensionattribute7']);
                        Attribute::setAttribute($hm, 'extensionattribute8', $data['extensionattribute8']);
                        Attribute::setAttribute($hm, 'extensionattribute9', $data['extensionattribute9']);
                        Attribute::setAttribute($hm, 'extensionattribute10', $data['extensionattribute10']);
                        Attribute::setAttribute($hm, 'extensionattribute11', $data['extensionattribute11']);
                        Attribute::setAttribute($hm, 'department', $data['department']);
                        Attribute::setAttribute($hm, 'telephonenumber', $data['telephonenumber']);
                        Attribute::setAttribute($hm, 'mobile', $data['mobile']);
                        Attribute::setAttribute($hm, 'url', $data['url']);
                        if (isset($data['jpegphoto'])) {
                            Attribute::setAttribute($hm, 'jpegphoto', $data['jpegphoto']);
                        }
                        
                        return $ldap->update($data['distinguishedname'], $hm);
                    }
                    break;
                case 'group':
                    $entry = $ldap->search($this->buildQuery(array('distinguishedname' => $data['distinguishedname'])), $ldap->getBaseDn(), Ldap::SEARCH_SCOPE_SUB, $this->attributes);
                    if ($entry) {
                        $hm = $entry->getFirst();
                        unset($hm['objectguid']);
                        unset($hm['name']);
                        unset($hm['samaccountname']);
                        
                        Attribute::setAttribute($hm, 'member', $data['member']);
                        
                        return $ldap->update($data['distinguishedname'], $hm);
                    }
                    
                    break;
            }
        }
    }
    
    protected function GUIDtoStr($binary_guid) 
    {
        $unpacked = unpack('Va/v2b/n2c/Nd', $binary_guid);
        return sprintf('%08x%04x%04x%04x%04x%08x', $unpacked['a'], $unpacked['b1'], $unpacked['b2'], $unpacked['c1'], $unpacked['c2'], $unpacked['d']);
    }
    
    protected function buildQuery(array $criteria)
    {
        $query = array();
        $query[] = '(objectClass='.$this->objectClass.')';
        $query[] = '(!(objectClass=computer))';
//        echo '<pre>'.print_r($criteria, true).'</pre>'; die();
        foreach ($criteria as $k => $v) {
            $query[] = '('.$k.'='.$v.')';
        }
        
        return '(&'.implode('', $query).')';
    }
    
    protected function buildOrderBy(array $orderBy)
    {
        $orderStr = '';
        if (is_array($orderBy)) {
            foreach ($orderBy as $k => $v) {
               $orderStr .= $k;
            }
        } else {
            return array();
        }
        
        return $orderStr;
    }
    

    private static function cmp($a, $b)
    {
        return strcmp($a->getDisplayname(), $b->getDisplayname());
    }
    
}