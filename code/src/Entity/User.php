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

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return User
     */
    public function setName(string $name): User
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getSurname(): ?string
    {
        return $this->surname;
    }

    /**
     * @param string $surname
     * @return User
     */
    public function setSurname(string $surname): User
    {
        $this->surname = $surname;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     * @return User
     */
    public function setPhone(string $phone): User
    {
        $this->phone = $phone;
        return $this;
    }

    /**
     * @return string
     */
    public function getCurrentJob(): ?string
    {
        return $this->current_job;
    }

    /**
     * @param string $current_job
     * @return User
     */
    public function setCurrentJob(string $current_job): User
    {
        $this->current_job = $current_job;
        return $this;
    }

    /**
     * @return string
     */
    public function getAbout(): ?string
    {
        return $this->about;
    }

    /**
     * @param string $about
     * @return User
     */
    public function setAbout(string $about): User
    {
        $this->about = $about;
        return $this;
    }

    /**
     * @return string
     */
    public function getPhoto(): ?string
    {
        return 'http://aa.swapp.ga/' . $this->photo;
    }

    /**
     * @param string $photo
     * @return User
     */
    public function setPhoto(string $photo): User
    {
        $this->photo = $photo;
        return $this;
    }

    /**
     * @return bool
     */
    public function isMentor(): ?bool
    {
        return $this->is_mentor;
    }

    /**
     * @param bool $is_mentor
     * @return User
     */
    public function setIsMentor(bool $is_mentor): User
    {
        $this->is_mentor = $is_mentor;
        return $this;
    }

    /**
     * @return array
     */
    public function getHomeWorks(): array
    {
        return $this->homeWorks ?: [];
    }

    /**
     * @param array $homeWorks
     * @return User
     */
    public function setHomeWorks(array $homeWorks): User
    {
        $this->homeWorks = $homeWorks;
        return $this;
    }
}
