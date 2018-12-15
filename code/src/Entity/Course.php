<?php

namespace App\Entity;

class Course
{
    /** @var int */
    private $id;

    /** @var string */
    private $title;

    /** @var Region */
    private $region;

    /** @var \DateTime */
    private $startDate;

    /** @var \DateTime */
    private $endDate;
}