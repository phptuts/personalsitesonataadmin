<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace AppBundle\EventListener\Email;

use JMS\DiExtraBundle\Annotation as DI;
use AppBundle\AppConstants;
use AppBundle\Event\Email\PasswordEvent;
use Symfony\Bundle\TwigBundle\TwigEngine;

/**
 * Description of ResetPasswordListener
 * @DI\Service("resume.listener.email.resetpassword")
 * @author student
 */
class PasswordListener 
{
    
    private $mailer;
    
    /** 
     * @var TwigEngine 
     */
    private $template;
    
    /**
     * @DI\InjectParams({
     *     "mailer" = @DI\Inject("mailer"),
     *     "template" = @DI\Inject("templating")
     * })
     */
    public function __construct($mailer, TwigEngine $template) 
    {
        $this->mailer = $mailer;
        $this->template = $template;
    }
    
    /** 
     * @DI\Observe(AppConstants::EMAIL_RESET_PASSWORD)
     */
    public function sendResetEmail(PasswordEvent $event)
    {
        $password = $event->getPassword();
        $user = $event->getUser();
        $message = \Swift_Message::newInstance()
            ->setSubject('Reset Password')
            ->setFrom('glaserpower@gmail.com')
            ->setTo($user->getEmail())
            ->setBody( $this->template->render('AppBundle:Email:resetpassword.html.twig', ['password' => $password] ),'text/html');
        
        $this->mailer->send($message);
    }
    /** 
     * @DI\Observe(AppConstants::EMAIL_NEW_USER)
     */
    public function sendNewUserEmail(PasswordEvent $event)
    {
        $password = $event->getPassword();
        $user = $event->getUser();
        $message = \Swift_Message::newInstance()
            ->setSubject('New User Password')
            ->setFrom('glaserpower@gmail.com')
            ->setTo($user->getEmail())
            ->setBody( $this->template->render('AppBundle:Email:newuser.html.twig', ['password' => $password] ),'text/html');
        
        $this->mailer->send($message);
    }
    
}
