<?php
namespace ProUser\Entity;


class Group
{
    /**
     * 
     * @var string
     */
    protected $objectguid;
    
    /**
     * 
     * @var string
     */
    protected $distinguishedname;
    
    /**
     * 
     * @var string
     */
    protected $name;
    
    /**
     * 
     * @var string
     */
    protected $samaccountname;

    /**
     * 
     * @var array
     */
    protected $member;
    
    public function __construct()
    {
        $this->distinguishedname = '';
        $this->member = array();
        $this->name = '';
        $this->objectguid = '';
        $this->samaccountname = '';
    }
    
    /**
     * @return the $objectguid
     */
    public function getObjectguid()
    {
        return $this->objectguid;
    }

    /**
     * @param string $objectguid
     */
    public function setObjectguid($objectguid)
    {
        $this->objectguid = $objectguid;
    }

    /**
     * @return the $distinguishedname
     */
    public function getDistinguishedname()
    {
        return $this->distinguishedname;
    }

    /**
     * @param string $distinguishedname
     */
    public function setDistinguishedname($distinguishedname)
    {
        $this->distinguishedname = $distinguishedname;
    }

    /**
     * @return the $name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return the $samaccountname
     */
    public function getSamaccountname()
    {
        return $this->samaccountname;
    }

    /**
     * @param string $samaccountname
     */
    public function setSamaccountname($samaccountname)
    {
        $this->samaccountname = $samaccountname;
    }

    /**
     * @return the $member
     */
    public function getMember()
    {
        return $this->member;
    }

    /**
     * @param multitype: $member
     */
    public function setMember($member)
    {
        $this->member = $member;
    }
    

    /**
     * Convert the object to an array.
     *
     * @return array
     */
    public function getArrayCopy()
    {
        return get_object_vars($this);
    }
    
}