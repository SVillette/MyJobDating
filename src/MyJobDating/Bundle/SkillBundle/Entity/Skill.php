<?php
/**
 * Created by IntelliJ IDEA.
 * User: zeshi
 * Date: 6/14/18
 * Time: 10:53 AM
 */

namespace MyJobDating\Bundle\SkillBundle\Entity;


use MyJobDating\Bundle\CoreBundle\Entity\ResourceTrait;
use MyJobDating\Bundle\CoreBundle\Entity\TimestampableTrait;

class Skill {
    use ResourceTrait, TimestampableTrait;

    private $name;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }
}