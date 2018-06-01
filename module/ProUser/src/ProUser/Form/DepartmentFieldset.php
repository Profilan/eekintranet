<?php
namespace ProUser\Form;

use ProUser\Entity\Department;
use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;

class DepartmentFieldset extends Fieldset implements InputFilterProviderInterface
{
    public function __construct(ObjectManager $objectManager)
    {
        parent::__construct('department');
        
        $this->setHydrator(new DoctrineHydrator($objectManager))->setObject(new Department());
        
        $this->add(array(
            'name' => 'id',
            'type' => 'Hidden'
        ));
        $this->add(array(
            'name' => 'descriptionNl',
            'type' => 'Text',
            'options' => array(
                'label' => 'Omschrijving (NL)'
            ),
            'attributes' => array(
                'class' => 'form-control',  
                'placeholder' => 'Omschrijving (NL)',
            ),
        ));
        $this->add(array(
            'name' => 'descriptionEn',
            'type' => 'Text',
            'options' => array(
                'label' => 'Omschrijving (EN)'
            ),
            'attributes' => array(
                'class' => 'form-control',  
                'placeholder' => 'Omschrijving (EN)',
            ),
        ));
        $this->add(array(
            'name' => 'descriptionDe',
            'type' => 'Text',
            'options' => array(
                'label' => 'Omschrijving (DE)'
            ),
            'attributes' => array(
                'class' => 'form-control',  
                'placeholder' => 'Omschrijving (DE)',
            ),
        ));
        $this->add(array(
            'name' => 'signatureSet',
            'type' => 'Select',
            'options' => array(
                'label' => 'Handtekeningenset',
                'value_options' => array(
                    'ExclaimerEekhoornZaadmarkt' => 'Eekhoorn Zaadmarkt',
                    'ExclaimerEekhoornMarktweg' => 'Eekhoorn Marktweg',
                    'ExclaimerBasiclabelMarktweg' => 'Basiclabel Marktweg',
                    'ExclaimerBasiclabelWinkel' => 'Basiclabel Winkel',
                ),
            ),
            'attributes' => array(
                'class' => 'form-control',
                'placeholder' => 'Handtekeningenset',
            ),
        ));
        
    }
    
    
    /**
     * {@inheritDoc}
     * @see \Zend\InputFilter\InputFilterProviderInterface::getInputFilterSpecification()
     */
    public function getInputFilterSpecification()
    {
        return array(
            'descriptionNl' => array(
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 1,
                            'max'      => 100,
                        ),
                    ),
                ),
            ),
            'descriptionEn' => array(
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 1,
                            'max'      => 100,
                        ),
                    ),
                ),
            ),
        );
        
    }

    
}