<?php

namespace MyJobDating\Bundle\UserBundle\Entity;

use MyJobDating\Bundle\CoreBundle\Entity\ResourceInterface;
use MyJobDating\Bundle\SkillBundle\Entity\Skill;

interface CandidateInterface extends ResourceInterface
{


  /**
   * @return Skill
   */
  public function getSkills();

  /**
   * @param Skill $skills
   */
  public function setSkills(Skill $skills): void;
}
