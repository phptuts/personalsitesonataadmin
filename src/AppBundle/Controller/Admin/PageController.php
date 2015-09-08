<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace AppBundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Description of PageController
 *
 * @author student
 */
class PageController extends Controller
{
    public function pageinfoAction(Request $request)
    {
       $siteSettingManager = $this->get('app.component.sitesettingmanager');
       $form = $this->createForm('pages_form', $siteSettingManager->getSiteProperties('page'));
       if('POST' === $request->getMethod()) {
           $form->handleRequest($request);
           if($form->isValid()) {
               $siteSettingManager->savePageSiteProperties($form->getData());
               unset($form);
               $form = $this->createForm('pages_form', $siteSettingManager->getSiteProperties('page'));
           }
       }
      
       return $this->render('AppBundle:Admin:Form\page.html.twig', 
                [
                    'pageForm' => $form->createView(),
                    'admin_pool' =>  $this->get('sonata.admin.pool')
                ]);
    }
}
