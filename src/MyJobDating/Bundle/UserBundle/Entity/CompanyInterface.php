<?php

namespace MyJobDating\Bundle\UserBundle\Entity;

use MyJobDating\Bundle\CoreBundle\Entity\DeletableInterface;
use MyJobDating\Bundle\CoreBundle\Entity\ResourceInterface;
use MyJobDating\Bundle\CoreBundle\Entity\TimestampableInterface;

interface CompanyInterface extends
    ResourceInterface,
    TimestampableInterface,
    DeletableInterface
{
    /**
     * @return null|string
     */
    public function getName(): ?string;

    /**
     * @param null|string $name
     */
    public function setName(?string $name): void;
}
