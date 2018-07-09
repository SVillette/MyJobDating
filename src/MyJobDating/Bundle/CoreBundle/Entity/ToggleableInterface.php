<?php

namespace MyJobDating\Bundle\CoreBundle\Entity;

interface ToggleableInterface
{
    /**
     * @return bool|null
     */
    public function isEnabled(): ?bool;

    /**
     * @param bool $enabled
     */
    public function setEnabled(?bool $enabled): void;

    public function enable(): void;

    public function disable(): void;
}
