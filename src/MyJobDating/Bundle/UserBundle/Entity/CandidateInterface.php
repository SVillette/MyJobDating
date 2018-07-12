<?php

namespace MyJobDating\Bundle\UserBundle\Entity;

use MyJobDating\Bundle\CoreBundle\Entity\ResourceInterface;
use MyJobDating\Bundle\SkillBundle\Entity\Skill;

interface CandidateInterface extends ResourceInterface
{

    /**
     * @return null|string
     */
    public function getDescription(): ?string;

    /**
     * @param null|string $description
     */
    public function setDescription(?string $description): void;

    /**
     * @return null|Skill
     */
    public function getSkills(): ?Skill;

    /**
     * @param null|Skill $skills
     */
    public function setSkills(?Skill $skills): void;
}
