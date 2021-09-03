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
    protected $fkAuthor;

    /**
     * @var object
     */
    protected $author;

    /**
     * @var int
     */
    protected $fkPost;

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
    public function getFkAuthor(): int
    {
        return $this->fkAuthor;
    }

    /**
     * @param int
     */
    public function setFkAuthor(int $fkAuthor)
    {
        $this->fkAuthor = $fkAuthor;
    }

    /**
     * @param object
     */
    public function getAuthor()
    {

        return $this->author;

    }

    /**
     * @param object
     */
    public function setAuthor(object $author)
    {
        if ($author instanceof User) {
            $this->author = $author;
        }
    }

    /**
     * @return int
     */
    public function getFkPost(): int
    {
        return $this->fkPost;
    }

    /**
     * @param int $fkPost
     */
    public function setFkPost(int $fkPost)
    {
        $this->fkPost = $fkPost;
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
