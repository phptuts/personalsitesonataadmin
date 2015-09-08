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
class PageForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options) 
    {
        $builder->add('aboutTitle', 'text')
                ->add('aboutMessage', 'textarea')
                ->add('communityTitle', 'text')
                ->add('communityMessage', 'textarea')
                ->add('contactTitle', 'text')
                ->add('contactMessage', 'textarea');
    }
    
    public function getName() 
    {
        return 'pages_form';
    }
    
    
    public function setDefaultOptions(\Symfony\Component\OptionsResolver\OptionsResolverInterface $resolver) 
    {
        $resolver->setDefaults(['data_class' => 'AppBundle\Model\SiteSetting', 'validation_groups' => ['pages']]);
    }
}
