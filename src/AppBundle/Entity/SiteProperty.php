<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use NoahGlaser\EntityBundle\Entity\Base;
/**
 * SiteProperty
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\SitePropertyRepository")
 */
class SiteProperty extends Base
{

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="value", type="text")
     */
    private $value;
    
    
    /**
     * @var string
     *
     * @ORM\Column(name="group_name", type="string", length=255)
     */
    private $group;

    /**
     * Set name
     *
     * @param string $name
     * @return SiteProperty
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set value
     *
     * @param string $value
     * @return SiteProperty
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return string 
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set section
     *
     * @param string $section
     * @return SiteProperty
     */
    public function setSection($section)
    {
        $this->section = $section;

        return $this;
    }

    /**
     * Get section
     *
     * @return string 
     */
    public function getSection()
    {
        return $this->section;
    }
    
    /** 
     * Set Group
     * @param string $group
     * @return SiteProperty
     */
    public function setGroup($group)
    {
        $this->group = $group;
        return $this;
    }
    
    /** 
     * Get Group
     * @return type
     */
    public function getGroup()
    {
        return $this->group;
    }
}
