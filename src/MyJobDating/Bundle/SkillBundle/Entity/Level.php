<?php

namespace MyJobDating\Bundle\SkillBundle\Entity;

use MyJobDating\Bundle\CoreBundle\Entity\DeletableTrait;
use MyJobDating\Bundle\CoreBundle\Entity\ResourceTrait;
use MyJobDating\Bundle\CoreBundle\Entity\TimestampableTrait;
use MyJobDating\Bundle\CoreBundle\Entity\ToggleableTrait;

class Level implements LevelInterface
{
    use ResourceTrait, ToggleableTrait, TimestampableTrait, DeletableTrait;

    /**
     * @var string
     */
    private $name;

    /**
     * @var integer
     */
    private $value;

    /**
     * @return null|string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param null|string $name
     */
    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return int|null
     */
    public function getValue(): ?int
    {
        return $this->value;
    }

    /**
     * @param null|integer $value
     */
    public function setValue(?int $value): void
    {
        $this->value = $value;
    }
}
