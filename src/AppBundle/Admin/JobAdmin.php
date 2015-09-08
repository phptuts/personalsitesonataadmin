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

/**
 * Description of JobAdmin
 *
 * @author student
 */
class JobAdmin extends Admin
{
    protected $formOptions = ['validation_groups' => ['create_user']];

    
   // Fields to be shown on create/edit forms
   protected function configureFormFields(FormMapper $formMapper) {
        $formMapper
              ->add('position')
              ->add('description')
              ->add('startDate', 'sonata_type_date_picker')
              ->add('endDate', 'sonata_type_date_picker')
              ->end();
   }
   
    protected function configureDatagridFilters(DatagridMapper $datagridMapper) {
        $datagridMapper
              ->add('id')
              ->add('position')
              ->add('startDate');
   }
   
      // Fields to be shown on lists
   protected function configureListFields(ListMapper $listMapper) {
        $listMapper
              ->addIdentifier('id')
              ->add('position', 'text')
              ->add('startDate', 'date');
   }
}
