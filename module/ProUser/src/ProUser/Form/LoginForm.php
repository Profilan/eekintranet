<?php
namespace ProUser\Form;

use Zend\Form\Form;

class LoginForm extends Form
{
    public function __construct($name = null)
    {
        parent::__construct('login');
        
        $this->add(array(
            'name'  => 'username',
            'type'  => 'Text',
            'options'   => array(
                'label' => 'Gebruikersnaam',  
                'label_attributes' => array(
                    'class' => 'sr-only',  
                ),
            ),
            'attributes' => array(
                'class' => 'form-control',  
                'placeholder' => 'Gebruikersnaam',
            ),
        ));
        $this->add(array(
            'name'  => 'password',
            'type'  => 'Password',
            'options'   => array(
                'label' => 'Wachtwoord',  
                'label_attributes' => array(
                    'class' => 'sr-only',  
                ),
            ),
            'attributes' => array(
                'class' => 'form-control',  
                'placeholder' => 'Wachtwoord',
            ),
        ));
        $this->add(array(
            'name'  => 'submit',
            'type'  => 'Submit',
            'attributes'    => array(
                'value' => 'Inloggen',
                'id'    => 'submitbutton',
                'class' => 'btn btn-primary btn-block',
            ),
        ));
    }
}