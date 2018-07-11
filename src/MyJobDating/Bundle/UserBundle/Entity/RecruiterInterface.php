<?php

namespace MyJobDating\Bundle\UserBundle\Entity;

use MyJobDating\Bundle\CoreBundle\Entity\ResourceInterface;

interface RecruiterInterface extends ResourceInterface
{
    /**
     * @return CompanyInterface|null
     */
    public function getCompany(): ?CompanyInterface;

    /**
     * @param CompanyInterface|null $company
     */
    public function setCompany(?CompanyInterface $company): void;
}
