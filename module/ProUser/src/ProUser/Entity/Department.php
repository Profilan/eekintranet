<?php
namespace ProUser\Entity;

use Doctrine\ORM\Mapping as ORM;

/** @ORM\Entity
 * @property $id
 * @property $descriptionNl
 * @property $descriptionEn
 * */
class Department
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     * 
     * @var int
     */
    protected $id;
    
    /**
     * @ORM\Column(type="string")
     * 
     * @var string
     */
    protected $descriptionNl;
    
    /**
     * @ORM\Column(type="string")
     * 
     * @var string
     */
    protected $descriptionEn;

    /**
     * @ORM\Column(type="string")
     *
     * @var string
     */
    protected $descriptionDe;

    /**
     * @ORM\Column(type="string")
     *
     * @var string
     */
    protected $descriptionFr;
    
    /**
     * @ORM\Column(type="string")
     * 
     * @var string
     */
    protected $signatureSet;

    /**
     * @return the $id
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * @return the $descriptionNl
     */
    public function getDescriptionNl()
    {
        return $this->descriptionNl;
    }

    /**
     * @param string $descriptionNl
     */
    public function setDescriptionNl($descriptionNl)
    {
        $this->descriptionNl = $descriptionNl;
    }

    /**
     * @return the $descriptionEn
     */
    public function getDescriptionEn()
    {
        return $this->descriptionEn;
    }

    /**
     * @param string $descriptionEn
     */
    public function setDescriptionEn($descriptionEn)
    {
        $this->descriptionEn = $descriptionEn;
    }

    /**
     *
     * @return the string
     */
    public function getDescriptionDe()
    {
        return $this->descriptionDe;
    }

    /**
     *
     * @param $descriptionDe
     */
    public function setDescriptionDe($descriptionDe)
    {
        $this->descriptionDe = $descriptionDe;
        return $this;
    }
 

    /**
     * @return the $descriptionFr
     */
    public function getDescriptionFr()
    {
        return $this->descriptionFr;
    }

    /**
     * @param string $descriptionFr
     */
    public function setDescriptionFr($descriptionFr)
    {
        $this->descriptionFr = $descriptionFr;
    }

    /**
     * @return the $signatureSet
     */
    public function getSignatureSet()
    {
        return $this->signatureSet;
    }

    /**
     * @param string $signatureSet
     */
    public function setSignatureSet($signatureSet)
    {
        $this->signatureSet = $signatureSet;
    }

    public function exchangeArray($data) 
    {
        $this->id = $data['id'];
        $this->descriptionNl = $data['descriptionNl'];
        $this->descriptionEn = $data['descriptionEn'];
        $this->descriptionDe = $data['descriptionDe'];
        $this->signatureSet = $data['signatureSet'];
        
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