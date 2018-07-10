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


      /**
       * @return Skill
       */
      public function getSkills(){

            return $this->skills;
      }

      /**
       * @param Skill $skills
       */
      public function setSkills(Skill $skills): void{
        
            $this->skills = $skills;
      }
}
