<?php

namespace App\Entity;

class EventTicket
{
    /** @var int */
    private $id;

    /** @var User */
    private $user;

    /** @var Event */
    private $event;

    /** @var bool */
    private $is_confirmed;

    /** @var bool */
    private $is_visited;

    public function __construct(User $user, Event $event)
    {
        $this->user = $user;
        $this->event = $event;
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
     * @return bool
     */
    public function isConfirmed(): bool
    {
        return $this->is_confirmed ?: false;
    }

    /**
     * @param bool $is_confirmed
     * @return EventTicket
     */
    public function setIsConfirmed(bool $is_confirmed): EventTicket
    {
        $this->is_confirmed = $is_confirmed;
        return $this;
    }

    /**
     * @return bool
     */
    public function isVisited(): bool
    {
        return $this->is_visited ?: false;
    }

    /**
     * @param bool $is_visited
     * @return EventTicket
     */
    public function setIsVisited(bool $is_visited): EventTicket
    {
        $this->is_visited = $is_visited;
        return $this;
    }
}