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

    public function __construct(
        string $title,
        \DateTime $startDate,
        \DateTime $endDate
    ) {
        $this->title = $title;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
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
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return Region
     */
    public function getRegion(): Region
    {
        return $this->region;
    }

    /**
     * @return \DateTime
     */
    public function getStartDate(): \DateTime
    {
        return $this->startDate;
    }

    /**
     * @return \DateTime
     */
    public function getEndDate(): \DateTime
    {
        return $this->endDate;
    }
}