<?php

namespace App\Entity;

class Comment
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
     * @var int
     */
    protected $fkUserCreate;

    /**
     * @var int
     */
    protected $verified;

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
    public function getVerified(): int
    {
        return $this->verified;
    }

    /**
     * @param int $verified
     */
    public function setVerified(int $verified): void
    {
        $this->verified = $verified;
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
}