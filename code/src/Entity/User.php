<?php

namespace App\Entity;

class User
{
    /** @var integer */
    private $id;

    /** @var string */
    private $name;

    /** @var string */
    private $surname;

    /** @var string  */
    private $phone;

    /** @var string */
    private $email;

    /** @var string */
    private $current_job;

    /** @var string */
    private $about;

    /** @var string */
    private $photo;

    /** @var bool */
    private $is_mentor;

    /** @var array */
    private $homeWorks;

    public function __construct(string $email)
    {
        $this->email = $email;
    }
}
