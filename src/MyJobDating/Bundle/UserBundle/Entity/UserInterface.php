<?php

namespace MyJobDating\Bundle\UserBundle\Entity;

use MyJobDating\Bundle\CoreBundle\Entity\DeletableInterface;
use MyJobDating\Bundle\CoreBundle\Entity\ResourceInterface;
use MyJobDating\Bundle\CoreBundle\Entity\TimestampableInterface;
use MyJobDating\Bundle\CoreBundle\Entity\ToggleableInterface;
use Symfony\Component\Security\Core\User\UserInterface as SecurityUserInterface;

interface UserInterface extends
    ResourceInterface,
    SecurityUserInterface,
    ToggleableInterface,
    TimestampableInterface,
    DeletableInterface
{
    /**
     * @return null|string
     */
    public function getFirstName(): ?string;

    /**
     * @param null|string $firstName
     */
    public function setFirstName(?string $firstName): void;

    /**
     * @return null|string
     */
    public function getLastName(): ?string;

    /**
     * @param null|string $lastName
     */
    public function setLastName(?string $lastName): void;

    /**
     * @return null|string
     */
    public function getEmail(): ?string;

    /**
     * @param null|string $email
     */
    public function setEmail(?string $email): void;

    /**
     * @return null|string
     */
    public function getPlainPassword(): ?string;

    /**
     * @param null|string $plainPassword
     */
    public function setPlainPassword(?string $plainPassword): void;

    /**
     * @return int
     */
    public function getRole(): int;

    /**
     * @param int $role
     */
    public function setRole(int $role): void;

    /**
     * @return CandidateInterface|null
     */
    public function getCandidate(): ?CandidateInterface;

    /**
     * @param CandidateInterface|null $candidate
     */
    public function setCandidate(?CandidateInterface $candidate): void;

    /**
     * @return RecruiterInterface|null
     */
    public function getRecruiter(): ?RecruiterInterface;

    /**
     * @param RecruiterInterface|null $recruiter
     */
    public function setRecruiter(?RecruiterInterface $recruiter): void;
}
