<?php

namespace MyJobDating\Bundle\UserBundle\Entity;

use Doctrine\Common\Collections\Collection;
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
     * @return Skill[]|Collection
     */
    public function getSkills(): ?Collection ;

    /**
     * @param Collection|array $skills
     */
    public function setSkills(?array $skills): void;

    /**
     * @return User|null
     */
    public function getUser(): ?User;

    /**
     * @param User|null $user
     */
    public function setUser(?User $user): void;
}
