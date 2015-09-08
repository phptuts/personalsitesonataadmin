<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace AppBundle\Admin\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\FormInterface;
use JMS\DiExtraBundle\Annotation as DI;
use AppBundle\Component\CloudinaryManager;

/** 
 * @DI\FormType()
 */
class SiteSettingForm extends AbstractType
{
    
    /** 
     * @var CloudinaryManager 
     */
    private $cloudinaryManager;
    
    /**
     * @DI\InjectParams({
     *     "cloudinaryManager" = @DI\Inject("app.component.cloudinarymanager"),
     * })
     */
    public function __construct(CloudinaryManager $cloudinaryManager)
    {
        $this->cloudinaryManager = $cloudinaryManager;
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options) 
    {
        $builder->add('name', 'text')
                ->add('city', 'text')
                ->add('state', 'text')
                ->add('email', 'text')
                ->add('picture', 'file', ['required' => false])
                ->add('summary', 'textarea');
    }
    
    public function getName() 
    {
        return 'site_settings_form';
    }
    
    public function setDefaultOptions(\Symfony\Component\OptionsResolver\OptionsResolverInterface $resolver) 
    {
        $resolver->setDefaults(['data_class' => 'AppBundle\Model\SiteSetting', 'validation_groups' => ['site_settings']]);
    }
    
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $view->vars['picture_url'] = $this->cloudinaryManager->getCloudinaryUrl(json_decode($form->getData()->pictureInformation, true), 'c_scale,w_550');
    }
    

}
