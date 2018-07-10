<?php

namespace MyJobDating\Bundle\UserBundle\Entity;

use MyJobDating\Bundle\CoreBundle\Entity\ResourceTrait;

class Recruiter implements RecruiterInterface
{
   use ResourceTrait, UserableTrait;
}
