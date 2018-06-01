<?php
namespace ProUser\Entity;


class User implements UserInterface
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
    protected $displayname;
    
    /**
     * 
     * @var string
     */
    protected $userprincipalname;
    
    /**
     * 
     * @var string
     */
    protected $samaccountname;

    /**
     *
     * @var string
     */
    protected $photo;
    
    /**
     * 
     * @var string
     */
    protected $jpegphoto;
    
    /**
     * 
     * @var string
     */
    protected $mail;
    
    /**
     * 
     * @var string
     */
    protected $title_nl;

    /**
     *
     * @var string
     */
    protected $title_en;

    /**
     *
     * @var string
     */
    protected $title_de;

    /**
     *
     * @var string
     */
    protected $title_fr;
    
    /**
     * 
     * @var string
     */
    protected $department_nl;

    /**
     *
     * @var string
     */
    protected $department_en;

    /**
     *
     * @var string
     */
    protected $department_de;

    /**
     *
     * @var string
     */
    protected $department_fr;
    
    /**
     * 
     * @var string
     */
    protected $telephonenumber;

    /**
     *
     * @var string
     */
    protected $common_telephonenumber;
    
    /**
     * 
     * @var string
     */
    protected $mobile;

    /**
     *
     * @var string
     */
    protected $url;
    
    /**
     * 
     * @var bool
     */
    protected $enabled;
    
    /**
     * 
     * @var int
     */
    protected $useraccountcontrol;
    
    /**
     * 
     * @var array
     */
    protected $memberof;

    /**
     *
     * @var string
     */
    protected $signatureExtra;

    /**
     *
     * @var string
     */
    protected $signatureExtraEn;

    /**
     *
     * @var string
     */
    protected $signatureExtraDe;

    /**
     *
     * @var string
     */
    protected $signatureExtraFr;
    
    public function __construct()
    {
        $this->department_en = '';
        $this->department_nl = '';
        $this->department_de = '';
        $this->department_fr = '';
        $this->displayname = '';
        $this->distinguishedname = '';
        $this->enabled = true;
        $this->jpegphoto = '';
        $this->mail = '';
        $this->memberof = array();
        $this->mobile = '';
        $this->objectguid = '';
        $this->photo = '';
        $this->samaccountname = '';
        $this->telephonenumber = '';
        $this->common_telephonenumber = '';
        $this->title_en = '';
        $this->title_nl = '';
        $this->title_de = '';
        $this->title_fr = '';
        $this->url = '';
        $this->useraccountcontrol = 0;
        $this->userprincipalname = '';
        $this->signatureExtra = '';
        $this->signatureExtraEn = '';
        $this->signatureExtraDe = '';
        $this->signatureExtraFr = '';
    }

    /**
     *
     * @return string
     */
    public function getDisplayname()
    {
        return $this->displayname;
    }

    /**
     *
     * @param string $displayname
     */
    public function setDisplayname($displayname)
    {
        $this->displayname = $displayname;
        return $this;
    }

    /**
     *
     * @return string
     */
    public function getUserprincipalname()
    {
        return $this->userprincipalname;
    }

    /**
     *
     * @param string $userprincipalname
     */
    public function setUserprincipalname($userprincipalname)
    {
        $this->userprincipalname = $userprincipalname;
        return $this;
    }

    /**
     *
     * @return string
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     *
     * @param string $mail
     */
    public function setMail($mail)
    {
        $this->mail = $mail;
        return $this;
    }

    /**
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     *
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     *
     * @return string
     */
    public function getTelephonenumber()
    {
        return $this->telephonenumber;
    }

    /**
     *
     * @param string $telephonenumber
     */
    public function setTelephonenumber($telephonenumber)
    {
        $this->telephonenumber = $telephonenumber;
        return $this;
    }

    /**
     * @return the $common_telephonenumber
     */
    public function getCommonTelephonenumber()
    {
        return $this->common_telephonenumber;
    }

    /**
     * @param string $common_telephonenumber
     */
    public function setCommonTelephonenumber($common_telephonenumber)
    {
        $this->common_telephonenumber = $common_telephonenumber;
        return $this;
    }

    /**
     *
     * @return string
     */
    public function getMobile()
    {
        return $this->mobile;
    }

    /**
     *
     * @param string $mobile
     */
    public function setMobile($mobile)
    {
        $this->mobile = $mobile;
        return $this;
    }

    /**
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     *
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
        return $this;
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
     * @return the $photo
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * @param string $photo
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;
    }

    /**
     * @return the $jpegphoto
     */
    public function getJpegphoto()
    {
        return $this->jpegphoto;
    }

    /**
     * @param string $jpegphoto
     */
    public function setJpegphoto($jpegphoto)
    {
        $this->jpegphoto = $jpegphoto;
    }

    /**
     * @return the $title_nl
     */
    public function getTitleNl()
    {
        return $this->title_nl;
    }

    /**
     * @param string $title_nl
     */
    public function setTitleNl($title_nl)
    {
        $this->title_nl = $title_nl;
    }

    /**
     * @return the $title_en
     */
    public function getTitleEn()
    {
        return $this->title_en;
    }

    /**
     * @param string $title_en
     */
    public function setTitleEn($title_en)
    {
        $this->title_en = $title_en;
    }

    /**
     *
     * @return the string
     */
    public function getTitleDe()
    {
        return $this->title_de;
    }

    /**
     *
     * @param $title_de
     */
    public function setTitleDe($title_de)
    {
        $this->title_de = $title_de;
        return $this;
    }
 

    /**
     * @return the $title_fr
     */
    public function getTitleFr()
    {
        return $this->title_fr;
    }

    /**
     * @param string $title_fr
     */
    public function setTitleFr($title_fr)
    {
        $this->title_fr = $title_fr;
    }

    /**
     * @return the $department_nl
     */
    public function getDepartmentNl()
    {
        return $this->department_nl;
    }

    /**
     * @param string $department_nl
     */
    public function setDepartmentNl($department_nl)
    {
        $this->department_nl = $department_nl;
    }

    /**
     * @return the $department_en
     */
    public function getDepartmentEn()
    {
        return $this->department_en;
    }

    /**
     * @param string $department_en
     */
    public function setDepartmentEn($department_en)
    {
        $this->department_en = $department_en;
    }

    /**
     *
     * @return the string
     */
    public function getDepartmentDe()
    {
        return $this->department_de;
    }

    /**
     *
     * @param $department_de
     */
    public function setDepartmentDe($department_de)
    {
        $this->department_de = $department_de;
        return $this;
    }
 

    /**
     * @return the $department_fr
     */
    public function getDepartmentFr()
    {
        return $this->department_fr;
    }

    /**
     * @param string $department_fr
     */
    public function setDepartmentFr($department_fr)
    {
        $this->department_fr = $department_fr;
    }

    /**
     * @return the $enabled
     */
    public function getEnabled()
    {
        return $this->enabled;
    }

    /**
     * @param boolean $enabled
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;
    }

    /**
     * @return the $useraccountcontrol
     */
    public function getUseraccountcontrol()
    {
        return $this->useraccountcontrol;
    }

    /**
     * @param number $useraccountcontrol
     */
    public function setUseraccountcontrol($useraccountcontrol)
    {
        $this->useraccountcontrol = $useraccountcontrol;
    }

    /**
     * @return the $memberof
     */
    public function getMemberof()
    {
        return $this->memberof;
    }

    /**
     * @param multitype: $memberof
     */
    public function setMemberof($memberof)
    {
        $this->memberof = $memberof;
    }

    /**
     * @return the $signatureExtra
     */
    public function getSignatureExtra()
    {
        return $this->signatureExtra;
    }

    /**
     * @param string $signatureExtra
     */
    public function setSignatureExtra($signatureExtra)
    {
        $this->signatureExtra = $signatureExtra;
    }

    /**
     * @return the $signatureExtraEn
     */
    public function getSignatureExtraEn()
    {
        return $this->signatureExtraEn;
    }

    /**
     * @param string $signatureExtraEn
     */
    public function setSignatureExtraEn($signatureExtraEn)
    {
        $this->signatureExtraEn = $signatureExtraEn;
    }

    /**
     * @return the $signatureExtraDe
     */
    public function getSignatureExtraDe()
    {
        return $this->signatureExtraDe;
    }

    /**
     * @param string $signatureExtraDe
     */
    public function setSignatureExtraDe($signatureExtraDe)
    {
        $this->signatureExtraDe = $signatureExtraDe;
    }

    /**
     * @return the $signatureExtraFr
     */
    public function getSignatureExtraFr()
    {
        return $this->signatureExtraFr;
    }

    /**
     * @param string $signatureExtraFr
     */
    public function setSignatureExtraFr($signatureExtraFr)
    {
        $this->signatureExtraFr = $signatureExtraFr;
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