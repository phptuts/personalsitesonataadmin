<?php

namespace AppBundle\Entity;

use Doctrine\ORM\EntityRepository;
use JMS\DiExtraBundle\Annotation as DI;

/**
 * UserRepository
 * @DI\Service("resume.repository.user")
 */
class UserRepository extends EntityRepository
{
}
