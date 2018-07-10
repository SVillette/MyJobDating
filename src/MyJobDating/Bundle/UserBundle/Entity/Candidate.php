<?php

namespace MyJobDating\Bundle\UserBundle\Entity;

use MyJobDating\Bundle\CoreBundle\Entity\ResourceTrait;
use MyJobDating\Bundle\SkillBundle\Entity\Skill;

class Candidate implements CandidateInterface
{
    use ResourceTrait;
    /**
    * @var Skill
    */
    private $skills;
}
