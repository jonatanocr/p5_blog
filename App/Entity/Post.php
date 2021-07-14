<?php

namespace App\Entity;

class Post
{
    /**
     * @var int
     */
    protected $id;

    // todo change type for date https://www.php.net/manual/en/language.types.declarations.php
    /**
     * @var string
     */
    protected $createdDate;

    /**
     * @var string
     */
    protected $updatedDate;

    /**
     * @var int
     */
    protected $fkUserCreate;

    /**
     * @var int
     */
    protected $fkUserUpdate;

    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $header;

    /**
     * @var string
     */
    protected $content;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getCreatedDate(): string
    {
        return $this->createdDate;
    }

    /**
     * @param string $createdDate
     */
    public function setCreatedDate(string $createdDate): void
    {
        $this->createdDate = $createdDate;
    }

    /**
     * @return string
     */
    public function getUpdatedDate(): string
    {
        return $this->updatedDate;
    }

    /**
     * @param string $updatedDate
     */
    public function setUpdatedDate(string $updatedDate): void
    {
        $this->updatedDate = $updatedDate;
    }

    /**
     * @return int
     */
    public function getFkUserCreate(): int
    {
        return $this->fkUserCreate;
    }

    /**
     * @param int $fkUserCreate
     */
    public function setFkUserCreate(int $fkUserCreate): void
    {
        $this->fkUserCreate = $fkUserCreate;
    }

    /**
     * @return int
     */
    public function getFkUserUpdate(): int
    {
        return $this->fkUserUpdate;
    }

    /**
     * @param int $fkUserUpdate
     */
    public function setFkUserUpdate(int $fkUserUpdate): void
    {
        $this->fkUserUpdate = $fkUserUpdate;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getHeader(): string
    {
        return $this->header;
    }

    /**
     * @param string $header
     */
    public function setHeader(string $header): void
    {
        $this->header = $header;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    public function index()
    {
        var_dump('index ok');
    }

}