<?php

namespace ORM\Objects;
class filmRating
{
    private $id;
    private $likes;
    private $dislikes;
    private $imdb;

    public function __construct($id, $likes, $dislikes, $imdb)
    {
        $this->id = $id;
        $this->likes = $likes;
        $this->dislikes = $dislikes;
        $this->imdb = $imdb;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getDislikes()
    {
        return $this->dislikes;
    }

    /**
     * @return mixed
     */
    public function getImdb()
    {
        return $this->imdb;
    }

    /**
     * @return mixed
     */
    public function getLikes()
    {
        return $this->likes;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @param mixed $dislikes
     */
    public function setDislikes($dislikes): void
    {
        $this->dislikes = $dislikes;
    }

    /**
     * @param mixed $imdb
     */
    public function setImdb($imdb): void
    {
        $this->imdb = $imdb;
    }

    /**
     * @param mixed $likes
     */
    public function setLikes($likes): void
    {
        $this->likes = $likes;
    }
}