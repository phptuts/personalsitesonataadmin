<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace AppBundle\Event\Email;

use Symfony\Component\EventDispatcher\Event;
use AppBundle\Entity\User;

/**
 * Description of ResetPasswordEvent
 *
 * @author student
 */
class PasswordEvent extends Event
{
    /** 
     * Raw Password
     * @var string
     */
    private $password;
    
    /** 
     * @var User 
     */
    private $user;
    
    public function __construct($password, User $user) 
    {
        $this->password = $password;
        $this->user = $user;
    }
    
    /** 
     * Get Paassword
     * @return type
     */
    public function getPassword() 
    {
        return $this->password;
    }

    /** 
     * Set Password
     * @param type $password
     * @return \AppBundle\Event\Email\ResetPasswordEvent
     */
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }
    
    /** 
     * Get User
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /** 
     * Set User
     * @param User $user
     * @return \AppBundle\Event\Email\ResetPasswordEvent
     */
    public function setUser(User $user) 
    {
        $this->user = $user;
        return $this;
    }



}
