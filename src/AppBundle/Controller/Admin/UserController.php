<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Controller\Admin;

use Sonata\AdminBundle\Controller\CRUDController as Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\RedirectResponse;
use AppBundle\Entity\User;

/**
 * Description of UserController
 *
 * @author student
 */
class UserController extends Controller 
{
    
   public function resetPassowrdAction()
   {
        /** @var User $object **/
        $object = $this->admin->getSubject();
        $password = $this->container->get('resume.component.usermanager')->resetPassword($object);
        
        return new RedirectResponse($this->admin->generateUrl('list'));

   }

}
