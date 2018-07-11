<?php

namespace MyJobDating\Bundle\SkillBundle\Entity;

use MyJobDating\Bundle\CoreBundle\Entity\ResourceTrait;
use MyJobDating\Bundle\CoreBundle\Entity\TimestampableTrait;

class Skill {
    use ResourceTrait, TimestampableTrait;

    private $name;

    /**
     * @param null|string $name
     */
    public function __construct(?string $name = "")
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param null|string $name
     */
    public function setName(?string $name = "")
    {
        $this->name = $name;
    }
}