<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use AppBundle\Entity\User;
use Sonata\AdminBundle\Route\RouteCollection;
use Symfony\Component\EventDispatcher\EventDispatcher;
use AppBundle\Event\Email\PasswordEvent;
use Sonata\AdminBundle\Validator\ErrorElement;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
/**
 * Description of Resume
 *
 * @author student
 */
class UserAdmin extends Admin
{

    protected $formOptions = ['validation_groups' => ['create_user']];
    /**  
    * @var string 
    */
   private $password;
    
   // Fields to be shown on create/edit forms
   protected function configureFormFields(FormMapper $formMapper) {
        $formMapper
              ->add('email')
              ->add('password')
              ->end();
   }

   protected function configureRoutes(RouteCollection $collection) {
      // to remove a single route
      $collection->remove('edit');
      $collection->add('resetpassowrd', $this->getRouterIdParameter() . '/resetpassowrd');
   }

   // Fields to be shown on filter forms
   protected function configureDatagridFilters(DatagridMapper $datagridMapper) {
        $datagridMapper
              ->add('email')
              ->add('id');
   }

   /**
    * @param User $user
    */
   public function prePersist($user) 
   {   
      parent::prePersist($user); 
      $user->setIsActive(true);
      $user->setRoles(['ROLE_ADMIN']);
      $this->password = $user->getPassword();
      $usermanager = $this->getConfigurationPool()->getContainer()->get('app.component.usermanager');
      $usermanager->hashUserPassword($user);
      
   }
   
   public function postPersist($user) 
   {
       parent::postPersist($user);
       /** @var  $dispatcher EventDispatcher**/
       $dispatcher = $this->getConfigurationPool()->getContainer()->get('event_dispatcher');
       $dispatcher->dispatch(\AppBundle\AppConstants::EMAIL_NEW_USER,  new PasswordEvent($this->password, $user));
       
   }

   // Fields to be shown on lists
   protected function configureListFields(ListMapper $listMapper) {
        $listMapper
              ->addIdentifier('id')
              ->add('email', 'text', ['label' => 'Email Address'])
              ->add('_action', 'action', [
                  'actions' => [
                      'resetpassowrd' => [
                          'template' => 'AppBundle:Admin:Partial\user__reset__password.html.twig',
                      ]
                  ],
                  'label' => 'Reset Password'
              ]);
   }

}
