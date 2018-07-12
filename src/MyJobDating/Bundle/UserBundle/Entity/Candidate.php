<?php

namespace MyJobDating\Bundle\UserBundle\Entity;

use MyJobDating\Bundle\CoreBundle\Entity\ResourceTrait;
use MyJobDating\Bundle\SkillBundle\Entity\Skill;

class Candidate implements CandidateInterface
{
    use ResourceTrait;

    /**
     * @var string|null
     */
    private $description;

    /**
     * @var Skill
     */
    private $skills;


    /**
     * @return null|string
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param null|string $description
     */
    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return Skill
     */
    public function getSkills(): ?Skill
    {

        return $this->skills;
    }

    /**
     * @param null|Skill $skills
     */
    public function setSkills(?Skill $skills): void
    {

        $this->skills = $skills;
    }
}
