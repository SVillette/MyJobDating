<?php

namespace MyJobDating\Bundle\UserBundle\Entity;

use MyJobDating\Bundle\CoreBundle\Entity\DeletableTrait;
use MyJobDating\Bundle\CoreBundle\Entity\ResourceTrait;
use MyJobDating\Bundle\CoreBundle\Entity\TimestampableTrait;
use MyJobDating\Bundle\CoreBundle\Entity\ToggleableTrait;
use Serializable;

class User implements UserInterface, Serializable
{
    use ResourceTrait, TimestampableTrait, ToggleableTrait, DeletableTrait;

    public const ROLE_CANDIDATE = 1;
    public const ROLE_RECRUITER = 2;
    public const ROLE_ADMIN = 3;

    /**
     * @var string
     */
    private $firstName;

    /**
     * @var string
     */
    private $lastName;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $password;

    /**
     * @var string
     */
    private $plainPassword;

    /**
     * @var int
     */
    private $role;

    /**
     * Returns the username used to authenticate the user.
     *
     * @return string The username
     */
    public function getUsername()
    {
        return $this->getEmail();
    }

    /**
     * @return null|string
     */
    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    /**
     * @param null|string $firstName
     */
    public function setFirstName(?string $firstName): void
    {
        $this->firstName = $firstName;
    }

    /**
     * @return null|string
     */
    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    /**
     * @param null|string $lastName
     */
    public function setLastName(?string $lastName): void
    {
        $this->lastName = $lastName;
    }

    /**
     * @return null|string
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param null|string $email
     */
    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    /**
     * Returns the password used to authenticate the user.
     *
     * @return string The password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param null|string $password
     */
    public function setPassword(?string $password): void
    {
        $this->password = $password;
    }

    /**
     * @return null|string
     */
    public function getPlainPassword(): ?string
    {
        return $this->plainPassword;
    }

    /**
     * @param null|string $plainPassword
     */
    public function setPlainPassword(?string $plainPassword): void
    {
        $this->plainPassword = $plainPassword;
    }

    /**
     * @return int
     */
    public function getRole(): int
    {
        return $this->role;

    }

    /**
     * @param int $role
     */
    public function setRole(int $role): void
    {
        $this->role = $role;
    }

    /**
     * Returns the roles granted to the user.
     *
     * @return array (Role|string)[] The user roles
     */
    public function getRoles()
    {
        switch ($this->getRole()) {
            case self::ROLE_CANDIDATE:
                return array('ROLE_CANDIDATE');
            case self::ROLE_RECRUITER:
                return array('ROLE_RECRUITER');
            case self::ROLE_ADMIN:
                return array('ROLE_ADMIN');
            default:
                return array();
        }
    }

    /**
     * Returns the salt that was originally used to encode the password.
     *
     * @return string|null The salt
     */
    public function getSalt()
    {
        return null; //use bcrypt no need to add salt
    }

    /**
     * Removes sensitive data from the user.
     */
    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    /**
     * @return string
     */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->email,
            $this->password
        ));
    }

    /**
     * @param string $serialized
     */
    public function unserialize($serialized)
    {
        list(
            $this->id,
            $this->email,
            $this->password
            ) = unserialize($serialized);
    }

    /**
     * @return CandidateInterface|null
     */
    public function getCandidate(): ?CandidateInterface
    {
        return $this->candidate;
    }

    /**
     * @param CandidateInterface|null $candidate
     */
    public function setCandidate(?CandidateInterface $candidate): void
    {
        $this->candidate = $candidate;
    }

    /**
     * @return RecruiterInterface|null
     */
    public function getRecruiter(): ?RecruiterInterface
    {
        return $this->recruiter;
    }

    /**
     * @param RecruiterInterface|null $recruiter
     */
    public function setRecruiter(?RecruiterInterface $recruiter): void
    {
        $this->recruiter = $recruiter;
    }
}
