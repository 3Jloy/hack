<?php

namespace App\Entity;

class Wifi
{
    /** @var string */
    private $name;

    /** @var string */
    private $login;

    /** @var string */
    private $password;

    public function __construct(
        string $name,
        string $login,
        string $password
    )
    {
        /** @var string */
        $this->name = $name;

        /** @var string */
        $this->login = $login;

        /** @var string */
        $this->password = $password;
    }
}