<?php
namespace ProUser\Form;

use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Stdlib\Hydrator\ClassMethods;
use ProLdap\ORM\EntityManager;
use ProUser\Entity\User;

class ProfileFieldset extends Fieldset implements InputFilterProviderInterface
{
    public function __construct(EntityManager $entityManager)
    {
        parent::__construct('user');
        
        $this->setHydrator(new ClassMethods())->setObject(new User());
        
        $this->add(array(
            'name' => 'objectguid',
            'type' => 'Hidden',
            'options' => array(
                'label' => 'GUID'
            ),
        ));
        $this->add(array(
            'name' => 'distinguishedname',
            'type' => 'Hidden',
        ));
        $this->add(array(
            'name' => 'userprincipalname',
            'type' => 'Hidden',
        ));
        $this->add(array(
            'name' => 'samaccountname',
            'type' => 'Hidden',
        ));
        $this->add(array(
            'name' => 'displayname',
            'type' => 'Text',
            'options' => array(
                'label' => 'Volledige naam'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'placeholder' => 'Volledige naam',
            ),
        ));
        $this->add(array(
            'name' => 'photo',
            'type' => 'Text',
            'options' => array(
                'label' => 'Foto'
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
            'displayname' => array(
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