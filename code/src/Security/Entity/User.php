<?php

namespace App\Security\Entity;

use Symfony\Component\Security\Core\User\UserInterface;

class User implements UserInterface
{
    /**
     * @var string
     */
    private $phone;

    /**
     * @var string
     */
    private $apiKey;

    public function __construct($phone, $apiKey)
    {
        $this->phone = $phone;
        $this->apiKey = $apiKey;
    }

    /**
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @return mixed
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }

    /**
     * @param mixed $apiKey
     * @return User
     */
    public function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;
        return $this;
    }

    public function getRoles()
    {
        return ['ROLE_USER'];
    }

    public function getPassword()
    {
        return $this->apiKey;
    }

    public function getSalt()
    {
        return '';
    }

    public function getUsername()
    {
        return '';

    }

    public function eraseCredentials()
    {
    }
}