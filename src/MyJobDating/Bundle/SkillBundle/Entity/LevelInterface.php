<?php

namespace MyJobDating\Bundle\SkillBundle\Entity;

use MyJobDating\Bundle\CoreBundle\Entity\DeletableInterface;
use MyJobDating\Bundle\CoreBundle\Entity\ResourceInterface;
use MyJobDating\Bundle\CoreBundle\Entity\TimestampableInterface;
use MyJobDating\Bundle\CoreBundle\Entity\ToggleableInterface;

interface LevelInterface extends ResourceInterface, ToggleableInterface, TimestampableInterface, DeletableInterface
{
    /**
     * @return null|string
     */
    public function getName(): ?string;

    /**
     * @param null|string $name
     */
    public function setName(?string $name): void;

    /**
     * @return int|null
     */
    public function getValue(): ?int;

    /**
     * @param int|null $value
     */
    public function setValue(?int $value): void;
}
