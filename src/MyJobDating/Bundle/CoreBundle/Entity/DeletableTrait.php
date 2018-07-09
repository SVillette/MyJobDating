<?php

namespace MyJobDating\Bundle\CoreBundle\Entity;

use DateTimeInterface;

trait DeletableTrait
{
    /**
     * @var DateTimeInterface|null
     */
    protected $deletedAt;

    /**
     * @return DateTimeInterface|null
     */
    public function getDeletedAt(): ?DateTimeInterface
    {
        return $this->deletedAt;
    }

    /**
     * @param DateTimeInterface|null $deletedAt
     */
    public function setDeletedAt(?DateTimeInterface $deletedAt): void
    {
        $this->deletedAt = $deletedAt;
    }
}