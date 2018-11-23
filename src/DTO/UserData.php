<?php
declare(strict_types=1);

namespace App\DTO;

class UserData
{
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
     * @var bool
     */
    private $active = false;

    /**
     * @param string $firstName
     *
     * @return UserData
     */
    public function setFirstName(string $firstName): UserData
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * @param string $lastName
     *
     * @return UserData
     */
    public function setLastName(string $lastName): UserData
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * @param string $email
     *
     * @return UserData
     */
    public function setEmail(string $email): UserData
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->active;
    }

    /**
     * @param bool $active
     */
    public function setActive(bool $active = true): void
    {
        $this->active = $active;
    }
}
