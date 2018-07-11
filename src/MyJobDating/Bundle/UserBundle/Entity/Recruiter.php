<?php

namespace MyJobDating\Bundle\UserBundle\Entity;

use MyJobDating\Bundle\CoreBundle\Entity\ResourceTrait;

class Recruiter implements RecruiterInterface
{
   use ResourceTrait;

    /**
     * @var CompanyInterface
     */
   private $company;

    /**
     * @return CompanyInterface|null
     */
    public function getCompany(): ?CompanyInterface
    {
        return $this->company;
    }

    /**
     * @param CompanyInterface|null $company
     */
    public function setCompany(?CompanyInterface $company): void
    {
        $this->company = $company;
    }
}
