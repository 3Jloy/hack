<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;

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

    public function __construct(
        string $title,
        int $number,
        User $mentor,
        \DateTime $startDate,
        \DateTime $endDate,
        string $description,
        array $resources_links,
        Location $location
    ) {
        $this->title = $title;
        $this->number = $number;
        $this->mentor = $mentor;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->description = $description;
        $this->resources_links = new ArrayCollection($resources_links);
        $this->location = $location;
    }

    /**
     * @return mixed
     */
    public function getId()
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
     * @return int
     */
    public function getNumber(): int
    {
        return $this->number;
    }

    /**
     * @return User
     */
    public function getMentor(): User
    {
        return $this->mentor;
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

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return ResourceLink[]
     */
    public function getResourcesLinks(): array
    {
        return $this->resources_links->toArray();
    }

    /**
     * @return Location
     */
    public function getLocation(): Location
    {
        return $this->location;
    }

    /**
     * @return array
     */
    public function getNotes(): array
    {
        return $this->notes ?: [];
    }

    /**
     * @param array $notes
     * @return Event
     */
    public function setNotes(array $notes): Event
    {
        $this->notes = $notes;
        return $this;
    }
}