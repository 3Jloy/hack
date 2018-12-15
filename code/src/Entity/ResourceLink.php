<?php

namespace App\Entity;

class ResourceLink
{
    const TYPE_PRESENTATION = 0;
    const TYPE_HOMEWORK = 1;

    /** @var int */
    private $id;

    /** @var string */
    private $title;

    /** @var string */
    private $link;

    /** @var int */
    private $type;

    public function __construct(string $title, string $link, int $type)
    {
        $this->title = $title;
        $this->link = $link;
        $this->type = $type;
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
     * @return string
     */
    public function getLink(): string
    {
        return $this->link;
    }

    /**
     * @return mixed
     */
    public function getType(): int
    {
        return $this->type;
    }
}