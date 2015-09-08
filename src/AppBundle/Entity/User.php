<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use NoahGlaser\EntityBundle\Entity\Base;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


/**
 * User
 * @UniqueEntity("email", groups="", message="Email already taken", groups={"create_user"})
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\UserRepository")
 */
class User extends Base implements AdvancedUserInterface
{

   /**
    * @Assert\NotBlank(message="You must fill out the password field", groups={"create_user"})
    * @Assert\Email(message="You must enter a valid email", groups={"create_user"})
    * @ORM\Column(name="email", type="string", length=255, unique=true)
    * @var string
    */
   private $email;
   
   /**
    * @Assert\NotBlank(message="You must fill out the password field", groups={"create_user"})
    * @Assert\Length(min= 8, max= 16, maxMessage="Your password must be between 8 to 16 characters long.", minMessage="Your password must be between 8 to 16 characters long", groups={"create_user"})
    * @ORM\Column(name="password", type="string", length=255)
    * @var string
    */
   private $password;
      
   /**
    * @ORM\Column(name="isActive", type="boolean")
    * @var string
    */
   private $isActive;
   
   /**
    * @var array
    *
    * @ORM\Column(name="roles", type="array")
    */
   private $roles;
   
   /**
    * @var string
    * 
    * @ORM\Column(name="secret_code", type="string", nullable=true)
    */
   private $secretCode;
   
   
   public function getEmail() 
   {
      return $this->email;
   }

   public function getPassword()
   {
      return $this->password;
   }

   public function getIsActive() 
   {
      return $this->isActive;
   }

   public function getRoles() 
   {
      return $this->roles;
   }

   public function getSecretCode() 
   {
      return $this->secretCode;
   }

   public function setEmail($email) 
   {
      $this->email = $email;
   }

   public function setPassword($password) 
   {
      $this->password = $password;
   }

   public function setIsActive($isActive) 
   {
      $this->isActive = $isActive;
   }

   public function setRoles($roles) 
   {
      $this->roles = $roles;
   }

   public function setSecretCode($secretCode) 
   {
      $this->secretCode = $secretCode;
   }

   public function eraseCredentials()
   {
      ;
   }

   public function getSalt()
   {
      return null;
   }

   public function getUsername()
   {
      return $this->email;
   }

   public function isAccountNonExpired()
   {
      return true;
   }

   public function isAccountNonLocked() 
   {
      return true;
   }

   public function isCredentialsNonExpired() 
   {
      return true;
   }

   public function isEnabled() 
   {
      return $this->isActive;
   }

   
   public function __toString()
   {
      return 'Users';
   }
}
