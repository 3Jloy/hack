<?php

namespace App\Entity;

class Note
{
    private $id;

    private $user;

    private $event;

    private $text;

    public function __construct(User $user, Event $event, string $text)
    {
        $this->user = $user;
        $this->event = $event;
        $this->text = $text;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @return Event
     */
    public function getEvent(): Event
    {
        return $this->event;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }
}