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
}