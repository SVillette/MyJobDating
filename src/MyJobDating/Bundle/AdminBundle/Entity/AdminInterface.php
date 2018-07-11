<?php

namespace MyJobDating\Bundle\AdminBundle\Entity;

use MyJobDating\Bundle\CoreBundle\Entity\ResourceInterface;
use Symfony\Component\Security\Core\User\UserInterface as SecurityUserInterface;
use MyJobDating\Bundle\CoreBundle\Entity\ToggleableInterface;
use MyJobDating\Bundle\CoreBundle\Entity\TimestampableInterface;
use MyJobDating\Bundle\CoreBundle\Entity\DeletableInterface;

interface AdminInterface extends
    ResourceInterface,
    SecurityUserInterface,
    ToggleableInterface,
    TimestampableInterface,
    DeletableInterface
{
    /**
     * @return null|string
     */
    public function getEmail(): ?string;

    /**
     * @param null|string $email
     */
    public function setEmail(?string $email): void;

    /**
     * @param null|string $password
     */
    public function setPassword(?string $password): void;

    /**
     * @return null|string
     */
    public function getPlainPassword(): ?string;

    /**
     * @param null|string $plainPassword
     */
    public function setPlainPassword(?string $plainPassword): void;
}
