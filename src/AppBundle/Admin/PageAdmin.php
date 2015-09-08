<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Route\RouteCollection;

class PageAdmin extends Admin
{
    protected function configureRoutes(RouteCollection $collection) 
    {
        $collection->clear();
        $collection->add('pageinfo');
    }
}
