<?php

namespace MyJobDating\Bundle\UserBundle\Entity;

use Doctrine\Common\Collections\Collection;
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
     * @var Skill[]|Collection
     */
    private $skills;

    /**
     * @var User
     */
    private $user;


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
     * @return Skill[]|Collection
     */
    public function getSkills(): Collection
    {
        return $this->skills;
    }

    /**
     * @param Collection|array $skills
     */
    public function setSkills(?array $skills): void
    {
        $this->skills = $skills;
    }

    /**
     * @return User|null
     */
    public function getUser(): ?User
    {
        return $this->user;
    }

    /**
     * @param User|null $user
     */
    public function setUser(?User $user): void
    {
        $this->user = $user;
    }
}
