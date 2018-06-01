<?php
namespace ProUser\Form;

use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\Form\Form;
use ProUser\Form\DepartmentFieldset;

class DepartmentForm extends Form
{
    public function __construct(ObjectManager $objectManager)
    {
        parent::__construct('department-form');
    
        $this->setHydrator(new DoctrineHydrator($objectManager));
    
        // Add the department fieldset, and set it as the base fieldset
        $departmentFieldset = new DepartmentFieldset($objectManager);
        $departmentFieldset->setName('department');
        $departmentFieldset->setUseAsBaseFieldset(true);
        $this->add($departmentFieldset);
    
        // … add CSRF and submit elements …
        $this->add(array(
            'name' => 'submit',
            'type' => 'Submit',
            'attributes' => array(
                'value' => 'Opslaan',
                'id' => 'submitbutton',
                'class' => 'btn btn-primary'
            )
        ));
    }
}