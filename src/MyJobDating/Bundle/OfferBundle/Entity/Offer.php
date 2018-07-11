<?php

namespace MyJobDating\Bundle\OfferBundle\Entity;

use MyJobDating\Bundle\CoreBundle\Entity\DeletableTrait;
use MyJobDating\Bundle\CoreBundle\Entity\ResourceTrait;
use MyJobDating\Bundle\CoreBundle\Entity\TimestampableTrait;
use MyJobDating\Bundle\CoreBundle\Entity\ToggleableTrait;

class Offer {
    use ResourceTrait, TimestampableTrait, ToggleableTrait, DeletableTrait;

    private $title;
    private $description;
    private $recruiter;
    private $skills;

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getRecruiter()
    {
        return $this->recruiter;
    }

    /**
     * @return mixed
     */
    public function getSkills()
    {
        return $this->skills;
    }

    /**
     * @param mixed $skills
     */
    public function setSkills($skills): void
    {
        $this->skills = $skills;
    }
}