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
     * @var object
     */
    protected $userCreate;

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
    public function setId(int $id)
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
     * @param string
     */
    public function setCreatedDate(string $createdDate)
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
     * @param int
     */
    public function setFkUserCreate(int $fkUserCreate)
    {
        $this->fkUserCreate = $fkUserCreate;
    }

    /**
     * @param int
     */
    public function setUserCreate(object $userCreate)
    {
        if ($userCreate instanceof User) {
            $this->UserCreate = $userCreate;
        }
    }

    /**
     * @return int
     */
    public function getVerified(): int
    {
        return $this->verified;
    }

    /**
     * @param int
     */
    public function setVerified(int $verified)
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
     * @param string
     */
    public function setContent(string $content)
    {
        $this->content = $content;
    }
}