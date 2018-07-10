<?php

namespace MyJobDating\Bundle\UserBundle\Entity;

trait UserableTrait
{
    /**
     * @var User
     */
    private $user;

    /**
     * @return User|null
     */
    public function getUser(): ?UserInterface
    {
        return $this->user;
    }

    /**
     * @param UserInterface|null $user
     */
    public function setUser(?UserInterface $user): void
    {
        $this->user = $user;
    }
}
