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
     * @var array
     */
   private $offers;

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

    /**
     * @return array
     */
    public function getOffers(): ?array
    {
        return $this->offers;
    }

    /**
     * @param array $offers
     */
    public function setOffers(array $offers): void
    {
        $this->offers = $offers;
    }


}
