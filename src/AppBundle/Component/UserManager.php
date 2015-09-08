<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Component;

use JMS\DiExtraBundle\Annotation as DI;
use AppBundle\Entity\User;
use AppBundle\Entity\UserRepository;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;
use Symfony\Component\Security\Core\Util\SecureRandom;


/** 
 * @DI\Service("app.component.usermanager")
 */
class UserManager 
{
    
    /** 
     * @var UserPasswordEncoder
     */
    private $encoder;
    
    /** 
     * @var SwiftMailer
     */
    private $mailer;
    
    /**
     * @DI\InjectParams({
     *     "encoder" = @DI\Inject("security.password_encoder"),
     *     "mailer" =  @DI\Inject("mailer")
     * })
     */
    public function __construct( UserPasswordEncoder $encoder, $mailer)
    {
        $this->encoder  = $encoder;
        $this->mailer = $mailer;
    }
    
    /** 
     * Hash the users password
     * @param User $user
     */
    public function hashUserPassword(User $user)
    {
       $hashedPassword =  $this->encoder->encodePassword($user, $user->getPassword());
       $user->setPassword($hashedPassword);
    }
    
    /** 
     * Resets the users password, and returns the unhashed password
     * @param User $user
     * @return string
     */
    public function resetPassword(User $user) 
    {
        $securityRandom = new SecureRandom();
        $password = $securityRandom->nextBytes(8);
        $user->setPassword($password);
        $this->hashUserPassword($user);
        return $password;
    }
}
