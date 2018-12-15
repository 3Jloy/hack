<?php

namespace App\Entity;

class Event
{
    /** @var  */
    private $id;

    /** @var string */
    private $title;

    /** @var int */
    private $number;

    /** @var User */
    private $mentor;

    /** @var \DateTime */
    private $startDate;

    /** @var \DateTime */
    private $endDate;

    /** @var string */
    private $description;

    /** @var ResourceLink[] */
    private $resources_links;

    /** @var Location */
    private $location;

    /** @var array */
    private $notes;
}