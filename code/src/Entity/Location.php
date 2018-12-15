<?php

namespace App\Entity;

class Location
{
    /** @var string */
    private $title;

    /** @var string */
    private $logo;

    /** @var string */
    private $lat;

    /** @var string */
    private $long;

    /** @var string */
    private $description;

    /** @var Wifi */
    private $wifi;

    public function __construct(
        string $title,
        string $lat,
        string $long,
        string $description,
        Wifi $wifi
    ) {
        $this->title = $title;
        $this->lat = $lat;
        $this->long = $long;
        $this->description = $description;
        $this->wifi = $wifi;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getLogo(): ?string
    {
        return $this->logo;
    }

    /**
     * @return string
     */
    public function getLat(): string
    {
        return $this->lat;
    }

    /**
     * @return string
     */
    public function getLong(): string
    {
        return $this->long;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return Wifi
     */
    public function getWifi(): Wifi
    {
        return $this->wifi;
    }
}