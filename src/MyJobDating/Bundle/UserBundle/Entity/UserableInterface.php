<?php

namespace MyJobDating\Bundle\UserBundle\Entity;

interface UserableInterface
{
    /**
     * @return UserInterface|null
     */
    public function getUser(): ?UserInterface;

    /**
     * @param UserInterface|null $user
     */
    public function setUser(?UserInterface $user): void;
}
