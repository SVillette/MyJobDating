<?php

namespace MyJobDating\Bundle\CoreBundle\Entity;

use DateTimeInterface;

interface TimestampableInterface
{
    /**
     * @return DateTimeInterface|null
     */
    public function getCreatedAt(): ?DateTimeInterface;

    /**
     * @param DateTimeInterface|null $date
     */
    public function setCreatedAt(?DateTimeInterface $date): void;

    /**
     * @return DateTimeInterface|null
     */
    public function getUpdatedAt(): ?DateTimeInterface;

    /**
     * @param DateTimeInterface|null $date
     */
    public function setUpdatedAt(?DateTimeInterface $date): void;
}
