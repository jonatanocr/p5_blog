<?php

namespace App\Entity;

class Post
{
    /**
     * @var int
     */
    protected $postId;

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
    protected $fkAuthor;

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
        return $this->postId;
    }

    /**
     * @param int $id
     */
    public function setId(int $postId): void
    {
        $this->postId = $postId;
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
    public function getFkAuthor()
    {
        return $this->fkAuthor;
    }

    /**
     * @param int $fkAuthor
     */
    public function setFkAuthor(int $fkAuthor)
    {
        $this->fkAuthor = $fkAuthor;
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

    /**
     * @return int
     */
    public function getReadingTime(): int
    {
        //Average reading speed for an adult is 200words/min
        return str_word_count($this->content)>200?(str_word_count($this->content)/200):1;
    }

}
