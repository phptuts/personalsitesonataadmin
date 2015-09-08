<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace AppBundle\Component;

use JMS\DiExtraBundle\Annotation as DI;
use Doctrine\ORM\EntityManager;
use AppBundle\Entity\SitePropertyRepository;
use AppBundle\Entity\SiteProperty;
use AppBundle\Model\SiteSetting;
/**
 * Description of SiteSettingManager
 * @DI\Service("app.component.sitesettingmanager")
 * @author student
 */
class SiteSettingManager
{
    /** 
     * @var EntityManager 
     */
    private $em;
       
    /** 
     * @var SitePropertyRepository 
     */
    private $siteSettingRespository;
    
    /**
     * @DI\InjectParams({
     *     "em" = @DI\Inject("doctrine.orm.entity_manager")
     * })
     */
    public function __construct(EntityManager $em) 
    {
        $this->em = $em;
        $this->siteSettingRespository = $em->getRepository('AppBundle:SiteProperty');
    }
    
    /** 
     * Save All Site Properties
     * @param SiteSetting $siteSettings
     */
    public function saveGeneralSiteProperties(SiteSetting $siteSettings) 
    {
        $this->saveByName('name', $siteSettings->name, 'general')
             ->saveByName('email', $siteSettings->email, 'general')
             ->saveByName('pictureInformation', $siteSettings->pictureInformation, 'general')
             ->saveByName('state', $siteSettings->state, 'general')
             ->saveByName('city', $siteSettings->city, 'general')
             ->saveByName('summary', $siteSettings->summary, 'general');
    }
    
    /** 
     * 
     * @param SiteSetting $siteSettings
     */
    public function savePageSiteProperties(SiteSetting $siteSettings)
    {
        $this->saveByName('contactMessage', $siteSettings->contactMessage, 'page')
             ->saveByName('contactTitle', $siteSettings->contactTitle, 'page')
             ->saveByName('communityMessage', $siteSettings->communityMessage, 'page')
             ->saveByName('communityTitle', $siteSettings->communityTitle, 'page')
             ->saveByName('aboutMessage', $siteSettings->aboutMessage, 'page')
             ->saveByName('aboutTitle', $siteSettings->aboutTitle, 'page');

    }
    
    /** 
     * 
     * @return SiteSetting
     */
    public function getSiteProperties($general)
    {
        $properties = $this->siteSettingRespository->getSiteProperties($general);
        $siteProperties = new SiteSetting();
        foreach($properties as $prop) {
            foreach(array_keys(get_class_vars('\AppBundle\Model\SiteSetting')) as $objProp) {
                if($objProp === $prop->getName()) {
                    $siteProperties->{$objProp} = $prop->getValue();
                }
            }
        }
        
        return $siteProperties;
    }
    
    /** 
     * 
     * @param type $name
     * @param type $value
     * @return \AppBundle\Component\SiteSettingManager
     */
    public function saveByName($name, $value, $group)
    {
        if(!empty($value)) {
            $property = $this->getByName($name)
                    ->setGroup($group)
                    ->setValue($value);
            $this->em->persist($property);
            $this->em->flush();
        }
        return $this;
    }
    
    /** 
     * @param type $name
     * @return SiteProperty
     */
    public function getByName($name)
    {
       $property = $this->siteSettingRespository->findOneBy(['name' => $name]);
       return (null === $property) ? (new SiteProperty())->setName($name) :  $property;
    }
}
