<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SiteSettingBlock
 *
 * @author student
 */

namespace AppBundle\Admin\Block;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Sonata\BlockBundle\Model\BlockInterface;
use Sonata\BlockBundle\Block\BlockContextInterface;

use Sonata\AdminBundle\Form\FormMapper;
use Sonata\BlockBundle\Block\BaseBlockService;
use JMS\DiExtraBundle\Annotation as DI;
use Symfony\Component\Templating\EngineInterface;
use Sonata\AdminBundle\Validator\ErrorElement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use AppBundle\Component\CloudinaryManager;
use AppBundle\Model\SiteSetting;
use AppBundle\Component\SiteSettingManager;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/** 
 * @DI\Service("sonata.block.service.sitesetting")
 * @DI\Tag("sonata.block")
 */
class SiteSettingBlock extends BaseBlockService
{
    
    /** 
     * @var FormFactory 
     */
    private $formFactory;
    
    /**
     *
     * @var Request
     */
    private $request;
    
    /** 
     *
     * @var CloudinaryManager 
     */
    private $cloudinaryManager;
    
    /** 
     * @var SiteSettingManager
     */
    private $siteSettingManager;
    
    /** 
     * 
     * @DI\InjectParams({
     *     "templating" =  @DI\Inject("templating"),
     *     "formFactory" = @DI\Inject("form.factory"),
     *     "requestStack" = @DI\Inject("request_stack"),
     *     "cloudinaryManager" = @DI\Inject("app.component.cloudinarymanager"),
     *     "siteSettingManager" = @DI\Inject("app.component.sitesettingmanager")
     * })     
     */
    public function __construct( EngineInterface $templating,  FormFactory $formFactory, RequestStack $requestStack,
            CloudinaryManager $cloudinaryManager, SiteSettingManager $siteSettingManager)
    {
        parent::__construct('site_settings', $templating);
        $this->formFactory = $formFactory;
        $this->request = $requestStack->getCurrentRequest();
        $this->cloudinaryManager = $cloudinaryManager;
        $this->siteSettingManager = $siteSettingManager;
        
    }
    
    /**
     * {@inheritdoc}
     */
    public function setDefaultSettings(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults([
            'template' => 'AppBundle:Admin\Block:site_settings.html.twig',
            'title'    => 'Information Base Site Stuff'
        ]);
    }
    
    /**
     * {@inheritdoc}
     */
    public function execute(BlockContextInterface $blockContext, Response $response = null)
    {
        $settings = $blockContext->getSettings();  
        $form = $this->formFactory->create('site_settings_form', $this->siteSettingManager->getSiteProperties('general'));

       
        if( 'POST' === $this->request->getMethod()) {
            $form = $this->formFactory->create('site_settings_form');
            $form->handleRequest($this->request);
            if($form->isValid()) {
                /** @var SiteSetting $siteProperties  **/
                $siteProperties = $form->getData();
                $picture = $form->get('picture')->getData();
                $siteProperties->pictureInformation = (null === $picture) ? null : $this->uploadPic($picture, 'main_pic');
                $this->siteSettingManager->saveGeneralSiteProperties($siteProperties);
                unset($form);
                $form = $this->formFactory->create('site_settings_form', $this->siteSettingManager->getSiteProperties('general'));
            } 
        } 
                   
        return $this->renderPrivateResponse($blockContext->getTemplate(), array(
            'block'         => $blockContext->getBlock(),
            'settings'      => $settings,
            'siteForm'      => $form->createView()
           
        ), $response);

    }
    
    /** 
     * Upload Picture
     * @param UploadedFile $file
     * @param type $public_id
     * @return type
     */
    public function uploadPic(UploadedFile $file, $public_id)
    {
        return  $this->cloudinaryManager->upload($file, $public_id);
    }
}
