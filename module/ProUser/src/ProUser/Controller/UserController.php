<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ProUser for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace ProUser\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use ProUser\Form\LoginForm;
use Zend\Authentication\Result;
use Zend\Authentication\AuthenticationService;
use ProLdap\ORM\EntityManager;
use Doctrine\ORM\EntityManager as DoctrineManager;
use ProUser\Entity\User;
use ProUser\Entity\Group;
use ProUser\Entity\Department;


class UserController extends AbstractActionController
{
    protected $em;
    
    /**
     * @return DoctrineManager
     */
    public function getEntityManager()
    {
        if (null === $this->em) {
            $this->em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        }
    
        return $this->em;
    }
    
    /**
     * 
     * @var AuthenticationService
     */
    protected $authService;
    
    public function indexAction()
    {
        if (!$this->proUserAuthentication()->hasIdentity()) {
            return $this->redirect()->toRoute('pro-user', array('action' => 'login'));
        }
        
        $filters = array();
        
        $request = $this->getRequest();
        if ($request->isPost()) {
            $post = $request->getPost();
            
            if ($post['deptnl'] != '' || $post['employee'] != '') {
                if ($post['deptnl'] != '') {
//                    $users = $this->getServiceLocator()->get('prouser_user_service')->findByDepartment($post['deptnl']);
                    $filters['department'] = $post['deptnl'];
                } 
                if ($post['employee'] != '') {
                    $filters['displayname'] = '*'.$post['employee'].'*';
                }
                    $users = $this->getServiceLocator()->get('prouser_user_service')->findBy($filters);
            } else {
                $users = $this->getServiceLocator()->get('prouser_user_service')->findAll();
            }
        } else {
            $users = $this->getServiceLocator()->get('prouser_user_service')->findAll();
        }
        
        return array(
            'users' => $users,
            'departments' => $this->getEntityManager()->getRepository('ProUser\Entity\Department')->findAll(),
            'filters' => $filters,
        );
    }
    
    public function editAction()
    {
        if ($this->proUserAuthentication()->hasIdentity()) {
            $username = $this->params()->fromRoute('id', null);
            
            /**
             * 
             * @var User $user
             */
            $user = $this->getServiceLocator()->get('prouser_user_service')->findByUsername($username)[0];
//            $user->setTelephonenumber(str_replace('+31 (0)', '', $user->getTelephonenumber()));
//            $user->setMobile(str_replace('+31 (0)', '', $user->getMobile()));
            
            $departments = $this->getEntityManager()->getRepository('ProUser\Entity\Department')->findAll();
            
            $request = $this->getRequest();
                    if ($request->isPost()) {
                $post = array_merge_recursive(
                    $request->getPost()->toArray(),
                    $request->getFiles()->toArray()
                );
                $data = $request->getPost();
                
//                echo '<pre>'.print_r($data, true).'</pre>';die();
                
                $messages = $this->isValid($data);
                
                if (count($messages) == 0) {
                    $data['telephonenumber'] = $data['dial-code'] . ' ' . $data['telephonenumber'];
                    if ($data['mobile'] != '') {
                        $data['mobile'] = $data['dial-code'] . ' ' . $data['mobile'];
                    } else {
                        $data['mobile'] = '';
                    }
                    
                    if ($post['photo']['tmp_name'] != '') {
                        
                        $ext = strtolower(pathinfo($post['photo']['name'], PATHINFO_EXTENSION));
                        
                        if (($ext == 'jpg') || ($ext == 'jpeg')) {
                        
                            $image = @imagecreatefromjpeg($post['photo']['tmp_name']);
            
                            if ($image) {
                                $new_image = imagescale($image, 320);
                                
                                // start buffering
                                ob_start();
                                imagejpeg($new_image);
                                $data['jpegphoto'] = ob_get_contents();
                                ob_end_clean();
                            }
                        } else {
                            $this->flashmessenger()->addMessage('Je kunt alleen "jpg" fotos kiezen');
                            return $this->redirect()->toRoute('pro-user', array('action' => 'edit'));
                        }
                    }
                    
    //                echo '<img src="data:image/jpeg;base64,'.$user['jpegphoto'].'" />';die();
                    
                    $result = $this->getServiceLocator()->get('prouser_user_service')->update($data);
                    
                    if ($result) {
                        // Als alles goed is verlopen moeten de juiste groepen worden ingesteld
                        $this->addGroups($data);

                        if (isset($data['hipin'])) {
                            if ($data['hipin'] == '1') {
                                $this->add($data, 'GAppHIPIN');
                            } else {
                                $this->remove($data, 'GAppHIPIN');
                            }
                        }
                        
                        $this->flashmessenger()->addMessage('De instellingen zijn opgeslagen');
                    }
                
                } else {
                    $this->flashMessenger()->addErrorMessage('Het formulier is niet compleet');   
                    
                }
                
                return $this->redirect()->toRoute('pro-user', array('action' => 'index'));
            }
        } else {
            return $this->redirect()->toRoute('pro-user', array('action' => 'login'));
        }
        $identity = $this->proUserAuthentication()->getIdentity();
        $me = $this->getServiceLocator()->get('prouser_user_service')->findByUsername($identity)[0];
        
        return array(
            'user' => $user,
            'departments' => $departments,
            'me' => $me,
        );
    }
    
    public function loginAction()
    {
        $form = new LoginForm();
        $form->get('submit')->setValue('Inloggen');
        
        $request = $this->getRequest();
        if ($request->isPost()) {
            $username = $this->getRequest()->getPost('username');
            $password = $this->getRequest()->getPost('password');
         
            $auth = $this->proUserAuthentication()->getAuthService();
            
            $adapter = $this->proUserAuthentication()->getAuthAdapter();
            $adapter->setUsername($username);
            $adapter->setPassword($password);
            
            $result = $auth->authenticate($adapter);
            
            switch ($result) {
                case Result::SUCCESS:
                    return $this->redirect()->toRoute('pro-user', array('action' => 'profile'));
                    break;
                default:
                    return $this->redirect()->toRoute('pro-user', array('action' => 'login'));
                    break;
            }
            
        }
        
        
        return array('form' => $form);
    }
    
    public function profileAction()
    {
        if ($this->proUserAuthentication()->hasIdentity()) {
            $identity = $this->proUserAuthentication()->getIdentity();
            $user = $this->getServiceLocator()->get('prouser_user_service')->findByUsername($identity)[0];
//            echo '<pre>'.print_r($user->getArrayCopy(), true).'</pre>';
//            $user->setTelephonenumber(str_replace('+31 (0)', '', $user->getTelephonenumber()));
//            $user->setMobile(str_replace('+31 (0)', '', $user->getMobile()));
            
            $departments = $this->getEntityManager()->getRepository('ProUser\Entity\Department')->findAll();
            
            $request = $this->getRequest();
            if ($request->isPost()) {
                
                $post = array_merge_recursive(
                    $request->getPost()->toArray(),
                    $request->getFiles()->toArray()
                );
                $data = $request->getPost();
 //               echo '<pre>'.print_r($data, true).'</pre>';die();
                
                $messages = $this->isValid($data);
                
                if (count($messages) == 0) {
                    $data['telephonenumber'] = $data['dial-code'] . ' ' . $data['telephonenumber'];
                    if ($data['mobile'] != '') {
                        $data['mobile'] = $data['dial-code'] . ' ' . $data['mobile'];
                    } else {
                        $data['mobile'] = '';
                    }
                    
                    if ($post['photo']['tmp_name'] != '') {
                        
                        $ext = strtolower(pathinfo($post['photo']['name'], PATHINFO_EXTENSION));
                        
                        if (($ext == 'jpg') || ($ext == 'jpeg') || ($ext == 'png')) {
                        
                            if (($ext == 'jpg') || ($ext == 'jpeg')) {
                                $image = @imagecreatefromjpeg($post['photo']['tmp_name']);
                            }

                            if ($ext == 'png') {
                                $image = @imagecreatefrompng($post['photo']['tmp_name']);
                            }
                            
                            if ($image) {
                                $new_image = imagescale($image, 320);
                                
                                // start buffering
                                ob_start();
                                imagejpeg($new_image);
                                $data['jpegphoto'] = ob_get_contents();
                                ob_end_clean();
                            }
                        } else {
                            $this->flashmessenger()->addMessage('Je kunt alleen "jpg" fotos kiezen');
                            return $this->redirect()->toRoute('pro-user', array('action' => 'profile'));
                        }
                    }
                    
    //                echo '<img src="data:image/jpeg;base64,'.$user['jpegphoto'].'" />';die();
                    
                    $result = $this->getServiceLocator()->get('prouser_user_service')->update($data);
                    
                    if ($result) {
                        // Als alles goed is verlopen moeten de juiste groepen worden ingesteld
                        $this->addGroups($data);
                        
                        $this->flashmessenger()->addMessage('De instellingen zijn opgeslagen');
                    }
                
                } else {
                    $this->flashMessenger()->addErrorMessage('Het formulier is niet compleet');   
                    
                }
                
                return $this->redirect()->toRoute('pro-user', array('action' => 'profile'));
            }
        } else {
            return $this->redirect()->toRoute('pro-user', array('action' => 'login'));
        }
        
        return array(
            'user' => $user,
            'departments' => $departments,
        );
    }
    
    public function testAction()
    {
        if (!$this->proUserAuthentication()->hasIdentity()) {
            return $this->redirect()->toRoute('pro-user', array('action' => 'login'));
        }
        
        /**
         * 
         * @var Group $group
         */
        $group = $this->getServiceLocator()->get('prouser_group_service')->findByName('ExclaimerEekhoornZaadmarkt')[0];
        /**
         * 
         * @var User $user1
         */
        $user1 = $this->getServiceLocator()->get('prouser_user_service')->findByUsername('test1@zwd.deeekhoorn.com')[0];
        
        $member = $group->getMember();
        $member = array_diff($member, [$user1->getDistinguishedname()]);
        
//        echo '<pre>'.print_r($member, true).'</pre>';die();
        
        $group->setMember($member);
        
        $result = $this->getServiceLocator()->get('prouser_group_service')->update($group);
        
        return array(
            'group' => $group,
         );
    }
    
    private function isValid($data)
    {
        $messages = array();
        
        if ($data['title'] == '') {
            $messages['title'] = 'Dit veld is verplicht';
            return $messages;
        }
        if ($data['extensionattribute1'] == '') {
            $messages['extensionattribute1'] = 'Dit veld is verplicht';
            return $messages;
        }
        if ($data['deptnl'] == '') {
            $messages['deptnl'] = 'Dit veld is verplicht';
            return $messages;
        }
        if ($data['depten'] == '') {
            $messages['depten'] = 'Dit veld is verplicht';
            return $messages;
        }
        if ($data['telephonenumber'] == '') {
            $messages['telephonenumber'] = 'Dit veld is verplicht';
            return $messages;
        }
        
        return $messages;
    }
    
    private function addGroups($user)
    {
        
        // Verwijder eerst alle Exclaimer gerelateerde groepen
        $this->remove($user, 'ExclaimerEekhoornZaadmarkt');
        $this->remove($user, 'ExclaimerEekhoornMarktweg');
        $this->remove($user, 'ExclaimerBasiclabelMarktweg');
        $this->remove($user, 'ExclaimerBasiclabelWinkel');
        $this->remove($user, 'Disclaimer_De Eekhoorn');

        // Voeg de gebruiker toe aan de juiste Exclaimer gerelateerde groepen
        // Welke afdeling is er gekozen?
        /**
         * 
         * @var Department
         */
        $department = $this->getEntityManager()->find('ProUser\Entity\Department', $user['deptnl']);
        $this->add($user, $department->getSignatureSet());
        $this->add($user, 'Disclaimer_De Eekhoorn');
    }
    
    private function remove($user, $groupName)
    {
        /**
         *
         * @var Group $group
         */
        $group = $this->getServiceLocator()->get('prouser_group_service')->findByName($groupName)[0];
        $member = $group->getMember();
        $member = array_diff($member, [$user['distinguishedname']]);
        $group->setMember($member);
        
        return $this->getServiceLocator()->get('prouser_group_service')->update($group);
    }
    
    private function add($user, $groupName)
    {
        /**
         *
         * @var Group $group
         */
        $group = $this->getServiceLocator()->get('prouser_group_service')->findByName($groupName)[0];
        $member = $group->getMember();
        $member = array_merge($group->getMember(), [$user['distinguishedname']]);
        $group->setMember($member);
        
        return $this->getServiceLocator()->get('prouser_group_service')->update($group);
    }
}
