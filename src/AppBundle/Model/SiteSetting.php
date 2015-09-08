<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace AppBundle\Model;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Description of SiteSetting
 *
 * @author student
 */
class SiteSetting 
{
    /** 
     * @Assert\NotBlank(message="Name must be filled out",  groups={"site_settings"})
     * @Assert\Length(
     *      min = 10,
     *      max = 50,
     *      minMessage = "Your name must be at least {{ limit }} characters long",
     *      maxMessage = "Your name cannot be longer than {{ limit }} characters",
     *      groups={"site_settings"}
     * )     
     * @var string
     */
    public $name;
    
    /** 
     * @Assert\NotBlank(message="City must be filled out",  groups={"site_settings"})
     * @Assert\Length(
     *      min = 5,
     *      max = 100,
     *      minMessage = "Your city must be at least {{ limit }} characters long",
     *      maxMessage = "Your city cannot be longer than {{ limit }} characters",
     *      groups={"site_settings"}
     * )     
     * @var string
     */
    public $city;
    
    /** 
     * @Assert\NotBlank(message="State must be filled out",  groups={"site_settings"})
     * @Assert\Length(
     *      min = 2,
     *      max = 2,
     *      minMessage = "You must choose a 2 character abbreviation for state",
     *      maxMessage = "You must choose a 2 character abbreviation for state",
     *      groups={"site_settings"}
     * )     
     * @var string
     */
    public $state;
    
    /** 
     * @Assert\NotBlank(message="Email must be filled out",  groups={"site_settings"})
     * @Assert\Length(
     *      min = 10,
     *      max = 140,
     *      minMessage = "Your email must be at least {{ limit }} characters long",
     *      maxMessage = "Your email cannot be longer than {{ limit }} characters",
     *      groups={"site_settings"}
     * )     
     * @var string
     */
    public $email;
    
    /** 
     * @Assert\Image(
     *     minWidth = 200,
     *     maxWidth = 4000,
     *     minHeight = 200,
     *     maxHeight = 4000,
     *     groups={"site_settings"}
     * )   
     * @var string
     */
    public $picture;
    
    /**     
     * @Assert\NotBlank(message="Summary must be filled out",  groups={"site_settings"})
     * @Assert\Length(
     *      min = 10,
     *      max = 10000,
     *      minMessage = "Your summary must be at least {{ limit }} characters long",
     *      maxMessage = "Your summary cannot be longer than {{ limit }} characters",
     *      groups={"site_settings"}
     * )     
     * @var string
     *
     */
    public $summary;
    
    
    /** 
     * @var string 
     */
    public $pictureInformation;
    
    
    /** 
     * @Assert\NotBlank(message="Contact title must be filled out",  groups={"site_settings"})
     * @Assert\Length(
     *      min = 3,
     *      max = 140,
     *      minMessage = "Your contact title must be at least {{ limit }} characters long",
     *      maxMessage = "Your contact title cannot be longer than {{ limit }} characters",
     *      groups={"pages"}
     * )     
     * @var string
     */
    public $contactTitle;
    
    
    /** 
     * @Assert\NotBlank(message="Contact message must be filled out",  groups={"site_settings"})
     * @Assert\Length(
     *      min = 10,
     *      max = 10000,
     *      minMessage = "Your contact message must be at least {{ limit }} characters long",
     *      maxMessage = "Your contact message cannot be longer than {{ limit }} characters",
     *      groups={"pages"}
     * )     
     * @var string
     */
    public $contactMessage;
    
    
    /** 
     * @Assert\NotBlank(message="About title must be filled out",  groups={"site_settings"})
     * @Assert\Length(
     *      min = 3,
     *      max = 140,
     *      minMessage = "Your about title must be at least {{ limit }} characters long",
     *      maxMessage = "Your about title cannot be longer than {{ limit }} characters",
     *      groups={"pages"}
     * )     
     * @var string
     */
    public $aboutTitle;
    
    /** 
     * @Assert\NotBlank(message="About message must be filled out",  groups={"site_settings"})
     * @Assert\Length(
     *      min = 3,
     *      max = 10000,
     *      minMessage = "Your about message must be at least {{ limit }} characters long",
     *      maxMessage = "Your about message cannot be longer than {{ limit }} characters",
     *      groups={"pages"}
     * )     
     * @var string
     */
    public $aboutMessage;
    
    
    /** 
     * @Assert\NotBlank(message="Community title must be filled out",  groups={"site_settings"})
     * @Assert\Length(
     *      min = 3,
     *      max = 140,
     *      minMessage = "Your community title must be at least {{ limit }} characters long",
     *      maxMessage = "Your community title cannot be longer than {{ limit }} characters",
     *      groups={"pages"}
     * )     
     * @var string
     */
    public $communityTitle;
    
    /** 
     * @Assert\NotBlank(message="Community message must be filled out",  groups={"site_settings"})
     * @Assert\Length(
     *      min = 3,
     *      max = 10000,
     *      minMessage = "Your community message must be at least {{ limit }} characters long",
     *      maxMessage = "Your community message cannot be longer than {{ limit }} characters",
     *      groups={"pages"}
     * )     
     * @var string
     */
    public $communityMessage;
    
}
