<?php
namespace ProUser\Controller;


use Zend\Mvc\Controller\AbstractActionController;
use Doctrine\ORM\EntityManager;
use Zend\View\Model\ViewModel;
use ProUser\Form\DepartmentForm;
use ProUser\Entity\Department;

class DepartmentController extends AbstractActionController
{
    protected $em;
    
    /**
     * @return EntityManager
     */
    public function getEntityManager()
    {
        if (null === $this->em) {
            $this->em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        }
    
        return $this->em;
    }
    
    public function indexAction()
    {
        return new ViewModel(array(
            'departments' => $this->getEntityManager()->getRepository('ProUser\Entity\Department')->findAll(),
        ));
    }
    
    public function addAction()
    {
        $form = new DepartmentForm($this->getEntityManager());
        $form->get('submit')->setValue('Toevoegen');
        
        $request = $this->getRequest();
        if ($request->isPost()) {
            $department = new Department();
            
            $form->bind($department);
                        
            $form->setData($request->getPost());
        
            if ($form->isValid()) {
//                $department->exchangeArray($form->getData());
                $this->getEntityManager()->persist($department);
                $this->getEntityManager()->flush();
        
                // Stuur terug naar lijst met posten
                return $this->redirect()->toRoute('pro-department');
            }
        }
        

//        echo '<pre>'.print_r($form, true).'</pre>';die();
                
        
        return array('form' => $form);
        
    }
    
    public function editAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('pro-department', array('action' => 'add'));
        }
        
        $department = $this->getEntityManager()->find('ProUser\Entity\Department', $id);
        if (!$department) {
            return $this->redirect()->toRoute('pro-department', array('action' => 'index'));
        }
        
        $form = new DepartmentForm($this->getEntityManager());
        $form->bind($department);
        $form->get('submit')->setAttribute('value', 'Wijzigen');
        
//        var_dump($form->get('id'));die();
        
        $request = $this->getRequest();
        if ($request->isPost()) {
            
            $form->setData($request->getPost());
        
            if ($form->isValid()) {
                $this->getEntityManager()->flush();
        
                // Stuur terug naar lijst met posten
                return $this->redirect()->toRoute('pro-department');
            }
        }
        
        return array(
            'id'    => $id,
            'form'  => $form,
        );
        
    }
}