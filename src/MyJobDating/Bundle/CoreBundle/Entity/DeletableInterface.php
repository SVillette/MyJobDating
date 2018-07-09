<?php

namespace MyJobDating\Bundle\CoreBundle\Entity;

use DateTimeInterface;

interface DeletableInterface
{
    /**
     * @return DateTimeInterface|null
     */
    public function getDeletedAt(): ?DateTimeInterface;

    /**
     * @param DateTimeInterface|null $deletedAt
     */
    public function setDeletedAt(?DateTimeInterface $deletedAt): void;
}