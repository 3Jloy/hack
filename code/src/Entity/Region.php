<?php

namespace App\Entity;

class Region
{
    /** @var int */
    private $id;

    /** @var string */
    private $title;

    public function __construct(string $title)
    {
        $this->title = $title;
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
}